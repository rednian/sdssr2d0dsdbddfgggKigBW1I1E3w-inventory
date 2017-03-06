<?php
include '../include/stock-header.php';
include '../include/stock-navigation.php';
include '../include/stock-sidebar.php';
require_once '../function/includes.php';
$b_id = $_GET['id'];

$sql = "SELECT
prod_profile.*,
barcode.*,
price.price,
prod_total_quantity.quantity
FROM
prod_profile,
barcode,
price,
prod_total_quantity
WHERE
prod_profile.prod_id =barcode.prod_id
AND
barcode.b_id = price.b_id
AND
barcode.b_id = prod_total_quantity.b_id
AND
barcode.b_id = '$b_id'";
$result = $db->query($sql);
$row = $result->fetch_array();


?>

<div class="row">
  <div class="col-md-12">
    <?php if (isset($_SESSION['message'])) {
      echo $_SESSION['message'];
      unset($_SESSION['message']);
    } ?>
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active">
        <a href="#home" aria-controls="home" role="tab" data-toggle="tab" class="btn btn-success">
          <span class="glyphicon glyphicon-pencil"></span> Update
          <?php echo $row['name'] . ' with barcode number ' . $row['barcode']; ?>
        </a>
      </li>
      <li role="presentation"><a href="add-item.php"> <span class="glyphicon glyphicon-plus"></span>Add New Product</a>
      </li>
    </ul>
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane fade in active" id="home">
        <form class="form-horizontal" id="frm-add-product" method="post" action="update-product.php">
          <div class="form-group">
            <!--                <label for="inputEmail3" class="col-sm-3 control-label">Select Type</label>-->
            <section class="row">
              <div class="col-sm-6">

              </div>

            </section>

          </div>
          <section class="row" style="margin-top: 2%">
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Type</label>

                <div class="col-sm-9">
                  <input type="hidden" name="p_id" value="<?php echo $row['prod_id']; ?>">
                  <input type="hidden" name="b_id" value="<?php echo $row['b_id']; ?>">
                  <!-- <input type="text" class="form-control" id="category" name="category"
                         value="<?php echo ucfirst($row['category']); ?>" > -->
                         <select name="category" id="category" class="form-control">
                           <option><?php echo ucfirst($row['category']); ?></option>
                           <?php 
                            if (ucfirst($row['category'])== 'Item') {
                              echo "<option>Medicine</option>";
                            }
                            else{
                              echo "<option>Item</option>";
                            }
                            ?>
                         </select>
                </div>

              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Barcode</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="barcode" name="barcode"
                         value="<?php echo $row['barcode']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Item Name</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="item-name" name="item_name"
                         value="<?php echo $row['name']; ?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label" id="lbl-model">Model No.</label>

                <div class="col-sm-9">
                  <?php
              
                  if(ucfirst($row['category'])=='Item'){
                    $item = '';
                    $med = 'disabled';
                  }
                  elseif(ucfirst($row['category'])=='Medicine'){
                    $med = '';
                    $item = 'disabled';
                  }
                  ?>
                  <input type="text" class="form-control" id="txt-model"  <?php echo $item; ?> name="model"
                         value="<?php echo $row['model_no']; ?>">
                </div>
              </div>

            </div>
            <div class="col-md-6">
              <div class="form-group" style="position: relative">
                <label for="inputEmail3" class="col-sm-3 control-label">Expiration Date</label>

                <div class="col-sm-9">
                  <?php
                  $d = '';
                  $v = '';
                  if ($row['model_no'] != '') {
                    // $d = 'disabled';
                  } else {
                    $d = '';
                    $v = $row['expiration_date'];
                  }
                  ?>
                  <p style="position: absolute; top: -20px"
                     class="text-danger"><?php if ($row['category'] == 'medicine') {
                       echo 'Expiration Date :' . $row['expiration_date'];
                    }

                    // $readonly = '';
                    // $required = '';
                    /*check if the category is an item and disable the date expiration.*/
                    // if ($row['category'] != 'Medicine') {
                    //    $readonly = 'readonly';
                    //    $required = 'required';
                    // }

                    ?></p>

                  <input type="text" class="form-control date-picker" id="expiration"
                         name="expiration" <?php echo $med; ?>>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Supplier</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="supplier" name="supplier"
                         value="<?php echo $row['supplier']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Selling Price</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="price" name="price" value="<?php echo $row['price']; ?>"
                         required>
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Quantity</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="qty" name="quantity"
                         value="<?php echo $row['quantity']; ?>" readonly>
                </div>
              </div>

            </div>
          </section>
          <section class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">
                  <button type="submit" class="btn btn-success" tabindex="-1" id="submit">
                    <span class='glyphicon glyphicon-ok'></span> Save Changes
                  </button>
                  <button type="button" class="btn btn-danger" tabindex="-1"><span
                      class="glyphicon glyphicon-remove"></span> Cancel
                  </button>

                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3" id="display-qty"></div>
              </div>
            </div>
          </section>
        </form>
        <section class="page-header"></section>
        <section id="details"></section>
      </div>
      <!--      <div role="tabpanel" class="tab-pane fade" id="profile"></div>-->

    </div>

  </div>


  <h2></h2>

</div>
</div>
</div>
<?php include '../include/stock-footer.php'; ?>
<script>
  $(document).ready(function () {

      $('#barcode').on('change keyup', function () {
      // alert($(this).val());
      });

    $('#qty').on('change keyup', function () {
      if (isNaN($(this).val())) {
      }
    });
    $('#price').on('change keyup', function () {
      if (isNaN($(this).val())) {
      }
    });

    $('#frm-add-product').submit(function (e) {
      e.preventDefault();

      var select = $('#select-type').val();
      var formData = $(this).serialize();

      $.post('update-product.php', formData, function (message) {
        success_message(message);
        $('.form-control').val('');
      });


      if (select == 'item') {
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
