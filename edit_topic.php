<?php

require 'brain/core.php';

$page = "Forum";
$annexe = "Modifier le topic";

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

if ($_SESSION['auth']['token'] != $topic_target->author_token and $user->info('rank') < 6) {
  redirect('topic?id='.$topic_target->id);
  exit();
}

if ($topic_target->locked > 0 and $user->info('rank') < 6) {
  redirect('topic?id='.$topic_target->id);
}

if (trigger('edit_topic_button')) {
  if (getField('edit_topic_title') and getField('edit_topic_content')) {
    if ((strlen($_POST['edit_topic_title'])) >  6) {
      if ((strlen($_POST['edit_topic_content'])) > 10) {
        $topic->editTopic($topic_target->id,field('edit_topic_title'),$_POST['edit_topic_content']);
        alert('success','Le sujet a bien été modifié');
        redirect('topic?id='.$topic_target->id);
        exit();
      } else {
        alert('error','Votre contenu est trop court');
        redirect('edit_topic?id='.$topic_target->id);
        exit();
      }
    } else {
      alert('error','Votre titre est trop court');
      redirect('edit_topic?id='.$topic_target->id);
      exit();
    }
  } else {
    alert('error','Veuillez remplir tous les champs');
    redirect('edit_topic?id='.$topic_target->id);
    exit();
  }
}


include 'inc/header.php';

include 'inc/top.php';

include 'inc/forum_top.php';

?>

<div class="forum-container">
  <div class="write-box">
    <form action="" method="POST">
      <input type="text" class="field field-expanded" name="edit_topic_title" value="<?= decode($topic_target->title) ?>">
      <textarea name="edit_topic_content" rows="8" cols="40"><?= $topic_target->content ?></textarea><br>
      <button class="button button-success" name="edit_topic_button">Enregistrer</button>
    </form>
  </div>
</div>

<?php

 include 'inc/bottom.php';

 ?>

 <?php

include 'inc/footer.php';

?>
