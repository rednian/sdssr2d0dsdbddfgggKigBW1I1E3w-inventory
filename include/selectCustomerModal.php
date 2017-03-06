<div class="modal fade" id="searchCustomerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" onclick="$('#searchCustomerModal').modal('hide');clearForm()"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Select Customer</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <!-- <input id="txtsearch" type="text" onkeyup="search_item($(this).val())" class="form-control input-sm"> -->
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search customer">
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group" style="height:150px">
              <table class="table table-striped" id="table-search-customer">
                <tbody>
                  <tr>
                    <td colspan="4">No data found</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <form method="post" id="Form_Add_customer">
              Add Customer
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-4"><input type="text" name="txtfirstname" class="form-control input-sm" placeholder="First name"></div>
                  <div class="col-lg-4"><input type="text" name="txtmiddlename" class="form-control input-sm" placeholder="Middle name"></div>
                  <div class="col-lg-4"><input type="text" name="txtlastname" class="form-control input-sm" placeholder="Last name"></div>
                </div>
              </div>
              <div class="form-group">
                <textarea class="form-control input-sm" name="txtaddress" placeholder="Address"></textarea>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-6"><input type="text" name="txtcontact" class="form-control input-sm" placeholder="Contact no."></div>
                  <div class="col-lg-6"><input type="text" name="txtemail" class="form-control input-sm" placeholder="Email address"></div>
                </div>
              </div>
              <div class="form-group">
                <button class="btn btn-success btn-sm"><i class="fa fa-user-plus"></i> Save Customer</button>
              </div>
            </form>
            
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="$('#searchCustomerModal').modal('hide');clearForm()">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
