<?php
include '../include/stock-header.php';
include '../include/stock-navigation.php';
include '../include/stock-sidebar.php';
require_once '../function/includes.php';

$sql = "SELECT
barcode.*,
prod_profile.*,
prod_total_quantity.*,
price.*
FROM
prod_profile,
barcode,
prod_total_quantity,
price
WHERE
prod_profile.prod_id = barcode.prod_id
AND
barcode.b_id = prod_total_quantity.b_id
AND
barcode.b_id = price.b_id
ORDER BY prod_profile.`name`";
$result = $db->query($sql);
?>

<div class="row">
  <div class="col-md-12">
    <?php if (isset($_SESSION['message'])) {
      echo $_SESSION['message'];
      unset($_SESSION['message']);
    } ?>
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                                                data-toggle="tab"><span class="glyphicon glyphicon-plus"></span> Add New
          Product</a></li>
      <!--      <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><span-->
      <!--            class="glyphicon glyphicon-plus"></span> Add New Medicine</a></li>-->
      <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab" id="view-stock"><span
            class="glyphicon glyphicon-search"></span> Stock Record History </a>
      </li>
    </ul>
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane fade in active" id="home">
        <form class="form-horizontal" id="frm-add-product">
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
                <div class="col-sm-9 col-sm-offset-3">
                  <select name="" id="select-type" class="form-control">
                    <option value="" disabled selected>Select Type</option>
                    <option value="Item">Item</option>
                    <option value="Medicine">Medicine</option>
                  </select>
                </div>

              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Barcode</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="barcode" name="barcode" required="" autofocus>
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Item Name</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="item-name" name="item_name" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label" id="lbl-model">Model No.</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="txt-model" disabled name="model">
                </div>
              </div>

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Expiration Date</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control date-picker" id="expiration" disabled name="expiration"
                         required="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Supplier</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="supplier" name="supplier" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Selling Price</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="price" name="price" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Quantity</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="qty" name="quantity" required="">
                </div>
              </div>

            </div>
          </section>
          <section class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">
                  <button type="submit" class="btn btn-success" tabindex="-1" id="submit" disabled>
                    <span class='glyphicon glyphicon-ok'></span> Save Item
                  </button>
                  <button type="button" class="btn btn-danger" tabindex="-1" id="cancel"><span
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
      <div role="tabpanel" class="tab-pane fade" id="messages">
        <section class="panel" style="margin-top: 2%">
          <div class="panel-body">
            <div class="page-header">
              <h2>Stock-in Record <small>All Products</small></h2>
            </div>
            <table class="table paginate table-bordered">
              <thead>
              <tr class="bg-success">
                <td>#</td>
                <td>Barcode</td>
                <td>Product Description</td>
                <td>Model Number</td>
                <td>Quantity</td>
                <td>Price</td>
                <td>Actions</td>
              </tr>
              </thead>
              <tbody>
              <?php  $i = 1;
              while ($row = $result->fetch_array()) {
                ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $row['barcode']; ?></td>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['model_no']; ?></td>
                  <td><?php echo $row['quantity']; ?></td>
                  <td><?php echo $row['price']; ?></td>
                  <td>
                    <a href="../product-profile/product-details.php?item=<?php echo base64_encode($row['prod_id']); ?>"
                      class="btn btn-primary btn-xs"> <span class="glyphicon glyphicon-search"></span></a>
                     <a href="update.php?id=<?php echo $row['b_id'].'&p_id='.$row['prod_id']; ?>" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-pencil"></span></a> 
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
      </div>
    </div>

  </div>
</div>
<!--</div>-->
<!--</div>-->
<?php include '../include/stock-footer.php'; ?>
<script>
  $(document).ready(function () {

    $('#cancel').click(function(){
      $('#barcode').val('');
      $('#item-name').val('');
      $('#txt-model').val('');
      $('#expiration').val('');
      $('#supplier').val('');
      $('#price').val('');
      $('#qty').val('');
    });

    $('#qty').on('change keyup', function () {
      if (isNaN($(this).val())) {
        $('#submit').attr('disabled', true);
        $('#display-qty').html("<p><strong class='text-danger'>Invalid quantity</strong></p>");
      } else {
        $('#submit').removeAttr('disabled');
        $('#display-qty').html('');
      }
    });
    $('#price').on('change keyup', function () {
      if (isNaN($(this).val())) {
        $('#submit').attr('disabled', true);  
        $('#display-qty').html("<p><strong class='text-danger'>Invalid Price</strong></p>");
      } else {
        $('#submit').removeAttr('disabled');
        $('#display-qty').html('');
      }
    });


    $('#frm-add-product').submit(function (e) {
      e.preventDefault();

      var select = $('#select-type').val();
      var formData = $('#frm-add-product').serialize();



          // alert(formData);
      if (select == 'Item') {
        $.post('insert-item.php', formData, function (message) {
          clear();
          if (message === 'No data added or updated') {
            error_message(message);
          }
          else {
            success_message(message);
          }
        });

      }
      else if (select == 'Medicine') {
        $.post('insert-med.php', formData, function (message) {
          clear();
          if (message === 'No data added or updated') {
            error_message(message);
          }
          else {
            success_message(message);
          }
        })
      }
      else {
        // alert(select);
      }
    });
    $('#barcode').on('change keyup', function () {
     
      get_barcode( $('#barcode').val());
    
    });

    function get_barcode(barcode) {
      $.ajax({
        url: '../function/search.php',
        type: 'POST',
        dataType: 'JSON',
          data: {barcode : barcode},
        success: function (data) {
          if(data != ""){
            $("#select-type option[value="+data['category']+"]").attr("selected", true);
            // alert(data['category']);
            $('#item-name').val(data['name']).attr('readonly',true);
            $('#txt-model').val(data['model_no']).attr('readonly',true);
            $('#supplier').val(data['supplier']).attr('readonly',true);
            $('#price').val(data['price']).attr('readonly',true);
          }
          else{
            $('#item-name').removeAttr('readonly').val('');
            $('#txt-model').removeAttr('readonly').val('');
            $('#supplier').removeAttr('readonly').val('');
            $('#price').removeAttr('readonly').val('');
          }

          if (typeof  data[4] == 'undefined') {
            data[4] = 0;
            $('#display-qty').hide();
          }
          else {
            $('#display-qty').html("<strong class='text-danger'>" + data['quantity'] + " Quantity Available.</strong>").fadeIn();
          }
        }
      });
    }

    function get_item() {
      $.ajax({
        url: '../function/search.php',
        type: 'POST',
        dataType: 'JSON',
        data: "item=" + $('#item-name').val(),
        success: function (data) {
          $('#barcode').val(data['barcode']);
          $('#txt-model').val(data['model_no']);
          $('#supplier').val(data['supplier']);
          $('#price').val(data['price']);
          if (typeof  data[4] == 'undefined') {
            data[4] = 0;
          }

          $('#display-qty').html("<strong class='text-danger'>" + data[4] + " Quantity Available.</strong>").fadeIn();
        }
      });
    }

    $('#select-type').change(function () {
      var select = $(this).val();
      if (select == 'Item') {
        $('#txt-model').removeAttr('disabled');
        $('#expiration').attr('disabled', true);
        $('#submit').html("<span class='glyphicon glyphicon-ok'></span> Save Item");
      }
      if (select == 'Medicine') {
        $('#expiration').removeAttr('disabled');
        $('#txt-model').attr('disabled', true);
        $('#submit').html("<span class='glyphicon glyphicon-ok'></span> Save Medicine");
      }

      if (select == 'Item' || select == 'Medicine') {
        $('#submit').removeAttr('disabled');
      }
      else {
        $('#submit').attr('disabled', true);
      }
    });
    function clear() {
      $('.form-control').val('');
    }

    function success_message(message) {
      var d = "<div class='alert alert-success alert-dismissible fade in' role='alert'>";
      d += "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>";
      d += "<h4>Success!</h4>";
      d += "<p>" + message + "</p>";
      d += "<p>";
      d += "</p>";
      d += "</div>";
      $('#details').html(d).fadeIn();
    }

    function error_message(message) {
      var d = "<div class='alert alert-danger alert-dismissible fade in' role='alert'>";
      d += "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>";
      d += "<h4>Error!</h4>";
      d += "<p>" + message + "</p>";
      d += "<p>";
      // d += "<button type='button' class='btn btn-danger'>Take this action</button>";
      // d += "<button type='button' class='btn btn-default'>Or do this</button>";
      d += "</p>";
      d += "</div>";
      $('#details').html(d).fadeIn().fadeOut(3000);
    }

  });


</script>
