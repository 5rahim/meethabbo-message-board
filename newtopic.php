<?php

require 'brain/core.php';

$page = "Forum";
$annexe = "Nouveau topic";

$user->restrict();
$user->restrictBan();
$user->restrictByFirstco();

if (!url('forum')) {
  redirect('error');
}

$forums_target = $bdd->query('SELECT * FROM forum_forums WHERE id = '.urlVal('forum'));
$forum_target = $forums_target->fetch(PDO::FETCH_OBJ);

if ($forums_target->rowCount() < 1) {
  redirect('error');
}

if ($forum_target->locked > 0 and $user->info('rank') < 6) {
  redirect('viewforum?id='.$forum_target->id);
}

if (trigger('newtopic_button')) {
  if (getField('newtopic_title') and getField('newtopic_content')) {
    if (strlen(field('newtopic_title')) > 6) {
      if (strlen(field('newtopic_content')) > 10) {
        $topic->addTopic(field('newtopic_title'),$_POST['newtopic_content'],$forum_target->id);
        alert('success','Le sujet a bien été créé');
        redirect('viewforum?id='.$forum_target->id);
        exit();
      } else {
        alert('error','Votre contenu est trop court');
        redirect('newtopic?forum='.$forum_target->id);
        exit();
      }
    } else {
      alert('error','Votre titre est trop court');
      redirect('newtopic?forum='.$forum_target->id);
      exit();
    }
  } else {
    alert('error','Veuillez remplir tous les champs');
    redirect('newtopic?forum='.$forum_target->id);
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
        Nouveau sujet dans [<?= decode($forum_target->title) ?>]
       </div>
       <div class="newtopic-data">
           Vous êtes sur le point de poster une réponse dans un topic. Faites attention à vos propos dans celui-ci.
       </div>
    </div>
  </div>
  <div class="write-box">
    <form action="" method="POST">
      <input type="text" class="field field-expanded" name="newtopic_title" placeholder="Titre du topic">
      <textarea name="newtopic_content" rows="8" cols="40"></textarea><br>
      <button class="button button-success" name="newtopic_button">Go! Créer le topic</button>
    </form>
  </div>
</div>

<?php

 include 'inc/bottom.php';

 ?>

 <?php

include 'inc/footer.php';

?>
