<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("../../main/drive/config.php");
@require("../../assets/header333.php");
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>  
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />  
<link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />  
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>  


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
                    <td><button class="btn btn-success" style="font-weight: bolder;float:left;position:relative" onclick="return ExportToExcel()">Export Excel</button>
                    <td><select name="filterMember" onchange="return filterMember();" id="filterMember" class="form-control" style="width: 80%;float:right;margin:0px 100px">
                        <?php
                        $sel = $con->prepare("SELECT * FROM stockout GROUP BY ClientName,CompanyName,ClientPhone");
                        $sel->execute();
                        if ($sel->rowCount()>=1) {
                          while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option>".$ft_sel['ClientName']." | ".$ft_sel['CompanyName']." | ".$ft_sel['ClientPhone']."</option>";
                          }
                        }
                        ?>
                    </select>
                  </td>
                    <td>
                    <select name="sortby" id="sortby" class="form-control" style="width: 80%;float:right;margin:0px 100px">
                      <option value="" selected>Sort By</option>
                      <option>Price</option>
                      <option>Date</option>
                      <option>Member</option>
                      <option>Stock</option>
                      <option>Payment</option>
                      <option>Client</option>
                      <option>Company</option>
                      <option>Item</option>
                    </select>
                  </td>
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
<!-- Page script -->
<script>
  $("#filterMember").select2();

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
      var GeneralSallesReport = true;
      $.ajax({url:"../../main/view.php",
        type:"POST",data:{GeneralSallesReport:GeneralSallesReport},cache:false,success:function(res){  
          var res = JSON.parse(res);
          // console.log(res.res);
          if (res.found===1) {
            for (const key in res.res) {
              if (key==0) {
              $("#report_div").html("<center style='background-color:#eee;font-size:20px'>"+res.res[key].branch_name+" </center>");
                
              }else{
              $("#report_div").append("<center style='background-color:#eee;font-size:20px'>"+res.res[key].branch_name+" </center>");
                
              }
              // $("#report_div").append("<table class='table table-responsive' id='tbl"+key+"'> <thead  class='thead-dark'>  <th>#</th>  <th>MemberName</th>  <th>InvoiceNumber</th>  <th>Date</th>  <th>Product</th>  <th>ClientName</th>  <th>CompanyName</th>  <th>QuantitySold</th> <th>SoldPrice</th>  <th>Paid</th> <th>UnPaid</th> <th>PaymentStatus</th> <th>PaymentWay</th>  </thead> <tbody> ");

              $("#report_div").append("<table class='table table-responsive' id='tbl"+key+"'> <thead  class='thead-dark'>  <th>#</th>  <th>MemberName</th>  <th>InvoiceNumber</th>  <th>Date</th>  <th>ClientName</th>  <th>CompanyName</th> <th>PaymentStatus</th> <th>PaymentWay</th>  </thead> <tbody> ");
              if (res.res[key].is_found==0) {
                $("#tbl"+key+"").append("<tr> <td colspan='10'><center>No data found ...</center></td> </tr>");
                // $("#"+key+"").css("display","none");
              }else{
                
                let finalData = res.res[key].data;
                let ll = finalData.length;
                  var ttlQntty = ttlSoldPrice = 0;

                for (var i = 0; i < ll; i++) {
                  // console.log(res.res[key].data[i].SoldPrice);
                // $("#tbl"+key+"").append("<tr><td>"+ (i+1) +"</td> <td><a style='color:black!important' target='_blank' href='emp_sales?emp="+res.res[key].data[i].EmployeesId+"'>"+res.res[key].data[i].employee_name+"<a></td> <td>"+res.res[key].data[i].InvoiceNumber+"</td> <td>"+res.res[key].data[i].StockOutDate+"</td>  <td>"+res.res[key].data[i].product_name+"</td>  <td>"+res.res[key].data[i].ClientName+"</td>  <td>"+res.res[key].data[i].CompanyName+"</td>  <td>"+Intl.NumberFormat().format(res.res[key].data[i].QuantitySold)+"</td>   <td>"+Intl.NumberFormat().format(res.res[key].data[i].SoldPrice)+"</td> <td>"+res.res[key].data[i].Paid+"</td> <td>"+res.res[key].data[i].UnPaid+"</td> <td>"+res.res[key].data[i].PaymentStatus+"</td> <td>"+res.res[key].data[i].PaymentWay+"</td> </tr> ");

                $("#tbl"+key+"").append("<tr><td>"+ (i+1) +"</td> <td><a style='color:black!important' target='_blank' href='emp_sales?emp="+res.res[key].data[i].EmployeesId+"'>"+res.res[key].data[i].employee_name+"<a></td> <td> <a href='#' onclick='return detailsOneInvoice(\""+res.res[key].data[i].InvoiceNumber+"\")'> "+res.res[key].data[i].InvoiceNumber+"</a></td> <td>"+res.res[key].data[i].StockOutDate+"</td>  <td>"+res.res[key].data[i].ClientName+"</td>  <td>"+res.res[key].data[i].CompanyName+"</td>  <td>"+res.res[key].data[i].PaymentStatus+"</td> <td>"+res.res[key].data[i].PaymentWay+"</td> </tr> ");
                // $("#"+key+"").append("<tr> ");

                ttlQntty+= parseInt(res.res[key].data[i].QuantitySold);
                ttlSoldPrice+= parseInt(res.res[key].data[i].SoldPrice);

                }
              $("#tbl"+key+"").DataTable();
                $("#report_div").append("</tbody></table>");
                $("#tbl"+key+"").append("<th>Total</th> <th>"+Intl.NumberFormat().format(ttlQntty)+"</th> <th>"+Intl.NumberFormat().format(ttlSoldPrice)+"</th> <th colspan='2'></th><tr> ");

                

              }
            }
          }else{
            // console.log("not found");
            $("#report_div").html("<center><h3>No data available ...</h3></center>");
            // $("#"+key+"").css("display","none");
          }
          }
      });
      // $("#tbl0").DataTable();

  })
