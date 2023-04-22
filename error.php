<?php

require 'brain/core.php';

$page = "Erreur";

$user->restrict();
$user->restrictBan();
$user->restrictByFirstco();

include 'inc/header.php';

include 'inc/top.php';

?>

<div class="goback" style="margin-top:8px;"><a onclick="history.go(-1);">&laquo; Retour</a></div>

<div class="content-box content-box-initial">
  <div class="error">
    <div class="error-image">
      <img src="brain/style/img/meet_frank_search.png" alt="" />
    </div>
    <div class="error-title">Oops,</div>
    <div class="error-text">Désolé, la page que vous cherchez n'existe pas ou plus.</div>
  </div>
</div>

<?php

 include 'inc/bottom.php';

include 'inc/footer.php';

?>
