<?php
	require('../core/db_connect.php');
	$bdd = new db();
	
	$rows = $bdd->getOne("SELECT MAX(question_id) as id_limit FROM questions");
	$id = intval($rows['id_limit']) + 1;
	
	$sql = "INSERT INTO questions (question_id, title, text, answers, course_id, source)";
	$sql .= " VALUES('$id', ";
	$sql .= "'$_POST[question_title]', ";
	$sql .= "'$_POST[question_text]', ";
	$sql .= "'$_POST[question_answers]', ";
	$sql .= "'$_POST[question_course]', ";
	$sql .= "'$_POST[question_source]') ";
	$result = $bdd->execute($sql);
	
	$json_result = array();
	$json_result['result'] = $sql;
	
	echo json_encode($json_result);
?>