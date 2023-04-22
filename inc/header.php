<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title><?= $config['title'] ?> - <?php
    if (!isset($annexe)) {
      echo $page;
    } else {
      echo $annexe;
    }
   ?></title>
  <link rel="stylesheet" href="brain/style/css/meet.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <?php if (isset($annexe) and $annexe = "Nouveau topic") { ?>
    <script src="brain/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
      tinymce.init({
        selector: 'textarea',
        theme: 'modern',
        height: 300,
        language : "fr_FR",
        plugins: [
          'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
          'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
          'save table contextmenu directionality emoticons template paste textcolor'
        ],
        content_css: 'css/content.css',
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
      });
    </script>
  <?php } ?>
  <meta charset="UTF-8">
</head>

<body <?php if (!$user::isConnected() or $user->info('ban') > 0 or $page == "Bienvenue"): ?>
  class="body-not-logged-in"
<?php endif; ?>>

<?php if ($user->isConnected()): ?>
  <?php if ($user->info('rank') > 9): ?>
    <div class="mod-tool" id="tool">
      <div class="mod-tool-head">
        <div class="mod-tool-caption">
          <i class="fa fa-cogs"></i> Admin Tool
        </div>
      </div>
      <ul>
        <li><a class="button_openpush" data-openpush="push_ban">Bannir un utilisateur</a></li>
        <li><a class="button_openpush" data-openpush="push_unban">Débannir un utilisateur</a></li>
        <li><a class="button_openpush" data-openpush="push_givebadge">Donner un badge</a></li>
        <li><a class="button_openpush" data-openpush="push_givecoins">Donner des Coins</a></li>
        <li><a class="button_openpush" data-openpush="push_giveducks">Donner des Ducks</a></li>
        <li><a>Utilisateurs en ligne</a></li>
      </ul>
    </div>
  <?php endif; ?>
  <?php if ($user->info('rank') == 6): ?>
    <div class="mod-tool" id="tool">
      <div class="mod-tool-head">
        <div class="mod-tool-caption">
          <i class="fa fa-cogs"></i> Mod Tool
        </div>
      </div>
      <ul>
        <li><a class="button_openpush" data-openpush="push_ban">Bannir un utilisateur</a></li>
        <li><a class="button_openpush" data-openpush="push_unban">Débannir un utilisateur</a></li>
        <li><a>Utilisateurs en ligne</a></li>
      </ul>
    </div>
  <?php endif; ?>
  <?php if ($user->info('rank') == 4): ?>
    <div class="mod-tool" id="tool">
      <div class="mod-tool-head">
        <div class="mod-tool-caption">
          <i class="fa fa-cogs"></i> Anim Tool
        </div>
      </div>
      <ul>
        <li><a class="button_openpush" data-openpush="push_givebadge">Donner un badge</a></li>
        <li><a class="button_openpush" data-openpush="push_givecoins">Donner des Coins</a></li>
        <li><a class="button_openpush" data-openpush="push_giveducks">Donner des Ducks</a></li>
      </ul>
    </div>
  <?php endif; ?>
<?php endif; ?>

<?php if ($user->isConnected() and $user->info('rank') > 3): ?>
  <div class="push-shadow" id="push_ban">
    <div class="push">
      <div class="push-head">
        <div class="push-head-caption"><i class="fa fa-user-times"></i> Bannir un utilisateur <span class="button_closepush" data-closepush="push_ban">×</span></div>
      </div>
      <div style="margin-bottom:6px;text-align:center;">Cet outil permet de bannir un utilisateur</div>
      <form method="POST">
        <input type="text" class="field field-expanded" name="ban_user_pseudo" placeholder="Pseudo de l'utilisateur" required>
        <input type="text" class="field field-expanded" name="ban_user_raison" placeholder="Raison du bannissement" required>
        <select class="field field-expanded" name="ban_user_time" required>
          <option value="+1 hour">1 heure</option>
          <option value="+2 hour">2 heures</option>
          <option value="+4 hour">4 heures</option>
          <option value="+12 hour">12 heures</option>
          <option value="+1 day">1 journée</option>
          <option value="+2 day">2 journée</option>
          <option value="+20 year">Définitivement</option>
        </select>
        <button class="button" type="submit" name="ban_user_button">Envoyer</button>
      </form>
    </div>
  </div>
