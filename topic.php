<?php

require 'brain/core.php';

$user->restrict();
$user->restrictBan();
$user->restrictByFirstco();

$page = "Forum";

if (!url('id')) {
  redirect('error');
}

$topics_view = $bdd->query('SELECT * FROM forum_topics WHERE id = '.urlVal('id'));
$topic_view = $topics_view->fetch(PDO::FETCH_OBJ);

if ($topics_view->rowCount() < 1) {
  redirect('error');
}

$get_forums = $bdd->query('SELECT * FROM forum_forums WHERE id = '.$topic_view->forum_id);
$topic_forum = $get_forums->fetch(PDO::FETCH_OBJ);

$annexe = $topic_view->title;

if (empty($_SESSION['hit_topic'][$topic_view->id])) {
  $topic->hit($topic_view->id);
}
$_SESSION['hit_topic'][$topic_view->id] = "hit";

if (trigger('delete_topic_button')) {
  if ($_SESSION['auth']['token'] == $topic_view->author_token or $user->info('rank') > 3) {
    $id = urlVal('id');
    $delete_before = $bdd->prepare('DELETE FROM forum_topics WHERE id = ?');
		$delete_before->execute(array($id));
    alert('success','Le sujet a bien été supprimé');
    redirect('viewforum?id='.$topic_view->forum_id);
    exit();
  }
}

if (url('lock')) {
  if (urlVal('lock') == "true") {
    if ($user->info('rank') > 9) {
      $lock = $bdd->prepare('UPDATE forum_topics SET locked = 1 WHERE id = ?');
      $lock->execute(array(urlVal('id')));
      alert('success','Le topic est désormais vérrouillé');
      redirect('topic?id='.$topic_view->id);
      exit();
    } else {
      alert('error','Erreur');
      redirect('topic?id='.$topic_view->id);
      exit();
    }
  }
  if (urlVal('lock') == "false") {
    if ($user->info('rank') > 9) {
      $lock = $bdd->prepare('UPDATE forum_topics SET locked = 0 WHERE id = ?');
      $lock->execute(array(urlVal('id')));
      alert('success','Le topic est désormais dévérrouillé');
      redirect('topic?id='.$topic_view->id);
      exit();
    } else {
      alert('error','Erreur');
      redirect('topic?id='.$topic_view->id);
      exit();
    }
  }
}

if (url('stick')) {
  if (urlVal('stick') == "true") {
    if ($user->info('rank') > 9) {
      $stick = $bdd->prepare('UPDATE forum_topics SET sticked = 1, announce = 0 WHERE id = ?');
      $stick->execute(array(urlVal('id')));
      alert('success','Le topic est désormais stické');
      redirect('topic?id='.$topic_view->id);
      exit();
    } else {
      alert('error','Erreur');
      redirect('topic?id='.$topic_view->id);
      exit();
    }
  }
  if (urlVal('stick') == "false") {
    if ($user->info('rank') > 9) {
      $stick = $bdd->prepare('UPDATE forum_topics SET sticked = 0, announce = 0 WHERE id = ?');
      $stick->execute(array(urlVal('id')));
      alert('success','Le topic est désormais déstické');
      redirect('topic?id='.$topic_view->id);
      exit();
    } else {
      alert('error','Erreur');
      redirect('topic?id='.$topic_view->id);
      exit();
    }
  }
}

if (url('announce')) {
  if (urlVal('announce') == "true") {
    if ($user->info('rank') > 9) {
      $announce = $bdd->prepare('UPDATE forum_topics SET announce = 1, sticked = 0 WHERE id = ?');
      $announce->execute(array(urlVal('id')));
      alert('success','Le topic est désormais un annonce');
      redirect('topic?id='.$topic_view->id);
      exit();
    } else {
      alert('error','Erreur');
      redirect('topic?id='.$topic_view->id);
      exit();
    }
  }
  if (urlVal('announce') == "false") {
    if ($user->info('rank') > 9) {
      $announce = $bdd->prepare('UPDATE forum_topics SET announce = 0, sticked = 0 WHERE id = ?');
      $announce->execute(array(urlVal('id')));
      alert('success','Le topic n\'est plus une annonce désormais');
      redirect('topic?id='.$topic_view->id);
      exit();
    } else {
      alert('error','Erreur');
      redirect('topic?id='.$topic_view->id);
      exit();
    }
  }
}

include 'inc/header.php';

include 'inc/top.php';

include 'inc/forum_top.php';

?>

