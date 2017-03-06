<?php
session_start();
if (isset($_SESSION['user_id'])) {
  header('Location:index.php');
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Villanueva Eye Clinic | Login</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

  <link href="font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
  <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
  <link href="dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css"/>
  <link href="bootstrap/css/custom.css" rel="stylesheet" type="text/css"/>
</head>
<body style="background-color: #eeeeee">
<div class="message"></div>
<nav class="navbar navbar-default ">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
              data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!--      <a class="navbar-brand" href="#">Brand</a>-->
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="#"><h4>Villanueva Eye Clinic</h4><span class="sr-only">(current)</span></a></li>
        <!--        <li><a href="#">About</a></li>-->
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
</nav>
<!-- /.container-fluid -->


<section class="container-fluid">
  <div class="row" style="margin-top: 1%; min-height: 100%">
    <div class="col-md-9" id="slide" expanded="true">
      <div id="carousel-example-generic" class="carousel slide hidden-xs hidden-sm " data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img src="dist/img/slide/1.jpg" alt="..." class="img">

            <div class="carousel-caption">
              ...
            </div>
          </div>
          <div class="item">
            <img src="dist/img/slide/v2.jpg" alt="..." class="img">

            <div class="carousel-caption">
              ...
            </div>
          </div>
          <div class="item">
            <img src="dist/img/slide/v3.jpg" alt="..." class="img">

            <div class="carousel-caption">
              ...
            </div>
          </div>

        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
    <div class="col-md-3 col-sm-5" id="login">
      <section class="panel panel-success">
        <div class="panel-heading">
          <img src="dist/img/user1-128x128.jpg" class="img-circle img-thumbnail center-block"
               alt=""
               style="width: 20%"/>

          <h1 class="panel-title text-center">Administrator Login</h1>
        </div>
        <div class="panel-body" id="panel_login">

          <form action="" method="post" id="frm_login">
            <div class="form-group">
              <label for="">Username</label>
              <input type="text" name="username" id="username" placeholder="username" class="form-control input-lg"
                     autofocus=""/>
            </div>
            <div class="form-group">
              <label for="">Password</label>
              <input type="password" name="password" id="password" placeholder="password"
                     class="form-control input-lg"/>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox"> Remember me
              </label>
            </div>
            <div class="form-group">
              <input type="submit" name="login" id="login" value="Login" class="btn btn-success btn-lg btn-block"/>
            </div>
          </form>
        </div>
      </section>
      <section class="panel panel-success">
        <div class="panel-heading">
          <h1 class="panel-title text-center">Contact &amp; Support</h1>
        </div>
        <div class="panel-body">
          <ul class="list-unstyled">
            <li>Tel: <strong>(085)815-9299</strong></li>
            <li>Email: <strong class="te"> sales@engtechglobal.com</strong></li>
            <li>Website: <strong><a href="http://www.engtechglobal.com"
                                    target="_blank">www.engtechglobal.com</a></strong></li>
            <li>Address: <strong>999 HDS Building, J.C. Aquino Ave., Butuan City, Philippines, 8600</strong></li>
          </ul>
        </div>
      </section>
    </div>

  </div>
</section>
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="function/function-js.js"></script>
<script>


  //	-----------------------------------show & hide the login form.
  //$('#login').hide();
  //	$('#sign-in').click(function(){
  //		var expand = $("#slide").attr("expanded");
  //
  //		if(expand == "true"){
  //			$('#slide').removeClass('col-md-12');
  //			$('#slide').addClass('col-md-9 col-sm-7');
  //			$('#login').fadeIn(1000);
  //			$("#slide").attr("expanded","false");
  //		}
  //		else if(expand == "false"){
  //			$('#slide').removeClass('col-md-9 col-sm-7');
  //			$('#slide').addClass('col-md-12');
  //			$('#login').fadeOut(1000);
  //			$("#slide").attr("expanded","true");
  //		}
  //
  //	});
</script>
</body>
</html>
