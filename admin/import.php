<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("../assets/header2.php");
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Imports
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
            <h5 class="modal-title" style="font-weight: bold;font-size: 20px;" id="exampleModalLabel">Record Imports</h5>
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
                <label>Custom Station:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="text" class="form-control" id="CustomStation" placeholder="CustomStation here"> 
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group" id="product_idDiv">
                <label>Custom Declaration No:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="text" class="form-control" id="CustomDeclarationNo" placeholder="CustomDeclarationNo here"> 
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group" id="product_idDiv">
                <label>Custom Declaration Date:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="date" class="form-control" id="CustomDeclarationDate" placeholder="CustomDeclarationDate here"> 
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
                <label>Item Name:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="text" class="form-control" id="ItemName" placeholder="ItemName here"> 
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group" id="product_idDiv">
                <label>Custom Value:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="number" class="form-control" id="CustomValue" placeholder="CustomValue here"> 
                </div>
                <!-- /.input group -->
              </div>
                <!-- /.input group -->
              </div>
              <div class="form-group" id="product_idDiv">
                <label>VAT Paid:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="number" class="form-control" id="VATPaid" placeholder="VATPaid here"> 
                </div>
                <!-- /.input group -->
              </div>


              <div class="form-group">
        
                <div class="input-group">
                  <button class="btn btn-success" style="font-weight: bold;margin: 10px" id="SaveImports">Save</button>
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
                        </div>
                        <a href=""  style="float:right;" class="btn btn-default">Close</a>
                      </div>
            </div>
          <!-- </form> -->
        </div>
      </div>
    </div>

<!-- ================================================ UPDATE MODAL ====================================================== -->

<input type="hidden" id="importId">
<button id="openUpdateRequestModal" data-toggle="modal" data-target="#UpdateRequestModal" style="display: none;"></button>
    <div class="modal fade" id="UpdateRequestModal" tabindex="-1" role="dialog" aria-labelledby="UpdateRequestModalLabel" aria-hidden="false" sty>
      <div class="modal-dialog" style="min-width: 90%" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" style="font-weight: bold;font-size: 20px;" id="UpdateRequestModalLabel">Record Imports</h5>
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
                <label>Custom Station:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="text" class="form-control" id="updCustomStation" placeholder="CustomStation here"> 
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group" id="product_idDiv">
                <label>Custom Declaration No:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="text" class="form-control" id="updCustomDeclarationNo" placeholder="CustomDeclarationNo here"> 
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group" id="product_idDiv">
                <label>Custom Declaration Date:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="date" class="form-control" id="updCustomDeclarationDate" placeholder="CustomDeclarationDate here"> 
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
                <label>Item Name:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="text" class="form-control" id="updItemName" placeholder="ItemName here"> 
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group" id="product_idDiv">
                <label>Custom Value:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="number" class="form-control" id="updCustomValue" placeholder="CustomValue here"> 
                </div>
                <!-- /.input group -->
              </div>
                <!-- /.input group -->
              </div>
              <div class="form-group" id="product_idDiv">
                <label>VAT Paid:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <!-- <i class="fa fa-trophy"></i> -->
                  </div>
                  <input type="number" class="form-control" id="updVATPaid" placeholder="VATPaid here"> 
                </div>
                <!-- /.input group -->
              </div>


              <div class="form-group">
        
                <div class="input-group">
                  <button class="btn btn-success" style="font-weight: bold;margin: 10px" id="updSaveImports">Update</button>
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
                        </div>
                        <a href=""  style="float:right;" class="btn btn-default">Close</a>
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
                      Station
                    </th>
                    <th>
                      DeclarationNo
                    </th>
                    <th>
                      DeclarationDate
                    </th>
                    <th>
                      DeclarationDate
                    </th>
                    <th>
                      Value
                    </th>
                    <th>
                      VATPaid
                    </th>
                    <th>
                      RecordedDate
                    </th>
                    <th>
                      Actions
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
function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('respTale');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('Imports.' + (type || 'xlsx')));
    }



