<?php
/**
 * Created by PhpStorm.
 * User: RedZ
 * Date: 8/28/2015
 * Time: 10:33 AM
 */
require_once '../function/includes.php';
$sql = "SELECT
barcode.barcode,
prod_profile.`name`,
prod_profile.model_no,
prod_profile.supplier,
price.price,
prod_total_quantity.quantity,
stock_in_history.dates,
prod_profile.expiration_date
FROM
barcode,
prod_profile,
price,
prod_total_quantity,
stock_in_history
WHERE
prod_profile.prod_id = barcode.prod_id
AND
barcode.b_id = price.b_id
AND
barcode.b_id = prod_total_quantity.b_id
AND
barcode.b_id = stock_in_history.b_id
AND
prod_profile.category = 'item'";

$result = $db->query($sql);

          if($result->num_rows > 0){
            $i = 1;
            while($row = $result->fetch_array()){
              echo "<tr>";
              echo "<td>".$i++."</td>";
              echo "<td>".$row[3]."</td>";
              echo "<td>".$row[0]."</td>";
              echo "<td>".$row[1]."</td>";
              echo "<td>".$row[2]."</td>";
              echo "<td>".$row[4]."</td>";
              echo "<td>".$row[5]."</td>";
              echo "<td>".$row[6]."</td>";
              echo "<td>".$row[7]."</td>";
              echo "<td></td>";
              echo "</tr>";
            }
          }
          ?>