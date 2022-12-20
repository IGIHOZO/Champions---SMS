<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("../../assets/header22222.php");
?>
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
  /* border: 1px solid orange; */
}

td {
  width: 1.5em;
  height: 3.5em;
  text-align: center;
  vertical-align: middle;
}
</style>
<link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Stock Report
        <small>Stock</small>
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
              <center><div id="report_div" style="text-align: center;margin: 0 auto"></div></center>

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
<script  type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script  type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />
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
 


      var GeneralStockReportBranch = true;
      $.ajax({url:"../../main/view.php",
        type:"POST",data:{GeneralStockReportBranch:GeneralStockReportBranch},cache:false,success:function(res){  
          var res = JSON.parse(res);
          // console.log(res.res);
          if (res.found===1) {
            for (const key in res.res) {
              $("#report_div").append("<table class='table table-stripe' id='respTable'> <thead> <th colspan='8'> <center style='background-color:#eee;font-size:20px'>"+res.res[key].branch_name+" </center> </th> </thead> "+

                "<thead  class='thead-dark'>  <th>#</th>  <th>ItemName</th>  <th>DateRegistered</th>  <th>InitialStock</th>  <th>Total-In</th>  <th>Total-Out</th>  <th>Remaining</th>  <th>Actions</th>  </thead> </table><tbody> ");
              if (res.res[key].is_found==0) {
                $("#respTable").append("<tr> <td colspan='8'><center>No data found ...</center></td> </tr>");
              }else{
                let finalData = res.res[key].data;
                let ll = finalData.length;
                  var ttlInitial = ttlTTLIn = ttlTTLOut = ttlRemaining = 0;

                for (var i = 0; i < ll; i++) {

                  // console.log(res.res[key].data[i].SoldPrice);
                $("#respTable").append("<tr> ");
                var nn = '"'+res.res[key].data[i].product_name+'"';
                $("#respTable").append("<td>"+ (i+1) +"</td><td>"+res.res[key].data[i].product_name+"</td>  <td>"+res.res[key].data[i].ProductDate+"</td>  <td>"+Intl.NumberFormat().format(res.res[key].data[i].ProductInitialStock)+"</td>  <td>"+Intl.NumberFormat().format(res.res[key].data[i].ProductIn)+"</td>  <td>"+Intl.NumberFormat().format(res.res[key].data[i].ProductOut)+"</td> <td>"+Intl.NumberFormat().format(res.res[key].data[i].Remaining)+"</td> <td> <tutton onclick='return updateProductStockModal("+res.res[key].data[i].product_id+","+nn+","+res.res[key].data[i].ProductInitialStock+","+res.res[key].data[i].ProductIn+","+res.res[key].data[i].ProductOut+","+res.res[key].data[i].Remaining+","+res.res[key].data[i].BranchId+")' class='btn btn-link'>Update</button> </td>");
                $("#respTable").append("<tr> ");
                $("#respTable").append("<tr> ");

                ttlInitial+= parseInt(res.res[key].data[i].ProductInitialStock);
                ttlTTLIn+= parseInt(res.res[key].data[i].ProductIn);
                ttlTTLOut+= parseInt(res.res[key].data[i].ProductOut);
                ttlRemaining+= parseInt(res.res[key].data[i].Remaining);

                }
                $("#respTable").append("<tfoot> <th colspan='3'>Total:</th> <th>"+Intl.NumberFormat().format(ttlInitial)+"</th> <th>"+Intl.NumberFormat().format(ttlTTLIn)+"</th> <th>"+Intl.NumberFormat().format(ttlTTLOut)+"</th> <th>"+Intl.NumberFormat().format(ttlRemaining)+"</th> <th></th> </tfoot> ")
                $("#respTable").append(" </tbody> ");
  $("#respTable").DataTable();
                

              }

            }
          }else{
            console.log("not found");
            $("#report_div").html("<center><h3>No data available ...</h3></center>");
          }
          }
      });

  })


$("#initialStock").focusout(function(){
  var totalIn = $("#totalIn").val();
  var totalOut = $("#totalOut").val();
  var remaining = $("#remaining").val();
  var initialStock = $("#initialStock").val();

  document.getElementById("remaining").value=(parseInt(initialStock) + parseInt(totalIn))-parseInt(totalOut);

})
$("#totalIn").focusout(function(){
  var totalIn = $("#totalIn").val();
  var totalOut = $("#totalOut").val();
  var remaining = $("#remaining").val();
  var initialStock = $("#initialStock").val();

  document.getElementById("remaining").value=(parseInt(initialStock)+parseInt(totalIn))-parseInt(totalOut);

})
$("#totalOut").focusout(function(){
  var totalIn = $("#totalIn").val();
  var totalOut = $("#totalOut").val();
  var remaining = $("#remaining").val();
  var initialStock = $("#initialStock").val();

  document.getElementById("remaining").value=(parseInt(initialStock)+parseInt(totalIn))-parseInt(totalOut);

})
$("#remaining").focusout(function(){
  var totalIn = $("#totalIn").val();
  var totalOut = $("#totalOut").val();
  var remaining = $("#remaining").val();
  var initialStock = $("#initialStock").val();

  document.getElementById("initialStock").value=(parseInt(remaining)+parseInt(totalOut))-parseInt(totalIn);

})

function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('respTable');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('StockReport.' + (type || 'xlsx')));
    }
</script>
</body>
</html>
