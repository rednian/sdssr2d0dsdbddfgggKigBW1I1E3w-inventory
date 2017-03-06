<?php
include 'include/header.php';
include 'include/navigation.php';
include 'include/sidebar.php';
?>

  <style type="text/css">
    #table-unclaim-products thead td{
      background: #76C89C;
      color:#FFF;
      font-size:13px;
    }
    #table-unclaim-products tbody td{
      border-top:none;
    }

    #suggest{
      position:absolute;
      z-index:1000;
      width:90%;
      background:#FFF;
    }

    .suggest_item{
      padding:6px;
      background:#CCC;
      color:#333;
      font-size:12px;
      cursor:pointer;
    }

    .suggest_item:hover{
      background: #f3f3f3;
      color:#333;
    }
  </style>

  <div class="row">
    <div class="col-lg-12">
      <h2>Claim Products</h2>
    </div>
  </div>

  <div class="row">
    <div class="col-md-10">
      <div class="form-group">
        <div class="row">
          <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
            <div class="input-group input-group-sm">
              <input autofocus onkeyup="suggest($(this).val())" type="text" class="form-control" placeholder="Search" id="txtsearch">
              <span class="input-group-btn">
                <button onclick="search_product($('#txtsearch').val())" class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
              </span>
            </div><!-- /input-group -->
            <div id="suggest">
              
            </div>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <button onclick="load_list()" class="btn btn-sm btn-default"><i class="fa fa-refresh"></i> Refresh List</button>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-2">
            <select class="form-control input-sm" onchange="select_status($(this).val())">
                <option selected disabled>Select Status</option>
                <option value="all">All</option>
                <option value="claimed">Claimed</option>
                <option value="unclaim">Unclaim</option>
              </select>
          </div>

        </div>
      </div>
      <div class="row">
        <div class="col-lg-12" style="height:400px;overflow:auto">
          <table class="table table-striped" id="table-unclaim-products">
            <thead>
              <tr>
                <td>Barcode</td>
                <td>Description</td>
                <td>Qty</td>
                <td>Date reserved</td>
                <td>Date claimed</td>
                <td>Status</td>
                <td>Action</td>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
      </div>
      

    </div>
  </div>
<?php include 'include/footer.php'; ?>

<script type="text/javascript">

  $(document).keyup(function(e) {
  
    if (e.keyCode == 13){
      search_product($('#txtsearch').val());
      $("#suggest").hide();
    }

  });

  $(function(){
    load_list();
  });

  function load_list(){
    $.ajax({
      url: "function/claim/load_list.php",
      type: "GET",
      dataType: "html",
      success: function(data){
        $("#table-unclaim-products tbody").html(data);
      },
      error: function(){

      }
    });
  }

  function search_product(val){
    if(val.trim() != ""){
      $.ajax({
        url: "function/claim/search.php",
        data: "search="+val,
        type: "GET",
        dataType: "html",
        success: function(data){
          $("#table-unclaim-products tbody").html(data);
          $("#txtsearch").val("");
        },
        error: function(){

        }
      });
    }
    
  }

  function select_status(stat){
    $.ajax({
      url: "function/claim/select_status.php",
      data: "status="+stat,
      type: "GET",
      dataType: "html",
      success: function(data){
        $("#table-unclaim-products tbody").html(data);
      },
      error: function(){

      }
    });
  }

  function claim(res_id){
    $.ajax({
      url: "function/claim/claim.php",
      data: "claim="+res_id,
      type: "GET",
      dataType: "html",
      success: function(data){
        load_list();
      },
      error: function(){

      }
    });
  }

  function suggest(val){
    $.ajax({
      url: "function/claim/suggest.php",
      data: "value="+val,
      type: "GET",
      dataType: "html",
      success: function(data){
        $('#suggest').html(data);
      },
      error: function(){

      }
    });
  }

  $("#txtsearch").on("keyup",function(){
    if($(this).val().length > 0){
      $("#suggest").show();
    }
    if($(this).val().length == 0 || $(this).val().trim() == ""){
      $("#suggest").hide();
    }
   
  });

  function select_suggest(val){
    $("#txtsearch").val(val);
    $("#suggest").hide();
  }
</script>