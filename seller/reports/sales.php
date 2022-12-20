<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("../../assets/header22222.php");
?>
<link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />

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
              
    <div class="modal fade" id="newRequestModal" tabindex="-1" role="dialog" aria-labelledby="newRequestModalLabel" aria-hidden="false" sty>
      <div class="modal-dialog" style="min-width: 60%" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" style="font-weight: bold;font-size: 20px;" id="exampleModalLabel">Update Debt</h5>
            <div id="respp" style="font-weight: bold;display: block;text-align: center;"></div>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span style="float:right;margin-top: -50px;" aria-hidden="false">×</span>
            </button>
          </div>
          <!-- <div class="modal-body"> -->
          <!-- <form action = "employee" method = "POST" name="sentMessage" id="contactForm" novalidate="novalidate"> -->

            <div class="modal-body">
            <!-- <section class="content"> -->
      <div class="row">
        <div class="col-md-9">
          <div class="box" style="margin-left: 15%">
            <div class="box-body">
              <div class="form-group">
                <label>Paid Amount:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-trophy"></i>
                  </div>
                  <input type="number" class="form-control" id="paid" oninput="return updateUnPaid();">
                </div>

              </div>
              <div class="form-group">
                <label>UnPaid Amount
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-shopping-cart"></i>
                  </div>
                  <input disabled type="number" class="form-control" id="unpaid">
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <label>Total Debited
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-shopping-cart"></i>
                  </div>
                  <input disabled type="number" class="form-control" id="ttlDebited">
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
                  <button class="btn btn-success" style="font-weight: bold;" onclick=" return updateUnPaidApprove();">Update</button>
                </div>
                <a href="#" style="float:right;" class="btn btn-default" type="button" data-dismiss="modal" aria-label="Close">Close</a>

                <!-- /.input group -->
              </div>
            </div>
          <!-- </form> -->
          <input type='hidden' id='holdStock'>
          <input type='hidden' id='holdPaid'>
          <input type='hidden' id='holdUnPaid'>
          <input type='hidden' id='holdTtlAmount'>

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
              $("#report_div").append("<table class='table table-responsive' id='respTable'> "+

                "<thead  class='thead-dark'>  <th>#</th>  <th>MemberName</th>  <th>Date</th>  <th>Product</th>  <th>ClientName</th>  <th>CompanyName</th>  <th>QuantitySold</th> <th>SoldPrice</th>  <th>Paid</th> <th>UnPaid</th> <th>PaymentStatus</th>  <th>PaymentWay</th>  </thead> <tbody>");
              if (res.res[key].is_found==0) {
                $("#respTable").append("<tr> <td colspan='10'><center>No data found ...</center></td> </tr>");
                // $("#"+key+"").css("display","none");
              }else{
                let finalData = res.res[key].data;
                let ll = finalData.length;
                  var ttlQntty = ttlSoldPrice = 0;

                for (var i = 0; i < ll; i++) {
                  var PaymentStatus = "";
                  if  (res.res[key].data[i].PaymentStatus=="Not Yet"){
                      PaymentStatus = "<a onclick='return beforeUpdateDebt("+res.res[key].data[i].StockOutId+","+res.res[key].data[i].Paid+","+res.res[key].data[i].UnPaid+","+(res.res[key].data[i].SoldPrice*res.res[key].data[i].QuantitySold)+");' href='#' style='color:red;text-decoration:underline' data-toggle='modal' id='newGoalBtn' data-target='#newRequestModal'> Not Yet</a>";
                  }else{
                      PaymentStatus = "<a onclick='return beforeUpdateDebt("+res.res[key].data[i].StockOutId+","+res.res[key].data[i].Paid+","+res.res[key].data[i].UnPaid+","+(res.res[key].data[i].SoldPrice*res.res[key].data[i].QuantitySold)+");' href='#' style='color:green;font-weight:bolder' data-toggle='modal' id='newGoalBtn' data-target='#newRequestModal'> All Paid</a>";
                  }
                $("#respTable").append("<tr><td>"+ (i+1) +"</td> <td><a style='color:black!important' target='_blank' href='emp_sales?emp="+res.res[key].data[i].EmployeesId+"'>"+res.res[key].data[i].employee_name+"<a></td> <td>"+res.res[key].data[i].StockOutDate+"</td>  <td>"+res.res[key].data[i].product_name+"</td>  <td>"+res.res[key].data[i].ClientName+"</td>  <td>"+res.res[key].data[i].CompanyName+"</td>  <td>"+Intl.NumberFormat().format(res.res[key].data[i].QuantitySold)+"</td>   <td>"+Intl.NumberFormat().format(res.res[key].data[i].SoldPrice)+"</td>  <td>"+res.res[key].data[i].Paid+"</td> <td>"+res.res[key].data[i].UnPaid+"</td> <td>"+PaymentStatus+"</td> <td>"+res.res[key].data[i].PaymentWay+"</td> </tr> ");
                // $("#"+key+"").append("<tr> ");
                ttlQntty+= parseInt(res.res[key].data[i].QuantitySold);
                ttlSoldPrice+= parseInt(res.res[key].data[i].SoldPrice);

                }
                $("#respTable").append("  </table><tbody>  ");
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
          if (res.found===1) {
            for (const key in res.res) {
              $("#report_div").append("<table class='table table-responsive' id='respTable'> <thead  class='thead-dark'>  <th>#</th>  <th>MemberName</th>  <th>Date</th>  <th>Product</th>  <th>ClientName</th>  <th>CompanyName</th>  <th>QuantitySold</th> <th>SoldPrice</th>  <th>Paid</th> <th>UnPaid</th> <th>PaymentStatus</th>  <th>PaymentWay</th>  </thead> <tbody> ");
              if (res.res[key].is_found==0) {
                $("#respTable").append("<tr> <td colspan='10'><center>No data found ...</center></td> </tr>");
              }else{
                let finalData = res.res[key].data;
                let ll = finalData.length;
                  var ttlQntty = ttlSoldPrice = 0;
                for (var i = 0; i < ll; i++) {
                      var PaymentStatus = "";
                  if  (res.res[key].data[i].PaymentStatus=="Not Yet"){
                      PaymentStatus = "<a onclick='return beforeUpdateDebt("+res.res[key].data[i].StockOutId+","+res.res[key].data[i].Paid+","+res.res[key].data[i].UnPaid+","+(res.res[key].data[i].SoldPrice*res.res[key].data[i].QuantitySold)+");'  href='#' style='color:red;text-decoration:underline' data-toggle='modal' id='newGoalBtn' data-target='#newRequestModal'> Not Yet</a>";
                  }else{
                    PaymentStatus = "<a onclick='return beforeUpdateDebt("+res.res[key].data[i].StockOutId+","+res.res[key].data[i].Paid+","+res.res[key].data[i].UnPaid+","+(res.res[key].data[i].SoldPrice*res.res[key].data[i].QuantitySold)+");'  href='#' style='color:green;font-weight:bolder' data-toggle='modal' id='newGoalBtn' data-target='#newRequestModal'> All Paid</a>";
                  }
                  $("#respTable").append("<tr><td>"+ (i+1) +"</td> <td><a style='color:black!important' target='_blank' href='emp_sales?emp="+res.res[key].data[i].EmployeesId+"'>"+res.res[key].data[i].employee_name+"<a></td> <td>"+res.res[key].data[i].StockOutDate+"</td>  <td>"+res.res[key].data[i].product_name+"</td>  <td>"+res.res[key].data[i].ClientName+"</td>  <td>"+res.res[key].data[i].CompanyName+"</td>  <td>"+Intl.NumberFormat().format(res.res[key].data[i].QuantitySold)+"</td>   <td>"+Intl.NumberFormat().format(res.res[key].data[i].SoldPrice)+"</td> <td>"+res.res[key].data[i].Paid+"</td> <td>"+res.res[key].data[i].UnPaid+"</td> <td>"+PaymentStatus+"</td>  <td>"+res.res[key].data[i].PaymentWay+"</td> </tr> ");
                ttlQntty+= parseInt(res.res[key].data[i].QuantitySold);
                ttlSoldPrice+= parseInt(res.res[key].data[i].SoldPrice);
                } 
                $("#respTable").append("</tbody></table>");
                $('#respTable').DataTable();
                
              }
            }
          }else{
            $("#report_div").html("<center><h3>No data available ...</h3></center>");
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
function beforeUpdateDebt(Stock, Paid, Unpaid, ttlAmount){
  var newStock = document.getElementById("holdStock").value;
  var newPaid = document.getElementById("holdPaid").value;
  var newUnPaid = document.getElementById("holdUnPaid").value;
  var newTtlDebited = document.getElementById("holdTtlAmount").value;
  
  document.getElementById("paid").value = Paid;
  document.getElementById("unpaid").value = Unpaid;
  document.getElementById("ttlDebited").value = ttlAmount;
  document.getElementById("holdStock").value = Stock;

}
function updateUnPaid(){
  var paid = document.getElementById("paid").value;
  var unpaid =  document.getElementById("unpaid").value;
  var ttldebited =  document.getElementById("ttlDebited").value;
  
  var newUpaid = ttldebited-paid;
  document.getElementById("unpaid").value = newUpaid;
}
function updateUnPaidApprove(){
  console.log("Clicked");
  var paid = document.getElementById("paid").value;
  var unpaid =  document.getElementById("unpaid").value;
  var holdStock = document.getElementById("holdStock").value;
  if(paid!='' && holdStock!='' && unpaid!=''){
    var updateUnPaidApprove = true;
    $.ajax({url:"../../main/action.php",
        type:"POST",data:{updateUnPaidApprove:updateUnPaidApprove,paid:paid,unpaid:unpaid,newStock:holdStock},cache:false,success:function(res){  
          switch (res) {
            case 'Invalid':
              $("#respp").html("<h3>Invalid Amount</h3>");
              break;
              case 'Too_much':
                $("#respp").html("<h3 style='color:red;font-weight:bold;'>Amount paid is more than total debited ..</h3>");
              break;
              case 'failed':
              
              break;
              case 'not_found':
              
              break;
              case 'success':
                $("#respp").html("<h3 style='color:green;font-weight:bold;'>Updated Successfully !</h3>");
              break;
          
            default:
              break;
          }
          }
    });
  }else{
  console.log("paid: "+paid);
  console.log("unpaid: "+unpaid);
  console.log("holdStock: "+holdStock);

  }
}
</script>
</body>
</html>
