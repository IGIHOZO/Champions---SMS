<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("../../assets/header2222.php");
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Purchases
        <small>Records</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> ChampionTech</a></li>
        <li><a href="#">Warehouse</a></li>
        <li><a href="#">Office Stock</a></li>
        <li class="active">SubStock</li>
      </ol>
    </section>

    <!-- Main content -->

      <!-- /.row -->
    <div class="modal fade" id="newRequestModal" tabindex="-1" role="dialog" aria-labelledby="newRequestModalLabel" aria-hidden="false" >
      <div class="modal-dialog" style="min-width: 90%" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" style="font-weight: bold;font-size: 20px;" id="exampleModalLabel">Record Purchase</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="false">×</span>
            </button>
          </div>
          <!-- <div class="modal-body"> -->
          <!-- <form action = "employee" method = "POST" name="sentMessage" id="contactForm" novalidate="novalidate"> -->

            <div class="box-body">
            <div class="modal-body">
            <!-- <section class="content"> -->
      <div class="row">
        <div class="col-md-6">
          <div class="box">
              <div id="respp" style="font-weight: bold;display: none;text-align: center;font-size: 20px"></div>
              <!-- Date dd/mm/yyyy -->
              <div class="form-group" id="product_idDiv">
                <label>Supplier TIN Number:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="text" class="form-control" id="TINNumber" placeholder="TIN Number here"> 
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group" id="product_idDiv">
                <label>Supplier Name:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="text" class="form-control" id="SupplierName" placeholder="Supplier Name here"> 
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group" id="product_idDiv">
                <label>Item Name:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="text" class="form-control" id="ItemName" placeholder="Item Name here"> 
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group" id="product_idDiv">
                <label>Invoice Number:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="text" class="form-control" id="InvoiceNumber" placeholder="Invoice Number here"> 
                </div>
                <!-- /.input group -->
              </div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        <!-- /.col (right) -->



        <div class="col-md-6">
          <div class="box">
            <div class="box-body">
              <div id="respp" style="font-weight: bold;display: none;text-align: center;font-size: 20px"></div>
              <!-- Date dd/mm/yyyy -->


              <div class="form-group" id="product_idDiv">
                <label>Invoice Date:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="date" class="form-control" id="InvoiceDate" placeholder="Invoice Date here"> 
                </div>
                <!-- /.input group -->
              </div>
                <!-- /.input group -->
              </div>
              <div class="form-group" id="product_idDiv">
                <label>Total Amount Tax Inclusive:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="number" class="form-control" id="Inclusive" placeholder="Tax Inclusive here"> 
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group" id="product_idDiv">
                <label>VAT Amount:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="number" class="form-control" id="VATAmount" placeholder="VATAmount here"> 
                </div>
                <!-- /.input group -->
              </div>


              <div class="form-group">
        
                <div class="input-group">
                  <button class="btn btn-success" style="font-weight: bold;margin: 10px" id="SavePurchase">Save</button>
                  <br>
                </div>
                <!-- /.input group -->
              </div>

              <!-- /.form group -->
            </div>
            <!-- /.box-body -->
          </div>
        </div>

          <!-- /.box -->
        </div>
        <!-- /.col (right) -->

            </div>
            <div class="modal-footer">
                      <div class="form-group">
                        <div class="input-group">
                          <!-- <button class="btn btn-success" id="RegisterWareHouse">Register</button> -->

                        </div>
                        <a href=""  style="float:right;" class="btn btn-default">Close</a>
                        <!-- /.input group -->
                      </div>
            </div>
          <!-- </form> -->
        </div>
      </div>
    </div>
    <!-- </section> -->


