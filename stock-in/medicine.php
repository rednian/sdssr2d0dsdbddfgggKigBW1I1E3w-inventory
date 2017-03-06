<?php
include '../include/stock-header.php';
include '../include/stock-navigation.php';
include '../include/stock-sidebar.php';
?>
  <div class="row">
    <div class="col-md-5">
      <div class="well">
        <section class="panel panel-default">
          <!-- <div class="panel-heading">
            <h1 class="panel-title">Account Registration</h1>
          </div> -->
          <div class="panel-body">
            <h2 class="text-success text-center">Stock-in Medicine</h2>

            <form method="post" id="frm_medicine">
              <div class="form-group">
                <label for="">Medicine name</label>
                <input type="text" name="item_name" placeholder="Name of Medicine" class="form-control input-lg">
              </div>
              <div class="form-group">
                <label for="">Expiration Date</label>
                <input type="text" name="expire_date" placeholder="Expiration Date" id="expire-date"
                       class="form-control input-lg">
              </div>
              <div class="form-group">
                <label for="">Supplier</label>
                <input type="text" name="supplier" placeholder="Supplier" class="form-control input-lg">
              </div>
              <div class="form-group">
                <label for="">Date in</label>
                <input type="text" name="date_in" placeholder="Supplier Name" id="med-date-in"
                       class="form-control input-lg">
              </div>
              <div class="form-group">
                <label for="">Selling Price</label>
                <input type="text" name="selling_price" placeholder="Selling Price" class="form-control input-lg">
              </div>
              <div class="form-group">
                <label for="">Quantity</label>
                <input type="text" name="quantity" placeholder="Quantity" class="form-control input-lg">
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-lg btn-default" value="Save new medicine">
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
            <h2 class="text-success text-center">Medicine</h2>

            <div class="table-responsive">
              <table class="table table-stripped table-condensed table-hover">
                <tr class="bg-green">
                  <th>#</th>
                  <th>Medicine Name</th>
                  <th>Expiration Date</th>
                  <th>Supplier</th>
                  <th>Date in</th>
                  <th>Quantity</th>
                  <th>Action</th>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Eye Berry</td>
                  <td>12/12/12</td>
                  <td>xxxxxxxxxxxx</td>
                  <td>12/12/12</td>
                  <td>1233</td>
                  <td><a href="#"><span class="glyphicon glyphicon-pencil"></span> update</a></td>
                </tr>
              </table>
            </div>
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
<?php include '../include/stock-footer.php'; ?>