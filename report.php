<?php
require_once 'function/includes.php';
include 'include/header.php';
include 'include/navigation.php';
$user_id = $_SESSION['user_id'];
date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');
include 'include/sidebar.php';

//$result = $db->query($sales);


?>
<div class="row">
  <div class="col-md-12">
    <div class="page-header">
      <h4 class="text-center">Villanueva Eye Clinic</h4>

      <h3 class="text-center">Daily Sales &amp; Inventory Summary</h3>
      <h5 class="text-center text-muted" id="report_date"> as of <?php echo strtoupper(date('F d, Y ')); ?></h5>

      <div class="row hidden-print">
        <div class="col-md-10">
          <form action="" method="get" id="frm-report">
            <div class="row">
              <div class="col-lg-3">
                <div class="input-group">
                <span class="input-group-btn">
                  <button class="btn btn-primary btn-sm hidden-print" type="button">FROM</button>
                </span>
                  <input type="text" class="form-control input-sm hidden-print date-picker" id="from" name="from"
                         value="<?php echo date('m/d/Y'); ?>">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="input-group">
                <span class="input-group-btn">
                  <button class="btn btn-primary btn-sm hidden-print" type="button">TO</button>
                </span>
                  <input type="text" class="form-control input-sm hidden-print date-picker" id="to" name="to"
                         value="<?php echo date('m/d/Y'); ?>">
                </div>
              </div>

            </div>
          </form>
        </div>
        <div class="col-md-2 hidden-print">
          <a href="" class="btn btn-link" id="print"><span class="glyphicon glyphicon-print"></span> Print</a>
        </div>
      </div>
      <!-- Single button -->

    </div>
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <h3>Sold Items</h3>
        <section class="box box-success">
          <div class="panel-body">
            <table class="table table-hover" id="view-report">
              <thead>
              <tr class="bg-success">
                <th>Date</th>
                <th>Barcode</th>
                <th>Item Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Sub-Total</th>
              </tr>
              </thead>
              <tbody id="body">
              </tbody>
            </table>
          </div>
        </section>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <?php
        $sql = "SELECT 
                prod_profile. `name`,
                barcode.barcode,
                price.price,
                prod_total_quantity.quantity
                FROM
                prod_profile,
                barcode,
                prod_total_quantity,
                price
                WHERE 
                prod_profile.prod_id = barcode.prod_id 
                AND
                prod_total_quantity.b_id = barcode.b_id
                AND
                price.b_id = barcode.b_id
                AND
                prod_total_quantity.quantity > 0
                GROUP BY
                prod_profile.`name`";
        $result = $db->query($sql);
        ?>
        <h3>Item Available</h3>

        <div class="box box-success">
          <div class="box-header">

          </div>
          <div class="box-body">
            <table class="table paginate table-bordered">
              <thead>
              <tr class="bg-success">
                <th>Barcode</th>
                <th>Item Description</th>
                <!--                <th>Price</th>-->
                <th>Quantity</th>
              </tr>
              </thead>
              <tbody>
              <?php  $qty = 0;
              if ($result->num_rows > 0) {

                $price = 0;
                while ($row = $result->fetch_array()) {
                  $qty += $row['quantity'];
                  $price += $row['price'];
                  ?>
                  <tr>
                    <td><?php echo $row['barcode']; ?></td>
                    <td ><?php echo $row['name']; ?></td>
                    <!--                    <td>--><?php //echo $row['price']; ?><!--</td>-->
                    <td><?php echo number_format($row['quantity']); ?></td>
                  </tr>
                <?php
                }
              } ?>

              </tbody>
              <tfooter>
                <tr>
                  <td><h4><strong>Total Item</strong></h4></td>
                  <td></td>
                  <!--                  <td><h4><strong>P  --><?php //echo $price; ?><!--</strong></h4></td>-->
                  <td><h4><strong><?php echo number_format($qty); ?></strong></h4></td>
                </tr>
              </tfooter>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
<?php include 'include/footer.php'; ?>
<script>


  $('#print').click(function () {
   $( ".sidebar-toggle" ).trigger( "click" );
    window.print();
  });

  $('#to').change(function () {
    report($('#from').val(), $('#to').val());
    display_date();
  });

  $('#from').change(function () {
    report($('#from').val(), $('#to').val());
    display_date($(this).val());
  });

  report($('#from').val(), $('#to').val());

  function display_date(date) {
    var d = new Date();
    // if(date == d.now(){
    //   $('#report_date').html("as of"+$('#from').val());
    // }
    $('#report_date').html($('#from').val());

  }


  function report(from, to) {
    $.ajax({
      url: 'function/report-generate.php',
      type: 'GET',
      dataType: 'HTML',
      data: "from=" + from + "&to=" + to,
      success: function (data) {
        $('#body').html(data);
      }
    });
  }
</script>