<?php

require 'brain/core.php';

$page = "Home";
$annexe = "Notifications";

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
    <img src="brain/style/img/meet_notifications.png" alt="" />
    <?php if ($user->countNotifications() < 1): ?>
      <div class="text-light">Vous n'avez aucune notification</div>
    <?php endif; ?>
    <?php if ($user->countNotifications() > 0): ?>
      <div class="text-light margin-b">Vous avez <?= $user->countNotifications() ?> notification(s) (<a href="?delete_notifications=true" class="link">supprimer les notifications</a>)</div>
      <?php
        $get_user_n = $bdd->prepare('SELECT * FROM notifications WHERE target_token = ? ORDER BY id desc');
        $get_user_n->execute(array($_SESSION['auth']['token']));
        while ($n = $get_user_n->fetch(PDO::FETCH_OBJ)) { ?>
          <?php if ($n->_profile_token != NULL): ?>
            <a class="list list-notification" href="profile?user=<?= $n->author_token ?>">
              <div class="list-avatar" style="background-image:url(<?= $user->getAvatar($n->author_token) ?>)"></div>
              <div class="list-position">
                <div class="list-pseudo"><?= $user->get('pseudo','token',$n->author_token) ?></div>
                <div class="list-text"><?= $n->content ?> <span>(Il y a <?= $date->transform($n->added_date) ?>)</span></div>
              </div>
            </a>
          <?php endif; ?>
          <?php if ($n->_topic_id != NULL): ?>
            <a class="list list-notification" href="topic?id=<?= $n->_topic_id ?>">
              <div class="list-avatar" style="background-image:url(<?= $user->getAvatar($n->author_token) ?>)"></div>
              <div class="list-position">
                <div class="list-pseudo"><?= $user->get('pseudo','token',$n->author_token) ?></div>
                <div class="list-text"><?= $n->content ?> <span>(Il y a <?= $date->transform($n->added_date) ?>)</span></div>
              </div>
            </a>
          <?php endif; ?>
      <?php  }
       ?>
    <?php endif; ?>
  </div>
</div>

<?php

 include 'inc/bottom.php';

include 'inc/footer.php';

?>
