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

$replies_target = $bdd->query('SELECT * FROM forum_replies WHERE id = '.urlVal('id'));
$reply_target = $replies_target->fetch(PDO::FETCH_OBJ);

if ($replies_target->rowCount() < 1) {
  redirect('error');
  exit();
}

if ($_SESSION['auth']['token'] != $reply_target->author_token and $user->info('rank') < 6) {
  redirect('topic?id='.$reply_target->topic_id);
  exit();
}

if (trigger('edit_reply_button')) {
  if (getField('edit_reply_content')) {
    if ((strlen($_POST['edit_reply_content'])) > 10) {
      $topic->editreply($reply_target->id,$_POST['edit_reply_content'],$reply_target->topic_id);
      alert('success','La réponse a bien été modifiée');
      redirect('topic?id='.$reply_target->topic_id);
      exit();
    } else {
      alert('error','Votre contenu est trop court');
      redirect('edit_reply?id='.$reply_target->topic_id);
      exit();
    }
  } else {
    alert('error','Veuillez écrire une réponse');
    redirect('edit_reply?id='.$reply_target->topic_id);
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
      <textarea name="edit_reply_content" rows="8" cols="40"><?= $reply_target->content ?></textarea><br>
      <button class="button button-success" name="edit_reply_button">Enregistrer</button>
    </form>
  </div>
</div>

<?php

 include 'inc/bottom.php';

 ?>

 <?php

include 'inc/footer.php';

?>
