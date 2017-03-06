<div class="row" style="margin-top: 2%">
  <div class="col-md-12">
    <div class="box box-success">
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <form method="post" id="frm-reg-item" data-toggle="validator">
              <div class="form-group">
                <label for="barcode">Barcode</label>
                <input type="text" name="barcode" id="barcode" class="form-control barcode" autofocus=""
                        data-error="Bruh, that email address is invalid">

                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label for="tem-name">Item name</label>
                <input type="text" name="item_name" class="form-control" id="item-name" required="">
              </div>
              <div class="form-group">
                <label for="item-model">Model</label>
                <input type="text" name="model" class="form-control" id="item-model">
              </div>
              <div class="form-group">
                <label for="">Supplier</label>
                <input type="text" name="supplier" class="form-control" id="item-supplier">
              </div>
              <div class="form-group">
                <label for="">Date in</label>
                <input type="text" id="item-date-picker" name="date_in" class="form-control date-picker"
                       required="">
              </div>
              <div class="form-group">
                <label for="">Selling price</label>
                <input type="text" name="selling_price" class="form-control" id="item-price" required="">
              </div>
              <div class="form-group">
                <label for="">Quantity <i id="label-quantity" qty=""></i><span id="input"></span><span
                    id="total"></span></label>
                <input type="text" name="quantity" class="form-control" id="=item-quantity" required="">
              </div>

              <div class="form-group">
                <input type="submit" class="btn btn-success" value="insert item" name="btnItem" id="btn-submit">
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>

</div>