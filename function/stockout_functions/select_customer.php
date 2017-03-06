<?php
	include("../includes.php");

	if(isset($_GET['customer'])){
		session_start();
		
		$cus_id = $_GET['customer'];
		$_SESSION['cus_id'] = $cus_id;

		$sql = "SELECT * FROM customer_profile WHERE cus_id = {$cus_id}";

		$result = $db->query($sql);
		
		if($row = $result->fetch_array()){

			$name = $row[1];
			echo "<div class=\"alert alert-success\">
		              <a href=\"#\" onclick=\"remove_customer()\" class=\"pull-right\"><span class=\"fa fa-times-circle text-danger\"></span></a>
		              ".$name."
		            </div>";
		}

	}

	
?>