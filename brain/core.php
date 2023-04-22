<?php

session_start();
// date_default_timezone_set('UTC');

try{
	$param = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
	$bdd = new PDO("mysql:host=localhost;dbname=meethabbo", "root", "", $param);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e){
	echo $e->getMessage();
	die();
}

function secu($var){
	$var = htmlspecialchars(htmlentities(trim($var), ENT_NOQUOTES, "UTF-8"));
	return $var;
}

function passhash($var){
	$var = secu(md5(sha1(md5(sha1($var)))));
	return $var;
}

function hyperhash($var){
	$var = secu(md5(sha1(md5(sha1(md5(sha1(md5(sha1(md5(sha1(crypt($var, 100))))))))))));
	return $var;
}

function decode($var) {
	$var = html_entity_decode($var);
	return $var;
}

$config = array(
	"title" => "MeetHabbo",
	"state" => "BETA",
	"copyright" => "Wanka",
	"date" => "2016"
);

class Date {
	function transform($datetime) {
	    $now = time();
	    $created = strtotime($datetime);
	    // La différence est en seconde
	    $diff = $now-$created;
	    $m = ($diff)/(60); // on obtient des minutes
	    $h = ($diff)/(60*60); // ici des heures
	    $j = ($diff)/(60*60*24); // jours
	    $s = ($diff)/(60*60*24*7); // et semaines
	    if ($diff < 60) { // "il y a x secondes"
	        return $diff.' secondes';
	    }
	    elseif ($m < 60) { // "il y a x minutes"
	        $minute = (floor($m) == 1) ? 'minute' : 'minutes';
	        return floor($m).' '.$minute;
	    }
	    elseif ($h < 24) { // " il y a x heures, x minutes"
	        $heure = (floor($h) <= 1) ? 'heure' : 'heures';
	        $dateFormated = floor($h).' '.$heure;
	        /*if (floor($m-(floor($h))*60) != 0) {
	            $minute = (floor($m) == 1) ? 'minute' : 'minutes';
	            $dateFormated .= ', '.floor($m-(floor($h))*60).' '.$minute;
	        }*/
	        return $dateFormated;
	    }
	    elseif ($j < 7) { // " il y a x jours, x heures"
	        $jour = (floor($j) <= 1) ? 'jour' : 'jours';
	        $dateFormated = floor($j).' '.$jour;
	        /*if (floor($h-(floor($j))*24) != 0) {
	            $heure = (floor($h) <= 1) ? 'heure' : 'heures';
	            $dateFormated .= ', '.floor($h-(floor($j))*24).' '.$heure;
	        }*/
	        return $dateFormated;
	    }
	    elseif ($s < 5) { // " il y a x semaines, x jours"
	        $semaine = (floor($s) <= 1) ? 'semaine' : 'semaines';
	        $dateFormated = floor($s).' '.$semaine;
	        /*if (floor($j-(floor($s))*7) != 0) {
	            $jour = (floor($j) <= 1) ? 'jour' : 'jours';
	            $dateFormated .= ', '.floor($j-(floor($s))*7).' '.$jour;
	        }*/
	        return $dateFormated;
	    }
	    else { // on affiche la date normalement
	        return strftime("%d %B %Y à %H:%M", $created);
	    }
	}
}

$date = new Date();

function getField($what) {
	if (!empty($_POST[$what])) {
		return true;
	} else {
		return false;
	}
}

function field($what) {
	$field = secu($_POST[$what]);
	return $field;
}

function trigger($what) {
	if (isset($_POST[$what])) {
		return true;
	} else {
		return false;
	}
}

function url($url) {
	if (isset($_GET[$url])) {
		return true;
	} else {
		return false;
	}
}

function urlVal($url) {
	return $_GET[$url];
}

//On défini la fonction alert()
function alert($type,$message) {
  if ($type == "error") {
    $_SESSION['error_alert'] = $message;
  } else {
    $_SESSION['success_alert'] = $message;
  }
}

function redirect($where) {
	header('Location: '.$where);
}

function correctPseudo($what) {
	if (preg_match('`^([a-zA-Z0-9-_]{2,36})$`', $what)) {
		return true;
	} else {
		return false;
	}
}

function lenghtPseudo($what) {
	if (strlen($what) < 3) {
		return false;
	} else {
		return true;
	}
}

function lenghtPassword($what) {
	if (strlen($what) < 6) {
		return false;
	} else {
		return true;
	}
}

function samePasswords($one,$two) {
	if ($one == $two) {
		return true;
	} else {
		return false;
	}

}

class User {

	function login($pseudo) {
		global $bdd;
		$login_query = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
		$login_query->execute(array($pseudo));
		$login_user = $login_query->fetch(PDO::FETCH_OBJ);
		if ($login_query->rowCount() > 0) {
			$_SESSION['auth']['token'] = $login_user->token;
			$_SESSION['auth']['id'] = $login_user->id;
			return true;
		} else {
			return false;
		}
	}

