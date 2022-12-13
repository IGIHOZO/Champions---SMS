<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("../../../main/drive/config.php");
@require("../../../assets/header444.php");
?>
<link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />
<?php
function productIdFromName($product, $con){
    $sel = $con->prepare("SELECT * FROM products WHERE products.ProductName LIKE '%$product%' LIMIT 1");
    $sel->execute();
    if ($sel->rowCount()>=1) {
        $ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
        $pri_id = $ft_sel['ProductId'];
    }else{
        $pri_id = NULL;
    }
    return $pri_id;
}
function categoryIdFromName($category,$con){
    $sel = $con->prepare("SELECT * FROM productcategories WHERE productcategories.CategoryName LIKE '%$category%' LIMIT 1");
    $sel->execute();
    if ($sel->rowCount()>=1) {
        $ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
        $pri_id = $ft_sel['CategoryId'];
    }else{
        $pri_id = NULL;
    }
    return $pri_id;
}

function warehouseIdFromName($warehouse,$con){
    $sel = $con->prepare("SELECT * FROM warehouses WHERE warehouses.WarehouseName LIKE '%$warehouse%' LIMIT 1");
    $sel->execute();
    if ($sel->rowCount()>=1) {
        $ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
        $pri_id = $ft_sel['WarehouseId'];
    }else{
        $pri_id = NULL;
    }
    return $pri_id;
}
function UnitIdFromName($type){
    switch ($type) {
        case 'Single':
            $iid = 0;
            break;
        
        default:
            $iid = 1;
            break;
    }
    return $iid;
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Register New Product
        <small>Excel File Upload</small>
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
        <div style="margin: 0 7%!important;" class="col-md-10">
          <div class="box" style="margin-left: 0.5%">
            <div class="box-body">
              <!-- <button class="btn btn-success" style="font-weight: bolder;" onclick="return ExportToExcel()">Export Excel</button> -->
               
                  <!-- <button style="margin-left: 30%;font-weight: bold ;" class="btn btn-info">Download Sample & Guidelines</button> -->
    <h1 style=" float: justify;">Orient  to Warehouse by Uploading single excel file</h1>


    <form method="POST"    enctype="multipart/form-data">
        <div class="form-group">
            <label>Upload Excel File</label>
            <input type="file" name="file" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" name="Submit" class="btn btn-success">Upload</button>
        </div>






<?php


@require('../../../assets/ExcelUploads/php-excel-reader/excel_reader2.php');
@require('../../../assets/ExcelUploads/SpreadsheetReader.php');


if(isset($_POST['Submit'])){


  $mimes = ['application/vnd.ms-excel','text/xlsx','xlsx','text/xls','application/vnd.oasis.opendocument.spreadsheet'];
  if(in_array($_FILES["file"]["type"],$mimes)){


    $uploadFilePath = '../../../assets/ExcelUploads/uploads/'.basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath);


    $Reader = new SpreadsheetReader($uploadFilePath);


    $totalSheet = count($Reader->sheets());


    echo "<span style='font-size:20px'>You have total <span style='font-size:26px;color:green;font-weight:bolder'>".$totalSheet." </span>sheet(s)</span>".


    $html="<table class='table'>";
    $html.="<tr><th>Item Name</th><th>Category</th><th>Set-Type</th><th>Qnt Available</th><th>Warehouse</th></tr>";


    /* For Loop for all sheets */
    for($i=0;$i<$totalSheet;$i++){


      $Reader->ChangeSheet($i);

        $cnt = 0;
        $rrow = 1;
      foreach ($Reader as $Row)
      {
        
        $itemName = isset($Row[0]) ? (int)productIdFromName($Row[0],$con) : '';    //Product ID
        $itemcategory = isset($Row[1]) ? (int)categoryIdFromName($Row[1],$con) : ''; //Category
        $IsProductBox = isset($Row[2]) ? (int)UnitIdFromName($Row[2]) : '';  //UnityType
        $ProductQuantity = isset($Row[3]) ? (int)$Row[3] : ''; //Product Quantity
        $ProductBoxPieces = 1;  //Pieces
        $WarehouseId = isset($Row[0]) ? warehouseIdFromName($Row[4], $con) : ''; //Warehouse

        if ((productIdFromName($Row[0],$con)==NULL) OR (categoryIdFromName($Row[1],$con)==NULL) OR (warehouseIdFromName($Row[4], $con)==NULL)) {
          if ($rrow==1) {
            // echo "<br> productIdFromName: ".productIdFromName($Row[0],$con)."<br>";
            // echo "categoryIdFromName: ".categoryIdFromName($Row[1],$con)."<br>";
            // echo "ProductQuantity: ".$ProductQuantity."<br>";
            // echo "warehouseIdFromName: ".warehouseIdFromName($Row[4], $con)."<br>";
            ?>
            <center>
              <h4 style="color:brown;font-size: 30px;">Operation failed for: </h4>
              <hr>
            </center>
            <?php
          }
          echo "<ul>";
          if ( $ProductQuantity=="General") {
               echo "<li style='font-size:30px;'>Qnt Available on column <b style='color:red'>4</b> and Box_Pieces on column <b style='color:red'>5</b> must be <b><u>Number Cell Formated</u></b> </li> ";
          }
          if (productIdFromName($Row[0], $con)==NULL) {
            echo "<li style='font-size:30px;'>Item <b style='color:red'>".$Row[0]."</b> on row ".$rrow." not found </li> ";
          }
          if (categoryIdFromName($Row[1],$con)==NULL) {
            echo "<li style='font-size:30px;'>Category <b style='color:red'>".$Row[1]."</b> on row ".$rrow." not found </li> ";
          }
          if (UnitIdFromName($Row[2])) {
            echo "<li style='font-size:30px;'>Set-Type <b style='color:red'>".$Row[2]."</b> on row ".$rrow." not found </li> ";
          }
          if (warehouseIdFromName($Row[4], $con)==NULL) {
            echo "<li style='font-size:30px;'>Warehouse <b style='color:red'>".$Row[4]."</b> on row ".$rrow." not found </li>";
          }
          $rrow++;
          echo "</ul>";
          continue;
        }
        $html.="<tr>";
        $html.="<td>".$Row[0]."</td>";
        $html.="<td>".$Row[1]."</td>";
        $html.="<td>".$Row[2]."</td>";
        $html.="<td>".$Row[3]."</td>";
        // $html.="<td>".$Row[4]."</td>";
        $html.="<td>".$Row[4]."</td>";
        $html.="</tr>";

        // if ($ProductBoxPieces==0) {
        //   $ProductBoxPieces = NULL;
        // }


        $ins = $con->prepare("INSERT INTO mainstock(ProductId,IsProductBox,QuantityBefore,QuantityAdded,QuantityAfter,WarehouseId,InitialStock) VALUES(?,?,?,?,?,?,?)");
        $ins->bindValue(1,$itemName);
        $ins->bindValue(2,$IsProductBox);
        $ins->bindValue(3,0);
        if ($IsProductBox==1) {
            $addedd = $ProductQuantity*1;
            $after = $ProductQuantity*1;
        }else{
            $addedd = $ProductQuantity;
            $after = $ProductQuantity;
        }
            $ins->bindValue(4,($ProductQuantity));
            $ins->bindValue(5,($after));
            $ins->bindValue(6,($WarehouseId));
            $ins->bindValue(7,($ProductQuantity));
        $ok = $ins->execute();
        if ($ok) {
          $cnt++;
        }else{
         //   echo "<br />No";
            // print_r($ins->errorInfo());
            echo "Failed, try again later ...";
        }
        
       }
    }


    $html.="</table>";
    echo $html;
    echo "<span style='font-size:20px'> <span style='font-size:26px;color:green;font-weight:bolder'> ".$cnt. "</span> Data Recorded.</span>";

    echo "<center><br><a href='warehouse' class='btn btn-success' class='btn btn-success'>OK</a></center>"  ;
  }else { 
    die("<br/><p style='color:red;font-weight:bolder'>Sorry, File type is not allowed. Only Excel (.xls) file.</p>"); 
  }
?>
<script type="text/javascript">
// setTimeout(function(){
//             window.location.href = 'warehouse';
//          }, 20000);
</script>
<?php

}


?>









       <center> <p style="font-weight:bold;font-size:20px;">Download Sample & Guidelines File  <a href="../../../assets/ExcelUploads/GuideLines_WarehouseProducts_ChampionsTechSoft.zip"><strong style=" text-decoration: underline;">from here</strong></a>.</p></center>
    </form>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (right) -->
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
</body>
</html>
