<?php
	require_once '../includes.php';
	session_start();
	$user = $_SESSION['user_id'];
	total();

	function total(){
		global $user;
		global $db;
		$sql = "SELECT price.price,temp_purchase.qty,discount
				FROM barcode,price,temp_purchase
				WHERE barcode.b_id = price.b_id
				AND barcode.b_id = temp_purchase.b_id
				AND temp_purchase.user_id = {$user}";

		$result = $db->query($sql);

		$total = 0;
		$formatted = 0;
		while($row = $result->fetch_array()){
			$qty = $row[1];
			$discount = $row[2];
			$price = $row[0];
			$total += round(($price - ($price*($discount/100))) * $qty,2);
			$formatted = number_format($total, 2, '.', ',');
		}

		$total = array("total"=>$total,"formatted"=>$formatted);
		echo json_encode($total);
		// printf($total);
		// echo $mainTOt;
		// // echo "<strong>&#8369; ".$total."</strong>";
			
	}