	function checkToken($token) {
		global $bdd;
		$token_query = $bdd->prepare('SELECT * FROM users WHERE token = ?');
		$token_query->execute(array($token));
		if ($token_query->rowCount() > 0) {

		} else {
			alert("error", "Une erreur est survenue");
			header("Location: login");
			exit();
		}
	}

	function isProfileOwner() {
		if ($_SESSION['auth']['token'] == $_GET['user']) {
			return true;
		} else {
			return false;
		}
	}

	// On vérifie si l'utilisateur est vraiment à sa première connection
	function checkFirstco() {
		global $bdd;
		$token = $_SESSION['auth']['token'];
		$user_firstco_query = $bdd->prepare('SELECT * FROM users WHERE token = ?');
		$user_firstco_query->execute(array($token));
		$user_firstco = $user_firstco_query->fetch(PDO::FETCH_OBJ);
		if ($user_firstco->connection < 1) {

		} else {
			alert("error", "Vous ne pouvez pas accéder à cette page");
			header("Location: login");
			exit();
		}
	}

	/* On restrict l'accès à une page si l'utlisateur est à sa première connection */
	function restrictByFirstco() {
		global $bdd;
		$token = $_SESSION['auth']['token'];
		$user_firstco_query = $bdd->prepare('SELECT * FROM users WHERE token = ?');
		$user_firstco_query->execute(array($token));
		$user_firstco = $user_firstco_query->fetch(PDO::FETCH_OBJ);
		if ($user_firstco->connection > 0) {

		} else {
			header("Location: firstconnection?token=".$user_firstco->token);
			exit();
		}
	}

		/* On restrict l'accès à une page si l'utlisateur est banni */
		function restrictBan() {
			global $bdd;
			$token = $_SESSION['auth']['token'];
			$user_ban_query = $bdd->prepare('SELECT * FROM users WHERE token = ?');
			$user_ban_query->execute(array($token));
			$user_ban = $user_ban_query->fetch(PDO::FETCH_OBJ);
			if ($user_ban->ban < 1) {

			} else {
				header("Location: ban");
				exit();
			}
		}

	/* On récupère la valeur de la connection de l'utilisateur */
	function firstConnection($pseudo) {
		global $bdd;
		$firstco_query = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
		$firstco_query->execute(array($pseudo));
		$firstco = $firstco_query->fetch(PDO::FETCH_OBJ);
		return $firstco->connection;
	}

