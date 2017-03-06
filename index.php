<?php
include 'include/header.php';
include 'include/navigation.php';
include 'include/sidebar.php';

require_once 'function/includes.php';
$sql = "DELETE FROM temp_purchase";
$result = $db->query($sql);

$_SESSION['cus_id'] = 0;
?>
<style type="text/css">
  .alert {
    padding: 5px !important;
    margin-bottom: 0px !important;
    /*border: 1px solid transparent !important;
    border-radius: 4px !important;*/
  }

  #table_search tbody td {
    padding: 4px;
    border-top: none;
  }

  #shortcut_key_panel {
    box-shadow: none;
  }

  #table_purchase_list tbody td, #table-search-customer tbody td {
    /*border-top: none;*/
  }

  table#table-search-customer tbody td, table#table-search-customer tbody td a {
    font-size: 12px;
  }

  a.qty-minus, a.qty-plus {
    visibility: hidden;
  }

  #table_purchase_list tbody tr:hover a.qty-minus, #table_purchase_list tbody tr:hover a.qty-plus {
    visibility: visible;
  }

  #table_purchase_list thead td {
    background: #76C89C;
    color: #FFF;
    font-size: 13px;
  }

  #table_purchase_list tbody td {
    font-size: 13px;
  }
</style>

<div class="row">

  <div class="col-lg-4">

    <!-- <div id="customer_panel" class="box box-success">
      <div class="box-body">
        <button class="btn btn-default btn-xs" onclick="$('#searchCustomerModal').modal('show')"><i class="fa fa-user-plus"></i> Select customer</button>
        <div class="customer" style="padding-top:5px">
          No customer selected
        </div>
      </div>
    </div> -->

    <div id="search_product_panel" class="">
      <div class="box-header"><i class="fa fa-barcode"></i></div>
      <div class="box-body">
        <section class="panel panel-default">
          <div class="panel-heading">
            <div class="form-group">
              <input id="txtbarcode" onchange="search_barcode($(this).val())" onkeyup="search_barcode($(this).val())"
                     type="text" class="form-control input-lg" autofocus style="border: 1px solid #009966;"
                     placeholder="Enter barcode here">
            </div>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  Qty
                  <input id="txtquantity" value="1" min=1 type="number" class="form-control input-sm"
                         onkeypress='return isNumberKey(event)' >
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  Discount
                  <div class="input-group input-group-sm">
                    <input onkeyup="reset_dis($(this).val())" onkeypress='return isNumberKey(event)' type="number"
                           class="form-control" min=0 max=100 aria-describedby="basic-addon2" value="0"
                           id="txtparticulardiscount">
                    <span class="input-group-addon" id="basic-addon2" style="background:#CCC;color:#000">%</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              Item Name
              <input id="txtitemname" type="text" class="form-control input-sm" readonly>
            </div>

          </div>
        </section>

        <div class="form-group">
          <button class="btn btn-success btn-sm" onclick="add_to_list_barcode($('#txtbarcode').val())" id="add-to-list">
            <b><i class="fa fa-plus"></i> Add to list</b>
            <small>(Enter)</small>
          </button>
        </div>
      </div>
    </div>
    <div id="search_product_panel" class="">
      <div class="box-header"><i class="fa fa-search"></i> Search</div>
      <div class="box-body">
        <div class="form-group">
          <input id="search-product" onkeyup="search_product($(this).val());" type="text" class="form-control input-sm"
                 placeholder="Search here">
        </div>
        <div class="form-group" style="height:100px;overflow:auto">
          <table id="table_search" class="table table-striped" style="font-size:12px">
            <tbody>
            <tr>
              <td>No data available</td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>

  <div class="col-lg-8">

    <div id="shortcut_key_panel" class="box box-solid" style="box">
      <div class="box-body">
        <button class="btn btn-default btn-sm no-border" disabled>
          <span class="text-danger">Insert</span> - Pay
        </button>
        <!-- <button class="btn btn-default btn-sm" disabled>
          <span class="text-danger">F10</span> - Print Receipt
        </button> -->
        <button class="btn btn-default btn-sm no-border" disabled>
          <span class="text-danger">Enter</span> - Add to List
        </button>
        <button class="btn btn-default btn-sm no-border" disabled>
          <span class="text-danger">Del</span> - Clear List
        </button>
      </div>
    </div>

    <div class="box box-success" id="purchase_list_panel">
      <div class="box-header with-border">
        <i class="fa fa-shopping-cart"></i> Purchase List
        <button onclick="for_clearlist_confirm();" class="btn btn-default btn-sm pull-right">Clear list
          <small>(Delete)</small>
        </button>
        <button onclick="for_claim_confirm();" class="btn btn-success btn-sm pull-right" style="margin-right:10px">Pay
          <small>(Insert)</small>
        </button>
      </div>
      <div class="box-body no-padding" style="overflow:auto;height:303px">
        <table id="table_purchase_list" class="table table-striped">
          <thead>
          <tr>
            <td>Qty</td>
            <td>Description</td>
            <td>Price</td>
            <td>Discount</td>
            <td>Total</td>
            <td style="text-align:right">Action</td>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td colspan="5">List is empty</td>
          </tr>
          </tbody>
        </table>
      </div>
      <div class="box-footer">
        <!-- <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="color:#ff9933;"><h5>Sub Total</h5></div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="text-align:right;color:#ff9933;"><h5 class="subtotal">&#8369; 0.00</h5></div>
        </div> -->
        <input type="hidden" class="form-control" aria-describedby="basic-addon2" value="0" id="txtdiscount">
        <!-- <div class="row">
          <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="color:#ff9933;"><h5>Discount</h5></div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <div class="input-group input-group-sm">
              <input type="text" class="form-control" aria-describedby="basic-addon2" value="0" id="txtdiscount">
              <span class="input-group-addon" id="basic-addon2" style="background:#CCC;color:#000">%</span>
            </div>
          </div>
        </div> -->
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="color:#ff9933;"><h2><strong>TOTAL</strong></h2></div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="text-align:right;color:#ff9933;"><h2 class="total">
              <strong>&#8369; 0.00</strong></h2></div>
          <input type="hidden" id="txtMainTotal">
        </div>
      </div>
    </div>

  </div>

