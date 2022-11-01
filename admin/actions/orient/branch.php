<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("../../../assets/header44.php");
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>

</script>
<style type="text/css">
  .signupdiv{
      background: #fff;
      border: 1px solid #ddd;
      box-shadow: 1px 2px 3px #ccc;
      border-radius: 7px;
      text-align: center;
      width: 35%;
      display: block;
      margin: auto;
      margin-top: 100px;
  }
  #signupform{
      padding: 15px;
  }
  input, select{
      margin-bottom: 10px;
      height: 38px;
      border: 1px solid #ddd;
      padding-left: 10px;
  }
  input{
      width: 97%;
  }
  button, select{
      width: 100%;
  }
  button{
      height: 45px;
      background: #188c01;
      border: none;
      border-radius: 5px;
      color: #fff;
  }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Orient Products
        <small><b><u>Sub Stock</u></b></small>
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
    <div class="modal fade" id="newRequestModal" tabindex="-1" role="dialog" aria-labelledby="newRequestModalLabel" aria-hidden="false" sty>
      <div class="modal-dialog" style="min-width: 40%" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" style="font-weight: bold;font-size: 20px;" id="exampleModalLabel">Orient To SubStock</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span style="float:right;margin-top: -50px;" aria-hidden="false">×</span>
            </button>
          </div>
    <div class="modal-body">
            <!-- <section class="content"> -->
      <div class="row">
        <div class="col-md-12">
          <div class="box" style="margin-left: 0%">
            <div class="box-body">
              <div id="respp" style="font-weight: bold;display: none;text-align: center;font-size: 20px"></div>
              <!-- Date dd/mm/yyyy -->
              <div class="form-group">
                <label>Select Warehouse:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-trophy"></i>
                  </div>
                  <select style="width: 100%!important;" class="form-control" id="warehouseId" style="font-weight: lighter;">
                    <option value="0">Select Warehouse</option>
                  </select>
                </div>

              </div>

              <div class="form-group">
                <label>Select Sub-Stock:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-trophy"></i>
                  </div>
                  <select style="width: 100%!important;" class="form-control" id="branch_id" style="font-weight: lighter;"></select>
                </div>

              </div>

              <div class="form-group">
                <label>Select Product:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-trophy"></i>
                  </div>
                  <select style="width: 100%!important;" class="form-control" id="product_id" style="font-weight: lighter;"></select>
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <label>Product Unit type:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <select class="form-control" id="IsProductBox">
                    <option value=0 selected>Piece</option>
                    <option value=1>Box</option>
                  </select>
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group" style="display:none;">
                <label>Expected minimum Price
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-shopping-cart"></i>
                  </div>
                  <input type="number" class="form-control" value="100" placeholder="Expected price" id="product_price">
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <label>Quantity
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-shopping-cart"></i>
                  </div>
                  <input type="number" class="form-control" placeholder="Quantity added" id="added">
                </div>
                <!-- /.input group -->
              </div>


              <!-- /.form group -->

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (right) -->
      </div>
            </div>
            <div class="modal-footer">
              <div class="form-group">
        
                <div class="input-group">
                  <button class="btn btn-success" style="font-weight: bold;" id="OrientProductsToBranchStock">OK, Orient</button>
                </div>
                <!-- /.input group -->
              </div>
            </div>
          <!-- </form> -->
        </div>
      </div>
    </div>
      <div class="row">
        <div class="col-md-12">
          <div class="box" style="margin-left: 0.5%">
            <div class="box-body">
              <a class="btn btn-success" style="font-weight: bolder;">Export Excel</a>
                <a style="float:right;" class="btn btn-primary" id="Next" data-toggle="modal" id="newGoalBtn" data-target="#newRequestModal">Orient To SubStock</a>
              <center><div style="text-align: center;margin: 0 auto">
                <table class="table table-reaponsive">
                  <thead>
                    <th>
                      #
                    </th>
                    <th>
                      Stock
                    </th>
                    <th>
                      Item Name
                    </th>
                    <th>
                      Category
                    </th>
                    <th>
                      Set-Type
                    </th>
                    <th>
                      Qnt Available
                    </th>
                    <th>
                      Box_Pieces
                    </th>
                    <th>
                      Date Ragistered
                    </th>
                    <tbody id="report_div">
                      
                    </tbody>
                    <tfoot id="rep_footer">


                    </tfoot>
                  </thead>
                </table>
              </div></center>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (right) -->
      </div>

      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php require("../../../assets/footer.php");?>


  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../../../bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="../../../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../../../plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="../../../bower_components/moment/min/moment.min.js"></script>
