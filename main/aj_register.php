<?php
	require('../core/db_connect.php');
	$bdd = new db();
	
	$rows = $bdd->getOne("SELECT COUNT(first) as num FROM students");
	$id = intval($rows['num']) + 1;
	
	$sql = "INSERT INTO users (email, password) ";
	$sql.= " VALUES('".$_POST['student_email']."','".password_hash($_POST['student_password'], PASSWORD_DEFAULT)."')";
	$result = $bdd->execute($sql);
	
	$sql = "INSERT INTO students (student_id, first, last, email)";
	$sql .= " VALUES('$id', ";
	$sql .= "'$_POST[student_first]', ";
	$sql .= "'$_POST[student_last]', ";
	$sql .= "'$_POST[student_email]') ";
	$result = $bdd->execute($sql);
	
	$json_result = array();
	$json_result['result'] = $sql;
	echo json_encode($json_result);
?>