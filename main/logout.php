<?php
	require_once('../core/session_manager.php');
	SessionManager::sessionStart('');
	
	session_destroy();
	header("location: /../main/home.php");
?>