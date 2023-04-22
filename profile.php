<?php

require 'brain/core.php';

$page = "Profil";

$user->restrict();
$user->restrictBan();
$user->restrictByFirstco();

$user->checkProfile(urlVal('user'));

// Changer sa photo de profil
  if (trigger('edit_picture_button')) {
    $image_name = secu($_FILES['edit_picture']['name']);
    $image_tmp = secu($_FILES['edit_picture']['tmp_name']);
    $image_size = secu($_FILES['edit_picture']['size']);
    $dir = "brain/style/img/bank/";
    $maxsize = 99999999999999999999999999; // Taille en bytes (octets)
    if($_FILES['edit_picture']['size'] > $maxsize){
      alert("error", "L'image est trop lourde");
     redirect('profile?user='.urlVal('user').'');
     exit();
    } else {
       if(($_FILES['edit_picture']['type'] == 'image/gif') || ($_FILES['edit_picture']['type'] == 'image/jpeg') || ($_FILES['edit_picture']['type'] == 'image/png') || ($_FILES['edit_picture']['type'] == 'image/jpg') || ($_FILES['edit_picture']['type'] == 'jpg')) {
        $image_name_final = passhash($image_name.time());
        $path = $_FILES['edit_picture']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        if(move_uploaded_file($image_tmp,$dir .($image_name_final.'.'.$ext))){
          #...
         } else {
           alert("error", "L'hébergement de l'image a posé un problème");
     			redirect('profile?user='.urlVal('user').'');
     			exit();
         }
       } else {
         alert("error", "Le format de l'image n'est pas compris");
   			redirect('profile?user='.urlVal('user').'');
   			exit();
       }

    }
    if (trigger('edit_picture_button')) {
      $newphoto = $bdd->prepare('UPDATE users SET avatar = ? WHERE token = ?');
      $newphoto->execute(array(($image_name_final.'.'.$ext),$_SESSION['auth']['token']));
      alert("success", "Nouvelle photo de profil enregistrée");
			redirect('profile?user='.urlVal('user').'');
			exit();
    } else {
      alert("error", "Une erreur est survenir");
			redirect('profile?user='.urlVal('user').'');
			exit();
    }

  }

  if (trigger('edit_bg_button')) {
    $image_name = secu($_FILES['edit_bg']['name']);
    $image_tmp = secu($_FILES['edit_bg']['tmp_name']);
    $image_size = secu($_FILES['edit_bg']['size']);
    $dir = "brain/style/img/bank/";
    $maxsize = 99999999999999999999999999; // Taille en bytes (octets)
    if($_FILES['edit_bg']['size'] > $maxsize){
      alert("error", "L'image est trop lourde");
     redirect('profile?user='.urlVal('user').'');
     exit();
    } else {
       if(($_FILES['edit_bg']['type'] == 'image/gif') || ($_FILES['edit_bg']['type'] == 'image/jpeg') || ($_FILES['edit_bg']['type'] == 'image/png') || ($_FILES['edit_bg']['type'] == 'image/jpg') || ($_FILES['edit_bg']['type'] == 'jpg')) {
         $image_name_final = passhash($image_name.time());
         $path = $_FILES['edit_bg']['name'];
         $ext = pathinfo($path, PATHINFO_EXTENSION);
        if(move_uploaded_file($image_tmp,$dir .($image_name_final.'.'.$ext))){
          #...
         } else {
           alert("error", "L'hébergement de l'image a posé un problème");
     			redirect('profile?user='.urlVal('user').'');
     			exit();
         }
       } else {
         alert("error", "Le format de l'image n'est pas compris");
   			redirect('profile?user='.urlVal('user').'');
   			exit();
       }

    }
    if (trigger('edit_bg_button')) {
      $newphoto = $bdd->prepare('UPDATE users SET background = ? WHERE token = ?');
      $newphoto->execute(array(($image_name_final.'.'.$ext),$_SESSION['auth']['token']));
      alert("success", "Nouvelle photo de profil enregistrée");
			redirect('profile?user='.urlVal('user').'');
			exit();
    } else {
      alert("error", "Une erreur est survenir");
			redirect('profile?user='.urlVal('user').'');
			exit();
    }

  }

if (trigger('like_user_button')) {
  $user->likeUser(urlVal('user'));
  redirect('profile?user='.urlVal('user').'');
  exit();
}

if (trigger('demand_user_button')) {
  if ($user->acceptTextamigo(urlVal('user'))) {
    $user->friendDemandUser(urlVal('user'));
    redirect('profile?user='.urlVal('user').'');
    exit();
  } else {
    alert('error','Cet utilisateur n\'accepte pas les demandes d\'amis');
  }
}

if (trigger('delete_friend_user_button')) {
  $user->deleteFriend(urlVal('user'));
  redirect('profile?user='.urlVal('user').'');
  exit();
}

include 'inc/header.php';

include 'inc/top.php';

?>

<?php if ($user->isProfileOwner()): ?>
  <div class="profile-info"><i class="fa fa-info-circle"></i> Vous êtes actuellement en train de naviguer sur votre profil, vous pouvez modifier quelques éléments visuels, pour modifier des informations en profondeurs rendez-vous dans <a href="settings">vos paramètres</a>.</div>
