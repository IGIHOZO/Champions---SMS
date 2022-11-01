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
        Expenses
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
    <div class="modal fade" id="newRequestModal" tabindex="-1" role="dialog" aria-labelledby="newRequestModalLabel" aria-hidden="false" sty>
      <div class="modal-dialog" style="min-width: 90%" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" style="font-weight: bold;font-size: 20px;" id="exampleModalLabel">Record Expenses</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="false">×</span>
            </button>
          </div>
            <div class="modal-body">
      <div class="row">
        <div class="col-md-6">
          <div class="box">
            <div class="box-body">
              <div id="respp" style="font-weight: bold;display: none;text-align: center;font-size: 20px"></div>
              <!-- Date dd/mm/yyyy -->
              <div class="form-group" id="product_idDiv">
                <label>Expense Name:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="text" class="form-control" id="ExpenseName" placeholder="ExpenseName here"> 
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group" id="product_idDiv">
                <label>Expense Price:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="number" class="form-control" id="ExpensePrice" placeholder="ExpensePrice here"> 
                </div>
                <!-- /.input group -->
              </div>



            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        <div class="col-md-6">
          <div class="box">
            <div class="box-body">
              <div id="respp" style="font-weight: bold;display: none;text-align: center;font-size: 20px"></div>
              <!-- Date dd/mm/yyyy -->

              <div class="form-group" id="product_idDiv">
                <label>Expense Quantity:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="number" class="form-control" id="ExpenseQuantity" placeholder="ExpenseQuantity here"> 
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group" id="product_idDiv">
                <label>Payment Method:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <select class="form-control" id="ExpenseMethod">
                    <option>Cash</option>
                    <option>Momo</option>
                    <option>Cheque</option>
                    <option>Credit</option>
                  </select>
                </div>
                <!-- /.input group -->
              </div>
                <!-- /.input group -->
              </div>



              <div class="form-group">
        
                <div class="input-group">
                  <button class="btn btn-success" style="font-weight: bold;margin: 10px" id="SaveExpenses">Save</button>
                  <br>
                </div>
                <!-- /.input group -->
              </div>

              <!-- /.form group -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>
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
<input type="hidden" id="expenseId">
<button id="openUpdateRequestModal" data-toggle="modal" data-target="#newExpensesModal" style="display: none;"></button>

    <div class="modal fade" id="newExpensesModal" tabindex="-1" role="dialog" aria-labelledby="newExpensesModalLabel" aria-hidden="false" sty>
      <div class="modal-dialog" style="min-width: 90%" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" style="font-weight: bold;font-size: 20px;" id="newExpensesModalLabel">Update Expense Records</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="false">×</span>
            </button>
          </div>
            <div class="modal-body">
      <div class="row">
        <div class="col-md-6">
          <div class="box">
            <div class="box-body">
              <div id="respp" style="font-weight: bold;display: none;text-align: center;font-size: 20px"></div>
              <!-- Date dd/mm/yyyy -->
              <div class="form-group" id="product_idDiv">
                <label>Expense Name:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="text" class="form-control" id="updExpenseName" placeholder="ExpenseName here"> 
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group" id="product_idDiv">
                <label>Expense Price:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="number" class="form-control" id="updExpensePrice" placeholder="ExpensePrice here"> 
                </div>
                <!-- /.input group -->
              </div>



            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        <div class="col-md-6">
          <div class="box">
            <div class="box-body">
              <div id="respp" style="font-weight: bold;display: none;text-align: center;font-size: 20px"></div>
              <!-- Date dd/mm/yyyy -->

              <div class="form-group" id="product_idDiv">
                <label>Expense Quantity:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="number" class="form-control" id="updExpenseQuantity" placeholder="ExpenseQuantity here"> 
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group" id="product_idDiv">
                <label>Payment Method:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <select class="form-control" id="updExpenseMethod">
                    <option>Cash</option>
                    <option>Momo</option>
                    <option>Cheque</option>
                    <option>Credit</option>
                  </select>
                </div>
                <!-- /.input group -->
              </div>
                <!-- /.input group -->
              </div>



              <div class="form-group">
        
                <div class="input-group">
                  <button class="btn btn-success" style="font-weight: bold;margin: 10px" id="updSaveExpenses">Update</button>
                  <br>
                </div>
                <!-- /.input group -->
              </div>

              <!-- /.form group -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>
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
                      Expense Name
                    </th>
                    <th>
                      Expense Price
                    </th>
                    <th>
                      Expense Quantity
                    </th>
                    <th>
                      Payment Method
                    </th>
                    <th>
                      Recorded Date
                    </th>
                    <th>
                      
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
<script src="../../assets/js/main.js"></script>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

