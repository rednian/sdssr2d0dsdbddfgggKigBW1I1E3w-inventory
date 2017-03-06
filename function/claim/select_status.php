<?php

	require_once '../includes.php';

	$stat = $_GET['status'];

	if($stat == "all"){
		load_all();
	}
	else{
		select_status($stat);
	}

	function select_status($stat){
		global $db;
		$sql = "SELECT barcode.barcode,prod_profile.name,reserve.qty,status,date_res,date_claimed,reserve.b_id,res_id
			FROM barcode,prod_profile,reserve
			WHERE reserve.status = '{$stat}'
			AND reserve.b_id = barcode.b_id
			AND barcode.prod_id = prod_profile.prod_id";

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

	}

	function load_all(){
		global $db;
		$sql = "SELECT barcode.barcode,prod_profile.name,reserve.qty,status,date_res,date_claimed,reserve.b_id,res_id
			FROM barcode,prod_profile,reserve
			WHERE reserve.b_id = barcode.b_id
			AND barcode.prod_id = prod_profile.prod_id ORDER BY reserve.status";

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
	}

?>