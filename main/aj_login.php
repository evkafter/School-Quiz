<?php
	require('../core/db_connect.php');
	require_once('../core/session_manager.php');
	
	SessionManager::sessionStart('');
	$bdd = new db();
	
	$json_result = array();
	
	/* Select queries return a resultset */
	if($user = $bdd->getOne("SELECT * FROM users WHERE email='". $_POST['user_email'] ."'")) {
		if(password_verify($_POST["user_password"], $user['password'])){
			$email = $_POST['user_email'];
			$role = '';

			if($admin = $bdd->getOne("SELECT * FROM admins WHERE email='". $email ."'")){
				$role = SessionManager::$ROLE_ADMIN;
			}
			else if($student = $bdd->getOne("SELECT * FROM students WHERE email='". $email ."'")){
				$role = SessionManager::$ROLE_STUDENT;
			}
			
			$_SESSION['email'] = $email;
			$_SESSION['role'] = $role;
			$json_result['success'] = '';
		}
		else $json_result['error'] = 'Λάθος κωδικός';
	}
	else $json_result['error'] = 'Λάθος email';
	
	echo json_encode($json_result);
?>