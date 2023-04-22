<?php

require 'brain/core.php';

$page = "Bienvenue";

$user->restrict();

$user->checkToken($_GET['token']);

$user->checkFirstco();

if (trigger('connection_button')) {
  if (isset($_GET['token'])) {
    $user->finalize($_GET['token']);
    alert("success", "Bienvenue, ".$user->info("pseudo"));
    redirect('index');
    exit();
  } else {
    alert("error","Une erreur est survenue");
    redirect('login');
    exit();
  }
}

include 'inc/header.php'; ?>

<div class="fc-wrapper">
  <div class="fc-logo" style="text-align:center;">
    <img src="brain/style/img/meet_logo_bvn.png" alt="" />
    <div class="fc-box text-center">
      <div class="text-light text-center margin-b">Hello <?= $user->info('pseudo') ?>, bienvenue sur le forum MeetHabbo, ici vous pourrez discuter, partager, aider et rencontrer des gens, et établir votre style sur le forum. Pour te souhaiter la bienvenue, nous t'offrons un badge.</div>
      <div style="margin-bottom: 8px;" >
        <div class="fc-badge">
          <img src="brain/style/img/badges/BVN.gif" alt="" />
        </div>
      </div>
      <form method="POST">
        <button class="button button-success" name="connection_button"><i class="fa fa-check"></i> Terminer mon inscription</button>
      </form>
    </div>
  </div>
</div>

<?php include 'inc/footer.php';

?>