<div class="forum-container">

  <div class="goback">
    <a href="forum">&laquo; Forum</a> - <a href="viewforum?id=<?= $topic_forum->id ?>"><?= decode($topic_forum->title) ?></a> - <span><?= decode($topic_view->title) ?></span>
  </div>

  <div class="topic-view-forum-head"
    <?php if ($topic_view->announce == 0): ?>
      style="background-image:url(brain/style/img/meet_forum_head.png)"
    <?php else: ?>
      style="background-image:url(brain/style/img/meet_forum_head_announce.png)"
    <?php endif; ?>
  >
    <div class="topic-view-forum-caption">
      <div class="topic-view-forum-title">
        <?php if ($topic_view->announce == 0): ?>
          <i class="fa fa-comments"></i>
        <?php endif; ?>
        <?php if ($topic_view->announce == 1): ?>
          <i class="fa fa-rss"></i>
        <?php endif; ?>

         <?= decode($topic_view->title) ?>
       </div>
       <div class="topic-view-forum-data">
         Posté le <?= date('d/m/Y',strtotime($topic_view->added_date)) ?> à <?= date('H:i',strtotime($topic_view->added_date)) ?>, par <?= $user->get('pseudo','token',$topic_view->author_token) ?>
       </div>
    </div>
  </div>

  <?php if ($topic_view->locked > 0): ?>
    <div class="topic-view-state">
      <i class="fa fa-lock"></i> Ce topic est vérouillé
    </div>
  <?php endif; ?>

  <?php if (url('delete') and urlVal('delete') == "true" and ($_SESSION['auth']['token'] == $topic_view->author_token or $user->info('rank') > 3)) { ?>
      <div class="delete-info text-center">
        <div class="text-light text-center margin-b">Êtes-vous sûr de vouloir supprimer ce Topic ?</div>
        <div><form method="POST" style="display:inline-block;">
          <button class="button button-success" name="delete_topic_button">Supprimer</button>
        </form>
        <form action="topic?id=<?= $topic_view->id ?>" method="POST" style="display:inline-block;">
          <button class="button" type="submit">Annuler</button>
        </form></div>
      </div>
    <?php } ?>

    <div class="topic-view-buttons" style="display:inline-block">
      <?php if ($topic_view->locked < 1 or $user->info('rank') > 5): ?>
        <a href="newreply?id=<?= urlVal('id') ?>" class="button button-success button-hoverable"><i class="fa fa-plus"></i>&nbsp; Nouvelle réponse</a>
      <?php endif; ?>
      <?php if ($user->info('token') == $topic_view->author_token or $user->info('rank') > 5): ?>
        <?php if ($topic_view->locked < 1 or $user->info('rank') > 5): ?>
          <a href="edit_topic?id=<?= urlVal('id') ?>" class="button button-hoverable"><i class="fa fa-edit"></i>&nbsp; Modifier</a>
        <?php endif; ?>
        <a href="topic?id=<?= urlVal('id') ?>&delete=true" class="button button-hoverable"><i class="fa fa-times"></i>&nbsp; Supprimer</a>
      <?php endif; ?>
    </div>

  <div class="topic-view-buttons" style="display:inline-block;float:right;">
    <?php if ($user->info('rank') > 5): ?>
      <?php if ($topic_view->locked > 0) { ?>
        <a href="topic?id=<?= urlVal('id') ?>&lock=false" class="button button-hoverable"><i class="fa fa-unlock"></i>&nbsp; Devérrouiller</i></a>
      <?php } else { ?>
        <a href="topic?id=<?= urlVal('id') ?>&lock=true" class="button button-hoverable"><i class="fa fa-lock"></i></a>
      <?php } ?>
    <?php endif; ?>
    <?php if ($user->info('rank') > 9): ?>
      <!-- Sticker -->
      <?php if ($topic_view->sticked > 0) { ?>
        <a href="topic?id=<?= urlVal('id') ?>&stick=false" class="button button-hoverable"><i class="fa fa-unlink"></i>&nbsp; Désticker</a>
      <?php } else { ?>
        <a href="topic?id=<?= urlVal('id') ?>&stick=true" class="button button-hoverable"><i class="fa fa-link"></i></a>
      <?php } ?>
      <!-- Annoncer -->
      <?php if ($topic_view->announce > 0) { ?>
        <a href="topic?id=<?= urlVal('id') ?>&announce=false" class="button button-hoverable"><i class="fa fa-globe"></i>&nbsp; Désannoncer</a>
      <?php } else { ?>
        <a href="topic?id=<?= urlVal('id') ?>&announce=true" class="button button-hoverable"><i class="fa fa-globe"></i></a>
      <?php } ?>
    <?php endif; ?>
  </div>

  <div class="topic-view-content">
    <?php if ($topic_view->edit_date != NULL): ?>
      <div class="topic-view-edit-date">Modifié il y a <?= $date->transform($topic_view->edit_date) ?></div>
    <?php endif; ?>
      <div class="topic-view-info-part">
        <div class="topic-view-info">
          <div class="topic-view-pseudo"><a href="profile?user=<?= $topic_view->author_token ?>"><?= $user->stylizedPseudo($user->get('pseudo','token',$topic_view->author_token),$user->get('rank','token',$topic_view->author_token)) ?></a></div>
          <div class="topic-view-avatar-container">
            <div class="topic-view-avatar" style="background-image:url(<?= $user->getAvatar($topic_view->author_token) ?>)"></div>
          </div>
          <div class="topic-view-grade-container">
            <?= $user->getGrade($topic_view->author_token) ?>
          </div>
          <div class="topic-view-badges">
            <?php
              $get_user_badges_worn = $bdd->prepare('SELECT * FROM badges_worn WHERE user_token = ? ORDER BY id');
              $get_user_badges_worn->execute(array($topic_view->author_token));
              if ($get_user_badges_worn->rowCount() > 0) {
                while ($badge = $get_user_badges_worn->fetch(PDO::FETCH_OBJ)) { ?>
                  <div class="topic-view-badge"><img src="<?= $badges->getLink($badge->badge_code); ?>" alt=""></div>
              <?php  } } else { ?>
                <span>Aucun badge porté</span>
              <?php }

            ?>
          </div>
          <div class="topic-view-description">
            <?= $user->get('humor','token',$topic_view->author_token) ?>
          </div>
          <div class="topic-view-count">
            <i class="fa fa-comments"></i> Messages: <?= $user->countReplies($topic_view->author_token) ?>
          </div>
          <div class="topic-view-count">
            <i class="fa fa-thumbs-up"></i><?= $user->countLikes($topic_view->author_token) ?>
          </div>
        </div>
      </div>
      <div class="topic-view-text-part">
        <div class="topic-view-text">
          <?= decode($topic_view->content) ?>
        </div>
      </div>
  </div>

  <div class="replies-head"><i class="fa fa-comments"></i> Les réponses</div>

  <?php

  $repliesParPage = 10;
  $repliesTotalesReq = $bdd->query('SELECT id FROM forum_replies');
  $repliesTotales = $repliesTotalesReq->rowCount();
  $pagesTotales = ceil($repliesTotales/$repliesParPage);
  if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $pagesTotales) {
     $_GET['page'] = intval($_GET['page']);
     $pageCourante = $_GET['page'];
  } else {
     $pageCourante = 1;
  }
  $depart = ($pageCourante-1)*$repliesParPage;

   $get_replies = $bdd->prepare('SELECT * FROM forum_replies WHERE topic_id = ? LIMIT '.$depart.','.$repliesParPage);
  $get_replies->execute(array($topic_view->id));
  if ($get_replies->rowCount() > 0) {
    while ($reply = $get_replies->fetch(PDO::FETCH_OBJ)) { ?>
      <div class="reply-content">
        <?php if ($_SESSION['auth']['token'] == $reply->author_token or $user->info('rank') > 5): ?>
          <div class="reply-buttons">
            <a href="edit_reply?id=<?= $reply->id ?>"><i class="fa fa-edit"></i></a>
            <a href="delete_reply?id=<?= $reply->id ?>"><i class="fa fa-times"></i></a>
          </div>
        <?php endif; ?>
        <?php if ($reply->edit_date != NULL): ?>
          <div class="reply-edit-date">Modifié il y a <?= $date->transform($reply->edit_date) ?></div>
        <?php endif; ?>
          <div class="reply-info-part">
            <div class="reply-info">
              <div class="reply-pseudo"><a href="profile?user=<?= $reply->author_token ?>"><?= $user->stylizedPseudo($user->get('pseudo','token',$reply->author_token),$user->get('rank','token',$reply->author_token)) ?></a></div>
              <div class="reply-avatar-container">
                <div class="reply-avatar" style="background-image:url(<?= $user->getAvatar($reply->author_token) ?>)"></div>
              </div>
              <div class="reply-grade-container">
                <?= $user->getGrade($reply->author_token) ?>
              </div>
              <div class="reply-badges">
                <?php
                  $get_user_badges_worn = $bdd->prepare('SELECT * FROM badges_worn WHERE user_token = ? ORDER BY id');
                  $get_user_badges_worn->execute(array($reply->author_token));
                  if ($get_user_badges_worn->rowCount() > 0) {
                    while ($badge = $get_user_badges_worn->fetch(PDO::FETCH_OBJ)) { ?>
                      <div class="reply-badge"><img src="<?= $badges->getLink($badge->badge_code); ?>" alt=""></div>
                  <?php  } } else { ?>
                    <span>Aucun badge porté</span>
                  <?php }

                ?>
              </div>
              <div class="reply-description">
                <?= $user->get('humor','token',$reply->author_token) ?>
              </div>
              <div class="reply-count">
                <i class="fa fa-comments"></i> Messages: <?= $user->countReplies($reply->author_token) ?>
              </div>
              <div class="reply-count">
                <i class="fa fa-thumbs-up"></i><?= $user->countLikes($reply->author_token) ?>
              </div>
            </div>
          </div>
          <div class="reply-text-part">
            <div class="reply-text">
              <?= $reply->content ?>
            </div>
          </div>
      </div>
    <?php } ?>
    <div class="paginations">
    <?php

    for($i=1;$i<=$pagesTotales;$i++) {
           if($i == $pageCourante) {
              echo '<span class="pagination active">'.$i.'</span>';
           } else {
              echo '<a href="topic?id='.$_GET['id'].'&page='.$i.'" class="pagination">'.$i.'</a> ';
           }
        } ?>
    </div>
    <?php } else { ?>
    <div class="replies-info">
      Aucune réponse
    </div>
  <?php } ?>

</div>

<?php

 include 'inc/bottom.php';

include 'inc/footer.php';

?>
