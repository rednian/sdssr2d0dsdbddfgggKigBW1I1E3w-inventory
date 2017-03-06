<?php
	include("../includes.php");

	session_start();

	if(isset($_GET['add'])){
		$user = $_SESSION["user_id"];
		$b_id = $_GET['add'];
		$qty = $_GET['qty'];
		$dis = $_GET['dis'];
		$name = $_GET['name'];

		if(exist_name($name,$dis,$user) == false){
			if($qty <= get_prod_qty($b_id)){
				insert_temp($b_id,$qty,$dis,$user);
			}
			
		}
		elseif(exist_name($name,$dis,$user) == true){
			$temp_qty = get_qty($name,$dis,$user);
			$temp_id = get_temp_id($name,$dis,$user);
			$new_qty = $temp_qty + $qty;

			if($new_qty <= get_prod_qty($b_id)){
				update_temp($temp_id,$new_qty,$user);
			}
		}
		LoadItems();
	}


	function insert_temp($b_id,$qty,$dis,$user){
		global $db;
		$sql = "INSERT into temp_purchase(b_id,qty,discount,user_id) values({$b_id},{$qty},{$dis},{$user})";
		$result = $db->query($sql);
		if($result){

		}
	}

	function update_temp($temp_id,$qty,$user){
		global $db;
		$sql = "UPDATE temp_purchase set qty = {$qty} WHERE temp_id = {$temp_id} and user_id = {$user}";
		$result = $db->query($sql);
	}

	function get_qty($name,$dis,$user){
		global $db;
		$sql = "SELECT temp_purchase.qty
				from prod_profile,barcode,temp_purchase 
				where (prod_profile.name = '{$name}' 
				and temp_purchase.discount = {$dis})
				and temp_purchase.user_id = {$user}
				and prod_profile.prod_id = barcode.prod_id 
				and barcode.b_id = temp_purchase.b_id";

		$result = $db->query($sql);
		if($row = $result->fetch_array()){
			return $row[0];
		}

	}

	function get_temp_id($name,$dis,$user){
		global $db;
		$sql = "SELECT temp_purchase.temp_id
				from prod_profile,barcode,temp_purchase 
				where (prod_profile.name = '{$name}' 
				and temp_purchase.discount = {$dis})
				and temp_purchase.user_id = {$user}
				and prod_profile.prod_id = barcode.prod_id 
				and barcode.b_id = temp_purchase.b_id";

		$result = $db->query($sql);
		if($row = $result->fetch_array()){
			return $row[0];
		}

	}

	function get_prod_qty($b_id){
		global $db;
		global $user;
		$sql = "SELECT prod_total_quantity.quantity 
				from prod_total_quantity
				where b_id = {$b_id}";

		$result = $db->query($sql);
		if($row = $result->fetch_array()){
			return $row[0];
		}
	}
	// function exist_barcode($b_id,$dis){
	// 	global $db;
	// 	$sql = "SELECT from temp_purchase where b_id = {$b_id} and discount = {$dis}";
	// 	$result = $db->query($sql);
	// 	$count = $result->num_rows;
	// 	if($count == 0){
	// 		return false;
	// 	}
	// 	elseif($count > 0){
	// 		return true;
	// 	}
	// }

	function exist_name($name,$dis,$user){
		global $db;
		$sql = "SELECT prod_profile.name 
				from prod_profile,barcode,temp_purchase 
				where (prod_profile.name = '{$name}' and temp_purchase.discount = {$dis})
				and temp_purchase.user_id = {$user}
				and prod_profile.prod_id = barcode.prod_id 
				and barcode.b_id = temp_purchase.b_id";
		$result = $db->query($sql);
		$count = $result->num_rows;
		if($count == 0){
			return false;
		}
		elseif($count > 0){
			return true;
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