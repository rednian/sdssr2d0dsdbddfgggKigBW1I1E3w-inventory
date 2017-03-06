<?php
	include("../includes.php");

	$fname = $_POST['txtfirstname'];
	$mname = $_POST['txtmiddlename'];
	$lname = $_POST['txtlastname'];
	$address = $_POST['txtaddress'];
	$contact = $_POST['txtcontact'];
	$email = $_POST['txtemail'];

	$fullname = $fname." ".$mname[0].". ".$lname;
	$sql = "INSERT INTO customer_profile(cus_fullname,cus_contact_no,cus_address,cus_email)
			VALUES('{$fullname}','{$contact}','{$address}','{$email}')";

	$result = $db->query($sql);
	if($result){
		echo "Customer added successfully";
	}
	else{
		echo "Error saving customer";
	}
?>