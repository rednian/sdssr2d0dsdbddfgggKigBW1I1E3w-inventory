<?php
include 'include/header.php';
include 'include/navigation.php';
include 'include/sidebar.php';

require_once 'function/includes.php';
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM user_profile WHERE user_id = '$user_id' LIMIT 1";
$result = $db->query($sql);
$user = $result->fetch_array();
//

?>
<div class="row">
<div class="col-md-12">
<section class="row">
  <div class="col-sm-4">
    <div class="media" style="margin-bottom:4%;">
      <div class="col-lg-6">
        <form id="up-image" enctype="multipart/form-data" method="post">
          <img class="img img-responsive img-thumbnail flat view_image" src="image_upload/<?php if ($user['image']) {
            echo $user['image'];
          } else {
            echo "default.png";
          } ?>" style="width:100%">

          <div class="btn btn-success btn-file btn-xs flat" style="margin-top:5px;width:78%">
            <i class="fa fa-folder-o"></i> Browse
            <input type="file" id="takePictureField" name="image_path"/>

          </div>
          <button type="submit" name="submit" id="btn-upload" class="btn btn-xs btn-success btn-file flat"
                  style="margin-top:5%;height:20px"/>
          <span class="glyphicon glyphicon-upload"></span>
          </button>
        </form>
      </div>
      <div class="media-body">
        <h4 class="media-heading">Name: <strong> <?php
            echo ucfirst($user['firstname']) . " ";
            echo ucfirst($user['middlename']) . " ";
            echo ucfirst($user['lastname']);
            ?></strong></h4>
        <p>Username: <?php echo $user['username']; ?></p>
        <p>Registered on: <?php echo $user['date_register']; ?></p>
      </div>
    </div>
  </div>
  <div class="col-sm-8">
    <div id="details"></div>
  </div>
