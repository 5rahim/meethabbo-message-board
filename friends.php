<?php

require 'brain/core.php';

$page = "Home";
$annexe = "Amis";

$user->restrict();
$user->restrictBan();
$user->restrictByFirstco();

if (trigger('accept_demand_button')) {
  if (url('accept_friend_demand')) {
    $user->acceptDemand(urlVal('accept_friend_demand'),urlVal('id'));
    alert('success','Action effectuée');
    redirect('demands');
    exit();
  }
}

if (trigger('refuse_demand_button')) {
  if (url('refuse_friend_demand')) {
    $user->refuseDemand(urlVal('refuse_friend_demand'),urlVal('id'));
    alert('success','Action effectuée');
    redirect('demands');
    exit();
  }
}

if (url('delete_notifications')) {
  $delete_n = $bdd->prepare('DELETE FROM notifications WHERE target_token = ?');
  $delete_n->execute(array($_SESSION['auth']['token']));
  alert('success','Action effectuée');
  redirect('notifications');
  exit();
}

include 'inc/header.php';

include 'inc/top.php';

?>

<div class="content-box">
  <div style="text-align:center;margin-bottom:8px;">
    <img src="brain/style/img/meet_friendlist.png" alt="" />
    <?php if ($user->countFriendships() < 1): ?>
      <div class="text-light">Vous n'avez aucun ami :(</div>
    <?php endif; ?>
    <?php if ($user->countFriendships() > 0): ?>
      <div class="text-light margin-b">Vous avez <?= $user->countFriendships() ?> ami(s)</div>
      <?php $get_friends = $bdd->prepare('SELECT * FROM friendship WHERE user_token = ? ORDER BY id');
      $get_friends->execute(array($_SESSION['auth']['token']));
      while ($friend = $get_friends->fetch(PDO::FETCH_OBJ)) { ?>
        <div class="friend-container">
          <a class="friend" href="profile?user=<?= $friend->friend_token ?>">
            <div class="friend-avatar" style="background-image:url(<?= $user->getAvatar($friend->friend_token) ?>)"></div>
            <div class="friend-position">
              <div class="friend-pseudo"><?= $user->get('pseudo','token',$friend->friend_token) ?></div>
              <div class="friend-text">Vous êtes amis depuis <?= $date->transform($friend->added_date); ?></div>
            </div>
          </a>
        </div>
    <?php  } ?>
    <?php endif; ?>
  </div>
</div>

<?php

 include 'inc/bottom.php';

include 'inc/footer.php';

?>