<!-- ================================================ UPDATE MODAL ====================================================== -->
<input type="hidden" id="purchaseId">
<button id="openUpdateRequestModal" data-toggle="modal" data-target="#UpdateRequestModal" style="display: none;"></button>
    <div class="modal fade" id="UpdateRequestModal" tabindex="-1" role="dialog" aria-labelledby="UpdateRequestModalLabel" aria-hidden="false" >
      <div class="modal-dialog" style="min-width: 90%" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" style="font-weight: bold;font-size: 20px;" id="UpdatempleModalLabel">Update Purchase Records</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="false">×</span>
            </button>
          </div>
          <!-- <div class="modal-body"> -->
          <!-- <form action = "employee" method = "POST" name="sentMessage" id="contactForm" novalidate="novalidate"> -->

            <div class="box-body">
            <div class="modal-body">
            <!-- <section class="content"> -->
      <div class="row">
        <div class="col-md-6">
          <div class="box">
              <div id="respp" style="font-weight: bold;display: none;text-align: center;font-size: 20px"></div>
              <!-- Date dd/mm/yyyy -->
              <div class="form-group" id="product_idDiv">
                <label>Supplier TIN Number:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="text" class="form-control" id="updTINNumber" placeholder="TIN Number here"> 
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group" id="product_idDiv">
                <label>Supplier Name:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="text" class="form-control" id="updSupplierName" placeholder="Supplier Name here"> 
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group" id="product_idDiv">
                <label>Item Name:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="text" class="form-control" id="updItemName" placeholder="Item Name here"> 
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group" id="product_idDiv">
                <label>Invoice Number:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="text" class="form-control" id="updInvoiceNumber" placeholder="Invoice Number here"> 
                </div>
                <!-- /.input group -->
              </div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        <!-- /.col (right) -->



        <div class="col-md-6">
          <div class="box">
            <div class="box-body">
              <div id="respp" style="font-weight: bold;display: none;text-align: center;font-size: 20px"></div>
              <!-- Date dd/mm/yyyy -->


              <div class="form-group" id="product_idDiv">
                <label>Invoice Date:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="date" class="form-control" id="updInvoiceDate" placeholder="Invoice Date here"> 
                </div>
                <!-- /.input group -->
              </div>
                <!-- /.input group -->
              </div>
              <div class="form-group" id="product_idDiv">
                <label>Total Amount Tax Inclusive:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="number" class="form-control" id="updInclusive" placeholder="Tax Inclusive here"> 
                </div>
              </div>

              <div class="form-group" id="product_idDiv">
                <label>VAT Amount:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="number" class="form-control" id="updVATAmount" placeholder="VATAmount here"> 
                </div>
              </div>


              <div class="form-group">
        
                <div class="input-group">
                  <button class="btn btn-success" style="font-weight: bold;margin: 10px" id="updSavePurchase">Save</button>
                  <br>
                </div>
              </div>

            </div>
          </div>
        </div>
        
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

<!-- =========================== END ============= UPDATE MODAL ====================================================== -->

    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box" style="margin-left: 0.5%">
            <div class="box-body">
              <button class="btn btn-success" style="font-weight: bolder;" onclick="return ExportToExcel()">Export Excel</button>
                <button style="float:right;" class="btn btn-primary" id="Next" data-toggle="modal" id="newGoalBtn" data-target="#newRequestModal">New</button>
                <button data-toggle='modal' id='updateStockbtn' data-target='#UpdateStockModal' style='display: none;'></button>
              <center><div style="text-align: center;margin: 0 auto">
                <table class="table table-reaponsive" id="respTale">
                  <thead>
                    <th>
                      #
                    </th>
                    <th>
                      SupplierTin
                    </th>
                    <th>
                      SupplierName
                    </th>
                    <th>
                      ItemName
                    </th>
                    <th>
                      InvoiceNumber
                    </th>
                    <th>
                      InvoiceDate
                    </th>
                    <th>
                      TotalAmountTaxInclusive
                    </th>
                    <th>
                      VATAmount
                    </th>
                    <th>
                      RecordedDate
                    </th>
                    <tbody id="report_div">
                      
                    </tbody>
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
<?php require("../assets/footer.php");?>


  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script  type="text/javascript" src=" https://code.jquery.com/jquery-3.5.1.js"></script>
<script  type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script  type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
 $(document).ready(function () {
    $('#respTale').DataTable();
});
</script>
<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="../bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script src="../assets/js/main.js"></script>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

<script>
function updatePurchaseModal(purchaseId,SupplierTin,SupplierName,ItemName,InvoiceNumber,InvoiceDate,TotalAmountTaxInclusive,VATAmount) {
  document.getElementById("purchaseId").value=purchaseId;

  document.getElementById("updTINNumber").value=SupplierTin;
  document.getElementById("updSupplierName").value=SupplierName;
  document.getElementById("updItemName").value=ItemName;
  document.getElementById("updInvoiceNumber").value=InvoiceNumber;
  document.getElementById("updInvoiceDate").value=InvoiceDate;
  document.getElementById("updInclusive").value=TotalAmountTaxInclusive;
  document.getElementById("updVATAmount").value=VATAmount;
  $("#openUpdateRequestModal").click();
}

