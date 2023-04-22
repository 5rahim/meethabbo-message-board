<?php

require 'brain/core.php';

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

$delete_reply = $bdd->prepare('DELETE FROM forum_replies WHERE id = ?');
$delete_reply->execute(array(urlVal('id')));
alert('success','La réponse a bien été supprimée');
redirect('topic?id='.$reply_target->topic_id);
exit();

 ?>
