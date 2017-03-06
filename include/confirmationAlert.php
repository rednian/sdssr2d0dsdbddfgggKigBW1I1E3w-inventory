<div class="modal fade" id="confirmClearList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="">
        <div class="modal-header flat with-border">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Confirm</h4>
        </div>
        <div class="modal-body message">
          Are you sure you want to clear purchase list?
        </div>
        <div class="modal-footer flat">
          <button type="button" class="btn btn-default btn-sm flat" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-success btn-sm flat confirmOK" onclick="clear_list();$('#confirmClearList').modal('hide')" id="" name= class="btn btn-success btn-sm flat">Ok</button>
        </div>
      </form> 
    </div>
  </div>
</div>

