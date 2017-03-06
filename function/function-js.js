$(document).ready(function () {


  //
  //$('.barcode').change(function () {
  //  getBarcode();
  //});
  //$('.barcode').keyup(function () {
  //  getBarcode();
  //});


  var interval = setInterval(function () {
    getItem();
  }, 1000);


  function getItem() {
    $.ajax({
      url: 'function/display-item.php',
      type: 'POST',
      dataType: 'JSON',
      //data: {barcode: $('input#barcode').val()},
      success: function (data) {
        for (var d in data) {
          $('#display-item').append("<tr><td>" + data['name'] + "</td></tr>");
        }
      }
      //},
      //complete:function(){
      //  $('#barcode').select();
      //}
    });
  }


  function getBarcode() {
    $.ajax({
      url: 'function/search.php',
      type: 'POST',
      dataType: 'JSON',
      data: {barcode: $('input.barcode').val()},
      success: function (data) {


        $('#item-name').val(data['name']);
        $('#txt-model').val(data['model_no']);
        $('#supplier').val(data['supplier']);
        $('#price').val(data['price']);
        if (typeof  data[4] == 'undefined') {
          data[4] = 0;
        }
        $('#label-quantity').html("Available Quantity: " + data[4]).addClass('text-danger').attr('qty', data[4]);
      }
    });
  }


  //insert new product
  $('#frm-reg-med').submit(function (event) {
    event.preventDefault();

    var formData = $(this).serialize();
    $.post('function/insert-med.php', formData, function (message) {
      clearData();
      //alertDanger(message);
      alertSuccess('#frm-reg-med', '', message);
    });

  });

  // $('#frm-reg-item').submit(function (event) {
  //   event.preventDefault();

  //   var formData = $(this).serialize();
  //   $.post('function/insert-item.php', formData, function (message) {
  //     clearData();
  //     //alertDanger(message);
  //     alertSuccess('#frm-reg-item', '', message);
  //   });

  // });


  //login user
  $('#frm_login').submit(function (event) {
    event.preventDefault();

    var formData = $(this).serialize();
    $.post('function/function-login.php', formData, function (message) {
      if (message == true) {
        location.href = "index.php";
      }
      else {
        alertDanger('#frm_login', '', message);
      }
    });

  });

  //register new user


  //--------------------------------------------------------------------------------------------------------------------
  //upload image registration


  function clearData() {
    $('.form-control').val('');
  }


});

function alertSuccess(id, title, message) {
  $('.alert').remove();
  var m = " <div class='alert alert-success' alert-dismissible role='alert' style='position: absolute; top: 120px; right: 5px;'>";
  m += "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
  m += "<span class='glyphicon glyphicon-ok'></span>";
  m += " <strong> " + title + " </strong>  " + message;
  m += "</div>";
  $(id).prepend(m);
  $('.alert').fadeOut(3000);
}

function alertDanger(id, title, message) {
  $('.alert').remove();
  var m = " <div class='alert alert-danger' alert-dismissible role='alert' style='position: absolute; top: 120px; right: 13%;'>";
  m += "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
  m += "<span class='glyphicon glyphicon-alert'> </span>";
  m += "<strong> " + title + " </strong> " + message;
  m += "</div>";
  $(id).prepend(m);
  $('.alert').fadeOut(3000);

}
