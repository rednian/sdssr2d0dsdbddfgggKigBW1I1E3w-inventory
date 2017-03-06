<?php

	require_once '../includes.php';
	session_start();
	$user = $_SESSION["user_id"];

	if(isset($_GET['remove'])){
		$temp_id = $_GET['remove'];
		delete_temp($temp_id);
	}

	if(isset($_GET['clear'])){
		clear_all();
	}

	function delete_temp($temp_id){
		global $user;
		global $db;
		$sql = "DELETE FROM temp_purchase where temp_id = {$temp_id} AND user_id = {$user}";
		$result = $db->query($sql);
		if($result){
			LoadItems();
		}
	}

	function clear_all(){
		global $user;
		global $db;
		$sql = "DELETE FROM temp_purchase where user_id = {$user}";
		$result = $db->query($sql);
		if($result){
			LoadItems();
		}
	}

	function LoadItems(){
		global $user;
		global $db;
		$sql = "SELECT prod_profile.name,price.price,temp_purchase.qty,discount,temp_id,barcode.barcode
				FROM barcode,price,prod_profile ,temp_purchase
				WHERE barcode.b_id = temp_purchase.b_id
				AND barcode.b_id = price.b_id 
				AND barcode.prod_id = prod_profile.prod_id
				AND temp_purchase.user_id = {$user}
				ORDER BY temp_purchase.temp_id DESC";

		$result = $db->query($sql);
		$mainTOt = 0;
		
		$count = $result->num_rows;
		if($count == 0){
			echo "<tr>
		            <td colspan=\"5\">List is empty</td>
		         </tr>";
		}

		elseif($count > 0){
			while($row = $result->fetch_array()){

				$prod = $row[0];
				$qty = $row[2];
				$discount = $row[3];
				$price = $row[1];
				$total = round(($price - ($price*($discount/100))) * $qty,2);
				$formattedprice = number_format($price, 2, '.', ',');
				$formatted = number_format($total, 2, '.', ',');
				$temp_id = $row[4];
				$barcode = $row[5];
				
				echo "<tr>
		                <td><a href=\"#\" onclick=\"change_qty('minus','".$temp_id."')\" class=\"qty-minus\"><i class=\"fa fa-minus-circle text-success\"></i></a> ".$qty." <a href=\"#\" onclick=\"change_qty('add','".$temp_id."')\" class=\"qty-plus\"><i class=\"fa fa-plus-circle text-success\"></i></a></td>
		                <td>".$prod."</td>
		                <td>&#8369; ".$formattedprice."</td>
		                <td><a href=\"#\" onclick=\"change_discount('minus','".$temp_id."')\" class=\"qty-minus\"><i class=\"fa fa-minus-circle text-success\"></i></a> ".$discount."% <a href=\"#\" onclick=\"change_discount('add','".$temp_id."')\" class=\"qty-plus\"><i class=\"fa fa-plus-circle text-success\"></i></a></td>
		                <td>&#8369; ".$formatted."</td>
		                <td style=\"text-align:right\"><a href=\"#\" onclick=\"remove_from_list('".$temp_id."')\"><i class=\"fa fa-times-circle text-danger\"></i></a></td>
		              </tr>";
			}
		}
	}
?>