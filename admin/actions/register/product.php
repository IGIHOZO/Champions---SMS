<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("../../../assets/header4.php");

?>
<script  type="text/javascript" src=" https://code.jquery.com/jquery-3.5.1.js"></script>

<!-- <link rel="stylesheet" type="text/css" href=" https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="../../../bower_components/jquery/dist/jquery.min.js"></script>


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
        Register New Product
        <small>PRODUCT</small>
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
              <a class="btn btn-success" style="font-weight: bolder;" onclick="return ExportToExcel()">Export Excel</a>
               
                  <a href="ProductUpload" style="margin-left: 30%;font-weight: bold ;" class="btn btn-info">Import List From Excel File</a>
              
                <a style="float:right;" class="btn btn-primary" id="Next" data-toggle="modal" id="newGoalBtn" data-target="#newRequestModal">New Product</a>

              <center><div style="text-align: center;margin: 0 auto">
                <table class="table table-responsive" id="respTale" style="width:100%">
                  <thead>
                    <th>
                      #
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
                      Box_Pieces
                    </th>
                    <th>
                      Date Ragistered
                    </th>
                    <tbody id="report_div">
<script type="text/javascript">
 
      var AllProducts = true;
      $.ajax({url:"../../../main/view.php",
        type:"POST",data:{AllProducts:AllProducts},cache:false,success:function(res){  
          var res = JSON.parse(res);
          console.log(res.found);
          if (res.found===1) {
            var cnt = 1;
            for (const key in res.res) {
              // console.log(res.res[key]);
              $("#report_div").append("<tr> <td>"+cnt+".</td> <td>"+res.res[key].ProductName+"</td> <td>"+res.res[key].ProductCategory+"</td><td>"+res.res[key].IsProductBox+"</td> <td>"+res.res[key].ProductBoxPieces+"</td><td>"+res.res[key].ProductDate+"</td> </tr>");
              cnt++;
            }
          }else{
            $("#report_div").html("<tr> <td colspan=6> No Stock available</td></tr>");
          }
          }
      });
</script>
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
    <div class="modal fade" id="newRequestModal" tabindex="-1" role="dialog" aria-labelledby="newRequestModalLabel" aria-hidden="false" sty>
      <div class="modal-dialog" style="min-width: 60%" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" style="font-weight: bold;font-size: 20px;" id="exampleModalLabel">Register New Product</h5>
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
              <div id="respp" style="font-weight: bold;display: none;text-align: center;"></div>
              <!-- Date dd/mm/yyyy -->
              <div class="form-group">
                <label>Product Name:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-trophy"></i>
                  </div>
                  <input type="text" class="form-control" placeholder="Product name" id="name">
                </div>

              </div>
              <div class="form-group">
                <label>Product Category
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-shopping-cart"></i>
                  </div>
                  <select style="width: 100%!important;" class="form-control" id="category" style="font-weight: lighter;"></select>
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <label>Phone Unit type:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <select class="form-control" id="IsProductBox">
                    <option value="0" selected>Piece</option>
                    <option value="1">Box</option>
                  </select>
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group" id="ProductBoxPiecesDiv" style="display: none;">
                <label>Pieces per Box:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="number" class="form-control" placeholder="Number of pieces per box:" id="ProductBoxPieces">
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
                  <button class="btn btn-success" style="font-weight: bold;" id="RegisterNewProduct">Register</button>
                </div>
                <a href="../orient/warehouse" style="float:right;" class="btn btn-primary" id="Next">Next</a>

                <!-- /.input group -->
              </div>
            </div>
          <!-- </form> -->

        </div>
      </div>
    </div>
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
<script  type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script  type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
 $(document).ready(function () {
    $('#respTale').DataTable();
});
</script>
<!-- jQuery 3 -->
<!-- <script src="../../../bower_components/jquery/dist/jquery.min.   js"></script> -->
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
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>



<script>

function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('report_div');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('AvailableProducts.' + (type || 'xlsx')));
    }




  $(document).ready(function(){

      var available_categories = true;
      $.ajax({url:"../../../main/view.php",
        type:"POST",data:{available_categories:available_categories},cache:false,success:function(res){  
          var res = JSON.parse(res);
          console.log(res.found);
          if (res.found===1) {
            for (const key in res.res) {
              // console.log(res.res[key]);
              $("#category").append("<option value='"+res.res[key].catogory_id+"'>"+res.res[key].catogory_name+"</option>");
            }
          }else{
            $("#category").html("<option value=''>No category available</option>");
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