$("#dtto").change(function(){
  var dtFrom = $("#dtfrom").val();
  var dtTo = $("#dtto").val();
  if(dtFrom!='' && dtTo!=''){
    $("#report_div").html("");
    var GeneralSallesReportRange = true;
      $.ajax({url:"../../main/view.php",
        type:"POST",data:{GeneralSallesReportRange:GeneralSallesReportRange,dtFrom:dtFrom,dtTo:dtTo},cache:false,success:function(res){  
          var res = JSON.parse(res);
          // console.log(res.res);
          if (res.found===1) {
            for (const key in res.res) {
              $("#report_div").append("<table class='table table-responsive' id='"+key+"'> <thead> <th colspan='10'> <center style='background-color:#eee;font-size:20px'>"+res.res[key].branch_name+" </center> </th> </thead> "+

                "<thead  class='thead-dark'>  <th>#</th>  <th>MemberName</th>  <th>InvoiceNumber</th>  <th>Date</th>  <th>ClientName</th>  <th>CompanyName</th>  <th>PaymentStatus</th>  <th>PaymentWay</th>  </thead> </table><tbody> ");
              if (res.res[key].is_found==0) {
                $("#"+key+"").append("<tr> <td colspan='10'><center>No data found ...</center></td> </tr>");
              }else{
                let finalData = res.res[key].data;
                let ll = finalData.length;
                  var ttlQntty = ttlSoldPrice = 0;
                for (var i = 0; i < ll; i++) {
                  // console.log(res.res[key].data[i].SoldPrice);
                $("#"+key+"").append("<tr><td>"+ (i+1) +"</td> <td><a style='color:black!important' target='_blank' href='emp_sales?emp="+res.res[key].data[i].EmployeesId+"'>"+res.res[key].data[i].employee_name+"<a></td> <td> <a href='#' onclick='return detailsOneInvoice(\""+res.res[key].data[i].InvoiceNumber+"\")'> "+res.res[key].data[i].InvoiceNumber+"</a></td>  <td>"+res.res[key].data[i].StockOutDate+"</td>  <td>"+res.res[key].data[i].ClientName+"</td>  <td>"+res.res[key].data[i].CompanyName+"</td> <td>"+res.res[key].data[i].PaymentStatus+"</td> <td>"+res.res[key].data[i].PaymentWay+"</td> </tr> ");
                // $("#"+key+"").append("<tr> ");
                ttlQntty+= parseInt(res.res[key].data[i].QuantitySold);
                ttlSoldPrice+= parseInt(res.res[key].data[i].SoldPrice);
                }
                $("#"+key+"").append("<tr><tr><td></td></tr><th colspan='6'>Total</th> <th>"+Intl.NumberFormat().format(ttlQntty)+"</th> <th>"+Intl.NumberFormat().format(ttlSoldPrice)+"</th> <th colspan='2'></th><tr> ");
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


$("#sortby").change(function(){
  var sortby = $("#sortby").val();
  // var dtTo = $("#dtto").val();
  if(sortby!=''){
    $("#report_div").html("");
    var GeneralSallesReportSortBy = true;
      $.ajax({url:"../../main/view.php",
        type:"POST",data:{GeneralSallesReportSortBy:GeneralSallesReportSortBy,sortby:sortby},cache:false,success:function(res){  
          var res = JSON.parse(res);
          // console.log(res.res);
          if (res.found===1) {
            for (const key in res.res) {
              $("#report_div").append("<table class='table table-responsive' id='"+key+"'> <thead> <th colspan='10'> <center style='background-color:#eee;font-size:20px'>"+res.res[key].branch_name+" </center> </th> </thead> "+

                "<thead  class='thead-dark'>  <th>#</th>  <th>MemberName</th>  <th>InvoiceNumber</th>  <th>Date</th>  <th>ClientName</th>  <th>CompanyName</th>  <th>PaymentStatus</th>  <th>PaymentWay</th>  </thead> </table><tbody> ");
              if (res.res[key].is_found==0) {
                $("#"+key+"").append("<tr> <td colspan='10'><center>No data found ...</center></td> </tr>");
              }else{
                let finalData = res.res[key].data;
                let ll = finalData.length;
                  var ttlQntty = ttlSoldPrice = 0;
                for (var i = 0; i < ll; i++) {
                  // console.log(res.res[key].data[i].SoldPrice);
                $("#"+key+"").append("<tr><td>"+ (i+1) +"</td> <td><a style='color:black!important' target='_blank' href='emp_sales?emp="+res.res[key].data[i].EmployeesId+"'>"+res.res[key].data[i].employee_name+"<a></td>   <td> <a href='#' onclick='return detailsOneInvoice(\""+res.res[key].data[i].InvoiceNumber+"\")'> "+res.res[key].data[i].InvoiceNumber+"</a></td>  <td>"+res.res[key].data[i].StockOutDate+"</td>  <td>"+res.res[key].data[i].ClientName+"</td>  <td>"+res.res[key].data[i].CompanyName+"</td>  <td>"+res.res[key].data[i].PaymentStatus+"</td> <td>"+res.res[key].data[i].PaymentWay+"</td> </tr> ");
                // $("#"+key+"").append("<tr> ");
                ttlQntty+= parseInt(res.res[key].data[i].QuantitySold);
                ttlSoldPrice+= parseInt(res.res[key].data[i].SoldPrice);
                }
                $("#"+key+"").append("<tr><tr><td></td></tr><th colspan='6'>Total</th> <th>"+Intl.NumberFormat().format(ttlQntty)+"</th> <th>"+Intl.NumberFormat().format(ttlSoldPrice)+"</th> <th colspan='2'></th><tr> ");
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
        XLSX.writeFile(wb, fn || ('SalesReport.' + (type || 'xlsx')));
    }

function filterMember() {
	var memberDetails = document.getElementById("filterMember").value;
	if (memberDetails!='' || memberDetails!=null) {
		var filterMember = true;
		$.ajax({url:"../../main/view.php",
		type:"POST",data:{filterMember:filterMember,memberDetails:memberDetails},cache:false,success:function(res){  
      var res = JSON.parse(res);
      console.log(res.res.is_found);
          if (res.res.is_found===1) {
            $("#report_div").html("<table id='tbll' class='table table-responsive' ><thead  class='thead-dark'>  <th>#</th>  <th>MemberName</th>  <th>InvoiceNumber</th>  <th>Date</th>  <th>ClientName</th>  <th>CompanyName</th>  <th>PaymentStatus</th>  <th>PaymentWay</th>  </thead> <tbody>");
            var i = 0;
            var ttlQntty = ttlSoldPrice = 0;
            for (const key in res.res.data) {
              // console.log(res.res.data[key]);
                $("#tbll").append("<tr><td>"+ (i+1) +"</td> <td><a style='color:black!important' target='_blank' href='emp_sales?emp="+res.res.data[key].EmployeesId+"'>"+res.res.data[key].employee_name+"<a></td> <td>"+res.res.data[key].InvoiceNumber+"</td>  <td>"+res.res.data[key].StockOutDate+"</td>  <td> <a href='#' onclick='return detailsOneInvoice(\""+res.res.data[key].InvoiceNumber+"\")'> "+res.res.data[key].InvoiceNumber+"</a></td>  <td>"+res.res.data[key].CompanyName+"</td> <td>"+res.res.data[key].PaymentStatus+"</td>  <td>"+res.res.data[key].PaymentWay+"</td> </tr> ");
                ttlQntty+= parseInt(res.res.data[key].QuantitySold);
                ttlSoldPrice+= parseInt(res.res.data[key].SoldPrice);
                i ++;
              }
              $("#tbll").append("<tr><tr><td></td></tr><th colspan='6'>Total</th> <th>"+Intl.NumberFormat().format(ttlQntty)+"</th> <th>"+Intl.NumberFormat().format(ttlSoldPrice)+"</th> <th colspan='2'></th><tr> ");
            $("#report_div").append("</tbody></table>");
          $("#tbll").DataTable();
          }else{
            $("#report_div").html("<center><h3>No data available ...</h3></center>");
          }
			}
		});
	}
}

function detailsOneInvoice(invoice){
  var detailsOneInvoice = true;
		$.ajax({url:"../../main/view.php",
		type:"POST",data:{detailsOneInvoice:detailsOneInvoice,invoice:invoice},cache:false,success:function(res){  
      var res = JSON.parse(res);
      console.log(res.res.is_found);
          if (res.res.is_found===1) {
            $("#report_div").html("<table id='tbll' class='table table-responsive' ><thead  class='thead-dark'>  <th>#</th>  <th>MemberName</th>  <th>InvoiceNumber</th>  <th>Date</th>  <th>Product</th>  <th>ClientName</th>  <th>CompanyName</th>  <th>QuantitySold</th> <th>SoldPrice</th>  <th>Paid</th> <th>UnPaid</th> <th>PaymentStatus</th>  <th>PaymentWay</th>  </thead> <tbody>");
            var i = 0;
            var ttlQntty = ttlSoldPrice = 0;
            for (const key in res.res.data) {
              // console.log(res.res.data[key]);
                $("#tbll").append("<tr><td>"+ (i+1) +"</td> <td><a style='color:black!important' target='_blank' href='emp_sales?emp="+res.res.data[key].EmployeesId+"'>"+res.res.data[key].employee_name+"<a></td> <td>"+res.res.data[key].InvoiceNumber+"</td>  <td>"+res.res.data[key].StockOutDate+"</td>  <td>"+res.res.data[key].product_name+"</td>  <td>"+res.res.data[key].ClientName+"</td>  <td>"+res.res.data[key].CompanyName+"</td>  <td>"+Intl.NumberFormat().format(res.res.data[key].QuantitySold)+"</td>   <td>"+Intl.NumberFormat().format(res.res.data[key].SoldPrice)+"</td> <td>"+res.res.data[key].Paid+"</td> <td>"+res.res.data[key].UnPaid+"</td> <td>"+res.res.data[key].PaymentStatus+"</td>  <td>"+res.res.data[key].PaymentWay+"</td> </tr> ");
                ttlQntty+= parseInt(res.res.data[key].QuantitySold);
                ttlSoldPrice+= parseInt(res.res.data[key].SoldPrice);
                i ++;
              }
              $("#tbll").append("<tr><tr><td></td></tr><th colspan='6'>Total</th> <th>"+Intl.NumberFormat().format(ttlQntty)+"</th> <th>"+Intl.NumberFormat().format(ttlSoldPrice)+"</th> <th colspan='2'></th><tr> ");
            $("#report_div").append("</tbody></table>");
          $("#tbll").DataTable();
          }else{
            $("#report_div").html("<center><h3>No data available ...</h3></center>");
          }
			}
		});
}
</script>

</body>
</html>
