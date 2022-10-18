<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("../../assets/header3.php");
if (!isset($_SESSION['sms_user_id'])) {
echo "<script>window.location='../home'</script>";
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Orient Products
        <small><b><u>Sub-Stock</u></b></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> ChampionTech</a></li>
        <li><a href="#">Warehouse</a></li>
        <li><a href="#">Office Stock</a></li>
        <li class="active">SubStock</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <div class="box">
            <div class="box-body">
              <div id="respp" style="font-weight: bold;display: none;text-align: center;font-size: 20px"></div>
              <!-- Date dd/mm/yyyy -->
              <div class="form-group" id="product_idDiv">
                <label>Select Product:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <select class="form-control" id="product_id" style="font-weight: lighter;"><option selected="">Select Product</option></select>
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group" id="IsProductBoxDiv">
                <label>Product Unit type:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-phone"></i> -->
                  </div>
                  <select class="form-control" id="IsProductBox" disabled>
                    <option value=0 selected>Piece</option>
                    <option value=1>Box</option>
                  </select>
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group" id="soldPriceDiv">
                <label>Sold Price:
                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-shopping-cart"></i> -->
                  </div>
                  <input type="number" class="form-control" placeholder="Sold price" id="soldPrice">
                </div>
                <!-- /.input group -->
              </div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        <div class="col-md-3">
          <div class="box">
            <div class="box-body">
              <div class="form-group" id="quantitySoldDiv">
                <label>Quantity sold:
                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-shopping-cart"></i> -->
                  </div>
                  <input type="number" class="form-control" placeholder="Quantity sold" id="quantitySold">
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group" id="soldPriceDiv">
                <label>Invoice number:
                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-shopping-cart"></i> -->
                  </div>
                  <input type="text" class="form-control" placeholder="Invoice Number" id="invNumbr">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="form-group" id="paymentMethodDiv">
                <label>Sales method:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-phone"></i> -->
                  </div>
                  <select class="form-control" id="paymentMethod">
                    <option value=''>Select Sales method</option>
                    <option value=1>Paid</option>
                    <option value=0>Debt</option>
                  </select>
                </div>
                <!-- /.input group -->
              </div>


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col (right) -->



        <div class="col-md-3">
          <div class="box">
            <div class="box-body">
              <!-- Date dd/mm/yyyy -->
              <div class="form-group" id="clientNameDiv" style="margin-left: 10px">
                <label>Client Name:
                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-shopping-cart"></i> -->
                  </div>
                  <input type="text" class="form-control" placeholder="Client Name" id="clientName">
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group" id="clientNameDiv" style="margin-left: 10px">
                <label>Company Name:
                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-shopping-cart"></i> -->
                  </div>
                  <input type="text" class="form-control" placeholder="Company Name" id="companyName">
                </div>
                <!-- /.input group -->
              </div>
                <!-- /.input group -->
              </div>
              <div class="form-group" id="clientPhoneDiv" style="margin-left: 10px">
                <label>Phone:
                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-shopping-cart"></i> -->
                  </div>
                  <input type="text" class="form-control" placeholder="Client phone" id="clientPhone">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
        
                <div class="input-group">
                </div>
                <!-- /.input group -->
              </div>

              <!-- /.form group -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
<div>
<div class="col-md-3">
          <div class="box">
            <div class="box-body">
              <!-- Date dd/mm/yyyy -->


              <div class="form-group" id="paymentWayPaidDiv" style="display: none;">
                <label>Payment ways:</label>

                <div class="input-group"
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-phone"></i> -->
                  </div>
                  <select class="form-control" id="paymentWayPaid">
                    <option value=''>Select payment way</option>
                    <option>By Cash</option>
                    <option>By Momo</option>
                  </select>
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group" id="paymentWayDebtDiv" style="display: none;margin-left: 10px">
                <label>Debt ways:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-phone"></i> -->
                  </div>
                  <select class="form-control" id="paymentWayDebt">
                    <option value=''>Select debt way</option>
                    <option> Cheque</option>
                    <option> OP</option>
                    <option> Purchase order</option>
                    <option> Bank Slip</option>
                  </select>
                </div>
                <!-- /.input group -->
              </div>



              <div class="form-group" id="paymentWayPaidDiv" style="display: none;">
                <label>Payment ways:</label>

                <div class="input-group"
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-phone"></i> -->
                  </div>
                  <select class="form-control" id="paymentWayPaid">
                    <option value=''>Select payment way</option>
                    <option>By Cash</option>
                    <option>By Momo</option>
                  </select>
                </div>
              <div class="form-group" id="quantitySoldDiv">
                <label>Member name:
                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-shopping-cart"></i> -->
                  </div>
                  <select name="mmbrName" id="mmbrName" class="form-control"></select>
                </div>
                <!-- /.input group -->
              </div> 
              <div class="form-group" id="quantitySoldDiv">
                <label>Member's PIN:
                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-shopping-cart"></i> -->
                  </div>
                  <input class="form-control" type="password" name="memberspin" id="memberspin">
                </div>
                <!-- /.input group -->
              </div> 

              <div class="form-group">
        
                <div class="input-group">
                </div>
                <!-- /.input group -->
              </div>

              <!-- /.form group -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
<div>

  <input type="hidden" id="hdn_product_id">
  <input type="hidden" id="hdn_IsProductBox">
  <input type="hidden" id="hdn_soldPrice">
  <input type="hidden" id="hdn_quantitySold">
  <input type="hidden" id="hdn_paymentMethod">
  <input type="hidden" id="hdn_invNumbr">
  <input type="hidden" id="hdn_paymentWayPaid">
  <input type="hidden" id="hdn_paymentWayDebt">
  <input type="hidden" id="hdn_paymentWay">
  <input type="hidden" id="hdn_clientName">
  <input type="hidden" id="hdn_companyName">
  <input type="hidden" id="hdn_clientPhone">
  <input type="hidden" id="hdn_mmbrName">
  <input type="hidden" id="hdn_memberspin">

  <button class="btn btn-primary" style="font-weight: bold;margin:10px" id="AddNewTrans">Add New</button>
  <button class="btn btn-success" style="font-weight: bold;float:right;margin:10px" id="StockOut">Ok, Save</button>
</div>
        </div>
        <!-- /.col (right) -->

<div class="content">
  <div class="row">
    <div class="col-12" style="background-color: #fff;">
      <span id="resp_newItm"></span>
      <span style="display: none;" id="respBtn">
        <button class='btn btn-warning' onclick='window.location.reload();'>Reset</button>
        &nbsp;&nbsp;&nbsp;&nbsp;<button class='btn btn-success' id='StockOutAllTrans'>Save</button>
      </span>
    </div>
  </div>
</div>
        



      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php require("../../assets/footer.php");?>


  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../../bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="../../bower_components/moment/min/moment.min.js"></script>
<script src="../../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="../../bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page script -->
<script src="../../assets/js/main.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').php(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })



  $(document).ready(function(){

      var available_products_in_branch_stock = true;
      $.ajax({url:"../../main/view.php",
        type:"POST",data:{available_products_in_branch_stock:available_products_in_branch_stock},cache:false,success:function(res){  
          var res = JSON.parse(res);
          console.log(res.found);
          if (res.found===1) {
            for (const key in res.res) {
              // console.log(res.res[key]);
              $("#product_id").append("<option value='"+res.res[key].product_id+"'>"+res.res[key].product_name+"</option>");
            }
          }else{
            $("#product_id").html("<option value=''>No product found</option>");
          }
          }
      });
      var AvailableMembersForStock = true;
$.ajax({url:"../../main/view.php",
  type:"POST",data:{AvailableMembersForStock:AvailableMembersForStock},cache:false,success:function(res){  
    var res = JSON.parse(res);
    console.log(res.found);
    if (res.found===1) {
      for (const key in res.res) {
        // console.log(res.res[key]);
        $("#mmbrName").append("<option value='"+res.res[key].EmployeesId+"'>"+res.res[key].EmployeeNames+"</option>");
      }
    }else{
      $("#mmbrName").html("<option value=''>No product found</option>");
    }
    }
});

$("#product_id").change(function(){
  var product_id = $("#product_id").val();
  var IsProductBox = true;
      $.ajax({url:"../../main/view.php",
        type:"POST",data:{IsProductBox:IsProductBox,product_id:product_id},cache:false,success:function(res){  
          // console.log(res);
          if (res==1) {
            $("#IsProductBox").html("<option value='0' selected>Piece</option><option value='1' disable>Box</option>");
            $("#IsProductBox").attr("disabled",false);
          }else{
            $("#IsProductBox").html("<option value='0'>Piece</option>");
            $("#IsProductBox").attr("disabled",true);
          }
          }
      });
});


});

</script>
</body>
</html>
