<?php

require 'brain/core.php';

$page = "Forum";

$user->restrict();
$user->restrictBan();
$user->restrictByFirstco();

if (!url('id')) {
  redirect('error');
}

$forums_view = $bdd->query('SELECT * FROM forum_forums WHERE id = '.urlVal('id'));
$forum_view = $forums_view->fetch(PDO::FETCH_OBJ);

if ($forums_view->rowCount() < 1) {
  redirect('error');
}


include 'inc/header.php';

include 'inc/top.php';

include 'inc/forum_top.php';

?>

<?php
$check_announces_query = $bdd->query('SELECT * FROM forum_topics WHERE announce = 1 ');
if ($check_announces_query->rowCount() > 0) {
  $check_announces = true;
} else {
  $check_announces = false;
}
?>
  <div class="forum-container">

    <div class="goback">
      <a href="forum">&laquo; Forum</a> - <span><?= $forum_view->title ?></span>
    </div>

<?php if ($check_announces): ?>

    <div class="forum-view">
      <div class="forum-view-head">
        <div class="forum-view-caption">
          <div class="forum-view-head-title">Annonces globales</div>
          <div class="forum-view-head-replies">Réponses</div>
          <div class="forum-view-head-views">Vues</div>
          <div class="forum-view-head-lastreplies">Dernière réponse</div>
        </div>
      </div>
      <div class="forum-view-content">
    <?php
      $topics_preview = $bdd->prepare('SELECT * FROM forum_topics WHERE sticked = 0 and announce = 1 ORDER BY id');
      $topics_preview->execute(array(urlVal('id')));
      if ($topics_preview->rowCount() < 1) { ?>
        <div class="forum-view-info">Aucun topic</div>
      <?php } else {
        while ($topic_preview = $topics_preview->fetch(PDO::FETCH_OBJ)) { ?>

              <div class="topic">
                <a class="topic-case" href="topic?id=<?= $topic_preview->id; ?>">
                  <div class="topic-icon">
                    <div class="topic-icon-caption">
                      <i class="fa fa-rss"></i>
                    </div>
                  </div>
                  <div class="topic-title"><?= $topic_preview->title; ?></div>
                </a>
                <div class="topic-replies"><?= $topic->countReplies($topic_preview->id) ?></div>
                <div class="topic-views"><?= $topic->countHits($topic_preview->id) ?></div>
                <div class="topic-lastreplies"></div>
              </div>
        <?php }
      } ?>
    </div>
  </div>
