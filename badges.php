<?php

require 'brain/core.php';

$page = "Home";
$annexe = "Badges";

$user->restrict();
$user->restrictBan();
$user->restrictByFirstco();

if (trigger('leave_badge_button')) {
  if (url('leave_badge')) {
    if ($user->wearBadge(urlVal('leave_badge'))) {
      if ($user->leaveBadge(urlVal('leave_badge'))) {
        alert("success", "Le badge a bien été retiré");
        redirect('badges');
        exit();
      } else {
        alert("error", "Une erreur est survenue");
        redirect('badges');
        exit();
      }
    } else {
      alert("error", "Vous ne portez pas ce badge");
      redirect('badges');
      exit();
    }
  } else {
    alert("error", "Une erreur est survenue");
    redirect('badges');
    exit();
  }
}

if (trigger('take_badge_button')) {
  if (url('take_badge')) {
    if ($user->hasBadge(urlVal('take_badge'))) {
      if ($user->takeBadge(urlVal('take_badge'))) {
        alert("success", "Le badge a bien été porté");
        redirect('badges');
        exit();
      } else {
        alert("error", "Une erreur est survenue");
        redirect('badges');
        exit();
      }
    } else {
      alert("error", "Vous n'avez' pas ce badge");
      redirect('badges');
      exit();
    }
  } else {
    alert("error", "Une erreur est survenue");
    redirect('badges');
    exit();
  }
}

include 'inc/header.php';

include 'inc/top.php';

?>

<div class="content-box">
  <div style="text-align:center;margin-bottom:8px;">
    <div><img src="brain/style/img/meet_badges.png" alt="" /></div>
    <span class="text-light">Grâce à vos badges, distinguez-vous visuellement des autres utilisateurs. Ils marquent aussi votre parcours et votre évolution au sein de MeetHabbo. Plus vous en avez mieux c'est. Tu ne sais pas comment en avoir ? Il suffit de participer à des concours ou jeux organisés sur le Forum et sur le site, vous pouvez aussi en acheter à l'aide de Coins et Ducks, vous ne pouvez en porter que trois en même temps, choisissez les biens.</span>
    <div class="settings-badges-worn">
      <?php
        $get_user_badges_worn = $bdd->prepare('SELECT * FROM badges_worn WHERE user_token = ? ORDER BY id');
        $get_user_badges_worn->execute(array($_SESSION['auth']['token']));
        if ($get_user_badges_worn->rowCount() > 0) {
          while ($badge = $get_user_badges_worn->fetch(PDO::FETCH_OBJ)) { ?>
            <div class="settings-badge"><img src="<?= $badges->getLink($badge->badge_code); ?>" alt=""></div>
        <?php  } } else { ?>
          <span>Aucun badge porté</span>
        <?php }

      ?>
    </div>
    <?php if ($user->countBadges($_SESSION['auth']['token']) == 1): ?>
        <span class="settings-badges-advise">Vous portez 1 badge, vous pouvez en porter 2 de plus.</span>
    <?php endif; ?>
    <?php if ($user->countBadges($_SESSION['auth']['token']) == 2): ?>
        <span class="settings-badges-advise">Vous portez 2 badges, vous pouvez en porter 1 de plus.</span>
    <?php endif; ?>
    <?php if ($user->countBadges($_SESSION['auth']['token']) == 3): ?>
        <span class="settings-badges-advise">Vous portez 3 badges, vous ne pouvez plus en porter plus.</span>
    <?php endif; ?>
    <?php if ($user->countBadges($_SESSION['auth']['token']) == 0): ?>
        <span class="settings-badges-advise">Vous ne portez aucun badge, vous pouvez en porter.</span>
    <?php endif; ?>

    <div class="badges-proposition">
      <?php
        $get_user_badges_worn = $bdd->prepare('SELECT * FROM badges_membership WHERE user_token = ? ORDER BY id');
        $get_user_badges_worn->execute(array($_SESSION['auth']['token']));
        while ($badge = $get_user_badges_worn->fetch(PDO::FETCH_OBJ)) { ?>
          <div class="badge-proposition">
            <div class="badge-proposition-head" id="badge">
              <img src="<?= $badges->getLink($badge->badge_code); ?>" title="<?= $badges->getDesc($badge->badge_code); ?>">
            </div>
            <?php if ($user->wearBadge($badge->badge_code)): ?>
              <form method="POST" action="badges?leave_badge=<?= $badge->badge_code ?>">
                <button type="submit" class="badge-proposition-button" name="leave_badge_button">
                  Retirer
                </button>
              </form>
            <?php endif; ?>
            <?php if (!$user->wearBadge($badge->badge_code) and $user->countBadges($_SESSION['auth']['token']) < 3): ?>
                <form method="POST" action="badges?take_badge=<?= $badge->badge_code ?>">
                  <button type="submit" class="badge-proposition-button" name="take_badge_button">
                    Porter
                  </button>
                </form>
            <?php endif; ?>
            <?php if (!$user->wearBadge($badge->badge_code) and $user->countBadges($_SESSION['auth']['token']) == 3): ?>
              <div class="badge-proposition-button desactive">
                Porter
              </div>
            <?php endif; ?>

          </div>
      <?php  }
      ?>
    </div>
  </div>
</div>

<?php

 include 'inc/bottom.php';

include 'inc/footer.php';

?>
