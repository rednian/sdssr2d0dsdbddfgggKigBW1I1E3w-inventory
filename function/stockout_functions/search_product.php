<?php
include("../includes.php");

if(isset($_GET['search'])){

	$val = $_GET['search'];

		$sql = "SELECT barcode.b_id,barcode,prod_profile.name,price.price,prod_total_quantity.quantity 
				from barcode,prod_profile,price,prod_total_quantity
				where (prod_profile.name like '{$val}%' OR barcode.barcode = '{$val}')
				and (prod_total_quantity.quantity > 0)
				and prod_profile.prod_id = barcode.prod_id
				and barcode.b_id = price.b_id
				and barcode.b_id = prod_total_quantity.b_id";

		$result = $db->query($sql);

	$count = $result->num_rows;

	if($count == 0){
		echo "<tr>
            <td>No data found</td>
          </tr>";
	}
	elseif($count > 0){
		echo "<tr>
						<td></td>
						<td>Name</td>
						<td>Price</td>
						<td>Qty</td>
					 </tr>";

		while($row = $result->fetch_array()){
			echo "<tr>
	                <td><a href=\"#\" title=\"Add to list\" onclick=\"get_result('".$row[0]."','".$row[2]."','".$row[3]."','".$row[4]."')\"><i class=\"fa fa-plus-circle text-success\"></i></a></td>
	                  <td>".$row[2]."</td>
	                  <td>&#8369; ".$row[3]."</td>
	                  <td>".$row[4]."</td>
	               	</tr>";
		}
	}

	
}

?>