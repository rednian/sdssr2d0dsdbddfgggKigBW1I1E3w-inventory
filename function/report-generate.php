<?php
/**
 * Created by PhpStorm.
 * User: RedZ
 * Date: 9/3/2015
 * Time: 11:30 AM
 */
require_once 'includes.php';

$from = date_create($_GET['from']);
$from = date_format($from,'Y-m-d');

$to = date_create($_GET['to']);
$to = date_format($to,'Y-m-d');

$sql = "SELECT
	barcode.barcode,
	prod_profile.`name`,
  stock_out_history.date_out,
	SUM(stock_out_history.quantity) AS quantity,
	stock_out_history.raw_price,
	stock_out_history.discount_percent,
	(
		(
			stock_out_history.raw_price - (
				(
					stock_out_history.discount_percent / 100
				) * stock_out_history.raw_price
			)
		) * SUM(stock_out_history.quantity)
	) AS sub_total
FROM
	prod_profile,
	barcode,
	stock_out_history
WHERE
	prod_profile.prod_id = barcode.prod_id
AND stock_out_history.b_id = barcode.b_id
AND (
	stock_out_history.date_out BETWEEN '$from'
	AND '$to'
)
GROUP BY
	prod_profile.`name`,
	stock_out_history.discount_percent";


$result = $db->query($sql);
$percent = $qty = 0;
$discount = 0;
$sub = 0;
$price = 0;
if ($result->num_rows > 0) {
  $col = 1;
  while ($row = $result->fetch_array()) {
    
    $sub +=$row['sub_total'];
    $percent +=$row['discount_percent'];
    $qty += $row['quantity'];
    $price += $row['raw_price'];
    // $p = $row['discount_percent'] == 0 ? $row['discount_percent'] : -
   echo "<tr class='tr-border'>";
   echo "<td class='no-border'>".$row['date_out']."</td>";
   echo "<td class='no-border'>".$row['barcode']."</td>";
   echo "<td class='no-border'>".$row['name']."</td>";
   echo "<td class='no-border'>".$row['quantity']."</td>";
   echo "<td class='no-border'><strong>P </strong>".number_format($row['raw_price'],2)."</td>";
   echo "<td class='no-border'>".$p = $row['discount_percent'] != 0 ? $row['discount_percent']."%" : "-"."</td>";
   echo "<td class='no-border'><strong>P </strong>".number_format($row['sub_total'],2)."</td>";
   echo "</tr>";
  }
   echo "<tr class=''>";
      echo "<td><strong>Grand Total</strong></td>";
      echo "<td></td>";
      echo "<td></td>";
      echo "<td><strong>".$qty."</strong></td>";
      echo "<td><strong>P ".number_format($price,2)."</strong></td>";
      echo "<td><strong>".$percent."%</strong></td>";
      echo "<td> <strong>P </strong> ".number_format($sub,2)."</strong></td>";
   echo "</tr>";

}
