<?php
	require('../core/db_connect.php');
	require_once('../core/session_manager.php');
	
	SessionManager::sessionStart('');
	$bdd = new db();
	
	$json_result = array();
	
	/* Select queries return a resultset */
	if($user = $bdd->getOne("SELECT * FROM users WHERE email='". $_SESSION['email'] ."'")) {
		if(password_verify($_POST['user_old_pass'], $user['password'])){			
			$new_pass = password_hash($_POST['user_new_pass'], PASSWORD_DEFAULT);
			$sql = "UPDATE users SET password = '". $new_pass."' WHERE email = '". $_SESSION['email']."'";
			$bdd->execute($sql);
			$json_result['success'] = '';
		}
		else $json_result['error'] = 'Λάθος κωδικός';
	}
	else $json_result['error'] = 'Λάθος email';
	
	echo json_encode($json_result);
?>