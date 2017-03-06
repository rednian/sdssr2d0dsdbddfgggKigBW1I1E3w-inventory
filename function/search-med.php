<?php
/**
 * Created by PhpStorm.
 * User: RedZ
 * Date: 8/27/2015
 * Time: 12:20 AM
 */
require_once 'includes.php';

$barcode = $db->real_escape_string($_POST['barcode']);
$sql = "SELECT prod_profile.`name`,prod_profile.model_no,prod_profile.supplier,price.price,prod_total_quantity.quantity,barcode.barcode
        FROM prod_profile,price,prod_total_quantity, barcode
        WHERE prod_profile.prod_id = barcode.prod_id
        AND barcode.b_id = price.b_id
        AND prod_total_quantity.b_id = barcode.b_id
        AND barcode.barcode = '$barcode'";


$result = $db->query($sql);
if ($result->num_rows > 0) {
  $row = $result->fetch_array();
  echo json_encode($row);
} else {
  echo json_encode(array());
}
