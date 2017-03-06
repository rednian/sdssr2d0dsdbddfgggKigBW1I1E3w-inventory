<?php
	include("../includes.php");

	$sql = "SELECT * FROM temp_purchase";
	$result = $db->query($sql);
	echo $count = $result->num_rows;
?>