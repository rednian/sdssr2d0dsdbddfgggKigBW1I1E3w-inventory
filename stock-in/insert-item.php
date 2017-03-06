<?php
/**
 * Created by PhpStorm.
 * User: RedZ
 * Date: 8/19/2015
 * Time: 2:33 PM
 */
try {
session_start();
  require_once '../function/includes.php';
date_default_timezone_set('Asia/Manila');



//for product profile
  $item = $db->real_escape_string($_POST['item_name']);
  $item = ucwords($item);
  // if(isset($_POST['model'])){$model = $db->real_escape_string($_POST['model']);}
  $model = $db->real_escape_string($_POST['model']);
  
  $supplier =$db->real_escape_string( $_POST['supplier']);
  $supplier = ucwords($supplier);

  // $item = $db->real_escape_string('item1');
  // $model = $db->real_escape_string('no model');
  // $supplier =$db->real_escape_string('no supplier');

//for stock in history
  $date_in = date('Y-m-d');
  $quantity = $db->real_escape_string($_POST['quantity']);  


  // // $date_in = date('Y-m-d');
  // $date_in = date('Y-m-d');
  // $quantity = $db->real_escape_string('1');

//barcode
  $barcode = $db->real_escape_string($_POST['barcode']);
  // $barcode = $db->real_escape_string('fake barcode');

//price
  $price =$db->real_escape_string($_POST['price']);
  // $price =$db->real_escape_string('353535');

  $user_id = $_SESSION['user_id'];

  

//--------------------------- development mode

  $sql = "SELECT * FROM barcode WHERE barcode = '$barcode'";
  $result_search = $db->query($sql);
  $row = $result_search->fetch_array();
  $barcode_id = $row[0];

  $db->autocommit(false);
  if ($result_search->num_rows > 0) {

    $stock_in = "INSERT INTO stock_in_history(dates,quantity,b_id,user_id)VALUES('$date_in','$quantity','$barcode_id','$user_id')";
    $db->query($stock_in);

    $update_quantity = "UPDATE prod_total_quantity SET quantity = quantity + '$quantity' WHERE b_id = '$barcode_id'";
    $db->query($update_quantity);

    if ($db->affected_rows > 0) {
      echo $barcode . " barcode successfully updated";
    }


  }
  else {
////  insert the new barcode
////  insert the new quantity

    $product = "INSERT INTO prod_profile(name, model_no,supplier,category)VALUES('$item','$model','$supplier','Item')";
    $db->query($product);
    $fk_product = $db->insert_id;

    $sql = "INSERT INTO barcode(prod_id,barcode)VALUES('$fk_product','$barcode')";
    $db->query($sql);
    $fk_barcode = $db->insert_id;

    $insert_price = "INSERT INTO price(b_id,price)VALUES('$fk_barcode','$price')";
    $db->query($insert_price);

    $stock_in = "INSERT INTO stock_in_history(dates,quantity,b_id,user_id)VALUES('$date_in','$quantity','$fk_barcode','$user_id')";
    $db->query($stock_in);

    $add_quantity = "INSERT INTO prod_total_quantity(b_id, quantity)VALUES ('$fk_barcode','$quantity')";
    $db->query($add_quantity);

    if ($db->affected_rows > 0) {
      echo $barcode . " Successfully added.";
    }
  }

  if ($db->affected_rows) {
    $db->autocommit(true);
  }
  else{
     echo "No data added or updated.";
  }
} catch (Exception $e) {
  echo $e->getMessage();
}

