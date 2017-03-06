<?php
require_once '../function/includes.php';
if (isset($_GET['category'])) {
  $category = $_GET['category'];
}

$sql = "SELECT prod_profile.`name`,prod_profile.model_no,prod_profile.supplier,
barcode.barcode,
price.price,
stock_in_history.quantity,
stock_in_history.dates
FROM
prod_profile,
barcode,
price,
stock_in_history
WHERE
prod_profile.prod_id = barcode.prod_id
AND
barcode.b_id = price.b_id
AND
barcode.b_id = stock_in_history.b_id";

$result = $db->query($sql);


include '../include/stock-header.php';
include '../include/stock-navigation.php';
include '../include/stock-sidebar.php';
?>
<div class="row">
  <div class="col-md-12">
    <dv class="page-header">
      <h2>Stock-in Record</h2>
    </dv>
    <div class="box box-success">
      <div class="box-header">
        <div class="row">
          <div class="col-xs-6">
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false">
                filter by <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li><a href="item.php?category=all">All</a></li>
                <li><a href="item.php?category=item">Item</a></li>
                <li><a href="item.php?category=medicine">Medicine</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="box-body">
        <table class="table paginate table-hover">
          <thead>
          <tr>
            <td>#</td>
            <td>Barcode</td>
            <td>Name</td>
            <td>Model no</td>
            <td>Supplier</td>
            <td>Price</td>
            <td>Quantity</td>
            <td>Date in</td>
            <td>Expiry Date</td>
          </tr>
          </thead>
          <tbody>
          <?php
          if (isset($category)) {
            if ($category == 'item') {
              include_once 'include-item.php';
            }
            if ($category == 'all') {
              include_once 'include-all.php';
            }
            if ($category == 'medicine') {
              include_once 'include-medicine.php';
            }

          }
          else{
             include_once 'include-all.php';
          }

          ?>
          </tbody>
        </table>
      </div>
    </div>


  </div>
</div>
<?php include '../include/stock-footer.php'; ?>
