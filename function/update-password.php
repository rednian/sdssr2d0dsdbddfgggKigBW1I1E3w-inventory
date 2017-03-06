<?php 
session_start();
require_once 'includes.php';
$old = $_POST['old'];
$password = $_POST['new'];

$image = $_FILES['file_upload'];


$user_id = $_SESSION['user_id'];

$old = sha1($old.$_SESSION['user']['username']);

$sql = "SELECT password,username FROM user_profile WHERE password = '$old' AND user_id = '$user_id'";
$result = $db->query($sql);
$row = $result->fetch_array();
if($result->num_rows > 0 ){
	$temp_file = $_FILES['file_upload']['tmp_name']; 
	$target_file = $_FILES['file_upload']['name']; 
	$upload_dir = '../image_upload';
	move_uploaded_file($temp_file,$upload_dir."/".$target_file);
  $password = $_POST['new'];

  $password = sha1($password.$_SESSION['user']['username']);

	$update = "UPDATE user_profile SET password = '$password', image = '$target_file' WHERE user_id = '$user_id'";
	$db->query($update);
	if($db->affected_rows > 0) {
		$_SESSION['message'] =  "Password successfully updated.";
		header('Location:../user-profile.php');	
	}
 }
 else{
 		$_SESSION['message'] = "Password is invalid";	
 		header('Location:../user-profile.php');	
 }
?>
