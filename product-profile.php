<?php
include 'include/header.php';
include 'include/navigation.php';
include 'include/sidebar.php';
require_once 'function/includes.php';

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
      <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Available
          Products</a></li>
      </li>
    </ul>
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane fade in active" id="home">
        <h2>Available Products</h2>
        <section class="box">
          <div class="box-body">
            <table class="table table-condensed paginate table-bordered table-striped">
              <thead>
              <tr class="bg-success">
                <td>Type</td>
                <td>Barcode</td>
                <td>Product Description</td>
                <td>Model Number</td>
                <td>Quantity</td>
                <td>Price</td>
                <td class="text-center">Actions</td>
              </tr>
              </thead>
              <tbody>
              <?php  $i = 1;
              while ($row = $result->fetch_array()) {
                ?>
                <tr>
                  <td><?php echo $row['category']; ?></td>
                  <td><?php echo $row['barcode']; ?></td>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['model_no']; ?></td>
                  <td><?php echo $row['quantity']; ?></td>
                  <td><?php echo $row['price']; ?></td>
                  <td><a href="product-profile/product-details.php?item=<?php echo base64_encode($row['prod_id']); ?>"
                         class="btn btn-primary btn-xs"> <span class="glyphicon glyphicon-search"></span></a> <a
                      href="stock-in/update.php?id=<?php echo $row['b_id'] . '&p_id=' . $row['prod_id'] ?>"
                      class="btn btn-info btn-xs"><span
                        class="glyphicon glyphicon-pencil"></span></a></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </section>

      </div>
      <div role="tabpanel" class="tab-pane fade" id="profile">

      </div>
      <div role="tabpanel" class="tab-pane fade" id="messages">
      </div>
    </div>
  </div>
</div>
<?php include 'include/footer.php'; ?>
