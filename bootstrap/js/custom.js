$(document).ready(function () {


  //data table
  // $('tr:odd').addClass('success');
  $(".paginate").dataTable();

  $('.no-search').dataTable({
    "bPaginate": true,
    "bLengthChange": false,
    "bFilter": false,
    "bSort": false,
    "bInfo": false,
    "bAutoWidth": false
  });

  //date-picker
  // $('#item-date-picker').datepicker().setData("setDate",new Date());c
  $('.date-picker').datepicker({dateFormat: "yyyy-mm-dd"}); 
  $('#expire-date').datepicker({dateFormat: "yyyy-mm-dd"});
  $('#med-date-in').datepicker({dateFormat: "yyyy-mm-dd"});
  //$( "#item-date-picker" ).datepicker({
  //  showButtonPanel: false
  //});

  var interval = setInterval(function () {
    $('#time').html(moment().format('h:mm:ss a'));
    $('#month').html(moment().format('D MMMM'));
    $('#year').html(moment().format('YYYY'));

  }, 1000);


  $('#takePictureField').change(function (event) {
    if (event.target.files.length === 1 && event.target.files[0].type.indexOf("image/") === 0) {
      $("#yourimage").attr("src", URL.createObjectURL(event.target.files[0]));
    }
  });


});