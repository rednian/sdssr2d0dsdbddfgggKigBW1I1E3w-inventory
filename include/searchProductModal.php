<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Search</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <input id="txtsearch" type="text" onkeyup="search_item($(this).val())" class="form-control input-sm">
                </div>
              </div>
            </div>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th></th>
                  <th>Product code</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Available</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="5">No data found</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
