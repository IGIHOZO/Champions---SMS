<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("../../../assets/header4.php");
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Register New Stock
        <small>Stock Name</small>
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
      <div class="modal-dialog" style="min-width: 60%" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" style="font-weight: bold;font-size: 20px;" id="exampleModalLabel">Register New Stock</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="false">×</span>
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
                      <!-- Date dd/mm/yyyy -->
                      <div class="form-group">
                        <label>Sub-Stock Name:</label>
                        <div id="respp" style="font-weight: bold;display: none;text-align: center;"></div>
                        <br>
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                          </div>
                          <input type="text" class="form-control" placeholder="Write here ..." id="name">
                        </div>
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
                          <button class="btn btn-success" id="RegisterBranch">Register</button>

                        </div>
                        <a href="manager"  style="float:right;" class="btn btn-primary">Next</a>
                        <!-- /.input group -->
                      </div>
            </div>
          <!-- </form> -->
        </div>
      </div>
    </div>
    <!-- </section> -->



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
              <div class="row">
                <div class="col-md-9">
                  <div class="box" style="margin-left: 15%">
                    <div class="box-body">
                      <div class="form-group">
                        <label>Sub-Stock Name:</label>
                        <div id="respp" style="font-weight: bold;display: none;text-align: center;"></div>
                        <br>
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                          </div>
                          <input type="text" class="form-control" id="stockName">
                          <input type="hidden" class="form-control" id="stockNameID">

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
                          <button class="btn btn-success" id="UpdateBranchBtn">Update</button>
                        </div>
                      </div>
            </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box" style="margin-left: 0.5%">
            <div class="box-body">
              <button class="btn btn-success" style="font-weight: bolder;" onclick="return ExportToExcel()">Export Excel</button>
                <button style="float:right;" class="btn btn-primary" id="Next" data-toggle="modal" id="newGoalBtn" data-target="#newRequestModal">New Branch</button>
                <button data-toggle='modal' id='updateStockbtn' data-target='#UpdateStockModal' style='display: none;'></button>
              <center><div style="text-align: center;margin: 0 auto">
                <table class="table table-reaponsive" id="respTale">
                  <thead>
                    <th>
                      #
                    </th>
                    <th>
                      Branch
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
<?php require("../../../assets/footer.php");?>


  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script  type="text/javascript" src=" https://code.jquery.com/jquery-3.5.1.js"></script>

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
<script  type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script  type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
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
<script src="../../../assets/js/main.js"></script>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

<script>
function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('report_div');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('AvailableProducts.' + (type || 'xlsx')));
    }


function updateBranchModal(name,iid){
  // alert(name);
  document.getElementById("stockName").value=name;
  document.getElementById("stockNameID").value=iid;
  $("#updateStockbtn").click();
}
function deleteBranch(iid){
    var deleteBranch = true;
    $.ajax({url:"../../../main/action.php",
      type:"GET",data:{deleteBranch:deleteBranch,iid:iid},cache:false,success:function(res){
        if (res=='used') {
          alert("You can't delete a used Stock ...");
        }else{
          window.location.reload(true);
        }
      }
    });
}

  $(document).ready(function(){
      var available_branches = true;
      $.ajax({url:"../../../main/view.php",
        type:"POST",data:{available_branches:available_branches},cache:false,success:function(res){  
          var res = JSON.parse(res);
          console.log(res.found);
          if (res.found===1) {
            var cnt = 1;
            for (const key in res.res) {
              // console.log(res.res[key]);
              var nn = '"'+res.res[key].branch_name+'"';
              $("#report_div").append("<tr> <td>"+cnt+".</td> <td>"+res.res[key].branch_name+"</td> <td><button class='btn btn-link' onclick='return updateBranchModal("+nn+","+res.res[key].branch_id+")'> Update </button> <button class='btn btn-danger' onclick='return deleteBranch("+res.res[key].branch_id+")'>Delete</button></td> </tr>");
              cnt++;
            }
          }else{
            $("#report_div").html("<tr> <td colspan=2> No Stock available</td></tr>");
          }
          $('#respTale').DataTable();
          }
      });

$("#UpdateBranchBtn").click(function(){
  var newBrancName = $("#stockName").val();
  var branchId = $("#stockNameID").val();
  if (newBrancName!='') {
    var UpdateBranch = true;
    $.ajax({url:"../../../main/action.php",
      type:"GET",data:{UpdateBranch:UpdateBranch,branchId:branchId,newBrancName:newBrancName},cache:false,success:function(res){
        window.location.reload(true);
      }
    });
  }
});


});

</script>
</body>
</html>