</div>
<?php include('include/selectCustomerModal.php'); ?>
<?php include('include/confirmationAlert.php'); ?>
<?php include('include/confirmFinishTransactionAlert.php'); ?>
<?php include 'include/footer.php'; ?>

<script type="text/javascript">

var b_id = "";
var sub_total = 0;

$(document).keyup(function (e) {

;


  if (e.keyCode == 13) {
    var barcode = $("#txtbarcode").val();
    search_barcode(barcode);
    add_to_list_barcode(barcode);
  }

  if (e.keyCode == 46) {
    // clear_list();
    // $("#confirmClearList").modal('show');
    // $('#confirmClearList button.confirmOK').focus();

    for_clearlist_confirm();
  }

  if (e.keyCode == 45) {
    // $("#confirmFinishTransaction").modal('show');
    for_claim_confirm();
  }

  if (e.keyCode == 121) {
    alert("Print");
  }
});


$(function () {
  load_customer();
});

$("#Form_Add_customer").submit(function (e) {

  e.preventDefault();
  save_customer_info(this);

});

function clearForm() {
  // $("#txtquantity").focus();
  $("#txtbarcode").val("");
  $("#txtitemname").val("");
  $("#txtprice").val("");
  $("#txtquantity").val(1);
  $("#txtparticulardiscount").val(0);
}

$("#txtbarcode").focus(function () {
  $(this).val("");
});

/*search product*/
function search_barcode(barcode) {

  $.ajax({
    url: "function/stockout_functions/search_barcode.php",
    data: {barcode: barcode},
    type: "GET",
    dataType: "json",
    success: function (data) {
      b_id = data['b_id'];
      $('#txtitemname').val(data['Item']);
      $('#txtprice').val(data['Price']);
      $('#txtbarcode').val(data['Barcode']);
    },
    error: function () {

    }
  });
}


