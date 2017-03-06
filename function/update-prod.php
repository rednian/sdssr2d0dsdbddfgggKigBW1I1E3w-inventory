<?php
/**
 * Created by PhpStorm.
 * User: RedZ
 * Date: 9/3/2015
 * Time: 10:05 AM
 */
session_start();
require_once 'includes.php';
if (isset($_POST['action'])) {
  $name = $_POST['name'];
  $model = $_POST['model'];
  $supplier = $_POST['supplier'];
  $price = $_POST['price'];
  $qty = $_POST['quantity'];
  $id = $_POST['id'];
  print_r($id);

  $db->commit(false);
  $prod = "UPDATE prod_profile SET `name` = '$name', model_no = '$model', supplier = '$supplier' WHERE prod_id = '$id'";
  $db->query($prod);
  $update_price = "UPDATE price SET `price` = '$price' WHERE (SELECT prod_profile.prod_id  FROM prod_profile WHERE prod_profile.prod_id = '$id')";
  $db->query($update_price);
  $update_qty = "UPDATE  prod_total_quantity SET `quantity` = '$qty' WHERE (SELECT prod_profile.prod_id  FROM prod_profile WHERE prod_profile.prod_id = '$id')";
  $db->query($update_qty);
  if ($db->affected_rows > 0) {
  $db->rollback();
    $_SESSION['message'] = "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span>
</button>";
  }
//  header('Location:../product-profile.php');

}