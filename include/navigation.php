<?php
require_once 'function/includes.php';
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM user_profile WHERE user_id = '$user_id'";
$result = $db->query($sql);
$row = $result->fetch_array();

?>
<header class="main-header">
  <a href="#" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">Villanueva Eye Clinic</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">Villanueva Eye Clinic</span>
  </a>
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <ul class="nav navbar-nav time hidden-sm hidden-xs">
      <li><a href="#" id="time">
          <span class="sr-only">(current)</span></a></li>
      <li><a href="#" id="month">
        </a></li>
      <li><a href="#" id="year"></a></li>
    </ul>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php if($row['image'] == ''){ echo 'dist/img/default.png';}else{ echo 'image_upload/'.$row['image'];}?>" class="user-image" alt="User Image"/>
            <span class="hidden-xs"><?php echo $row['firstname']." ".$row['lastname']; ?><span class="caret"></span></span>
          </a>
          <ul class="dropdown-menu">
            <li class="user-header">
              <img src="<?php if($row['image2wbmp(image)e'] == ''){ echo 'dist/img/default.png';}else{ echo 'image_upload/'.$row['image'];}?>" class="img-circle" alt="User Image"/>

              <p>
                <?php echo $row['firstname']." ".$row['lastname']; ?>
                <small>Member since  <?php echo $row['date_register']; ?></small>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="user-profile.php" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="function/logout.php" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
<div class="content-wrapper">
  <section class="content">