</section>
<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Administrator
        Area</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Update Account</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="profile">
      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="margin-top:3%">
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="">
              <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                 aria-expanded="true" aria-controls="collapseOne">
                <h4><span class="glyphicon glyphicon-user"></span> Create New User</h4>
              </a>
            </h4>
          </div>
          <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
              <form method="post" enctype="multipart/form-data" id="frm-reg" data-toggle="validator">
                <p><strong>General Information</strong></p>
                <section class="row">
                  <div class="col-sm-6">
                    <label>First name</label>

                    <div class="form-group">
                      <input type="text" name="fname" id="fname" class="form-control" required autofocus=""
                             value="<?php if (isset($_POST['fname'])) {
                               echo $_POST['fname'];
                             } ?>">

                      <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                      <label>Middle name</label>
                      <input type="text" name="midname" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Last name</label>
                      <input type="text" name="lastname" class="form-control" required>
                    </div>

                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" name="username" class="form-control" required id="create-username">

                      <div id="error_username"></div>
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" name="password1" class="form-control" required id="pass">
                    </div>
                    <div class="form-group">
                      <label>Confirm Password</label>
                      <input type="password" name="password" class="form-control" required id="confirm">
                    </div>
                  </div>
                </section>
                <div class="form-group">
                  <button type="submit" name="submit" id="submit" class="btn btn-success"><span
                      class="glyphicon glyphicon-plus"></span> Create User
                  </button>
                  <button type="button" name="cancel" id="cancel" class="btn btn-danger cancel"><span
                      class="glyphicon glyphicon-remove"></span> Cancel
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingTwo">
            <h4 class="">
              <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                 aria-expanded="false" aria-controls="collapseTwo">
                <h4>Registered Accounts <span class="caret"></span></h4>
              </a>
            </h4>
          </div>
          <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">
              <?php
              $view_users = "SELECT * FROM user_profile ORDER BY date_register DESC";
              $result = $db->query($view_users);
              ?>
              <table class="table paginate">
                <thead>
                <tr class="bg-success">
                  <td>#</td>
                  <td>Name</td>
                  <td>Username</td>
                  <td>Date Registered</td>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                while ($row = $result->fetch_array()) {
                  ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['firstname'] . " " . $row['middlename'] . " " . $row['lastname']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['date_register']; ?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="messages">
      <section class="row" style="margin-top:2%">
        <div class="col-sm-12">
          <form class="form-horizontal" id="frm-user-update" method="post">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Current Password</label>

              <div class="col-sm-7">
                <input type="hidden" name="username" id="username" value="<?php echo $user['username']; ?>">
                <input type="password" placeholder="Current Password"
                       class="form-control required" autofocus="" id="current" name="password" required>
                <div id="err"></div>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">New Password</label>
              <div class="col-sm-7">
                <input type="password" name="new" placeholder="new password" id="new-pass" class="form-control required"
                       required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Confirm Password</label>
              <div class="col-sm-7">
                <input type="password" name="confirm" placeholder="confirm password" id="confirm-pass"
                       class="form-control required" required>
                <div id="error"></div>
              </div>
            </div>
            <div class="form-group">
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success" id="btn-update"><span
                    class="glyphicon glyphicon-ok"></span> Save changes
                </button>
                <button type="button" class="btn btn-danger cancel"><span class="glyphicon glyphicon-remove"></span>
                  Cancel
                </button>
              </div>
            </div>
          </form>
        </div>
      </section>
    </div>
  </div>

</div>
 </div>
</div>

<?php include 'include/footer.php'; ?>
<script type="text/javascript">
  $(document).ready(function () {

// check if username is already exist
    $('#create-username').keyup(function () {
      $.ajax({
        url: 'function/update-user.php',
        type: 'POST',
        dataType: 'HTML',
        data: "user_name=" + $('#create-username').val(),
        success: function (data) {
          if (data == 1) {
            $('#error_username').show();
            $('#error_username').html("<span class='text-danger'>Username already exist.</span>");
            $('#submit').attr('disabled', true);
          }
          else {
            $('#error_username').hide();
            $('#submit').removeAttr('disabled');

          }

        }
      });
    });

// uploading image
    $('#up-image').submit(function (e) {
      e.preventDefault();
      $.ajax({
        url: "function/update-user.php",
        type: "POST",
        data: new FormData(this),
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
          success_message(response);
        },
        complete: function () {
          location.reload();
        }
      });
    });

// check if the current password is correct
    $('#current').keyup(function () {  
      $.ajax({
        url: 'function/update-user.php',
        type: 'POST',
        dataType: 'HTML',
        data: "password=" + $('#current').val() + "&username=" + $('#username').val(),
        success: function (data) {
          if (data == 0) {
            $('#err').show();
            $('#err').html("<span class='text-danger'>Invalid Password.</span>");
            $('#btn-update').attr('disabled', true);
          }
          else {
            $('#err').hide();
            $('#btn-update').removeAttr('disabled');
          }

        }
      });
    });

// check if the password are match
    $('#confirm-pass').keyup(function () {

      var newpass = $('#new-pass').val();
      var confirm = $('#confirm-pass').val();

      if (confirm == newpass) {
        $('#error').hide();
        $('#btn-update').removeAttr('disabled');
      }
      else {
        $('#error').show();
        $('#error').html("<div class='text-danger'>Password do not match.</div>");
        $('#btn-update').attr('disabled', true);
      }
    });

// update password
    $('#frm-user-update').submit(function (e) {
      e.preventDefault();
      $.ajax({
        url: 'function/update-user.php',
        type: 'POST',
        dataType: 'HTML',
        data: "new=" + $('#new-pass').val() + "&confirm=" + $('#confirm-pass').val() + "&username=" + $('#username').val(),
        success: function (data) {
          $('.form-control').val('');
          success_message(data);
        }
      });
    });

// for cancel button
    $('.cancel').click(function () {
      $('.form-control').val('');
    });


    // register user
    $('#frm-reg').submit(function (event) {
      event.preventDefault();
      var pass = $('#pass').val();


      var confirm = $('#confirm').val();
      if (pass === confirm) {
        var formData = $(this).serialize();

        $.post('function/create-user.php', formData, function (data) {
          if (data) {
            success_message(data);
            $('.form-control').val('');
          }
        });
      }
      else {
        alert('Password do not match. Please try again');
      }
    });



    function success_message(message) {
      var d = "<div class='alert alert-success alert-dismissible fade in' role='alert'>";
          d += "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>";
          d += "<h4>Success!</h4>";
          d += "<p>" + message + "</p>";
          d += "<p>";
      // d += "<button type='button' class='btn btn-danger'>Take this action</button>";
      // d += "<button type='button' class='btn btn-default'>Or do this</button>";
          d += "</p>";
          d += "</div>";
        $('#details').html(d).fadeIn();
    }

  });
</script>
