<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("../../assets/header3.php");
if (!isset($_SESSION['sms_user_id'])) {
echo "<script>window.location='../home'</script>";
}

?>
<style>
  input{
    background-color: #fff;
  }
  .form-control,th,td{
    font-weight: bolder;text-align: center;font-size: 17px;
  }
  td{
    font-weight: bold;
  }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>
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

    <div class="row col-3" style="border: 2px solid #030;min-height:600px;width:80%;margin-left:10%;background-color:#fff">
      <div style="border: 2px solid #030;width:40%;">
        <table style="width: 100%;">
          <tr>
            <td style="font-weight: bold;">SDC NO:</td>
            <td><input type="text" class="form-control" placeholder="Invoice Number" id="invNumbr"></td>
          </tr>
          <tr>
            <td style="font-weight: bold;">CLIENT NAME:</td>
            <td><input type="text" class="form-control" placeholder="Client Name" id="clientName"></td>
          </tr>
          <tr>
            <td style="font-weight: bold;">COMPANY NAME:</td>
            <td><input type="text" class="form-control" placeholder="Company Name" id="companyName"></td>
          </tr>
          <tr>
            <td style="font-weight: bold;">MEMBER NAME:</td>
            <td> <select name="mmbrName" id="mmbrName" class="form-control"></select></td>
          </tr>
          <tr>
            <td style="font-weight: bold;">PHONE:</td>
            <td><input type="text" class="form-control" placeholder="Client phone" id="clientPhone"></td>
          </tr>
        </table>


      </div>
      <br><br><br>
      <div>
      
      <table border="1" style="width:100%;margin-left:0%">
          <thead>
            <th>#</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Total Price</th>
          </thead>
          <tbody id="resp_newItm">
            <td style="font-weight: bolder;text-align:center;font-size:large">*</td>
            <td><select class="form-control" id="product_id" style="font-weight: lighter;">
                  <option selected>Select Product</option>
              </select>
            </td>
            <td>
              <input type="number" class="form-control" placeholder="Quantity sold" id="quantitySold" oninput="return ttlAdd();">
            </td>
            <td>
            <input type="number" class="form-control" placeholder="Sold price" id="soldPrice" oninput="return ttlAdd();">
            </td>
            <td><input type="number" readonly id="ttl" class="form-control" style="font-weight: bolder;text-align:center;font-size:large;background-color:#fff"> </input></td>
          </tbody>
        </table>
        
      </div>

        <br>
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
  <input type="hidden" id="hdn_memberspin">
  <input type="hidden" id="hhdndn_ttl">
          <!-- <button class="btn btn-primary">Add Product</button> -->
          <button class="btn btn-primary" style="font-weight: bold;margin:10px" id="AddNewTrans">Add Product</button>
          

          <div style="float: right;">
            <h1 style="float: right;">Total:<span id="resttl">0</span>.<span style="font-size: 25px;">00</span>&nbsp;&nbsp;</h1>
            <br>

              <button style="float: right;" class="btn btn-default">
              <select class="form-control" id="paymentMethod">
                <option value=''>Select Payment</option>
                <option value=1>Paid</option>
                <option value=0>Debt</option>
              </select>
            </button>
                  <input type="hidden" id="IsProductBox" value=0>
            <br>
            <button style="float: right;display:none" id="BtnpaymentWayPaid" class="btn btn-default">
            <select class="form-control" id="paymentWayPaid">
                    <option value=''>Payment way</option>
                    <option>By Cash</option>
                    <option>By Momo</option>
            </select>
            </button>
            <br>
            <button style="float: right;display:none" id="BtnpaymentWayDebt" class="btn btn-default">
            <select class="form-control" id="paymentWayDebt">
                    <option value=''>Select debt way</option>
                    <option> Cheque</option>
                    <option> OP</option>
                    <option> Purchase order</option>
                    <option> Bank Slip</option>
                    <option> Bank Transfer</option>
            </select>
            </button>
            <br><br>
            <button class="btn btn-success" id="ApproveBtn" style="font-weight: bold;float:right;margin:10px" data-toggle="modal" data-target="#newRequestModal"><b>Approve</b></button>
            <button class='btn btn-success' id="SaveBtn" data-toggle="modal" data-target="#AllnewRequestModal" style="display: none;">Save</button>
            
        </div>
        <br><br> <button style="float: left;" onclick="return location.reload();" class="btn btn-warning"> <b>Reset</b> </button>
    </div>

      <!-- /.row -->
      <div class="modal fade" id="newRequestModal" tabindex="-1" role="dialog" aria-labelledby="newRequestModalLabel" aria-hidden="false" sty>
      <div class="modal-dialog" style="min-width: 50%" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <center><h5 class="modal-title" style="font-weight: bold;font-size: 20px;" id="exampleModalLabel">Confirm with Member's PIN</h5></center>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="false">×</span>
            </button>
            <div id="resppp"></div>
          </div>
            <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">
              <div id="respp" style="font-weight: bold;display: none;text-align: center;font-size: 20px"></div>
              <!-- Date dd/mm/yyyy -->
              <div class="form-group" id="product_idDiv">
                <label>Enter Member's PIN:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="password" class="form-control" id="memberspin1" placeholder="Enter PIN"> 
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group" id="product_idDiv">
                <label>Re-Enter PIN:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="password" class="form-control" id="re_memberspin1" placeholder="Re-Enter PIN"> 
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <div class="input-group">
                  <button class="btn btn-success" style="font-weight: bold;" id="StockOut">Continue</button>
                  <br>
                </div>
              </div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>


          <!-- /.box -->
      </div>
            </div>
            <div class="modal-footer">
                      <div class="form-group">
                        <div class="input-group">
                        </div>
                        <a href=""  style="float:right;" class="btn btn-default">Close</a>
                      </div>
            </div>
          <!-- </form> -->
        </div>
      </div>
    </div>




      <div class="modal fade" id="AllnewRequestModal" tabindex="-1" role="dialog" aria-labelledby="newRequestModalLabel" aria-hidden="false" sty>
      <div class="modal-dialog" style="min-width: 50%" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <center><h5 class="modal-title" style="font-weight: bold;font-size: 20px;" id="exampleModalLabel">Confirm with Member's PIN<br>
              <span id="respp_alltr" >rresp</span>
            </h5></center>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="false">×</span>
            </button>
          </div>
            <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">
              <div id="respp" style="font-weight: bold;display: none;text-align: center;font-size: 20px"></div>
              <!-- Date dd/mm/yyyy -->
              <div class="form-group" id="product_idDiv">
                <label>Enter Member's PIN:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="password" class="form-control" id="memberspin2" placeholder="Enter PIN"> 
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group" id="product_idDiv">
                <label>Re-Enter PIN:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="password" class="form-control" id="re_memberspin2" placeholder="Re-Enter PIN"> 
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <div class="input-group">
                  <button class="btn btn-success" style="font-weight: bold;" id="StockOutAllTrans">Continue</button>
                  <br>
                </div>
              </div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>


          <!-- /.box -->
      </div>
            </div>
            <div class="modal-footer">
                      <div class="form-group">
                        <div class="input-group">
                        </div>
                        <a href=""  style="float:right;" class="btn btn-default">Close</a>
                      </div>
            </div>
          <!-- </form> -->
        </div>
      </div>
    </div>


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
function ttlAdd(){
  var  quantitySold = $("#quantitySold").val();

  if(quantitySold=='' || quantitySold==null){
    quantitySold=0;
  }
  quantitySold = parseInt(quantitySold);
  var soldPrice = $("#soldPrice").val();
  if(soldPrice=='' || soldPrice==null){
    soldPrice=0;
  }
  soldPrice = parseInt(soldPrice);
  var bfr = $("#hhdndn_ttl").val();
  if(bfr=='' || bfr==null){
    bfr=0;
  }

  var ttl = soldPrice*quantitySold;
  ttl = parseInt(ttl);  
  document.getElementById("ttl").value=ttl;
  $("#hhdndn_ttl").html(ttl);

  $("#resttl").html(Intl.NumberFormat().format(ttl+0));

}
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
      $("#mmbrName").html("<option value=''>No Employee found</option>");
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

$("#paymentMethod").change(function(){
  var paymentMethod = $("#paymentMethod").val();
  if (paymentMethod==1) {
    $("#BtnpaymentWayPaid").css("display","block");
    $("#BtnpaymentWayDebt").css("display","none");
  }else{
    $("#BtnpaymentWayDebt").css("display","block");
    $("#BtnpaymentWayPaid").css("display","none");
  }
});

$("#quantitySold").change(function(){


});



});
$(function(){
  $("#product_id").select2();
  $("#mmbrName").select2();
 }); 
</script>
</body>
</html>
