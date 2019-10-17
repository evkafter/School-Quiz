<?php
	require('../core/db_connect.php');
	$bdd = new db();
	
	$sql = "DELETE FROM questions WHERE question_id = '$_POST[question_id]'";
	$result = $bdd->execute($sql);
	
	$json_result = array();
	$json_result['result'] = $result;
	echo json_encode($json_result);
?>