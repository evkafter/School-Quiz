<?php
	require_once('../core/db_connect.php');
	$bdd = new db();
	
	$sql = "UPDATE questions SET title = '$_POST[question_title]', ";
	$sql .= "text = '$_POST[question_text]', ";
	$sql .= "answers = '$_POST[question_answers]', ";
	$sql .= "course_id = '$_POST[question_course]', ";
	$sql .= "source = '$_POST[question_source]' ";
	$sql .= "WHERE question_id = '$_POST[question_id]' ";
	
	$result = $bdd->execute($sql);
	$json_result = array();
	$json_result['result'] = $result;
	$json_result['query'] = $sql;
	echo json_encode($json_result);
?>