<?php endif; ?>

<?php if ($user->isConnected() and $user->info('rank') > 5): ?>
  <div class="push-shadow" id="push_unban">
    <div class="push">
      <div class="push-head">
        <div class="push-head-caption"><i class="fa fa-user-times"></i> Débannir un utilisateur <span class="button_closepush" data-closepush="push_unban">×</span></div>
      </div>
      <div style="margin-bottom:6px;text-align:center;">Cet outil permet de débannir un utilisateur</div>
      <?php
        $get_users_bans = $bdd->prepare('SELECT * FROM users WHERE ban = 1 ORDER BY id desc');
        $get_users_bans->execute();
        while ($bans = $get_users_bans->fetch(PDO::FETCH_OBJ)) { ?>
          <div class="user-ban">
            <div class="user-ban-avatar" style="background-image:url(<?= $user->getAvatar($bans->token) ?>)"></div>
            <div class="user-ban-position">
              <div class="user-ban-pseudo"><?= $bans->pseudo ?></div>
              <div class="user-ban-text">Cet utilisateur est banni jusqu'au (<?= $bans->ban_time ?>)</div>
              <div class="user-ban-buttons">
                <form method="POST">
                  <input type="text" name="unban_user_token" value="<?= $bans->token ?>" hidden>
                  <button type="submit" class="button button-xsmall button-success" name="unban_user_button">Débannir</button>
                </form>
              </div>
            </div>
          </div>
      <?php  }
       ?>
    </div>
  </div>
<?php endif; ?>

<?php if ($user->isConnected() and $user->info('rank') > 3): ?>
  <div class="push-shadow" id="push_givebadge">
    <div class="push">
      <div class="push-head">
        <div class="push-head-caption"><i class="fa fa-trello"></i> Donner un badge <span class="button_closepush" data-closepush="push_givebadge">×</span></div>
      </div>
      <div style="margin-bottom:6px;text-align:center;">Cet outil permet de débannir un utilisateur</div>
      <form method="POST">
        <input type="text" class="field field-expanded" name="badge_user_pseudo" placeholder="Pseudo de l'utilisateur" required>
        <input type="text" class="field field-expanded" name="badge_user_code" placeholder="Code du badge" required>
        <button class="button" type="submit" name="badge_user_button">Envoyer</button>
      </form>
    </div>
  </div>
<?php endif; ?>

<?php if ($user->isConnected() and $user->info('rank') > 3): ?>
  <div class="push-shadow" id="push_givecoins">
    <div class="push">
      <div class="push-head">
        <div class="push-head-caption"><i class="fa fa-trello"></i> Donner des coins <span class="button_closepush" data-closepush="push_givecoins">×</span></div>
      </div>
      <div style="margin-bottom:6px;text-align:center;">Cet outil permet de donner des Coins à un utilisateur</div>
      <form method="POST">
        <input type="text" class="field field-expanded" name="coins_user_pseudo" placeholder="Pseudo de l'utilisateur" required>
        <input type="text" class="field field-expanded" name="coins_user_amount" placeholder="Montant" required>
        <button class="button" type="submit" name="coins_user_button">Envoyer</button>
      </form>
    </div>
  </div>
<?php endif; ?>

<?php if ($user->isConnected() and $user->info('rank') > 3): ?>
  <div class="push-shadow" id="push_giveducks">
    <div class="push">
      <div class="push-head">
        <div class="push-head-caption"><i class="fa fa-trello"></i> Donner des ducks <span class="button_closepush" data-closepush="push_giveducks">×</span></div>
      </div>
      <div style="margin-bottom:6px;text-align:center;">Cet outil permet de donner des Ducks à un utilisateur</div>
      <form method="POST">
        <input type="text" class="field field-expanded" name="ducks_user_pseudo" placeholder="Pseudo de l'utilisateur" required>
        <input type="text" class="field field-expanded" name="ducks_user_amount" placeholder="Montant" required>
        <button class="button" type="submit" name="ducks_user_button">Envoyer</button>
      </form>
    </div>
  </div>
<?php endif; ?>

  <?php include 'alerts.php'; ?>