<?php endif; ?>
<div class="profile">
  <div class="profile-head">
    <div class="profile-image" style="background-image:url(<?= $user->getBackground($_GET['user']); ?>)">
      <?php if ($user->isProfileOwner()): ?>
        <span class="profile-change-background button-modal" data-modal="modal-editbg"><i class="fa fa-camera"></i><span class="profile-change-background-text">Changer l'image de fond</span></span>
      <?php endif; ?>
      <div class="profile-buttons">
        <form method="POST">
          <?php if ($user->alreadyLike(urlVal('user'))): ?>
            <button class="button button-hoverable" name="like_user_button"><i class="fa fa-thumbs-up"></i> Je n'aime plus</button>
          <?php else: ?>
            <button class="button button-hoverable" name="like_user_button"><i class="fa fa-thumbs-up"></i> J'aime</button>
          <?php endif; ?>
        </form>
        <?php if (!$user->isProfileOwner()): ?>
          <form method="POST">
            <?php if ($user->alreadyFriend(urlVal('user')) and !$user->existDemand(urlVal('user'))): ?>
              <button class="button button-success button-hoverable" name="delete_friend_user_button"><i class="fa fa-user-times"></i> Supprimer des amis</button>
            <?php endif; ?>
            <?php if (!$user->alreadyFriend(urlVal('user')) and !$user->existDemand(urlVal('user'))): ?>
              <button class="button button-success button-hoverable" name="demand_user_button"><i class="fa fa-user-plus"></i> Envoyer une demande d'ami</button>
            <?php endif; ?>
              <?php if (!$user->alreadyFriend(urlVal('user')) and $user->existDemand(urlVal('user'))): ?>
              <div class="button-desac"><i class="fa fa-user-plus"></i> Demande envoyée</div>
              <?php endif; ?>
          </form>
        <?php endif; ?>
      </div>
      <div class="profile-pseudo"><?= $user->get('pseudo','token',$_GET['user']); ?> - <?= $retro->getName($user->get('retro','token',urlVal('user'))) ?></div>
      <div class="profile-avatar <?php if($user->isProfileOwner()) { echo 'profile-avatar-hoverable'; } ?>" style="background-image:url(<?= $user->getAvatar($_GET['user']); ?>)">
        <?php if ($user->isProfileOwner()): ?>
          <span class="profile-original-camera"><i class="fa fa-camera"></i></span>
          <div class="profile-avatar-caption button-modal" data-modal="modal-editpicture">
            <i class="fa fa-camera"></i>
            <span>Changer de photo de profil</span>
          </div>
        <?php endif; ?>
      </div>
      <div class="profile-badges">
        <?php
          $get_user_badges_worn = $bdd->prepare('SELECT * FROM badges_worn WHERE user_token = ? ORDER BY id');
          $get_user_badges_worn->execute(array($_GET['user']));
          if ($get_user_badges_worn->rowCount() > 0) {
            while ($badge = $get_user_badges_worn->fetch(PDO::FETCH_OBJ)) { ?>
              <div class="profile-badge"><img src="<?= $badges->getLink($badge->badge_code); ?>" alt=""></div>
          <?php  } } else { ?>
            <span>Aucun badge porté</span>
          <?php }

        ?>
      </div>
    </div>
    <div class="profile-data">
      <ul>
        <li><i class="fa fa-user-plus"></i> Inscrit le: <?= date('d/m/Y',strtotime($user->info('added_date'))) ?></li>
        <li><i class="fa fa-thumbs-up"></i> <?= $user->countLikes(urlVal('user')) ?></li>
        <li><i class="fa fa-users"></i> <?= $user->countFriends(urlVal('user')) ?></li>
      </ul>
    </div>
  </div>
</div>

<div id="modal-editpicture" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <span class="close button-close" data-close="modal-editpicture">×</span>
      <h2>Photo de profil</h2>
    </div>
    <div class="modal-body">

      <div class="modal-image">
        <img src="brain/style/img/meet_plan.png" alt="">
      </div>

        <form method="POST" enctype="multipart/form-data">
          <label for="">Nouvelle photo de profil</label>
          <input type="file" class="field field-expanded" name="edit_picture">
          <br>
          <button class="button button-success linkOpen" name="edit_picture_button" data-closemodal="" data-openmodal="">Confirmer</button>
          <a class="button button-error pull-right button-close" data-close="modal-editpicture" data-openmodal="">Annuler</a>
        </form>


    </div>
  </div>
</div>

<div id="modal-editbg" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <span class="close button-close" data-close="modal-editbg">×</span>
      <h2>Image de fond</h2>
    </div>
    <div class="modal-body">

      <div class="modal-image">
        <img src="brain/style/img/meet_dino.png" alt="">
      </div>

        <form method="POST" enctype="multipart/form-data">
          <label for="">Nouvelle image de fond</label>
          <input type="file" class="field field-expanded" name="edit_bg">
          <br>
          <button class="button button-success linkOpen" name="edit_bg_button" data-closemodal="" data-openmodal="">Confirmer</button>
          <a class="button button-error pull-right button-close" data-close="modal-editbg" data-openmodal="">Annuler</a>
        </form>


    </div>
  </div>
</div>
<?php

 include 'inc/bottom.php';

include 'inc/footer.php';

?>
