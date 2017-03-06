<?php
  include 'include/header.php';
  include 'include/navigation.php';
  include 'include/sidebar.php';
?>
  <div class="row">
    <div class="col-md-5">
      <div class="well">
        <section class="panel panel-default">
          <!-- <div class="panel-heading">
            <h1 class="panel-title">Account Registration</h1>
          </div> -->
          <div class="panel-body">
            <h2 class="text-success text-center">Stock-in Item</h2>

            <form>
              <div class="form-group">
                <input type="text" name="item_name" placeholder="Name of Item" class="form-control input-lg">
              </div>
              <div class="form-group">
                <input type="text" name="model" placeholder="Model No." class="form-control input-lg">
              </div>
              <div class="form-group">
                <input type="text" name="supplier" placeholder="Supplier Name" class="form-control input-lg">
              </div>
              <div class="form-group">
                <input type="date" name="date_in" placeholder="Date In" class="form-control input-lg">
              </div>
              <div class="form-group">
                <input type="text" name="selling_price" placeholder="Selling Price" class="form-control input-lg">
              </div>
              <div class="form-group">
                <input type="text" name="quantity" placeholder="Quantity" class="form-control input-lg">
              </div>
              <div class="form-group">
                <input type="text" name="barcode" placeholder="Barcode" class="form-control input-lg">
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-lg btn-success" value="insert product">
              </div>
            </form>
          </div>
        </section>

      </div>
    </div>
    <div class="col-md-7">

      <section class="well">
        <div class="panel panel-default">
          <div class="panel-body">
            <h2 class="text-success text-center">Registered Accounts</h2>
            <table>
              <tr>
                <td>
                  <section class="row">
                    <div class="col-md-9">
                      <p>1</p>
                      <p>Item Name :</p>
                      <p>Model No. :</p>
                      <p>Model No. :</p>
                    </div>
                    <div class="col-md-3">
                      <a href="#" class="btn btn-link"><span class="glyphicon glyphicon-pencil text-success"></span> edit</a>
                    </div>
                  </section>
                </td>
              </tr>
            </table>
            <nav class="pull-right">
              <ul class="pagination">
                <li>
                  <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li>
                  <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </section>
    </div>

  </div>
<?php include 'include/footer.php'; ?>