<?php endif; ?>

  <?php if ($forum_view->locked > 0): ?>
    <div class="forum-view-locked"><i class="fa fa-lock"></i> Désolé, ce forum est verouillé</div>
  <?php else: ?>
    <div class="forum-view-buttons">
      <a href="newtopic?forum=<?= urlVal('id') ?>" class="button button-hoverable button-success"><i class="fa fa-plus"></i>&nbsp;&nbsp; Créer un topic</a>
    </div>
  <?php endif; ?>

  <?php if ($forum_view->locked > 0 and $user->info('rank') > 1): ?>
    <div class="forum-view-buttons">
      <a href="newtopic?forum=<?= urlVal('id') ?>" class="button button-hoverable button-success"><i class="fa fa-plus"></i>&nbsp;&nbsp; Créer un topic</a>
    </div>
  <?php endif; ?>


  <div class="forum-view">
    <div class="forum-view-head">
      <div class="forum-view-caption">
        <div class="forum-view-head-title"><?= $forum_view->title ?></div>
        <div class="forum-view-head-replies">Réponses</div>
        <div class="forum-view-head-views">Vues</div>
        <div class="forum-view-head-lastreplies">Dernière réponse</div>
      </div>
    </div>
    <div class="forum-view-content">
  <?php
    $topics_preview_no_stick = $bdd->prepare('SELECT * FROM forum_topics WHERE forum_id = ? ORDER BY id');
    $topics_preview_no_stick->execute(array(urlVal('id')));

    /* Les topics non stickés */
    if ($topics_preview_no_stick->rowCount() < 1) { ?>
      <div class="forum-view-info">
        <div class="forum-view-info-image" style="text-align:center;">
          <img src="brain/style/img/meet_frank_search.png" alt="" />
        </div>
        <div>Aucun topic</div>
      </div>
    <?php } else {

      $topics_preview_sticked = $bdd->prepare('SELECT * FROM forum_topics WHERE forum_id = ? and sticked = 1 ORDER BY id desc');
      $topics_preview_sticked->execute(array(urlVal('id')));

      while ($topic_preview_sticked = $topics_preview_sticked->fetch(PDO::FETCH_OBJ)) { ?>

            <div class="topic">
              <a class="topic-case" href="topic?id=<?= $topic_preview_sticked->id; ?>">
                <div class="topic-icon">
                  <div class="topic-icon-caption">
                    <i class="fa fa-tag"></i>
                  </div>
                </div>
                <div class="topic-title"><?= decode($topic_preview_sticked->title); ?></div>
              </a>
              <div class="topic-replies"><?= $topic->countReplies($topic_preview_sticked->id) ?></div>
              <div class="topic-views"><?= $topic->countHits($topic_preview_sticked->id) ?></div>
              <div class="topic-lastreplies">
                <?php

                  $last_replies_sticked_query = $bdd->prepare('SELECT * FROM forum_replies WHERE topic_id = ? ORDER BY id desc LIMIT 1');
                  $last_replies_sticked_query->execute(array($topic_preview_sticked->id));

                  if ($last_replies_sticked_query->rowCount() > 0) {
                    while($last_reply_sticked = $last_replies_sticked_query->fetch(PDO::FETCH_OBJ)) {

                      ?>
                      <div class="topic-lastreplies-content">
                        <a href="profile?user=<?= $last_reply_sticked->author_token ?>" class="topic-lastreplies-avatar" style="background-image:url(<?= $user->getAvatar($last_reply_sticked->author_token) ?>)"></a>
                        <a href="profile?user=<?= $last_reply_sticked->author_token ?>" class="topic-lastreplies-pseudo"><?= $user->stylizedPseudo($user->get('pseudo','token',$last_reply_sticked->author_token),$user->get('rank','token',$last_reply_sticked->author_token)) ?></a>
                        <div class="topic-lastreplies-date">Il y a <?= $date->transform($last_reply_sticked->added_date) ?></div>
                      </div>
                    <?php }
                  } else { ?>
                    <div class="topic-lastreplies-info">
                      Aucune réponse
                    </div>
                  <?php } ?>
              </div>
            </div>
      <?php }

      $topicsParPage = 20;
      $topicsTotalesReq = $bdd->prepare('SELECT id FROM forum_topics WHERE forum_id = ?');
      $topicsTotalesReq->execute(array(urlVal('id')));
      $topicsTotales = $topicsTotalesReq->rowCount();
      $pagesTotales = ceil($topicsTotales/$topicsParPage);
      if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $pagesTotales) {
         $_GET['page'] = intval($_GET['page']);
         $pageCourante = $_GET['page'];
      } else {
         $pageCourante = 1;
      }
      $depart = ($pageCourante-1)*$topicsParPage;

      $topics_preview = $bdd->prepare('SELECT * FROM forum_topics WHERE forum_id = ? and sticked = 0 ORDER BY id LIMIT '.$depart.','.$topicsParPage);
      $topics_preview->execute(array(urlVal('id')));


      while ($topic_preview = $topics_preview->fetch(PDO::FETCH_OBJ)) { ?>

            <div class="topic">
              <a class="topic-case" href="topic?id=<?= $topic_preview->id; ?>">
                <div class="topic-icon">
                  <div class="topic-icon-caption">
                    <?php if ($topic_preview->locked > 0): ?>
                      <i class="fa fa-lock"></i>
                    <?php else: ?>
                      <i class="fa fa-comment" style="color:rgba(0,0,0,0.3)"></i>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="topic-title"><?= decode($topic_preview->title); ?></div>
              </a>
              <div class="topic-replies"><?= $topic->countReplies($topic_preview->id) ?></div>
              <div class="topic-views"><?= $topic->countHits($topic_preview->id) ?></div>
              <div class="topic-lastreplies">
                <?php

                  $last_replies_query = $bdd->prepare('SELECT * FROM forum_replies WHERE topic_id = ? ORDER BY id desc LIMIT 1');
                  $last_replies_query->execute(array($topic_preview->id));

                  if ($last_replies_query->rowCount() > 0) {
                    while($last_reply = $last_replies_query->fetch(PDO::FETCH_OBJ)) {

                      ?>
                      <div class="topic-lastreplies-content">
                        <a href="profile?user=<?= $last_reply->author_token ?>" class="topic-lastreplies-avatar" style="background-image:url(<?= $user->getAvatar($last_reply->author_token) ?>)"></a>
                        <a href="profile?user=<?= $last_reply->author_token ?>" class="topic-lastreplies-pseudo"><?= $user->stylizedPseudo($user->get('pseudo','token',$last_reply->author_token),$user->get('rank','token',$last_reply->author_token)) ?></a>
                        <div class="topic-lastreplies-date">Il y a <?= $date->transform($last_reply->added_date) ?></div>
                      </div>
                    <?php }
                  } else { ?>
                    <div class="topic-lastreplies-info">
                      Aucune réponse
                    </div>
                  <?php } ?>
              </div>
            </div>
      <?php } ?>
      <div class="paginations-forum">
      <?php

      for($i=1;$i<=$pagesTotales;$i++) {
             if($i == $pageCourante) {
                echo '<span class="pagination active">'.$i.'</span>';
             } else {
                echo '<a href="viewforum?id='.$_GET['id'].'&page='.$i.'" class="pagination">'.$i.'</a> ';
             }
          } ?>
      </div>
    <?php } ?>
  </div>
</div>
</div>

<?php

 include 'inc/bottom.php';

include 'inc/footer.php';

?>
