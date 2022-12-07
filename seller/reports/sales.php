<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("../../assets/header22222.php");
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sales Report
        <small>Sales</small>
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
        <div class="col-md-12">
          <div class="box" style="margin-left: 0.5%">
            <div class="box-body">
              <span>
                <table style="width: 100%;">
                  <tr>
                    <td><button class="btn btn-success" style="font-weight: bolder;float:left;position:relative" onclick="return ExportToExcel()">Export Excel</button></td>
                    <td>
                    <label for="dtto">From:</label>
                      <input type="date" name="dtfrom" id="dtfrom" class="form-control" style="position:relative"></td>
                    <td>
                      <label for="dtto">To:</label>
                      <input type="date" name="dtto" id="dtto" class="form-control" style="float:left;position:relative">
                      
                    </td>
                  </tr>
                </table>
                
                
                
              </span>
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
  $(function () {
        $("#sidebar-toggle").click();
      var GeneralSallesReportBranch = true;
      $.ajax({url:"../../main/view.php",
        type:"POST",data:{GeneralSallesReportBranch:GeneralSallesReportBranch},cache:false,success:function(res){  
          var res = JSON.parse(res);
          // console.log(res.res);
          if (res.found===1) {
            for (const key in res.res) {
              $("#report_div").append("<table class='table table-responsive' id='respTable'> <thead> <th colspan='10'> <center style='background-color:#eee;font-size:20px'>"+res.res[key].branch_name+" </center> </th> </thead> "+

                "<thead  class='thead-dark'>  <th>#</th>  <th>MemberName</th>  <th>Date</th>  <th>Product</th>  <th>ClientName</th>  <th>CompanyName</th>  <th>QuantitySold</th> <th>SoldPrice</th>  <th>PaymentWay</th>  </thead> </table><tbody> ");
              if (res.res[key].is_found==0) {
                $("#respTable").append("<tr> <td colspan='10'><center>No data found ...</center></td> </tr>");
                // $("#"+key+"").css("display","none");
              }else{
                let finalData = res.res[key].data;
                let ll = finalData.length;
                  var ttlQntty = ttlSoldPrice = 0;

                for (var i = 0; i < ll; i++) {
                  // console.log(res.res[key].data[i].SoldPrice);
                $("#respTable").append("<tr><td>"+ (i+1) +"</td> <td><a style='color:black!important' target='_blank' href='emp_sales?emp="+res.res[key].data[i].EmployeesId+"'>"+res.res[key].data[i].employee_name+"<a></td> <td>"+res.res[key].data[i].StockOutDate+"</td>  <td>"+res.res[key].data[i].product_name+"</td>  <td>"+res.res[key].data[i].ClientName+"</td>  <td>"+res.res[key].data[i].CompanyName+"</td>  <td>"+Intl.NumberFormat().format(res.res[key].data[i].QuantitySold)+"</td>   <td>"+Intl.NumberFormat().format(res.res[key].data[i].SoldPrice)+"</td> <td>"+res.res[key].data[i].PaymentWay+"</td> </tr> ");
                // $("#"+key+"").append("<tr> ");
                ttlQntty+= parseInt(res.res[key].data[i].QuantitySold);
                ttlSoldPrice+= parseInt(res.res[key].data[i].SoldPrice);

                }
                // $("#respTable").append("<tr><tr><td></td></tr><th>Total</th> <th>"+Intl.NumberFormat().format(ttlQntty)+"</th> <th>"+Intl.NumberFormat().format(ttlSoldPrice)+"</th> <th colspan='2'></th><tr> ");
                $('#respTable').DataTable();

                

              }

            }
          }else{
            // console.log("not found");
            $("#report_div").html("<center><h3>No data available ...</h3></center>");
            // $("#"+key+"").css("display","none");
          }
          // $('#respTable').DataTable();
          }
      });

  })

$("#dtto").change(function(){
  var dtFrom = $("#dtfrom").val();
  var dtTo = $("#dtto").val();
  if(dtFrom!='' && dtTo!=''){
    $("#report_div").html("");
    var GeneralSallesReportRangeBranch = true;
      $.ajax({url:"../../main/view.php",
        type:"POST",data:{GeneralSallesReportRangeBranch:GeneralSallesReportRangeBranch,dtFrom:dtFrom,dtTo:dtTo},cache:false,success:function(res){  
          var res = JSON.parse(res);
          // console.log(res.res);
          if (res.found===1) {
            for (const key in res.res) {
              $("#report_div").append("<table class='table table-responsive' id='respTable'> <thead> <th colspan='10'> <center style='background-color:#eee;font-size:20px'>"+res.res[key].branch_name+" </center> </th> </thead> "+

                "<thead  class='thead-dark'>  <th>#</th>  <th>MemberName</th>  <th>Date</th>  <th>Product</th>  <th>ClientName</th>  <th>CompanyName</th>  <th>QuantitySold</th> <th>SoldPrice</th>  <th>PaymentWay</th>  </thead> </table><tbody> ");
              if (res.res[key].is_found==0) {
                $("#"+key+"").append("<tr> <td colspan='10'><center>No data found ...</center></td> </tr>");
              }else{
                let finalData = res.res[key].data;
                let ll = finalData.length;
                  var ttlQntty = ttlSoldPrice = 0;
                for (var i = 0; i < ll; i++) {
                  // console.log(res.res[key].data[i].SoldPrice);
                $("#respTable").append("<tr><td>"+ (i+1) +"</td> <td><a style='color:black!important' target='_blank' href='emp_sales?emp="+res.res[key].data[i].EmployeesId+"'>"+res.res[key].data[i].employee_name+"<a></td> <td>"+res.res[key].data[i].StockOutDate+"</td>  <td>"+res.res[key].data[i].product_name+"</td>  <td>"+res.res[key].data[i].ClientName+"</td>  <td>"+res.res[key].data[i].CompanyName+"</td>  <td>"+Intl.NumberFormat().format(res.res[key].data[i].QuantitySold)+"</td>   <td>"+Intl.NumberFormat().format(res.res[key].data[i].SoldPrice)+"</td> <td>"+res.res[key].data[i].PaymentWay+"</td> </tr> ");
                // $("#"+key+"").append("<tr> ");
                ttlQntty+= parseInt(res.res[key].data[i].QuantitySold);
                ttlSoldPrice+= parseInt(res.res[key].data[i].SoldPrice);
                }
                $("#respTable").append("<tr><tr><td></td></tr><th>Total</th> <th>"+Intl.NumberFormat().format(ttlQntty)+"</th> <th>"+Intl.NumberFormat().format(ttlSoldPrice)+"</th> <th colspan='2'></th><tr> ");
                $('#respTable').DataTable();
                
              }
            }
          }else{
            // console.log("not found");
            $("#report_div").html("<center><h3>No data available ...</h3></center>");
            // $("#"+key+"").css("display","none");
          }
          }
      });
  }

});

function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('report_div');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('StockSalesReport.' + (type || 'xlsx')));
    }

</script>
</body>
</html>
