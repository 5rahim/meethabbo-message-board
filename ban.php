<?php

require 'brain/core.php';

$page = "Ban";

$user->restrict();
$user->restrictByFirstco();
$user->autoDeban();

include 'inc/header.php';

?>

<div class="ban-wrapper" style="width:550px;">
  <div class="ban-logo">
    <img src="brain/style/img/meet_logo_login.png" alt="" />
  </div>
  <div class="ban-box text-light">
    <div class="column small-12">
      <img src="brain/style/img/meet_ban.png" alt="" />
    </div>
    <div class="column small-12">
      Oops, vous avez été banni par un membre de l'équipe de MeetHabbo.<br/>
      Raison: <b>"<?= decode($user->info('ban_raison')) ?>"</b><br/>
      Le bannissement prendra fin le: <b><?php echo date('d/m/Y H:i:s',strtotime($user->info('ban_time'))) ?> (UTC +2)</b>
    </div>
  </div>
</div>

<?php

include 'inc/footer.php';

?>
