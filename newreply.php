<?php

require 'brain/core.php';

$page = "Forum";
$annexe = "Nouvelle réponse";

$user->restrict();
$user->restrictBan();
$user->restrictByFirstco();

if (!url('id')) {
  redirect('error');
}

$topics_target = $bdd->query('SELECT * FROM forum_topics WHERE id = '.urlVal('id'));
$topic_target = $topics_target->fetch(PDO::FETCH_OBJ);

if ($topics_target->rowCount() < 1) {
  redirect('error');
  exit();
}

if ($topic_target->locked > 0 and $user->info('rank') < 6) {
  redirect('topic?id='.$topic_target->id);
}

if (trigger('newreply_button')) {
  if (getField('newreply_content')) {
    if ((strlen($_POST['newreply_content'])) > 10) {
      $topic->addreply($_POST['newreply_content'],$topic_target->id);
      alert('success','La réponse a bien été postée');
      redirect('topic?id='.$topic_target->id);
      exit();
    } else {
      alert('error','Votre contenu est trop court');
      redirect('newreply?id='.$topic_target->id);
      exit();
    }
  } else {
    alert('error','Veuillez écrire une réponse');
    redirect('newreply?id='.$topic_target->id);
    exit();
  }
}


include 'inc/header.php';

include 'inc/top.php';

include 'inc/forum_top.php';

?>

<div class="forum-container">
  <div class="newtopic-head"
      style="background-image:url(brain/style/img/meet_forum_head.png)"
  >
    <div class="newtopic-caption">
      <div class="newtopic-title">
        Nouvelle réponse dans [<?= decode($topic_target->title) ?>]
       </div>
       <div class="newtopic-data">
           Vous êtes sur le point de poster une réponse dans un topic. Veuillez ne pas faire de hors-sujet.
       </div>
    </div>
  </div>
  <div class="write-box">
    <form action="" method="POST">
      <textarea name="newreply_content" rows="8" cols="40"></textarea><br>
      <button class="button button-success" name="newreply_button">Envoyer</button>
    </form>
  </div>
</div>

<?php

 include 'inc/bottom.php';

 ?>

 <?php

include 'inc/footer.php';

?>
