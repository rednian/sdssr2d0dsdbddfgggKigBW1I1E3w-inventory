<?php
require_once '../function/includes.php';



session_start();
$user_id = $_SESSION['user_id'];
$prod_id =$db->real_escape_string($_POST['p_id']);
$b_id = $db->real_escape_string($_POST['b_id']);
$barcode = $db->real_escape_string($_POST['barcode']);
$name = $db->real_escape_string($_POST['item_name']);
$supplier = $db->real_escape_string($_POST['supplier']);
$price = $db->real_escape_string($_POST['price']);
$qty = $db->real_escape_string($_POST['quantity']);
$model = $db->real_escape_string($_POST['model']);

$category = $db->real_escape_string($_POST['category']);

if(isset($_POST['expiration'])){
$expiration = $db->real_escape_string($_POST['expiration']);
}
if(isset($_POST['model'])){
$model = $db->real_escape_string($_POST['model']);
}


$date = date('Y-m-d');
$name  = ucwords($name); 
$supplier  = ucwords($supplier); 

//$category = $_POST['category'];
//$name = $_POST['category'];
//$db->autocommit(false);
$sql = "BEGIN;";
$sql =  "INSERT INTO stock_in_history(dates,quantity,user_id,b_id)VALUES('$date','$qty','$user_id','$b_id');";
if(isset($expiration_date)){
  $sql .="UPDATE prod_profile SET `name` = '$name',supplier = '$supplier',expiration_date = '$expiration', category = '$category' WHERE prod_id = '$prod_id';";
}else if(isset($model)){
  $sql .="UPDATE prod_profile SET `name` = '$name',model_no = '$model',supplier = '$supplier', category = '$category' WHERE prod_id = '$prod_id';";
}

$sql .="UPDATE price SET price = '$price' WHERE b_id = '$b_id';";
$sql .="UPDATE barcode SET barcode = '$barcode' WHERE b_id = '$b_id';";
$sql .= "COMMIT;";
// echo "<pre>";
// print_r($sql);
// echo "</pre>";
$db->multi_query($sql);
//$db->autocommit(true);

if($db->affected_rows > 0){

  echo $name." Successfully updated";
}
else{
  echo $db->error;
}


?>