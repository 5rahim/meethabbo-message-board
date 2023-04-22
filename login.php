<?php

require 'brain/core.php';

$page = "Connexion";

// $user->restrictConnected();
// test
if (trigger('login_button')) {
  if (getField('login_pseudo') and getField('login_password')) {
    if ($user->existUser("pseudo",field('login_pseudo'))) {
      if ($user->existUserWith(field('login_pseudo'), passhash(field('login_password')))) {
        /*if (!$user->isBanned(field('login_pseudo'))) {*/
          if ($user->login(field('login_pseudo'))) {
            if ($user->firstConnection(field('login_pseudo')) > 0) {
              alert("success","Rebienvenue sur MeetHabbo");
              redirect('index');
              exit();
            } else {
              alert("success","Bienvenue sur MeetHabbo");
              redirect('firstconnection?token='.$user->get("token","pseudo",field('login_pseudo')).'');
              exit();
            }
            exit();
          } else {
            alert("error","Une erreur est survenue");
            redirect('login');
            exit();
          }
        /*} else {
          alert("error","Cet utilisateur est banni");
          redirect('login');
          exit();
        }*/

      } else {
        alert("error","Le mot de passe est incorrect");
        redirect('login');
        exit();
      }
    } else {
      alert("error","Ce membre n'existe pas");
      redirect('login');
      exit();
    }
  } else {
    alert("error","Veuillez remplir tous les champs");
    redirect('login');
    exit();
  }
}
//
if (trigger('register_button')) {
  if ($settings->option("register_close") < 1) {
    if (getField('register_pseudo') and getField('register_email') and getField('register_retro') and getField('register_password') and getField('register_password_confirm')) {
      if (correctPseudo(secu(field('register_pseudo')))) {
        if (lenghtPseudo(field('register_pseudo'))) {
          if (!$user->existUser("pseudo",field('register_pseudo'))) {
            if (!$user->existUser("email",field('register_email'))) {
              if (lenghtPassword(field('register_password'))) {
                if (samePasswords(field('register_password'), field('register_password_confirm'))) {
                  $password_final = passhash(field('register_password'));
                  $register_pseudo = secu(field('register_pseudo'));
                  $register_email = secu(field('register_email'));
                  $register_retro = secu(field('register_retro'));
                  $user->addUser($register_pseudo,$password_final,$register_email,$register_retro);
                  alert("success","Votre inscription est terminée, vous pouvez vous connecter à présent");
                  redirect('login');
                  exit();
                } else {
                  alert("error","Les deux mots de passes entrés ne sont pas les mêmes");
                  redirect('login');
                  exit();
                }
              } else {
                alert("error","Le mot de passe entré doit faire au moins 6 caractères");
                redirect('login');
                exit();
              }
            } else {
              alert("error","L'email entrée est déjà utilisée");
              redirect('login');
              exit();
            }
          } else {
            alert("error","Le pseudo entré est déjà utilisé");
            redirect('login');
            exit();
          }
        } else {
          alert("error","Votre pseudo est trop court");
          redirect('login');
          exit();
        }
      } else {
        alert("error","Votre pseudo n'est pas correct");
        redirect('login');
        exit();
      }
    } else {
      alert("error","Veuillez remplir tous les champs");
      redirect('login');
      exit();
    }
  } else {
    alert("error","Les inscriptions sont désactivées pour le moment. Réessai plus tard");
    redirect('login');
    exit();
  }

}

include 'inc/header.php'; ?>

<div class="login-wrapper">
  <div class="login-logo">
    <img src="brain/style/img/meet_logo_login.png" alt="" />
  </div>
  <div class="login-box text-light">
    <div class="column small-12">
      <p>MeetHabbo, le forum de discussion, d'animation et de partage. Rencontrez des gens venus d'horizons diverses.</p>
    </div>
    <div class="column small-12">
      <form method="POST">
        <input type="text" name="register_pseudo" placeholder="Pseudonyme" class="field field-expanded">
        <input type="email" name="register_email" placeholder="Adresse email" class="field field-expanded">
        <select name="register_retro" placeholder="Dans quek retro es-tu ?" value="Dans quel retro es-tu ?" id="" class="field field-expanded">
          <option value="0">Choisis un rétro...</option>
          <?php
            $retro->list();
           ?>
        </select>
        <input type="password" name="register_password" placeholder="Mot de passe" class="field field-expanded">
        <input type="password" name="register_password_confirm" placeholder="Confirmer le mot de passe" class="field field-expanded">
        <button class="button button-expanded" name="register_button">S'inscrire</button>
        <a class="button button-success button-expanded button-modal" data-modal="modal-login">Déjà inscris ?</a>
      </form>
    </div>
  </div>
</div>

<div id="modal-login" class="modal">
<div class="modal-content">
  <div class="modal-header">
    <span class="close button-close" data-close="modal-login">×</span>
    <h2>Entrer dans MeetHabbo</h2>
  </div>
  <div class="modal-body">

    <div class="modal-image">
      <img src="brain/style/img/meet_welcome.png" alt="">
    </div>

      <form method="POST">
        <label for="">Pseudonyme</label>
        <input type="text" class="field field-expanded" name="login_pseudo">
        <label for="">Mot de passe</label>
        <input type="password" class="field field-expanded" name="login_password">
        <br>
        <button class="button button-success linkOpen" name="login_button" data-closemodal="" data-openmodal="">Confirmer</button>
        <a class="button button-error pull-right button-close" data-close="modal-login" data-openmodal="">Annuler</a>
      </form>


  </div>
</div>

</div>

<?php include 'inc/footer.php';

?>