	/* On verifie si un utilisateur existe grâce a une colonne */
	function existUser($with,$what) {
		global $bdd;
		$check_exist_user = $bdd->prepare('SELECT * FROM users WHERE '.$with.' = ?');
		$check_exist_user->execute(array($what));
		if ($check_exist_user->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	/* On verifie si un utilisateur est banni */
	function isBanned($pseudo) {
		global $bdd;
		$check_ban = $bdd->prepare('SELECT * FROM users WHERE pseudo = ? AND ban > 0');
		$check_ban->execute(array($pseudo));
		if ($check_ban->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	/* On verifie si un utilisateur est banni */
	function isBannedBytoken($token) {
		global $bdd;
		$check_ban = $bdd->prepare('SELECT * FROM users WHERE token = ? AND ban > 0');
		$check_ban->execute(array($token));
		if ($check_ban->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	/* On verifie si un utilisateur existe grâce à deux colonne */
	function existUserWith($pseudo,$password) {
		global $bdd;
		$check_exist_user_with = $bdd->prepare('SELECT * FROM users WHERE pseudo = ? and password = ?');
		$check_exist_user_with->execute(array($pseudo,$password));
		if ($check_exist_user_with->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	function isSaloonMember() {
		global $bdd;
		$check_is_saloon_member = $bdd->prepare('SELECT * FROM saloon_members WHERE member_token = ?');
		$check_is_saloon_member->execute(array($_SESSION['auth']['token']));
		if ($check_is_saloon_member->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	function isSaloonStaff() {
		global $bdd;
		$check_is_saloon_staff = $bdd->prepare('SELECT * FROM saloon_members WHERE member_token = ? and rank > 1');
		$check_is_saloon_staff->execute(array($_SESSION['auth']['token']));
		if ($check_is_saloon_staff->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	/* On verifie si un utilisateur existe grâce au tokene */
	function checkProfile($token) {
		global $bdd;
		$check_profile = $bdd->prepare('SELECT * FROM users WHERE token = ?');
		$check_profile->execute(array($token));
		if ($check_profile->rowCount() > 0) {

		} else {
			alert("error","Cet utilisateur n'existe pas");
			header("Location: index");
			exit();
		}
	}

	/* On restrict si l'utlisateur n'est pas co */
  function restrict() {
    if (empty($_SESSION['auth']['token'])) {
      header("Location: login");
			exit();
    }
  }

	/* On restrict si l'utilisateur est connecté */
	function restrictConnected() {
		if (isset($_SESSION['auth']['token'])) {
      header("Location: index");
			exit();
    }
	}

  /* Verifier si l'utilisateur est connecté */
	function isConnected() {
		if (isset($_SESSION['auth']['token'])) {
			return true;
		} else {
			return false;
		}
	}

	/* On déconnecte l'utilisateur */
	function logout() {
		session_destroy();
		header("Location: login");
		exit();
	}

	/* Prendre l'avatar de l'utilisateur */
	function getAvatar($token) {
		global $bdd;
		if ($this->isConnected()) {
			$get_avatar = $bdd->prepare('SELECT * FROM users WHERE token = ?');
			$get_avatar->execute(array($token));
			$avatar = $get_avatar->fetch(PDO::FETCH_OBJ);
			echo 'brain/style/img/bank/'.$avatar->avatar.'';
		}
	}

	/* Prendre le background de l'utilisateur */
	function getBackground($token) {
		global $bdd;
		if ($this->isConnected()) {
			$get_avatar = $bdd->prepare('SELECT * FROM users WHERE token = ?');
			$get_avatar->execute(array($token));
			$avatar = $get_avatar->fetch(PDO::FETCH_OBJ);
			echo 'brain/style/img/bank/'.$avatar->background.'';
		}
	}

  /* 2 */
	function countBadges($token) {
		global $bdd;
		if ($this->isConnected()) {
			$get_user_badges_worn_number = $bdd->prepare('SELECT * FROM badges_worn WHERE user_token = ?');
			$get_user_badges_worn_number->execute(array($token));
			return intval($get_user_badges_worn_number->rowCount());
		}
	}


  /* 1 */
	function wearBadge($code) {
		global $bdd;
		$get_user_badges_worn = $bdd->prepare('SELECT * FROM badges_worn WHERE user_token = ? AND badge_code = ?');
		$get_user_badges_worn->execute(array($_SESSION['auth']['token'],$code));
		if ($get_user_badges_worn->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

  /* 1 */
	function hasBadge($code) {
		global $bdd;
		$get_user_badges_membership = $bdd->prepare('SELECT * FROM badges_membership WHERE user_token = ? AND badge_code = ?');
		$get_user_badges_membership->execute(array($_SESSION['auth']['token'],$code));
		if ($get_user_badges_membership->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	function get($what,$by,$thing) {
		global $bdd;
		$get_user_information = $bdd->prepare('SELECT * FROM users WHERE '.$by.' = ?');
		$get_user_information->execute(array($thing));
		$get_information = $get_user_information->fetch(PDO::FETCH_OBJ);
		return $get_information->$what;
	}

	function info($what) {
		global $bdd;
		$get_user_info_query = $bdd->prepare('SELECT * FROM users WHERE token = ?');
		$get_user_info_query->execute(array($_SESSION['auth']['token']));
		$get_user_info = $get_user_info_query->fetch(PDO::FETCH_OBJ);
		return $get_user_info->$what;
	}

	/* On ajoute un utilisateur */
	function addUser($pseudo,$password,$email,$retro) {
		global $bdd;
		$default_humor = "Nouveau sur MeetHabbo!";
		$default_user_avatar = "default_user_avatar.png";
		$default_user_background = "default_user_background.png";
		$token = passhash($email.time());
		$add_user = $bdd->prepare('INSERT INTO users(pseudo,password,email,retro,mood,humor,avatar,background,added_date,rank,evolution,ban,validate,token,connection,textamigo,coins,ducks) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
		$add_user->execute(array($pseudo,$password,$email,$retro,1,$default_humor,$default_user_avatar,$default_user_background,date('m/d/Y H:i:s'),1,5,0,1,$token,0,1,500,0));
	}

	/* On finalise l'inscription d'un utilisateur */
	function finalize($token) {
		global $bdd;
		$user_id = $_SESSION['auth']['id'];
		$finalize_user_query = $bdd->query('UPDATE users SET connection = 1');
		$finalize_add_badge = $bdd->prepare('INSERT INTO badges_membership(user_token,user_id,badge_code) VALUES(?,?,?)');
		$finalize_add_badge->execute(array($token,$user_id,"BVN"));
	}

	function likeUser($token) {
		global $bdd;
		$check_like = $bdd->prepare('SELECT * FROM likes WHERE author_token = ? and target_token = ?');
		$check_like->execute(array($_SESSION['auth']['token'],$token));
		if ($check_like->rowCount() < 1) {
			$likeUser = $bdd->prepare('INSERT INTO likes(author_token,author_id,target_token) VALUES(?,?,?)');
			$likeUser->execute(array($_SESSION['auth']['token'],$_SESSION['auth']['id'],$token));
			alert('success','Mention j\'aimes enregistrée');
			$this->notification($token,'a apprécier votre profil','profile',$_SESSION['auth']['token']);
		} else {
			$likeUser = $bdd->prepare('DELETE FROM likes WHERE author_token = ? and target_token = ?');
			$likeUser->execute(array($_SESSION['auth']['token'],$token));
			alert('success','Vous n\'aimez plus ce profil');
		}
	}

	function friendDemandUser($token) {
		global $bdd;
			$check_demand = $bdd->prepare('SELECT * FROM friendship_demands WHERE user_token = ? and target_token = ? and refused = 1');
			$check_demand->execute(array($_SESSION['auth']['token'],$token));
			if ($check_demand->rowCount() > 0) {
				$demandUser = $bdd->prepare('UPDATE friendship_demands SET refused = 0 WHERE user_token = ? and target_token = ?');
				$demandUser->execute(array($_SESSION['auth']['token'],$token));
				alert('success','Demande d\'ami envoyée');
			} else {
				$demandUser = $bdd->prepare('INSERT INTO friendship_demands(user_token,target_token,accepted,refused) VALUES(?,?,?,?)');
				$demandUser->execute(array($_SESSION['auth']['token'],$token,0,0));
				alert('success','Demande d\'ami envoyée');
			}

	}

	function acceptTextamigo($token) {
		global $bdd;
		$check_textamigo = $bdd->prepare('SELECT * FROM users WHERE token = ?');
		$check_textamigo->execute(array($token));
		$check_textamigo = $check_textamigo->fetch(PDO::FETCH_OBJ);
		if ($check_textamigo->textamigo < 1) {
			return false;
		} else {
			return true;
		}
	}

	function alreadyLike($token) {
		global $bdd;
		$check_like = $bdd->prepare('SELECT * FROM likes WHERE author_token = ? and target_token = ?');
		$check_like->execute(array($_SESSION['auth']['token'],$token));
		if ($check_like->rowCount() < 1) {
			return false;
		} else {
			return true;
		}
	}

	function alreadyFriend($token) {
		global $bdd;
		$check_friend = $bdd->prepare('SELECT * FROM friendship WHERE friend_token = ? and user_token = ?');
		$check_friend->execute(array($_SESSION['auth']['token'],$token));
		if ($check_friend->rowCount() < 1) {
			$check_friend2 = $bdd->prepare('SELECT * FROM friendship WHERE user_token = ? and friend_token = ?');
			$check_friend2->execute(array($_SESSION['auth']['token'],$token));
			if ($check_friend2->rowCount() < 1) {
				return false;
			} else {
				return true;
			}
		} else {
			return true;
		}
	}

	function existDemand($token) {
		global $bdd;
		$check_demand_friend = $bdd->prepare('SELECT * FROM friendship_demands WHERE user_token = ? and target_token = ? and accepted = 0 and refused = 0');
		$check_demand_friend->execute(array($_SESSION['auth']['token'],$token));
		if ($check_demand_friend->rowCount() < 1) {
			return false;
		} else {
			return true;
		}
	}

	function countFriendDemands() {
		global $bdd;
		$count_likes = $bdd->prepare('SELECT * FROM friendship_demands WHERE target_token = ? and accepted = 0 and refused = 0');
		$count_likes->execute(array($_SESSION['auth']['token']));
		return $count_likes->rowCount();
	}

	function countFriendships() {
		global $bdd;
		$count_friends = $bdd->prepare('SELECT * FROM friendship WHERE user_token = ?');
		$count_friends->execute(array($_SESSION['auth']['token']));
		return $count_friends->rowCount();
	}

	function countNotifications() {
		global $bdd;
		$count_n = $bdd->prepare('SELECT * FROM notifications WHERE target_token = ?');
		$count_n->execute(array($_SESSION['auth']['token']));
		return $count_n->rowCount();
	}

	function countLikes($token) {
		global $bdd;
		$count_likes = $bdd->prepare('SELECT * FROM likes WHERE author_token = ? and target_token = ?');
		$count_likes->execute(array($_SESSION['auth']['token'],$token));
		if ($count_likes->rowCount() == 1) {
			echo $count_likes->rowCount().' Mention j\'aime';
		} elseif ($count_likes->rowCount() > 1) {
			echo $count_likes->rowCount().' Mentions j\'aime';
		} else {
			echo 'Aucune mention j\'aime';
		}
	}

	function countFriends($token) {
		global $bdd;
		$count_likes = $bdd->prepare('SELECT * FROM friendship WHERE friend_token = ?');
		$count_likes->execute(array($token));
		if ($count_likes->rowCount() == 1) {
			echo $count_likes->rowCount().' Ami';
		} elseif ($count_likes->rowCount() > 1) {
			echo $count_likes->rowCount().' Amis';
		} else {
			echo 'Aucun ami';
		}
	}

	/* On retire un badge à l'utilisateur */
	function leaveBadge($code) {
		global $bdd;
		$leave_badge = $bdd->prepare('DELETE FROM badges_worn WHERE user_token = ? and badge_code = ?');
		$leave_badge->execute(array($_SESSION['auth']['token'],$code));
		return true;
	}

	/* On fait porter un badge à l'utilisateur */
	function takeBadge($code) {
		global $bdd;
		$leave_badge = $bdd->prepare('INSERT INTO badges_worn(user_token,user_id,badge_code) VALUES(?,?,?)');
		$leave_badge->execute(array($_SESSION['auth']['token'],$_SESSION['auth']['id'],$code));
		return true;
	}

	/* On modifie l'email de l'utilisateur */
	function editEmail($email) {
		global $bdd;
		$edit_email = $bdd->prepare('UPDATE users SET email = ? WHERE token = ?');
		$edit_email->execute(array($email,$_SESSION['auth']['token']));
		return true;
	}

	/* On modifie l'état des textamigos de l'utilisateur */
	function editTextamigo($val) {
		global $bdd;
		$edit_textamigo = $bdd->prepare('UPDATE users SET textamigo = ? WHERE token = ?');
		$edit_textamigo->execute(array($val,$_SESSION['auth']['token']));
		return true;
	}

	/* On modifie l'email de l'utilisateur */
	function editPassword($password) {
		global $bdd;
		$edit_password = $bdd->prepare('UPDATE users SET password = ? WHERE token = ?');
		$edit_password->execute(array($password,$_SESSION['auth']['token']));
		return true;
	}

	function notification($target_token,$content,$type,$type_thing) {
		global $bdd;
		if ($target_token !== $_SESSION['auth']['token']) {
			if ($type == "topic") {
				$n = $bdd->prepare('INSERT INTO notifications(author_token,author_id,target_token,content,_topic_id,added_date) VALUES(?,?,?,?,?,?)');
				$n->execute(array($_SESSION['auth']['token'],$_SESSION['auth']['id'],$target_token,$content,$type_thing,date('m/d/Y H:i:s')));
			} elseif ($type == "room") {
				$n = $bdd->prepare('INSERT INTO notifications(author_token,author_id,target_token,content,_room_id,added_date) VALUES(?,?,?,?,?,?)');
				$n->execute(array($_SESSION['auth']['token'],$_SESSION['auth']['id'],$target_token,$content,$type_thing,date('m/d/Y H:i:s')));
			} elseif ($type == "profile") {
				$n = $bdd->prepare('INSERT INTO notifications(author_token,author_id,target_token,content,_profile_token,added_date) VALUES(?,?,?,?,?,?)');
				$n->execute(array($_SESSION['auth']['token'],$_SESSION['auth']['id'],$target_token,$content,$type_thing,date('m/d/Y H:i:s')));
			}
		} else {

		}

	}

	function acceptDemand($token,$id) {
		global $bdd;
		$accept_demand = $bdd->prepare('INSERT INTO friendship(user_token,friend_token,added_date,demand_id) VALUES(?,?,?,?)');
		$accept_demand->execute(array($_SESSION['auth']['token'],$token,date('m/d/Y H:i:s'),$id));
		$accept_demand2 = $bdd->prepare('INSERT INTO friendship(friend_token,user_token,added_date,demand_id) VALUES(?,?,?,?)');
		$accept_demand2->execute(array($_SESSION['auth']['token'],$token,date('m/d/Y H:i:s'),$id));
		$ad = $bdd->prepare('UPDATE friendship_demands SET accepted = 1 WHERE id = ?');
		$ad->execute(array($id));
		$this->notification($token,'a accepté votre demande d\'ami','profile',$_SESSION['auth']['token']);
	}

	function refuseDemand($token,$id) {
		global $bdd;
		$ad = $bdd->prepare('UPDATE friendship_demands SET refused = 1 WHERE id = ?');
		$ad->execute(array($id));
		$this->notification($token,'a refusé votre demande d\'ami','profile',$_SESSION['auth']['token']);
	}

	/*function deleteFriend($token) {
		global $bdd;
		$check_friend = $bdd->prepare('SELECT * FROM friendship WHERE user_token = ? and friend_token = ?');
		$check_friend->execute(array($_SESSION['auth']['token'],$token));
		if ($check_friend->rowCount() < 1) {
			$check_friend2 = $bdd->prepare('SELECT * FROM friendship WHERE friend_token = ? and user_token = ?');
			$check_friend2->execute(array($_SESSION['auth']['token'],$token));
			if ($check_friend2->rowCount() < 1) {

			} else {
				$delete_friend = $bdd->prepare('DELETE FROM friendship WHERE friend_token = ? or user_token = ?');
				$delete_friend->execute(array($_SESSION['auth']['token'],$token));
				$delete_demand = $bdd->prepare('DELETE FROM friendship_demands WHERE user_token = ? or target_token = ?');
				$delete_demand->execute(array($_SESSION['auth']['token'],$token));
			}
		} else {
			$delete_friend = $bdd->prepare('DELETE FROM friendship WHERE user_token = ? or friend_token = ?');
			$delete_friend->execute(array($_SESSION['auth']['token'],$token));
			$delete_demand = $bdd->prepare('DELETE FROM friendship_demands WHERE target_token = ? or user_token = ?');
			$delete_demand->execute(array($_SESSION['auth']['token'],$token));
		}
		alert('success','Cet utilisateur ne fait plus partit de vos amis');
	}*/

	function deleteFriend($token) {
		global $bdd;
		$check_friend = $bdd->prepare('SELECT * FROM friendship WHERE user_token = ? and friend_token = ?');
		$check_friend->execute(array($_SESSION['auth']['token'],$token));
		$friend_demand = $check_friend->fetch(PDO::FETCH_OBJ);
		if ($check_friend->rowCount() > 0) {
			$delete_friend = $bdd->prepare('DELETE FROM friendship WHERE user_token = ? or friend_token = ?');
			$delete_friend->execute(array($_SESSION['auth']['token'],$token));
			$delete_friend = $bdd->prepare('DELETE FROM friendship WHERE friend_token = ? or user_token = ?');
			$delete_friend->execute(array($_SESSION['auth']['token'],$token));
			$delete_demand = $bdd->prepare('DELETE FROM friendship_demands WHERE id = ?');
			$delete_demand->execute(array($friend_demand->demand_id));
		}
		alert('success','Cet utilisateur ne fait plus partit de vos amis');
	}

	function ban($pseudo,$raison,$time) {
		global $bdd;
		$ban = $bdd->prepare('UPDATE users SET ban = 1, ban_raison = ?, ban_time = ? WHERE pseudo = ?');
		$ban->execute(array($raison,date('m/d/Y H:i:s',strtotime($time)),$pseudo));
	}

	function getBanTime($token) {
		global $bdd;
		$get_ban_time = $bdd->prepare('SELECT * FROM users WHERE token = ?');
		$get_ban_time->execute(array($token));
		$get_ban_time = $get_ban_time->fetch(PDO::FETCH_OBJ);
		return $get_ban_time->ban_time;
	}

	function unban($token) {
		global $bdd;
		$deban = $bdd->prepare('UPDATE users SET ban = 0 , ban_time = ?, ban_raison = ? WHERE token = ?');
		$deban->execute(array(NULL,NULL,$token));
	}

	function giveBadge($token,$id,$code) {
		global $bdd;
		$givebadge = $bdd->prepare('INSERT INTO badges_membership(user_token,user_id,badge_code) VALUES(?,?,?)');
		$givebadge->execute(array($token,$id,$code));
	}

	function giveCoins($token,$amount) {
		global $bdd;
		$givecoins = $bdd->prepare('UPDATE users SET coins = coins + ? WHERE token = ?');
		$givecoins->execute(array($amount,$token));
	}

	function giveDucks($token,$amount) {
		global $bdd;
		$giveducks = $bdd->prepare('UPDATE users SET ducks = ducks + ? WHERE token = ?');
		$giveducks->execute(array($amount,$token));
	}

	function autoDeban() {
		global $bdd;
		global $user;
			if ($user->isBannedByToken($_SESSION['auth']['token'])) {
				$ban_time = strtotime($this->getBanTime($_SESSION['auth']['token']));
				// $ban_time = strtotime($ban_time);
				if ((strtotime(date('m/d/Y H:i:s',time())) - strtotime($user->info('ban_time'))) >= 0) {
					$deban = $bdd->prepare('UPDATE users SET ban = 0 , ban_time = ?, ban_raison = ? WHERE token = ?');
					$deban->execute(array(NULL,NULL,$_SESSION['auth']['token']));
				}
		} else {
			redirect('index');
			exit();
		}
	}

	function stylizedPseudo($pseudo,$rank) {
		if ($rank == 10) { ?>
			<img src="brain/style/img/meet_state_admin.png" alt=""> <span style="color:rgb(185, 47, 47)"><?= $pseudo ?></span>
		<?php } elseif($rank == 4) { ?>
			<img src="brain/style/img/meet_state_anim.png" alt=""> <span style="color:rgb(0, 162, 158)"><?= $pseudo ?></span>
		<?php } elseif ($rank == 6) { ?>
			<img src="brain/style/img/meet_state_modo.png" alt=""> <span style="color:rgb(47, 185, 94)"><?= $pseudo ?></span>
		<?php } else {
			echo $pseudo;
		}

	}

	function countReplies($token) {
		global $bdd;
		$get_nb_replies = $bdd->prepare('SELECT * FROM forum_replies WHERE author_token = ?');
		$get_nb_replies->execute(array($token));
		return $get_nb_replies->rowCount();
	}

	function getGrade($token) {
		global $bdd;
		if ($this->countReplies($token) >= 0 and $this->countReplies($token)<= 50 and $this->get('rank','token',$token) == 1) { ?>
			<img src="brain/style/img/meet_grade_user_0.png" alt="" />
		<?php } elseif($this->countReplies($token) >= 50 and $this->countReplies($token) <= 150 and $this->get('rank','token',$token) == 1){ ?>
			<img src="brain/style/img/meet_grade_user_1.png" alt="" />
		<?php } elseif($this->countReplies($token) >= 150 and $this->countReplies($token) <= 300 and $this->get('rank','token',$token) == 1) { ?>
			<img src="brain/style/img/meet_grade_user_2.png" alt="" />
		<?php } elseif($this->countReplies($token) >= 200 and $this->countReplies($token) <= 450 and $this->get('rank','token',$token) == 1) { ?>
			<img src="brain/style/img/meet_grade_user_3.png" alt="" />
		<?php } elseif($this->countReplies($token) >= 350 and $this->countReplies($token) <= 950 and $this->get('rank','token',$token) == 1) { ?>
			<img src="brain/style/img/meet_grade_user_4.png" alt="" />
		<?php }  elseif($this->countReplies($token) >= 750 and $this->countReplies($token) <= 1200 and $this->get('rank','token',$token) == 1) { ?>
			<img src="brain/style/img/meet_grade_user_1.png" alt="" />
		<?php }

		if ($this->get('rank','token',$token) == 10) { ?>
			<img src="brain/style/img/meet_grade_fonda.png" alt="" />
		<?php }

		if ($this->get('rank','token',$token) == 6) { ?>
			<img src="brain/style/img/meet_grade_modo.png" alt="" />
		<?php }

		if ($this->get('rank','token',$token) == 4) { ?>
			<img src="brain/style/img/meet_grade_anim.png" alt="" />
		<?php }

	}

}
$user = new User();

class Settings {

	function option($what) {
		global $bdd;
		$get_settings_options = $bdd->query('SELECT * FROM settings WHERE id = 1');
		$get_settings_option = $get_settings_options->fetch(PDO::FETCH_OBJ);
		return $get_settings_option->$what;
	}

	public function greeting() {
		$hour = date('G');
		global $user;
		?>
			<div class="greeting-box">
				<a class="greeting-box-close" href="?no_greeting=true">×</a>
				<div class="greeting-hotel"></div>
				<?php

					echo 'Salut '.$user->info('pseudo').', ';

					if ( $hour >= 5 && $hour <= 11 ) {
						echo "bonne journée sur MeetHabbo "."[".date('H:i', time())."]";
					} else if ( $hour >= 12 && $hour <= 17 ) {
						echo "bon après-midi sur MeetHabbo "."[".date('H:i', time())."]";
					} else if ( $hour >= 18 || $hour <= 4 ) {
						echo "bonne soirée sur MeetHabbo "."[".date('H:i', time())."]";
					}
				 ?>
			</div>
		<?php
	}
}

$settings = new Settings();

class Retro {
	function list() {
		global $bdd;
		$retro_list_query = $bdd->query('SELECT * FROM retros ORDER BY id');
		while ($retro_list = $retro_list_query->fetch(PDO::FETCH_OBJ)) {
			if ($retro_list->code != "MHB") {
				echo '<option value="'.$retro_list->code.'">'.$retro_list->title.'</option>';
			}
		}
	}

	function getName($code) {
		global $bdd;
		$get_retro_desc = $bdd->prepare('SELECT * FROM retros WHERE code = ?');
		$get_retro_desc->execute(array($code));
		$retro_desc = $get_retro_desc->fetch(PDO::FETCH_OBJ);
		echo $retro_desc->title;
	}
}

$retro = new Retro();

class Badges {
	function getLink($code) {
		global $bdd;
		$get_badge_link = $bdd->prepare('SELECT * FROM badges WHERE code = ?');
		$get_badge_link->execute(array($code));
		$badge_link = $get_badge_link->fetch(PDO::FETCH_OBJ);
		echo 'brain/style/img/badges/'.$badge_link->image;
	}

	function getDesc($code) {
		global $bdd;
		$get_badge_desc = $bdd->prepare('SELECT * FROM badges WHERE code = ?');
		$get_badge_desc->execute(array($code));
		$badge_desc = $get_badge_desc->fetch(PDO::FETCH_OBJ);
		echo $badge_desc->description;
	}
}

$badges = new Badges();

class Forum {
	public function countTopics($id) {
		global $bdd;
		$count_topics = $bdd->prepare('SELECT * FROM forum_topics WHERE forum_id = ?');
		$count_topics->execute(array($id));
		if ($count_topics->rowCount() < 1) {
			echo '0';
		} else {
			return $count_topics->rowCount();
		}
	}
}

$forum = new Forum();

class Topic {
	public function countReplies($id) {
		global $bdd;
		$count_replies = $bdd->prepare('SELECT * FROM forum_replies WHERE topic_id = ?');
		$count_replies->execute(array($id));
		if ($count_replies->rowCount() < 1) {
			echo '0';
		} else {
			return $count_replies->rowCount();
		}
	}

	public function hit($id) {
		global $bdd;
		$view_check = $bdd->prepare('SELECT * FROM topic_views WHERE topic_id = :id');
		$view_check->execute(array("id" => $id));
		if($view_check->rowCount() < 1) {
			$topic_id = $_GET['id'];

			$view_insert = $bdd->prepare('INSERT INTO topic_views(topic_id,hits) VALUES(?,?)');
			$view_insert->execute(array($topic_id,1));
		} else {
			$view_sql = $bdd->prepare("UPDATE topic_views SET hits = hits + 1 WHERE topic_id = :id");
			$view_sql->bindValue("id", $id, PDO::PARAM_STR);
			$view_sql->execute();
		}
	}

	public function countHits($id) {
		global $bdd;
		$count_replies = $bdd->prepare('SELECT * FROM topic_views WHERE topic_id = ?');
		$count_replies->execute(array($id));
		$get_count = $count_replies->fetch(PDO::FETCH_OBJ);
		if ($count_replies->rowCount() < 1 or $get_count->hits < 1) {
			echo '0';
		} else {
			return $get_count->hits;
		}
	}

	function addtopic($title,$content,$forum_id) {
		global $bdd;
		$add_topic = $bdd->prepare('INSERT INTO forum_topics(title,author_token,content,added_date,announce,sticked,warned,locked,forum_id) VALUES(?,?,?,?,?,?,?,?,?) ');
		$add_topic->execute(array($title,$_SESSION['auth']['token'],$content,date('m/d/Y H:i:s'),0,0,0,0,$forum_id));
	}

	function addreply($content,$topic_id) {
		global $bdd;
		global $user;
		$get_topic = $bdd->prepare('SELECT * FROM forum_topics WHERE id = ?');
		$get_topic->execute(array($topic_id));
		$topic = $get_topic->fetch(PDO::FETCH_OBJ);
		$add_reply = $bdd->prepare('INSERT INTO forum_replies(author_token,content,added_date,topic_id) VALUES(?,?,?,?) ');
		$add_reply->execute(array($_SESSION['auth']['token'],$content,date('m/d/Y H:i:s'),$topic_id));
		if ($_SESSION['auth']['token'] != $topic->author_token) {
			if (!isset($_SESSION['alreadyAnswer'][$topic_id])) {
				$user->notification($topic->author_token,'a posté un réponse sur votre topic','topic',$topic->id);
				$_SESSION['alreadyAnswer'][$topic_id] = "true";
			}
		}
	}

	function editreply($id,$content,$topic_id) {
		global $bdd;
		$select_reply = $bdd->prepare('SELECT * FROM forum_replies WHERE id = ?');
		$select_reply->execute(array($id));
		$rs = $select_reply->fetch(PDO::FETCH_OBJ);
		$delete_before = $bdd->prepare('DELETE FROM forum_replies WHERE id = ?');
		$delete_before->execute(array($id));
		$add_reply = $bdd->prepare('INSERT INTO forum_replies(id,author_token,content,added_date,topic_id,edit_date) VALUES(?,?,?,?,?,?) ');
		$add_reply->execute(array($id,$rs->author_token,$content,$rs->added_date,$rs->topic_id,date('m/d/Y H:i:s')));
	}

	function edittopic($id,$title,$content) {
		global $bdd;
		$select_topic = $bdd->prepare('SELECT * FROM forum_topics WHERE id = ?');
		$select_topic->execute(array($id));
		$ts = $select_topic->fetch(PDO::FETCH_OBJ);
		$delete_before = $bdd->prepare('DELETE FROM forum_topics WHERE id = ?');
		$delete_before->execute(array($id));
		$add_topic_after = $bdd->prepare('INSERT INTO forum_topics(id,title,author_token,content,added_date,announce,sticked,warned,locked,forum_id,edit_date) VALUES(?,?,?,?,?,?,?,?,?,?,?) ');
		$add_topic_after->execute(array($id,$title,$ts->author_token,$content,$ts->added_date,$ts->announce,$ts->sticked,$ts->warned,$ts->locked,$ts->forum_id,date('m/d/Y H:i:s')));
	}
}

$topic = new Topic();
