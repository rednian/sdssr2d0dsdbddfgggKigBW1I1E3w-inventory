<?php

	require_once '../includes.php';

	if(isset($_GET['barcode'])){
		$barcode = $_GET['barcode'];
		get_details($barcode);
	}

	function get_details($barcode){
		global $db;
		$sql = "SELECT prod_profile.name,price.price,barcode.b_id,barcode
				FROM barcode,price,prod_profile
				WHERE barcode.barcode = '{$barcode}'
				AND barcode.b_id = price.b_id 
				AND barcode.prod_id = prod_profile.prod_id";

		$result = $db->query($sql);
		if($row = $result->fetch_array()){

			$prod = $row[0];
			$price = $row[1];
			$b_id = $row[2];
			$barcode = $row[3];

			$data = array("b_id"=>$b_id,"Item"=>$prod,"Price"=>$price,"Barcode"=>$barcode);
			echo json_encode($data);
		}
	}

?>