<div class="modal fade" id="confirmFinishTransaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="">
        <div class="modal-header flat with-border">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Payment</h4>
        </div>
        <div class="modal-body message">
          <div class="row">
              <div class="col-lg-6 col-lg-offset-3">
                <div class="form-group">
                  <strong>Amount to pay</strong>
                  <input id="txtamounttopay" type="text" class="form-control no-border" readonly>
                </div>
              </div>
          </div>
          <div class="row">
              <div class="col-lg-6 col-lg-offset-3">
                <div class="form-group">
                  <strong>Amount tendered</strong>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">&#8369;</span>
                    <input id="txtamounttendered" onkeyup="display_change($(this).val())" type="text" class="form-control" placeholder="0.00" aria-describedby="basic-addon1">
                  </div>
                </div>
              </div>
          </div>
          <div class="row">
              <div class="col-lg-6 col-lg-offset-3">
                <div class="form-group">
                  <strong>Change</strong>
                  <input type="text" id="txtchange" class="form-control no-border" value="0.00" readonly>
                </div>
              </div>
          </div>
        </div>
        <div class="modal-footer flat">
          <!-- <button type="button" class="btn btn-default btn-sm flat" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-success btn-sm flat confirmOK" onclick="finish_transaction();" id="" name= class="btn btn-success btn-sm flat">Ok</button> -->
          <button id="btn_claim" disabled type="button" class="btn btn-sm btn-success flat" onclick="for_claim();">For claim</button> <button disabled id="btn_takeout" class="btn btn-sm btn-success flat" type="button" onclick="finish_transaction();">Takeout</button>
        </div>
      </form> 
    </div>
  </div>
</div>

<script type="text/javascript">
  
  function display_change(val){
    var total = $("#txtamounttopay").val();
    var change = val - total;
    var final_change = parseFloat(Math.round(change*100)/100).toFixed(2);

   if(val.length == 0 || val.trim("")){
      $("#txtchange").val("0.00");
    }
    
    if(isNaN(val) || change < 0){
      $("#btn_claim").attr("disabled",true);
      $("#btn_takeout").attr("disabled",true);
    }
    else if(!isNaN(val) || change > 0){
      $("#btn_claim").removeAttr("disabled");
      $("#btn_takeout").removeAttr("disabled");
      $("#txtchange").val(final_change);
    }

    if(isNaN(change)){
      $("#txtchange").val("0.00");
    }
  }


  
</script>