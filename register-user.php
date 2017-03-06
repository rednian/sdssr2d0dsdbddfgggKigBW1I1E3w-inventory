<?php
include 'include/header.php';
include 'include/navigation.php';
include 'include/sidebar.php';
?>
  <div class="row">
    <div class="col-md-12">
        <section class="panel panel-success">
          <!-- <div class="panel-heading">
            <h1 class="panel-title">Account Registration</h1>
          </div> -->
          <div class="panel-body">
            <div class="page-header">
              <h3 class="text-success"><span class="glyphicon glyphicon-user"></span> Create Account</h3>
            </div>
            <form method="post" enctype="multipart/form-data" id="frm-reg" data-toggle="validator">
              <p><strong>General Information</strong></p>
              <section class="row">
                <div class="col-sm-4">
                  <label>First name</label>
                 <div class="form-group">
                    <input type="text" name="fname" id="fname" placeholder="First name" class="form-control required" autofocus="">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="username" class="form-control required">
                  </div>
                  

                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Middle name</label>
                    <input type="text" name="midname" placeholder="Middle name" class="form-control required">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="password" class="form-control required">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Last name</label>
                    <input type="text" name="lastname" placeholder="Last name" class="form-control required">
                  </div>
                  <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm" placeholder="Confirm Password" class="form-control required">
                  </div>
                </div>
              </section>
              <div class="form-group">
                <input type="submit" class="btn btn-success" value="submit" name="submit" id="submit">
                <input type="button" class="btn btn-default" value="cancel" name="cancel">
              </div>
            </form>
          </div>
        </section>
        <section class="panel panel-success">
          <div class="panel-body">
          <div class="page-header">
            <p><strong>Registered Accounts</strong></p>
          </div>
            <table class="table paginate">
              <thead>
                <tr>
                  <td>#</td>
                  <td>Name</td>
                  <td>Username</td>
                  <td>last login</td>
                  <td>Actions</td>
                  <td></td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>#</td>
                  <td>Name</td>
                  <td>Username</td>
                  <td>last login</td>
                  <td><a href="#" class="btn btn-link btn-xs"><span class="glyphicon glyphicon-remove-circle"></span></a></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
        </section>

    </div><!---->
  </div><!-- row-->
<?php include 'include/footer.php'; ?>

<script type="text/javascript">
  $(document).ready(function(){
    // cancel the form
    $('button').click(function(){
      $("input").val() = '';
    });

  });
</script>
