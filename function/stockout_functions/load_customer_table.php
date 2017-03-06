<?php
	include("../includes.php");

	$sql = "SELECT * FROM customer_profile ORDER BY cus_fullname ASC";

	$result = $db->query($sql);
	
	while($row = $result->fetch_array()){
		echo "<tr>
				<td><a href=\"#\" onclick=\"select_customer('".$row[0]."')\"><i class=\"fa fa-user-plus\"></i></a></td>
				<td>".$row[1]."</td>
				<td>".$row[2]."</td>
				<td>".$row[4]."</td>
			  </tr>";
	}
?>