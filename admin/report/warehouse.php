<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("../../assets/header333.php");
?>
<link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />
<style type="text/css">
  .thead-dark th{
    text-align: left;
  }
  td{
    text-indent: 10%;
  }
table {
  border-spacing: 1em .5em;
  padding: 0 2em 1em 0;
}

td {
  width: 1.5em;
  height: 3.5em;
  text-align: center;
  vertical-align: middle;
}
</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Report
        <small>Warehouse</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> ChampionTech</a></li>
        <li><a href="#">Warehouse</a></li>
        <li><a href="#">Office Stock</a></li>
        <li class="active">SubStock</li>
      </ol>
    </section>
    <!-- UPDATE STOCK DETAILS MODAL -->
    <div class="modal fade" id="UpdateStockModal" tabindex="-1" role="dialog" aria-labelledby="UpdateStockModallLabel" aria-hidden="false" sty>
      <div class="modal-dialog" style="min-width: 60%" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" style="font-weight: bold;font-size: 20px;" id="UpdateStockModalLabel">Update stock details</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="false">×</span>
            </button>
          </div>
            <div class="modal-body">
              <div class="row form-group">
                <div class="col-md-12">
                  <p class="help-block text-danger" id="ress" style="color:red"></p>
                  <center>  <label style="font-weight: bold;" for="productName">Product Name:</label>
                  <input type="text" id="productName" class="form-control" disabled style="width:60%"></center>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                  <p class="help-block text-danger" id="ress" style="color:red"></p>
                  <label style="font-weight: bold;" for="initialStock">Initial Stock:</label>
                  <input type="text" id="initialStock" class="form-control">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                  <p class="help-block text-danger" id="ress" style="color:red"></p>
                  <label style="font-weight: bold;" for="totalIn">Total In:</label>
                  <input type="text" id="totalIn" class="form-control">
                </div>
                <div class="col-md-3">
                  <label style="font-weight: bold;" for="totalOut">Total Out:</label>
                  <p class="help-block text-danger"></p>
                  <input type="text" id="totalOut" class="form-control">
                </div>
                <div class="col-md-3">
                  <label style="font-weight: bold;" for="remaining">Remainig:</label>
                  <p class="help-block text-danger"></p>
                  <input type="text" id="remaining" class="form-control">
                </div>
              </div>
            </div>


                          <input type="hidden" class="form-control" id="hdnproductid">
                          <input type="hidden" class="form-control" id="hdnbranchid">

            <div class="modal-footer">
                      <div class="form-group">
                        <div class="input-group">
                          <button class="btn btn-success" id="UpdateProductStockhBtn">Update</button>
                        </div>
                      </div>
            </div>
        </div>
      </div>
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box" style="margin-left: 0.5%">
            <div class="box-body">
              <button class="btn btn-success" style="font-weight: bolder;" onclick="return ExportToExcel()">Export Excel</button>
              <button class="btn btn-default" style="float:right;background-color: #fdc ;">
                <select class="form-control" id="warehouses" style="background-color:transparent;">
                  <option value="">Select Warehouse</option>
                </select>
              </button>
              <center>

                <div id="report_div" style="text-align: center;margin: 0 auto">
                  <table class="table table-reaponsive" id="respTable"> 
                    <thead>
                      <th>#</th>
                      <th>ItemName</th>
                      <th>DateRegistered</th>
                      <th>InitialStock</th>
                      <th>Total-In</th>
                      <th>Total-Out</th>
                      <th>Remaining</th>
                      <!-- <th>Actions</th> -->
                    </thead>
                    <tbody id="resp">
                      <tr>
                        <td colspan="7" style="font-weight:bold;font-size: 25px;"><center>Select Warehouse</center></td>
                      </tr>
                    </tbody>
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
<?php require("../../assets/footer.php");?>

<button data-toggle='modal' id='updateStockbtn' data-target='#UpdateStockModal' style='display: none;'></button>

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
<script  type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script  type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
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
<script src="../../assets/js/main.js"></script>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<style type="text/css">
  td,th{
    text-align: left;
  }
</style>
<!-- Page script -->

<script>
  function PaymentMethod(method){
    switch(method){
      case 1:
        return "Paid";
      break;
      default:
        return "Debited";
      break;
    }
  }


 function updateProductStockModal(productid, productName, initialStock, totalIn, totalOut, remaining, branchid) {
      document.getElementById('productName').value=productName;
      document.getElementById('initialStock').value=initialStock;
      document.getElementById('totalIn').value=totalIn;
      document.getElementById('totalOut').value=totalOut;
      document.getElementById('remaining').value=remaining;
      document.getElementById('hdnproductid').value=productid;
      document.getElementById('hdnbranchid').value=branchid;
  $("#updateStockbtn").click();
}

  $(function () {
 
      var available_warehouses = true;
      $.ajax({url:"../../main/view.php",
        type:"POST",data:{available_warehouses:available_warehouses},cache:false,success:function(res){  
          var res = JSON.parse(res);
          // console.log(res.found);
          if (res.found===1) {
            for (const key in res.res) {
              $("#warehouses").append("<option value='"+res.res[key].warehouse_id+"'>"+res.res[key].warehouse_name+"</option>");
            }
          }else{
            $("#warehouses").html("<option value=''>No warehouse available</option>");
          }
          }
      });

//==================================================================================== CHANGE WAREHOUSE

$("#warehouses").change(function(){
  var warehouse = $("#warehouses").val();
      var WarehouseStockReport = true;
      $.ajax({url:"../../main/view.php",
        type:"POST",data:{WarehouseStockReport:WarehouseStockReport,warehouse:warehouse},cache:false,success:function(res){  
          var res = JSON.parse(res);
          // console.log(res.found);
          $("#resp").html("");
          if (res.found===1) {
            var cnt = 1;
            for (const key in res.res) {
              // console.log(res.res[key]);
              var nn = '"'+res.res[key].branch_name+'"';
              $("#resp").append("<tr> <td>"+cnt+".</td> <td>"+res.res[key].product_name+"</td> <td>"+res.res[key].ProductDate+"</td> <td>"+res.res[key].ProductInitialStock+"</td> <td>"+res.res[key].ProductIn+"</td> <td>"+res.res[key].ProductOut+"</td> <td>"+res.res[key].Remaining+"</td> </tr>");
              cnt++;
            }
            $("#resp").css("width","200%");
          }else{
            $("#resp").html("<tr> <td > <center>No Stock available</center></td></tr>");
          }
         $('#respTable').DataTable();

          }
      });
});

  })


function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('report_div');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('WarehouseReport.' + (type || 'xlsx')));
    }
</script>
</body>
</html>
