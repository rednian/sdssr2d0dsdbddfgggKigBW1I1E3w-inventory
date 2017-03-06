<?php
	require_once '../includes.php';

	$val = $_GET['search'];

	$sql = "SELECT barcode.barcode,prod_profile.name,reserve.qty,status,date_res,date_claimed,reserve.b_id,res_id
			FROM barcode,prod_profile,reserve
			WHERE barcode.prod_id = prod_profile.prod_id
			AND reserve.b_id = barcode.b_id
			AND (barcode.barcode = '{$val}'
			OR prod_profile.name = '{$val}')";

	$result = $db->query($sql);
	$count = $result->num_rows;
	if($count == 0){
		echo "<td colspan='7'>No data found</td>";
	}
	elseif($count > 0){
		while($row = $result->fetch_array()){
			$btn = "";
			$stat = "";
			$b_id = $row[6];
			$res_id = $row[7];	
			if($row[3] == "unclaim"){
				$btn = "<button onclick='claim($res_id)' class='btn btn-xs btn-success'>Claim</button>";
				$stat = "<span class='label label-warning'>Unclaim</span>";
			}
			elseif($row[3] == "claimed"){
				$btn = "<button class='btn btn-xs btn-default' disabled>Claim</button>";
				$stat = "<span class='label label-success'>Claimed</span>";
			}

			echo "<tr>
					<td>".$row[0]."</td>
					<td>".$row[1]."</td>
					<td>".$row[2]."</td>
					<td>".$row[4]."</td>
					<td>".$row[5]."</td>
					<td>".$stat."</td>
					<td>".$btn."</td>
				  </tr>";
		}
	}
?>