<?php
include '../include/stock-header.php';
include '../include/stock-navigation.php';
include '../include/stock-sidebar.php';

require_once '../function/includes.php';
$user_id = $_SESSION['user_id'];
$item_id = base64_decode($_GET['item']);
//$item_id = $_GET['item'];
$sql = "SELECT
prod_profile.*,barcode.*, price.price,
prod_total_quantity.quantity
FROM
prod_profile,
barcode,
price,
prod_total_quantity
WHERE
prod_profile.prod_id = barcode.prod_id
AND
barcode.b_id = price.b_id
AND
barcode.b_id = prod_total_quantity.b_id
AND
prod_profile.prod_id = '$item_id'";
$result = $db->query($sql);
$row = $result->fetch_array();

?>
<div class="row">
  <div class="col-md-12">
    <section class="row">
      <div class="col-sm-12">
        <section class="panel">
          <div class="panel-heading">
            <h1 class=" text-success"> <?php echo ucwords($row['name']); ?> <a
                href="../stock-in/update.php?id=<?php echo $row['b_id'] . '&p_id=' . $row['prod_id']; ?>"
                class="btn btn-info btn-xs"><span class="glyphicon glyphicon-pencil"></span></a></h1>
          </div>
          <div class="panel-body">
            <section class="row">
              <div class="col-sm-2">
                <p>Price:</p>

                <p>Barcode:</p>

                <p>Suppper:</p>

                <p>Model Number:</p>

                <p>Expiration Date:</p>

                <p>Available Quantity:</p>
              </div>
              <div class="col-sm-6">
                <p><strong><?php echo number_format($row['price'], 2); ?></strong></p>

                <p><strong><?php echo $row['barcode']; ?></strong></p>

                <p><strong><?php echo $row['supplier']; ?></strong></p>

                <p><strong><?php if ($row['model_no'] == '') {
                      echo "-";
                    } else {
                      echo $row['model_no'];
                    } ?></strong></p>

                <p><strong><?php echo $row['expiration_date']; ?></strong></p>

                <p><strong><?php echo number_format($row['quantity']); ?></strong></p>
              </div>
            </section>
          </div>
        </section>
      </div>
    </section>
    <div>

      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Stock-in
            History</a></li>
        <li role="presentation"><a href="../stock-in/add-item.php" class="btn" role="tab"><span
              class="glyphicon glyphicon-plus"></span> Add New Product</a></li>
        <li role="presentation"><a href="../product-profile.php" role="tab" class="btn"><span
              class="glyphicon glyphicon-search"></span> View All Product</a></li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="home">
          <section class="panel panel-success" style="margin-top: 3%">
            <div class="panel-heading">
              <h1 class="panel-title"><?php echo ucwords($row['name']); ?> Stock-in History</h1>
            </div>
            <div class="panel-body">
              <table class="table paginate">
                <thead class="bg-success">
                <th>#</th>
                <th>Model no</th>
                <th>Supplier</th>
                <th>Quantity in</th>
                <th>Price</th>
                <th>Expiration</th>
                <th>Date in</th>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT
                          prod_profile.*,
                          price.price,
                          stock_in_history.quantity,
                          stock_in_history.dates,
                          price.price
                        FROM
                          prod_profile,
                          price,
                          stock_in_history,
                          barcode
                        WHERE
                          barcode.prod_id = prod_profile.prod_id
                        AND price.b_id = barcode.b_id
                        AND stock_in_history.b_id = barcode.b_id
                        AND prod_profile.prod_id = '$item_id'";
                $result = $db->query($sql);
                $i = 1;
                while ($row = $result->fetch_array()) {
                  ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['model_no']; ?></td>
                    <td><?php echo $row['supplier']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['expiration_date']; ?></td>
                    <td><?php echo $row['dates']; ?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>

          </section>
        </div>
        <div role="tabpanel" class="tab-pane fade in active" id="profile">

        </div>
        <!-- <div role="tabpanel" class="tab-pane fade" id="messages"></div> -->
      </div>

    </div>
  </div>
</div>

<?php include '../include/stock-footer.php'; ?>

<?php


?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">update information</h4>
      </div>
      <div class="modal-body">
        <section class="row">
          <div class="col-sm-12">
            <form method="post" enctype="multipart/form-data" action="function/update-password.php"
                  data-toggle="validator">
              <section class="row">
                <div class="col-sm-3">
                  <div class="media">
                    <img class="img img-thumbnail flat view_image" id="yourimage" src="dist/img/default.png"
                         style="width:135px; height: 138px;">

                    <div class="btn btn-primary btn-file btn-xs flat" style="margin-top:5px;width:100%">
                      <i class="fa fa-folder-o"></i> Browse for photos
                      <input type="file" id="takePictureField" accept="image/*" name="file_upload"/>
                    </div>
                  </div>
                </div>
                <div class="col-sm-9">
                  <div class="form-group">
                    <input type="password" name="old" id="old-pass" placeholder="Current Password"
                           class="form-control required" autofocus="">

                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <input type="password" name="new" placeholder="new password" class="form-control required">
                  </div>
                  <div class="form-group">
                    <input type="password" name="confirm" placeholder="confirm password" class="form-control required">
                  </div>
                </div>
              </section>

          </div>
        </section>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function () {



    $('#frm-reg').submit(function (event) {
      event.preventDefault();
      var pass = $('#pass').val();
      var confirm = $('#confirm').val();

      if (pass === confirm) {
        var formData = $(this).serialize();

        $.post('function/create-user.php', formData, function (data) {
          if (data) {
            alertSuccess('#frm-reg', '', data);
            clearData();
          }
        });
      }
      else {
        alert('Password do not match. Please try again');
      }
    });


  });
</script>
