<?php
/*check if the inputted quantity is greater than the quantity avaialable*/
include("../includes.php");

if (isset($_GET['b_id'])) {
  $id = $_GET['b_id'];
  $qty = $_GET['qty'];


  $sql = "SELECT quantity FROM prod_total_quantity,barcode
          WHERE barcode.b_id = prod_total_quantity.b_id
          AND barcode.b_id = '$id'";

  $result = $db->query($sql);
  if ($result->num_rows > 0) {

    $row = $result->fetch_array();

    $result_qty = $row[0];

    if ($result_qty < $qty) {
      echo 'quantity is greater than the available stock';
    }
    else{
      echo '0';
    }
  }


}

//array_key_exists('GET','qty');


?>