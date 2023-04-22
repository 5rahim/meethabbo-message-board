<div class="header">
    <div class="container">
      <a class="header-logo" href="index"></a>
      <div class="user-area">
        <a href="profile?user=<?= $user->info('token'); ?>" class="user-area-avatar" style="background-image:url(<?= $user->getAvatar($_SESSION['auth']['token']) ?>);"></a>
        <div class="user-area-options">
          <div class="user-area-pseudo"><?= $user->info('pseudo') ?></div>
          <a href="settings" class="user-area-option"><i class="fa fa-cog"></i> Mes paramètres</a>
          <a href="logout" class="user-area-option"><i class="fa fa-sign-out"></i> Déconnexion</a>
        </div>
      </div>
      <div class="header-menu">
        <div class="container">
          <ul>
            <li <?php if($page == "Home") { echo "class=\"active\""; } ?>><a href="index"><i class="fa fa-home"></i> Accueil</a></li>
            <li <?php if($page == "Forum") { echo "class=\"active\""; } ?>><a href="forum"><i class="fa fa-sign-in"></i> Forum</a></li>
            <li <?php if($page == "Communauté") { echo "class=\"active\""; } ?>><a href="community"><i class="fa fa-globe"></i> Communauté</a></li>
            <li <?php if($page == "Membres") { echo "class=\"active\""; } ?>><a href="members"><i class="fa fa-users"></i> Membres</a></li>
            <li <?php if($page == "Paramètres") { echo "class=\"active\""; } ?>><a href="settings"><i class="fa fa-gear"></i> Paramètres</a></li>
            <li <?php if($page == "MeetShop") { echo "class=\"active\""; } ?>><a href="shop"><i class="fa fa-shopping-basket"></i> MeetShop</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <?php if ($page == "Home"): ?>
  <div class="container">
    <div class="under-menu">
        <ul>
          <li><a href="index" <?php if (isset($annexe)) {
            if ($annexe == "Pseudo") {
              echo 'class="active"';

          } } ?>><?= $user->info('pseudo') ?></a></li>
          <li><a href="notifications" <?php if (isset($annexe)) {
            if ($annexe == "Notifications") {
              echo 'class="active"';

          } } ?>>Notifications <?php if ($user->countNotifications() > 0): ?>
            <span class="badge"><?= $user->countNotifications() ?></span>
          <?php endif; ?></a></li>
          <li><a href="friends" <?php if (isset($annexe)) {
            if ($annexe == "Amis") {
              echo 'class="active"';

          } } ?>>Mes amis</a></li>
          <li><a href="demands" <?php if (isset($annexe)) {
            if ($annexe == "Demandes") {
              echo 'class="active"';

          } } ?>>Mes demandes
            <?php if ($user->countFriendDemands() > 0): ?>
              <span class="badge"><?= $user->countFriendDemands() ?></span>
            <?php endif; ?>
          </a></li>
          <li><a href="badges" <?php if (isset($annexe)) {
            if ($annexe == "Badges") {
              echo 'class="active"';

          } } ?>>Mes badges</a></li>
          <li><a href="payements" <?php if (isset($annexe)) {
            if ($annexe == "Achats") {
              echo 'class="active"';

          } } ?>>Mes achats</a></li>
        </ul>
      </div>
  </div>
<?php endif; ?>
<div class="main">