function deletePurchases(idd) {
  var deletePurchases = true;
    $.ajax({url:"../main/action.php",
      type:"POST",data:{deletePurchases:deletePurchases,idd:idd},cache:false,success:function(res){  
        window.location.reload();
        // console.log(res);
        }
    });
}
function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('respTale');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('Purchases.' + (type || 'xlsx')));
    }




  $(document).ready(function(){
    $("#updSavePurchase").click(function(){
      var purchaseId = document.getElementById("purchaseId").value;

      var SupplierTin = document.getElementById("updTINNumber").value;
      var SupplierName = document.getElementById("updSupplierName").value;
      var ItemName = document.getElementById("updItemName").value;
      var InvoiceNumber = document.getElementById("updInvoiceNumber").value;
      var InvoiceDate = document.getElementById("updInvoiceDate").value;
      var TotalAmountTaxInclusive = document.getElementById("updInclusive").value;
      var VATAmount = document.getElementById("updVATAmount").value;

      if (purchaseId!='' && SupplierTin!='' && SupplierName!='' && ItemName!='' && InvoiceNumber!='' && InvoiceDate!='' && TotalAmountTaxInclusive!='' && VATAmount!='') {
          var updSavePurchase = true;
            $.ajax({url:"../main/action.php",
              type:"POST",data:{updSavePurchase:updSavePurchase,purchaseId:purchaseId,SupplierTin:SupplierTin,SupplierName:SupplierName,ItemName:ItemName,InvoiceNumber:InvoiceNumber,InvoiceDate:InvoiceDate,TotalAmountTaxInclusive:TotalAmountTaxInclusive,VATAmount:VATAmount},cache:false,success:function(res){  
                window.location.reload();
                // console.log(res);
                }
            });

      }else{
        alert("Fill all fields ...");
      }
    })



      var AllPurchases = true;
      $.ajax({url:"../main/view.php",
        type:"POST",data:{AllPurchases:AllPurchases},cache:false,success:function(res){  
          var res = JSON.parse(res);
          console.log(res.found);
          if (res.found===1) {
            var cnt = 1;
            for (const key in res.res) {
              var SupplierTin = '"'+res.res[key].SupplierTin+'"';
              var SupplierName = '"'+res.res[key].SupplierName+'"';
              var ItemName = '"'+res.res[key].ItemName+'"';
              var InvoiceNumber = '"'+res.res[key].InvoiceNumber+'"';
              var InvoiceDate = '"'+res.res[key].InvoiceDate+'"';
              var TotalAmountTaxInclusive = '"'+res.res[key].TotalAmountTaxInclusive+'"';
              var VATAmount = '"'+res.res[key].VATAmount+'"';
              $("#report_div").append("<tr> <td>"+cnt+".</td> <td>"+res.res[key].SupplierTin+"</td> <td>"+res.res[key].SupplierName+"</td><td>"+res.res[key].ItemName+"</td><td>"+res.res[key].InvoiceNumber+"</td> <td>"+res.res[key].InvoiceDate+"</td> <td>"+Intl.NumberFormat().format(res.res[key].TotalAmountTaxInclusive)+"</td> <td>"+Intl.NumberFormat().format(res.res[key].VATAmount)+"</td> <td><a class='btn btn-link' onclick='return updatePurchaseModal("+res.res[key].PurchaseId+","+SupplierTin+","+SupplierName+","+ItemName+","+InvoiceNumber+","+InvoiceDate+","+TotalAmountTaxInclusive+","+VATAmount+")'> Update </a> <a class='btn btn-danger' onclick='return deletePurchases("+res.res[key].PurchaseId+")'>Delete</a></td> </tr>");
              cnt++;
            }
          }else{
            $("#report_div").html("<tr> <td colspan=8> No Stock available</td></tr>");
          }
          }
      });




});
 $(function(){
  // $("#branch").css("width",30%);

  $("#category").select2();
 }); 
</script>
</body>
</html>
