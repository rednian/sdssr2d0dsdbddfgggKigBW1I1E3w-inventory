<div class="row" style="margin-top: 2%">
  <div class="col-md-12">
    <div class="box box-success">
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <form method="post" id="frm-reg-med" data-toggle="validator">
              <div class="form-group">
                <label for="tem-name">Barcode</label>
                <input type="text" name="med_barcode" class="form-control" id="med-barcode" required="">
              </div>
              <div class="form-group">
                <label for="tem-name">Medicine Name</label>
                <input type="text" name="med_name" class="form-control" id="med-txt-name" required="">
              </div>
              <div class="form-group">
                <label for="">Supplier</label>
                <input type="text" id="item-date-picker" name="med_supplier" class="form-control date-picker"
                       required="">
              </div><div class="form-group">
                <label for="">Expiry Date</label>
                <input type="text" name="med_supplier" class="form-control date-picker"
                       required="">
              </div>
              <div class="form-group">
                <label for="">Selling price</label>
                <input type="text" name="med_price" class="form-control" id="item-price" required="">
              </div>
              <div class="form-group">
                <label for="">Date in</label>
                <input type="text" id="item-date-picker" name="med_date_in" class="form-control date-picker"
                       required="">
              </div>
              <div class="form-group">
                <label for="">Quantity <i id="label-quantity" qty=""></i><span id="input"></span><span
                    id="total"></span></label>
                <input type="text" name="med_quantity" class="form-control" id="=item-quantity" required="">
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-success" value="insert item" name="btn_med" id="med-btn-submit">
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>

</div>