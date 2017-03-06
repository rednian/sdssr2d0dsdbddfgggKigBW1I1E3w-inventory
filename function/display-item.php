<?php
/**
 * Created by PhpStorm.
 * User: RedZ
 * Date: 8/27/2015
 * Time: 11:02 AM
 */
require_once 'includes.php';
$sql = "SELECT
prod_profile.`name`,prod_profile.model_no,prod_profile.supplier,
barcode.barcode,
price.price,
prod_total_quantity.quantity
FROM
prod_profile,
barcode,
price,
prod_total_quantity
WHERE
prod_profile.prod_id = barcode.prod_id
AND
barcode.b_id = price.b_id
AND
barcode.b_id = prod_total_quantity.b_id ORDER BY barcode.b_id DESC";
$result = $db->query($sql);
if($result->num_rows > 0){
  $i = 1;
  while($row = $result->fetch_array()){
    echo json_encode($row);
//    echo "<tr>";
//    echo "<td>$i</td>";
//    echo "<td>$row[0]</td>";
//    echo "<td>$row[1]</td>";
//    echo "<td>$row[2]</td>";
//    echo "<td>$row[3]</td>";
//    echo "<td>$row[4]</td>";
//    echo "<td>$row[5]</td>";
//    echo "<td><a href='#'><span class'glyphicon glyphicon-pencil'></span> update</a></td>";
//    echo "</tr>";
    $i++;
  }
}