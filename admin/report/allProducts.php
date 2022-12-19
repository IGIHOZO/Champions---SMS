<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("../../main/view.php");
@require("../../assets/header333.php");
?>
<script  type="text/javascript" src=" https://code.jquery.com/jquery-3.5.1.js"></script>

<!-- <link rel="stylesheet" type="text/css" href=" https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
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
        All Products Status
        <small>Stock</small>
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
              </span>
              <center><div id="report_div" style="text-align: center;margin: 0 auto">
              <button class="btn btn-success" style="font-weight: bolder;float:left;position:relative" onclick="return ExportToExcel()">Export Excel</button>
                <table class="table-bordered" id="respTale">
                  <thead  id="respp">
                  <?php
                    $sel = $con->prepare("SELECT * FROM warehouses WHERE warehouses.WarehouseStatus=1");
                    $sel->execute();
                    if ($sel->rowCount()>=1) {
                      echo "<th> #</th><th> Product</th>";
                      while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
                        echo "<th>".$ft_sel['WarehouseName']."</th>";
                      }
                    }
                    $sell = $con->prepare("SELECT * FROM branches WHERE branches.BranchStatus=1");
                    $sell->execute();
                    if ($sell->rowCount()>=1) {
                      while ($ft_sell = $sell->fetch(PDO::FETCH_ASSOC)) {
                        echo "<th>".$ft_sell['BranchName']."</th>";
                      }
                    }
                  ?>
                  </thead>
                  <tbody>
                    <?php 
                    $MainView = new MainView();
                    $sel = $con->prepare("SELECT * FROM products WHERE products.ProductSatatus=1");
                    $sel->execute();
                    if ($sel->rowCount()>=1) {
                      $cnt = 1;
                      while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                          echo "<td>$cnt</td><td>".$ft_sel['ProductName']."</td>";
                        $sell = $con->prepare("SELECT * FROM warehouses WHERE warehouses.WarehouseStatus=1");
                        $sell->execute();
                        if ($sell->rowCount()>=1) {
                          while ($ft_sell = $sell->fetch(PDO::FETCH_ASSOC)) {
                            $warehouse = $ft_sell['WarehouseId'];
                            echo "<td>".$MainView->WarehouseCertainProduct($warehouse, $ft_sel['ProductId'])."</td>";
                          }
                        }
                        $selll = $con->prepare("SELECT * FROM branches WHERE branches.BranchStatus=1");
                        $selll->execute();
                        if ($selll->rowCount()>=1) {
                          while ($ft_selll = $selll->fetch(PDO::FETCH_ASSOC)) {
                            $branch = $ft_selll['BranchId'];
                            echo "<td>".$MainView->BranckCertainProduct($branch, $ft_sel['ProductId'])."</td>";
                          }
                        }
                        echo "</tr>";
                        $cnt++;
                      }
                    }
                    ?>
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

<script  type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script  type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
 $(document).ready(function () {
    
});
</script>
<!-- jQuery 3 -->
<!-- <script src="../../bower_components/jquery/dist/jquery.min.   js"></script> -->
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
<!-- Page script -->
<script src="../../assets/js/main.js"></script>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

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
    $('#respTale').DataTable();

  });


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
