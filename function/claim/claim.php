<?php
	require_once '../includes.php';

	$res_id = $_GET['claim'];
	$date = date("Y-m-d");
	$sql = "UPDATE reserve set status = 'claimed',date_claimed = '{$date}' where res_id = {$res_id}";
	$result = $db->query($sql);

	if($result){

	}
	elseif(!$result){

	}
?>