function updateImportModal(importId,updCustomStation,updCustomDeclarationNo,updCustomDeclarationDate,updItemName,updCustomValue,updVATPaid) {
  document.getElementById("importId").value=importId;

  document.getElementById("updCustomStation").value=updCustomStation;
  document.getElementById("updCustomDeclarationNo").value=updCustomDeclarationNo;
  document.getElementById("updCustomDeclarationDate").value=updCustomDeclarationDate;
  document.getElementById("updItemName").value=updItemName;
  document.getElementById("updCustomValue").value=updCustomValue;
  document.getElementById("updVATPaid").value=updVATPaid;
  $("#openUpdateRequestModal").click();
}

function deleteImports(idd) {
  var deleteImports = true;
    $.ajax({url:"../main/action.php",
      type:"POST",data:{deleteImports:deleteImports,idd:idd},cache:false,success:function(res){  
        window.location.reload();
        // console.log(res);
        }
    });
}


  $(document).ready(function(){

    $("#updSaveImports").click(function(){
    var importId = document.getElementById("importId").value;

    var updCustomStation = document.getElementById("updCustomStation").value;
    var updCustomDeclarationNo = document.getElementById("updCustomDeclarationNo").value;
    var updCustomDeclarationDate = document.getElementById("updCustomDeclarationDate").value;
    var updItemName = document.getElementById("updItemName").value;
    var updCustomValue = document.getElementById("updCustomValue").value;
    var updVATPaid = document.getElementById("updVATPaid").value;

      if (importId!='' && updCustomStation!='' && updCustomDeclarationNo!='' && updCustomDeclarationDate!='' && updItemName!='' && updCustomValue!='' && updVATPaid!='') {
          var updSaveImports = true;
            $.ajax({url:"../main/action.php",
              type:"POST",data:{updSaveImports:updSaveImports,importId:importId,updCustomStation:updCustomStation,updCustomDeclarationNo:updCustomDeclarationNo,updCustomDeclarationDate:updCustomDeclarationDate,updItemName:updItemName,updCustomValue:updCustomValue,updVATPaid:updVATPaid},cache:false,success:function(res){  
                window.location.reload();
                // console.log(res);
                }
            });

      }else{
        alert("Fill all fields ...");
      }
    })

      var AllImports = true;
      $.ajax({url:"../main/view.php",
        type:"POST",data:{AllImports:AllImports},cache:false,success:function(res){  
          var res = JSON.parse(res);
          console.log(res.found);
          if (res.found===1) {
            var cnt = 1;
            for (const key in res.res) {
              var CustomStation = '"'+res.res[key].CustomStation+'"';
              var CustomDeclarationNo = '"'+res.res[key].CustomDeclarationNo+'"';
              var CustomDeclarationDate = '"'+res.res[key].CustomDeclarationDate+'"';
              var ItemName = '"'+res.res[key].ItemName+'"';
              var CustomValue = '"'+res.res[key].CustomValue+'"';
              var VATPaid = '"'+res.res[key].VATPaid+'"';
              var ImportDate = '"'+res.res[key].ImportDate+'"';
              $("#report_div").append("<tr> <td>"+cnt+".</td> <td>"+res.res[key].CustomStation+"</td> <td>"+res.res[key].CustomDeclarationNo+"</td><td>"+res.res[key].CustomDeclarationDate+"</td><td>"+res.res[key].ItemName+"</td> <td>"+Intl.NumberFormat().format(res.res[key].CustomValue)+"</td> <td>"+Intl.NumberFormat().format(res.res[key].VATPaid)+"</td> <td>"+res.res[key].ImportDate+"</td> <td><a class='btn btn-link' onclick='return updateImportModal("+res.res[key].ImportId+","+CustomStation+","+CustomDeclarationNo+","+CustomDeclarationDate+","+ItemName+","+CustomValue+","+VATPaid+")'> Update </a> <a class='btn btn-danger' onclick='return deleteImports("+res.res[key].ImportId+")'>Delete</a></td> </tr>");
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
