<?php
require_once 'function/includes.php';


include 'include/header.php';
include 'include/navigation.php';
include 'include/sidebar.php';
?>
<?php
$sql = "SELECT user_profile.firstname, user_profile.middlename, user_profile.lastname, user_profile.username, log_history.date_login, log_history.date_log_out";
$sql .= " FROM user_profile, log_history";
$sql .= " WHERE user_profile.user_id = log_history.user_id";
$sql .= " ORDER BY log_history.lh_id";
$sql .= " DESC";
//$sql="select * from user_profile";
$result = $db->query($sql);
//$row = $result->fetch_array();
//print_r($row);
?>
  <div class="row">
    <div class="col-md-12">
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
          data-toggle="tab"><span class="glyphicon glyphicon-clock"></span> Log History</a></li>
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="home">
        <h3 style="margin:2% 0">Log History</h3>
               <?php

            if ($result->num_rows > 0) {
              $table = "<table class='table table-bordered paginate'style='margin-top:2%'>";
              $table .= "<thead>";
              $table .= " <tr class='bg-success'>";
              $table .= "  <th>#</th>";
              $table .= "  <th>Name</th>";
              $table .= "  <th>Username</th>";
              $table .= "  <th>Login Date</th>";
              $table .= "  <th>Logout Date</th>";
              $table .= "  </tr></thead>";
              $i = 0;
              while ($row = $result->fetch_array()) {
                $i++;
                $table .= "  <tr>";
                $table .= "  <td>$i</td>";
                $table .= "  <td>" . $row[0] . " " . $row[1] . " " . $row[2] . "</td>";
                $table .= "  <td>$row[3]</td>";
                $table .= "  <td>$row[4]</td>";
                $table .= "  <td>$row[5]</td>";
                $table .= "  </tr>";
              }
              echo $table . "</table>";
            } else {
              echo "<div class='alert alert-danger'>";
              echo "<strong>No Log History yet.</strong>";
              echo "</div>";
            }
            ?>
        </div>
      </div>
    </div>
  </div>
<?php include 'include/footer.php'; ?>