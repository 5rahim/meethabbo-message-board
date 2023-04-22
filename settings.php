<?php

require 'brain/core.php';

$page = "Paramètres";

$user->restrict();
$user->restrictBan();
$user->restrictByFirstco();

if (url('no_greeting') and urlVal('no_greeting') == "true") {
  $_SESSION['no_greeting'] = "true";
  redirect('index');
  exit();
}

if (url('no_greeting') and urlVal('no_greeting') == "false") {
  unset($_SESSION['no_greeting']);
  redirect('index');
  exit();
}

if (trigger('edit_email_button')) {
  if (getField('edit_email')) {
    if ($user->editEmail(field('edit_email'))) {
      alert("success", "L'adresse email a bien été modifée");
      redirect('settings?page=infos');
      exit();
    } else {
      alert("error", "Une erreur est survenue");
      redirect('settings?page=infos');
      exit();
    }
  } else {
    alert("error", "Veuillez proposer une nouvelle adresse email");
    redirect('settings?page=infos');
    exit();
  }

}

if (trigger('edit_textamigo_button')) {
  if (field('edit_textamigo') == 1 or field('edit_textamigo') == 0) {
    if ($user->editTextamigo(field('edit_textamigo'))) {
      alert("success", "Modification effectuée");
      redirect('settings?page=infos');
      exit();
    } else {
      alert("error", "Une erreur est survenue");
      redirect('settings?page=infos');
      exit();
    }
  } else {
    alert("error", "Une errur est survenur");
    redirect('settings?page=infos');
    exit();
  }

}

// Changer son mot de passe
if (trigger('edit_password_button')) {
	if (getfield('edit_ancien_password') and getField('edit_password') and getField('edit_password_confirm')) {
		if(lenghtPassword('edit_password')) {
			$ancien_pass = field('edit_ancien_password');
			$new_pass = field('edit_password');
			$new_passre = field('edit_password_confirm');
			if (passhash($ancien_pass) == $user->info('password')) {
				if ($new_pass == $new_passre) {
					$new_pass_final = passhash($new_pass);
					$sql = $bdd->prepare('UPDATE users SET password = ? WHERE token = ? ');
					$sql->execute(array($new_pass_final,$_SESSION['auth']['token']));

					alert("success", "Votre mot de passe a bien été modifié");
					redirect('settings?page=secu');
					exit();
				} else {
					alert("error", "Les deux mots de passe ne se correspondent pas");
					redirect('settings?page=secu');
					exit();
				}
			} else {
				alert("error", "Le mot de passe entré ne correspond pas à votre mot de passe actuel");
				redirect('settings?page=secu');
				exit();
			}
		} else {
			alert("error", "Les mots de passe doivent faire au moins 6 caractères");
			redirect('settings?page=secu');
			exit();
		}
	} else {
		alert("error", "Veuillez remplir tous les champs");
		redirect('settings?page=secu');
		exit();
	}
}

include 'inc/header.php';

include 'inc/top.php';

?>

<div class="container">
  <div class="under-menu">
    <ul>
      <?php if (isset($_GET['page'])): ?>
        <li><a href="settings"><i class="fa fa-cogs"></i> <?= $user->info('pseudo') ?></a></li>
        <li><a href="?page=infos" <?php if($_GET['page'] == "infos") { echo 'class="active"'; } ?>><i class="fa fa-user"></i> Informations personnelles</a></li>
        <li><a href="?page=secu" <?php if($_GET['page'] == "secu") { echo 'class="active"'; } ?>><i class="fa fa-lock"></i> Confidentialité</a></li>
      <?php else: ?>
        <li><a href="settings"><i class="fa fa-cogs"></i> <?= $user->info('pseudo') ?></a></li>
        <li><a href="?page=infos"><i class="fa fa-user"></i> Informations personnelles</a></li>
        <li><a href="?page=secu"><i class="fa fa-lock"></i> Confidentialité</a></li>
      <?php endif; ?>
    </ul>
  </div>
</div>

<?php if (!isset($_GET['page'])): ?>
  <div class="settings-box _4dgb" style="padding:15px 15px 15px 220px;">
    <div class="settings-box-image"></div>
    <span>Bienvenue dans vos paramètres, ici, vous pourrez modifier tous ce qui vous concèrne. Faites bien attention à garder des informations personnelles, privées. Vous pouvez modifier votre email, votre mot de passe, et réguler les demandes d'amis.</span>
  </div>
<?php endif; ?>
<?php if (isset($_GET['page']) and $_GET['page'] == "infos"): ?>
  <div class="settings-box">
    <form method="POST">
      <div class="settings-box-title"><i class="fa fa-envelope"></i> Changer mon email</div>
      <input type="email" name="edit_email" placeholder="Nouvelle adresse email" class="field field-expanded">
      <button class="button" name="edit_email_button">Changer</button>
    </form>
  </div>
  <div class="settings-box" style="border-top-left-radius: 6px;border-top-right-radius: 6px;">
    <form method="POST">
      <div class="settings-box-title"><i class="fa fa-user-plus"></i> Accepter les demandes d'amis</div>
      <select name="edit_textamigo" class="field field-expanded">
        <option value="1" <?php if($user->info('textamigo') == 1) { echo 'selected'; } ?>>Oui</option>
        <option value="0" <?php if($user->info('textamigo') == 0) { echo 'selected'; } ?>>Non</option>
      </select>
      <button class="button" name="edit_textamigo_button">Changer</button>
    </form>
  </div>
<?php endif; ?>
<?php if (isset($_GET['page']) and $_GET['page'] == "secu"): ?>
  <div class="settings-box">
    <form method="POST">
      <div class="settings-box-title"><i class="fa fa-lock"></i> Changer mon mot de passe</div>
      <input type="password" name="edit_ancien_password" placeholder="Mot de passe actuel" class="field field-expanded">
      <input type="password" name="edit_password" placeholder="Nouveau mot de passe" class="field field-expanded">
      <input type="password" name="edit_password_confirm" placeholder="Nouveau mot de passe" class="field field-expanded">
      <button class="button" name="edit_password_button">Changer</button>
    </form>
  </div>
<?php endif; ?>

<?php

 include 'inc/bottom.php';

include 'inc/footer.php';

?>