<script>

function updateExpenseModal(expenseId,updExpenseName,updExpensePrice,updExpenseQuantity,updExpenseMethod) {
  document.getElementById("expenseId").value=expenseId;

  document.getElementById("updExpenseName").value=updExpenseName;
  document.getElementById("updExpensePrice").value=updExpensePrice;
  document.getElementById("updExpenseQuantity").value=updExpenseQuantity;
  document.getElementById("updExpenseMethod").value=updExpenseMethod;
  $("#openUpdateRequestModal").click();
  // console.log(updExpenseMethod);
}

function deleteExpenses(idd) {
  var deleteExpenses = true;
    $.ajax({url:"../../main/action.php",
      type:"POST",data:{deleteExpenses:deleteExpenses,idd:idd},cache:false,success:function(res){  
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

    $("#updSaveExpenses").click(function(){
    var expenseId = document.getElementById("expenseId").value;

    var updExpenseName = document.getElementById("updExpenseName").value;
    var updExpensePrice = document.getElementById("updExpensePrice").value;
    var updExpenseQuantity = document.getElementById("updExpenseQuantity").value;
    var updExpenseMethod = document.getElementById("updExpenseMethod").value;

      if (expenseId!='' && updExpenseName!='' && updExpensePrice!='' && updExpenseQuantity!='' && updExpenseMethod!='') {
          var updSaveExpenses = true;
            $.ajax({url:"../../main/action.php",
              type:"POST",data:{updSaveExpenses:updSaveExpenses,expenseId:expenseId,updExpenseName:updExpenseName,updExpensePrice:updExpensePrice,updExpenseQuantity:updExpenseQuantity,updExpenseMethod:updExpenseMethod},cache:false,success:function(res){  
                window.location.reload();
                // console.log(res);
                }
            });

      }else{
        alert("Fill all fields ...");
      }
    })




      var AllExpenses = true;
      $.ajax({url:"../../main/view.php",
        type:"POST",data:{AllExpenses:AllExpenses},cache:false,success:function(res){  
          var res = JSON.parse(res);
          console.log(res.found);
          if (res.found===1) {
            var cnt = 1;
            for (const key in res.res) {
              var ExpenseName = '"'+res.res[key].ExpenseName+'"';
              var ExpensePrice = '"'+res.res[key].ExpensePrice+'"';
              var ExpenseQuantity = '"'+res.res[key].ExpenseQuantity+'"';
              var ExpenseMethod = '"'+res.res[key].ExpenseMethod+'"';
              var ExpenseDate = '"'+res.res[key].ExpenseDate+'"';
              $("#report_div").append("<tr> <td>"+cnt+".</td> <td>"+res.res[key].ExpenseName+"</td> <td>"+Intl.NumberFormat().format(res.res[key].ExpensePrice)+"</td><td>"+Intl.NumberFormat().format(res.res[key].ExpenseQuantity)+"</td><td>"+res.res[key].ExpenseMethod+"</td> <td>"+res.res[key].ExpenseDate+"</td> <td><a class='btn btn-link' onclick='return updateExpenseModal("+res.res[key].ExpenseId+","+ExpenseName+","+ExpensePrice+","+ExpenseQuantity+","+ExpenseMethod+")'> Update </a> <a class='btn btn-danger' onclick='return deleteExpenses("+res.res[key].ExpenseId+")'>Delete</a></td> </tr>");
              cnt++;
            }
          }else{
            $("#report_div").html("<tr> <td colspan=5> No Stock available</td></tr>");
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