function add_to_list_barcode(barcode) {
      get_qty();
  var item_name = $('#txtitemname').val();
  var qty = $('#txtquantity').val();
  var dis = $('#txtparticulardiscount').val();

  if (dis.length == 0) {
    dis = 0;
  }
  if (qty.length == 0 || qty == 0) {
    qty = 1;
  }
  if (item_name.length > 0) {
    $.ajax({
      url: 'function/stockout_functions/check-qty.php',
      data: {id: b_id, qty: qty},
      type: 'GET',
      dataType: 'html',
      success: function (response) {

      }
    });

    add_to_list(b_id, qty, dis);
  }
}

function save_customer_info(form) {
  $.ajax({
    url: "function/stockout_functions/save_customer_info.php",
    type: "POST",
    data: new FormData(form),
    dataType: "html",
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {

      load_customer();
    },
    error: function (data) {
      alert("FUNCTION SAVE CUSTOMER ERROR!!!");
    }
  });
}

function get_result(id, name, price, qty) {

  b_id = id;
  $('#txtitemname').val(name);
  $('#txtprice').val(price);
  $('#txtbarcode').val(qty);
  $('#search-product').val('');
}

function load_customer() {
  $.ajax({
    url: "function/stockout_functions/load_customer_table.php",
    type: "GET",
    dataType: "html",
    success: function (data) {
      $("#table-search-customer tbody").html(data);
    },
    error: function () {
      alert("FUNCTION LOAD CUSTOMER ERROR!!!");
    }
  });
}

function select_customer(cus_id) {
  $.ajax({
    url: "function/stockout_functions/select_customer.php",
    data: "customer=" + cus_id,
    type: "GET",
    dataType: "html",
    success: function (data) {
      $('#customer_panel .customer').html(data);
      $('#searchCustomerModal').modal('hide');
      clearForm();
    },
    error: function () {
      alert("FUNCTION SELECT CUSTOMER ERROR!!!");
    }
  });
}

function remove_customer() {
  $.ajax({
    url: "function/stockout_functions/remove_customer.php",
    type: "GET",
    dataType: "html",
    success: function (data) {
      $('#customer_panel .customer').html(data);
      clearForm();
    },
    error: function () {
      alert("FUNCTION REMOVE CUSTOMER ERROR!!!");
    }
  });
}

function search_product(val) {

  if (val.length == 0 || val.trim() == "") {
    $("#search_product_panel #table_search tbody").html("<tr><td>No data available</td></tr>");
  }
  else {
    $.ajax({
      url: "function/stockout_functions/search_product.php",
      data: {search: val},
      type: "GET",
      dataType: "html",
      success: function (data) {
        $("#search_product_panel #table_search tbody").html(data);
      },
      error: function () {
        alert("FUNCTION SEARCH PRODUCT ERROR!!!");
      }
    });
  }

}

function add_to_list(b_id, qty, dis) {
  var name = $('#txtitemname').val();
  $.ajax({
    url: "function/stockout_functions/add_to_list_product.php",
    data: "add=" + b_id + "&qty=" + qty + "&dis=" + dis + "&name=" + name,
    type: "GET",
    dataType: "html",
    success: function (data) {
      $("#table_purchase_list tbody").html(data);
      get_subtotal();
      get_main_total();
      clearForm();
    },
    error: function () {
      alert("FUNCTION SEARCH PRODUCT ERROR!!!");
    }
  });
}

function get_subtotal() {
  var tot = "";
  $.ajax({
    url: "function/stockout_functions/get_subtotal.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      var subTotal = parseFloat(Math.round(data['total'] * 100) / 100).toFixed(2);
      $("h5.subtotal").html("&#8369 " + subTotal);
    },
    error: function () {

    }
  });
}

function change_qty(type, temp_id) {
  $.ajax({
    url: "function/stockout_functions/change_qty.php",
    data: "change=" + temp_id + "&type=" + type,
    type: "GET",
    dataType: "html",
    success: function (data) {
      $("#table_purchase_list tbody").html(data);
      get_subtotal();
      get_main_total();
      clearForm();
    },
    error: function () {

    }
  });
}

