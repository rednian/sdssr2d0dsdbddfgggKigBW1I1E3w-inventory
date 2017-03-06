<?php
$file = basename($_SERVER['SCRIPT_NAME'], '.php');
$file = strtolower($file);
require_once '../function/includes.php';
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM user_profile WHERE user_id = '$user_id'";
$result = $db->query($sql);
$row = $result->fetch_array();

?>
<aside class="main-sidebar hidden-print">
  <section class="sidebar">
    <div class=" center-block">
      <div class=" image">

        <img src="<?php if ($row['image'] == ' ') {
                    echo 'dist/img/default.png';
                  }
                  else{
                    echo '../image_upload/'.$row['image'];
                    } ?>" class="img-circle img-thumbnail center-block img-responsive" alt="User Image"
             style="width:100px;height:auto"/>
      </div>
      <div class="name">
        <p class="" style="margin-left: 5px">Welcome</p>

        <h3 class="text-center"><?php echo ucfirst($row['firstname'])." ".ucfirst($row['lastname']); ?></h3>
        <!-- Status -->
        <!--        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
      </div>
    </div>
    <ul class="sidebar-menu">
      <li class="header">Select Transaction</li>
      <li><a href="../"><i class='fa fa-shopping-cart'></i> <span>Stock-out</span></a></li>
      <li><a href="../stock-in/add-item.php"><i class='fa fa-link'></i> <span>Stock-in</span></a></li>
      <li><a href="../product-profile.php"><i class='fa fa-link'></i> <span>Product Profile</span></a></li>
      <li><a href="../claim-status.php"><i class='fa fa-link'></i> <span>Claim Status</span></a></li>
      <li><a href="../report.php"><i class='fa fa-file'></i> <span>Reports</span></a></li>
      <li class="header">Administrator Portal</li>
      <li><a href="../user-profile.php"><i class='glyphicon glyphicon-user'></i> <span>User Profile</span></a></li>
      <li><a href="../history.php"><i class='fa fa-history'></i> <span>History</span></a></li>

    </ul>
  </section>
</aside>  