<script src="../../../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="../../../bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="../../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../../../plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="../../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../../dist/js/demo.js"></script>
<!-- Page script -->
<script src="../../../assets/js/main.js"></script>

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

      var available_branches = true;
      $.ajax({url:"../../../main/view.php",
        type:"POST",data:{available_branches:available_branches},cache:false,success:function(res){  
          var res = JSON.parse(res);
         // console.log(res.found);
          if (res.found===1) {
            for (const key in res.res) {
              // console.log(res.res[key]);
              $("#branch_id").append("<option value='"+res.res[key].branch_id+"'>"+res.res[key].branch_name+"</option>");
            }
          }else{
            $("#branch_id").html("<option value=''>No branch available</option>");
          }
          }
      });

      var available_warehouses = true;
      $.ajax({url:"../../../main/view.php",
        type:"POST",data:{available_warehouses:available_warehouses},cache:false,success:function(res){  
          var res = JSON.parse(res);
         // console.log(res.found);
          if (res.found===1) {
            for (const key in res.res) {
              // console.log(res.res[key]);
              $("#warehouseId").append("<option value='"+res.res[key].warehouse_id+"'>"+res.res[key].warehouse_name+"</option>");
            }
          }else{
            $("#warehouseId").html("<option value=''>No warehouse available</option>");
          }
          }
      });



$("#warehouseId").change(function(){
  var product_id = $("#product_id").val();
  var warehouseId = $("#warehouseId").val();
  $("#product_id").html("");
  $("#product_id").html("<option value='0'>Select Product</option>");

  var available_products_in_warehouse_stock = true;
      $.ajax({url:"../../../main/view.php",
        type:"POST",data:{available_products_in_warehouse_stock:available_products_in_warehouse_stock,warehouseId:warehouseId},cache:false,success:function(res){  
          var res = JSON.parse(res);
          // console.log("Status is: "+res.found);
          if (res.found==1) {
              $("#product_id").attr("disabled",false);
              $("#product_id").append("<option value='0'>Select Product</option>");
            for (const key in res.res) {
              // console.log(res.res[key]);
              // $("#product_id").attr("disabled",false);
              $("#product_id").append("<option value='"+res.res[key].product_id+"'>"+res.res[key].product_name+"</option>");
              
            }
          }else{
            $("#product_id").html("<option value=''>No product available</option>");
            $("#product_id").attr("disabled",true);
          }
          }
      });
});



$("#product_id").change(function(){
  var product_id = $("#product_id").val();
  var IsProductBox = true;
      $.ajax({url:"../../../main/view.php",
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


      var branchStockProducts = true;
      $.ajax({url:"../../../main/view.php",
        type:"POST",data:{branchStockProducts:branchStockProducts},cache:false,success:function(res){  
          var res = JSON.parse(res);
          console.log(res.found);
          if (res.found===1) {
            var cnt = 1;
            var ttlQnt = 0;
            for (const key in res.res) {
              // console.log(res.res[key]);
              $("#report_div").append("<tr> <td>"+cnt+".</td> <td>"+res.res[key].StockName+"</td> <td>"+res.res[key].ProductName+"</td> <td>"+res.res[key].ProductCategory+"</td><td>"+res.res[key].IsProductBox+"</td><td>"+res.res[key].Qnt+"</td> <td>"+res.res[key].ProductBoxPieces+"</td><td>"+res.res[key].ProductDate+"</td> </tr>");
              ttlQnt+=parseInt(res.res[key].Qnt);
              $("#rep_footer").html("<th colspan='5'><hr>Total</th> <th><hr>"+ttlQnt+"</th> <hr><th colspan='2'></th>");
              cnt++;
            }
          }else{
            $("#report_div").html("<tr> <td colspan=6> No Stock available</td></tr>");
          }
          }
      });




});
 $(function(){
  // $("#branch").css("width",30%);

 $("#branch_id").select2();
 $("#product_id").select2();
 $("#warehouseId").select2();

 }); 
</script>
</body>
</html>