function change_discount(type, temp_id) {
  $.ajax({
    url: "function/stockout_functions/change_discount.php",
    data: "change=" + temp_id + "&type=" + type,
    type: "GET",
    dataType: "html",
    success: function (data) {
      $("#table_purchase_list tbody").html(data);
      get_subtotal();
      get_main_total();
      clearForm();
    },
    error: function () {

    }
  });
}

function remove_from_list(temp_id) {
  $.ajax({
    url: "function/stockout_functions/remove_from_list.php",
    data: "remove=" + temp_id,
    type: "GET",
    dataType: "html",
    success: function (data) {
      $("#table_purchase_list tbody").html(data);
      get_subtotal();
      get_main_total();
      clearForm();
    },
    error: function () {

    }
  });
  // alert(temp_id);
}

function clear_list() {
  $.ajax({
    url: "function/stockout_functions/remove_from_list.php",
    data: "clear=all",
    type: "GET",
    dataType: "html",
    success: function (data) {
      $("#table_purchase_list tbody").html(data);
      get_subtotal();
      get_main_total();
    },
    error: function () {

    }
  });

  clearForm();
}


function get_main_total() {
  var percent = $('#txtdiscount').val() / 100;
  // var discount = sub_total*percent;
  // var total = sub_total-discount;
  // $("h2.total").html("&#8369 "+total);
  $.ajax({
    url: "function/stockout_functions/get_subtotal.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      var discount = data['total'] * percent;
      var total = data['total'] - discount;
      var finalTotal = parseFloat(Math.round(total * 100) / 100).toFixed(2);
      $("h2.total").html("<strong>&#8369 " + finalTotal + "</strong>");
      $("#txtMainTotal").val(finalTotal);
    },
    error: function () {

    }
  });

}

$("#txtdiscount").on('keyup', function () {
  var percent = $(this).val() / 100;
  $.ajax({
    url: "function/stockout_functions/get_subtotal.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      var discount = data['total'] * percent;
      var total = data['total'] - discount;
      var finalTotal = parseFloat(Math.round(total * 100) / 100).toFixed(2);
      $("h2.total").html("&#8369 " + finalTotal);
      $("#txtMainTotal").val(finalTotal);
    },
    error: function () {

    }
  });
});

function finish_transaction() {
  location.href = "function/stockout_functions/transaction_finish.php";
}

function for_claim() {
  location.href = "function/stockout_functions/transaction_finish_claim.php";
}

function for_claim_confirm() {

  var total = $("#txtMainTotal").val();
  $("#txtamounttopay").val(total);
  $("#txtamounttendered").val("");
  $("#txtchange").val("0.00");

  $.ajax({
    url: "function/stockout_functions/count_temp.php",
    type: "GET",
    dataType: "html",
    success: function (data) {
      if (data == 0) {

      }
      if (data > 0) {
        $("#confirmFinishTransaction").modal('show');
      }
    }
  });
}

function for_clearlist_confirm() {
  $.ajax({
    url: "function/stockout_functions/count_temp.php",
    type: "GET",
    dataType: "html",
    success: function (data) {
      if (data == 0) {

      }
      if (data > 0) {
        $("#confirmClearList").modal('show');
      }
    }
  });
}

function isNumberKey(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;
  return true;
}

// function reset_qty(val){
//   if(val == 0){
//     $('#txtquantity').val(1);
//   }
// }

function reset_dis(val) {

  if (val > 100) {
    $('#txtparticulardiscount').val(100);
  }
}


/*check qty if the inputted value is greater than the stock*/
function get_qty() {
  var qty = $('#txtquantity').val();

  if($('#txtbarcode').val() != '') {

    $.ajax({
        url: "function/stockout_functions/check-qty.php",
        data: {qty: qty, b_id: b_id},
        type: "GET",
        dataType: "html",
        success: function (response) {
          if (response != 0) {

            //inform the user
            sweetAlert(response, '', 'error');

            //set the quantity input type to 1
            $('#txtquantity').val(1);
          }
        },
        error: function (xhr, status) {
          alert(status)
        }
      }
    );
  }
}
</script>