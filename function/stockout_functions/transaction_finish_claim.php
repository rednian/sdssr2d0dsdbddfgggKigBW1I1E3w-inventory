<?php
	require_once '../includes.php';

	session_start();

	$date = date("Y-m-d");
	$user = $_SESSION['user_id'];
	$customer = $_SESSION['cus_id'];

	$sql = "SELECT * FROM temp_purchase";
	$result = $db->query($sql);

	while($row = $result->fetch_array()){
		$b_id = $row[1];
		$temp_qty = $row[2];
		$discount = $row[3];

		$prod_price = get_price($b_id);

		update_quantity($b_id,$temp_qty);
		insert_stock_out_history($b_id,$date,$temp_qty,$discount,$prod_price,$user);
		reserve($b_id,$temp_qty);

		header("Location:../../index.php");
	}

	clear_all();
	
	function update_quantity($b_id,$qty){
		global $db;
		$total_quantity = get_qty($b_id);
		$purchased_quantity = $qty;
		$new_quantity = $total_quantity - $purchased_quantity;
		$sql = "UPDATE prod_total_quantity SET quantity = {$new_quantity} WHERE b_id =  {$b_id}";
		$result = $db->query($sql);
	}

	function get_qty($b_id){
		global $db;
		$sql = "SELECT quantity from prod_total_quantity where b_id = {$b_id}";
		$result = $db->query($sql);
		if($row = $result->fetch_array()){
			return $row[0];
		}
	}

	function get_price($b_id){
		global $db;
		$sql = "SELECT price from price where b_id = {$b_id}";
		$result = $db->query($sql);
		if($row = $result->fetch_array()){
			return $row[0];
		}
	}

	function insert_stock_out_history($b_id,$date,$qty,$dis,$price,$user){
		global $db;
		global $date;

		$sql = "INSERT INTO stock_out_history(b_id,date_out,quantity,discount_percent,raw_price,user_id)
				VALUES({$b_id},'{$date}',{$qty},{$dis},{$price},{$user})";

		$result = $db->query($sql);
	}

	function clear_all(){
		global $db;
		$sql = "DELETE FROM temp_purchase";
		$result = $db->query($sql);
		if($result){

		}
	}

	function reserve($b_id,$qty){
		$date = date("Y-m-d");
		$status = "unclaim";
		global $db;
		$sql = "INSERT INTO reserve(b_id,date_res,status,qty)
				VALUES({$b_id},'{$date}','{$status}',{$qty})";

		$result = $db->query($sql);
	}
?>