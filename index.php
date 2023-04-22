<?php

require 'brain/core.php';

$page = "Home";

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

include 'inc/header.php';

include 'inc/top.php';

if (!isset($_SESSION['no_greeting'])) {
  $settings->greeting();
}

?>

<div class="home-box">
  <div class="home-box-caption">
    <div class="home-box-position">
      <div  href="profile?user=<?= $user->info('token') ?>" class="home-box-avatar"  style="background-image:url(<?= $user->getAvatar($_SESSION['auth']['token']); ?>)"></div>
        <div class="home-box-pseudo">Bienvenue, <?= $user->info('pseudo') ?></div>
      <div class="home-box-humor">Humeur: <?= $user->info('humor') ?></div>
        <div class="home-box-counts">
          <div class="home-box-coins"><img src="brain/style/img/meet_coins.png" alt="" /> <span><?= $user->info('coins'); ?></span></div>
          <div class="home-box-ducks"><img src="brain/style/img/meet_duck.gif" alt="" /> <span><?= $user->info('ducks'); ?></span></div>
          <div class="home-box-messages"><img src="brain/style/img/meet_msg.gif" alt="" /> <span>138</span></div>
          <div class="home-box-badges">
            <?php
              $get_user_badges = $bdd->prepare('SELECT * FROM badges_worn WHERE user_token = ? ORDER BY id');
              $get_user_badges->execute(array($_SESSION['auth']['token']));
              while ($badge = $get_user_badges->fetch(PDO::FETCH_OBJ)) { ?>
                <div class="home-box-badge"><img src="<?= $badges->getLink($badge->badge_code); ?>" alt=""></div>
            <?php  }
            ?>
          </div>
        </div>
    </div>
  </div>
</div>

<div class="activity-box">
  <div class="column small-12 medium-6">
    <div class="activity-title">Mes derniers sujets</div>
    <div class="activity-content"><span>Rien à afficher</span></div>
  </div>
  <div class="column small-12 medium-6">
    <div class="activity-title">Mes dernières réponses</div>
    <div class="activity-content"><span>Rien à afficher</span></div>

  </div>
</div>

<?php

 include 'inc/bottom.php';

include 'inc/footer.php';

?>
