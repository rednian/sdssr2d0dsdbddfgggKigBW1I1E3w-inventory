<?php
	require_once '../includes.php';

	$val = $_GET['value'];
	
	$sql = "SELECT prod_profile.name from prod_profile,barcode
			where (prod_profile.name like '{$val}%'
			or barcode.barcode = '{$val}')
			and prod_profile.prod_id = barcode.prod_id";

	$result = $db->query($sql);

	while($row = $result->fetch_array()){
		echo "<div onclick=\"select_suggest('".$row[0]."')\" class=\"suggest_item\">".$row[0]."</div>";
	}

?>