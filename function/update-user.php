<?php 
require_once 'includes.php';
session_start();

$user_id = $_SESSION['user_id'];
// $user_id = 1;



if(isset($_POST['new'])  || isset($_POST['confirm'])){

  $new = $db->real_escape_string($_POST['new']);
  $confirm = $db->real_escape_string($_POST['confirm']);
  $username = $db->real_escape_string($_POST['username']);

  update_user($confirm,$username,$user_id);

}


if(isset($_POST['username'])  && isset($_POST['password'])){

  $username = $db->real_escape_string($_POST['username']);
  $password = $db->real_escape_string($_POST['password']);

  search_user($username,$password,$user_id);  

}



// upload image
if(isset($_FILES['image_path'])){
  global $db;
    $image = $_FILES['image_path'];
  $temp_file = $_FILES['image_path']['tmp_name']; 
  $target_file = $_FILES['image_path']['name']; 
  $upload_dir = '../image_upload';
  if(move_uploaded_file($temp_file,$upload_dir."/".$target_file)){
      $update = "UPDATE user_profile SET  image = '$target_file' WHERE user_id = '$user_id'";
  $db->query($update);
  // if($db->affected_rows > 0){
   echo 'Image successfully uploaded.';
    // }else{
      // echo 0;
    // }
  }
}

if(isset($_POST['user_name'])){
  $username = $db->real_escape_string($_POST['user_name']);
  search_username($username);
}

// search_username('admin',1);

function search_username($username){
    global $db;

$sql = "SELECT * FROM user_profile WHERE username = '$username'";
$result = $db->query($sql);

  if($result->num_rows > 0){
    echo 1;
  }
  else{
    echo 0;
  }
}


function update_user($password,$username,$user_id){
  global $db;

$password = sha1($password.$username);

$sql = "UPDATE user_profile SET password = '$password' WHERE user_id = '$user_id'";
$result = $db->query($sql);

  if($db->affected_rows > 0){
    echo 'Password successfully updated.';
    exit();
  }
  else{
    echo 0;
  }
}



function search_user($username, $password,$user_id){
  global $db;

$password = sha1($password.$username);

$sql = "SELECT * FROM user_profile WHERE password = '$password' AND user_id = '$user_id'";
$result = $db->query($sql);

  if($result->num_rows < 1){
    echo 0;
    exit();
  }
  else{
    echo 1;
  }
}

 ?>
