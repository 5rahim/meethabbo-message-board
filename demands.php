<?php

require 'brain/core.php';

$page = "Home";
$annexe = "Demandes";

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

include 'inc/header.php';

include 'inc/top.php';

?>

<div class="content-box">
  <div style="text-align:center;margin-bottom:8px;">
    <img src="brain/style/img/meet_demands.png" alt="" />
    <?php if ($user->countFriendDemands() < 1): ?>
      <div class="text-light">Vous n'avez aucune demande d'ami en attente</div>
    <?php endif; ?>
    <?php if ($user->countFriendDemands() > 0): ?>
      <div class="text-light margin-b">Vous avez <?= $user->countFriendDemands() ?> demande(s) d'ami en attente</div>
      <?php
        $get_user_demands = $bdd->prepare('SELECT * FROM friendship_demands WHERE target_token = ? and accepted = 0 and refused = 0 ORDER BY id desc');
        $get_user_demands->execute(array($_SESSION['auth']['token']));
        while ($demand = $get_user_demands->fetch(PDO::FETCH_OBJ)) { ?>
          <div class="list">
            <div class="list-avatar" style="background-image:url(<?= $user->getAvatar($demand->user_token) ?>)"></div>
            <div class="list-position">
              <div class="list-pseudo"><?= $user->get('pseudo','token',$demand->user_token) ?></div>
              <div class="list-text">Vous a envoyé une demande d'ami, vous pouvez accepter ou refuser</div>
              <div class="list-buttons">
                <form method="POST" action="?accept_friend_demand=<?= $demand->user_token ?>&id=<?= $demand->id ?>">
                  <button type="submit" class="button button-xsmall button-success" name="accept_demand_button">Accepter</button>
                </form>
                <form method="POST" action="?refuse_friend_demand=<?= $demand->user_token ?>&id=<?= $demand->id ?>">
                  <button type="submit" class="button button-xsmall" name="refuse_demand_button">Refuser</button>
                </form>
              </div>
            </div>
          </div>
      <?php  }
       ?>
    <?php endif; ?>
  </div>
</div>

<?php

 include 'inc/bottom.php';

include 'inc/footer.php';

?>
