<?php 
require_once 'includes.php';
$fname = ucfirst($_POST['fname']);
$midname = ucfirst($_POST['midname']);
$lastname = ucwords($_POST['lastname']);
$username = $_POST['username'];
$password = $_POST['password'];

$reg_date = date('Y-m-d');

$fname = clean_input($fname);
$midname = clean_input($midname);
$lastname = clean_input($lastname);
$username = clean_input($username);



$sql = "SELECT * FROM user_profile WHERE username ='$username'";
$result = $db->query($sql);	
if($result->num_rows > 0){
 echo "username $username already exist";
 exit;
}
else{
	$password = clean_input($password);
	$password = sha1($password.$username);

	$sql = "INSERT INTO user_profile(firstname,middlename,lastname,username,password,date_register)
		VALUES('$fname','$midname','$lastname','$username','$password','$reg_date')";
	$db->query($sql);
	if($db->affected_rows > 0){
		echo "Username $username successfully created";
	}
	else{
		echo "Username $username failed to create.";

	}
}
?>


