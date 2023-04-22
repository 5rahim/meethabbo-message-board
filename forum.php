<?php

require 'brain/core.php';

$page = "Forum";

$user->restrict();
$user->restrictBan();
$user->restrictByFirstco();

include 'inc/header.php';

include 'inc/top.php';

include 'inc/forum_top.php';

?>

<div class="forum-container">
  <?php
    $categories = $bdd->prepare('SELECT * FROM categories ORDER BY order_id');
    $categories->execute();
    while ($category = $categories->fetch(PDO::FETCH_OBJ)) { ?>
      <div class="category">
        <div class="category-head">
          <div class="category-caption">
            <div class="category-head-title"><?= $category->title ?></div>
            <div class="category-head-subjects">Sujets</div>
            <div class="category-head-topics">Dernier topic</div>
          </div>
        </div>
        <div class="category-content">
          <?php

            $forums = $bdd->prepare('SELECT * FROM forum_forums WHERE category_id = ? ORDER BY id');
            $forums->execute(array($category->id));
            while ($forum_preview = $forums->fetch(PDO::FETCH_OBJ)) { ?>
              <div class="forum">
                <div class="forum-one">
                  <a class="forum-image"  style="background-image:url(brain/style/img/<?= $forum_preview->image ?>)" href="viewforum?id=<?= $forum_preview->id; ?>"></a>
                  <a class="forum-title" href="viewforum?id=<?= $forum_preview->id; ?>"><?= $forum_preview->title; ?></a>
                  <div class="forum-desc"><?= $forum_preview->description; ?></div>
                </div>
                <div class="forum-subjects">
                  <div class="forum-subjects-caption"><!--<i class="fa fa-comments"></i><--><span><?= $forum->countTopics($forum_preview->id) ?></span></div>
                </div>
                <div class="forum-lasttopics">
                  <?php

                  $topics_preview = $bdd->query('SELECT * FROM forum_topics WHERE forum_id = '.$forum_preview->id.' ORDER BY id desc LIMIT 1');
                  $topic_preview = $topics_preview->fetch(PDO::FETCH_OBJ);?>
                  <div class="forum-lasttopics-caption">
                    <div class="forum-lasttopics-content">
                      <?php if ($topics_preview->rowCount() < 1): ?>
                        <div class="forum-lasttopics-info">Aucun topic</div>
                      <?php else: ?>
                        <a class="forum-lasttopics-title" href="topic?id=<?= $topic_preview->id ?>"><?= decode($topic_preview->title) ?></a>
                        <?php $d = strtotime($topic_preview->added_date);
              					$texte_en = array(
              				    "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun",
              				    "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul",
              				    "Aug", "Sep", "Oct", "Nov", "Dec"
              						);
              						$texte_fr = array(
              						    "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche",
              						    "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet",
              						    "Août", "Septembre", "Octobre", "Novembre", "Décembre"
              						);
              					$date = date('D/d/M/Y',$d);
              					$date_fr = str_replace($texte_en,$texte_fr,$date);
              					$date_final = str_replace("/"," ",$date_fr)
              					?>
                        <div class="forum-lasttopics-date"><?= $date_final ?> - <?= date('H:i', $d) ?></div>
                        <a class="forum-lasttopics-pseudo" href="profile?user=<?= $topic_preview->author_token ?>">
                          <?= $user->get('pseudo','token',$topic_preview->author_token) ?>
                        </a>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
          <?php } ?>
        </div>
      </div>
    <?php }
   ?>
</div>

<?php

 include 'inc/bottom.php';

include 'inc/footer.php';

?>
