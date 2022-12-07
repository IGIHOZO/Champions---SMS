<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("../../../main/drive/config.php");
@require("../../../assets/header444.php");

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
function categoryIdFromName($category, $con){
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
function branchStockIdFromName($branch,$con){
    $sel = $con->prepare("SELECT * FROM branches WHERE branches.BranchName LIKE '%$branch%' LIMIT 1");
    $sel->execute();
    if ($sel->rowCount()>=1) {
        $ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
        $pri_id = $ft_sel['BranchId'];
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
        <li><a href="#">Branch</a></li>
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
    <h1 style=" float: justify;">Orient  to Branch by Uploading single excel file</h1>


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
    $html.="<tr><th>Stock</th><th>Item Name</th><th>Set Type</th><th>Qnt Available</th><th>Warehouse</th></tr>";


    /* For Loop for all sheets */
    for($i=0;$i<$totalSheet;$i++){


      $Reader->ChangeSheet($i);

        $cnt = 0;
        $rrow = 1;
      foreach ($Reader as $Row)
      {
        
        $WarehouseId = isset($Row[0]) ? (int)warehouseIdFromName($Row[0], $con) : ''; //Warehouse
        $branchStock = isset($Row[1]) ? (int)branchStockIdFromName($Row[1],$con) : '';    //Stock
        $ProductId = isset($Row[2]) ? (int)productIdFromName($Row[2],$con) : ''; //Item
        $UnitType = isset($Row[3]) ? UnitIdFromName($Row[3]) : ''; //Box_Type
        $Quantity = isset($Row[4]) ? (int)$Row[4] : '';  //Quantity
        $BoxPieces = 1; //Box Pieces

        if (warehouseIdFromName($Row[0], $con)==NULL OR branchStockIdFromName($Row[1],$con)==NULL OR productIdFromName($Row[2],$con)==NULL) {
          if ($rrow==1) {
            // echo "<h4 style='color:brown;font-size: 30px;'>Operation failed for: </h4> <hr>";
            // echo "warehouseIdFromName: ".warehouseIdFromName($Row[0], $con);
            // echo "<br>branchStockIdFromName: ".branchStockIdFromName($Row[1], $con);
            // echo "<br>productIdFromName: ".productIdFromName($Row[2], $con)."<br>";
          }
          echo "<ul>";
          if (branchStockIdFromName($Row[1], $con)==NULL) {
            echo "<li style='font-size:30px;'>Stock <b style='color:red'>".$Row[1]."</b> on row ".$rrow." not found </li> ";
          }
          if (productIdFromName($Row[2],$con)==NULL) {
            echo "<li style='font-size:30px;'>Item <b style='color:red'>".$Row[2]."</b> on row ".$rrow." not found </li> ";
          }
          if (warehouseIdFromName($Row[0], $con)==NULL) {
            echo "<li style='font-size:30px;'>Warehouse <b style='color:red'>".$Row[0]."</b> on row ".$rrow." not found </li>";
          }
          $rrow++;
          echo "</ul>";
          continue;
        }
        $html.="<tr>";
        $html.="<td>".$Row[1]."</td>";
        $html.="<td>".$Row[2]."</td>";
        // $html.="<td>".$Row[2]."</td>";
        $html.="<td>".$Row[3]."</td>";
        $html.="<td>".$Row[4]."</td>";
        $html.="<td>".$Row[0]."</td>";
        // $html.="<td>".$Row[6]."</td>";
        $html.="</tr>";

        // if ($BoxPieces==0) {
        //   $BoxPieces = NULL;
        // }
        $branch_id = $branchStock;
        $warehouseId = $WarehouseId;
        $IsProductBox = $UnitType;
        $ProductPrice = 100;

        // $MainFunctions = new MainFunctions();
        $session_user_id = $_SESSION['sms_admin_id'];
        $pro_added = $BoxPieces;
        $added = $Quantity;
        switch ($UnitType) {
          case 1:
            $added *= $pro_added;
            break;
          
          default:
            $added = $added;
            break;
        }
        // $con = parent::connect();
        $sel_qnty_in_head = $con->prepare("SELECT * FROM mainstock WHERE mainstock.ProductId='$ProductId' AND  mainstock.WarehouseId='$warehouseId'");
        $sel_qnty_in_head->execute();
        if ($sel_qnty_in_head->rowCount()>=1) {
          $ft_sel_qnty_in_head = $sel_qnty_in_head->fetch(PDO::FETCH_ASSOC);
          if ($added>$ft_sel_qnty_in_head["QuantityAfter"]) {
            // $response = "not_enough";
          }else{
            $sel_pro = $con->prepare("SELECT * FROM products WHERE products.ProductId='$ProductId'");
            $sel_pro->execute();
            if ($sel_pro->rowCount()==1) {
              $ft_sel_pro = $sel_pro->fetch(PDO::FETCH_ASSOC);
    
              $sel_branch = $con->prepare("SELECT * FROM mainstock WHERE mainstock.ProductId='$ProductId' AND  mainstock.WarehouseId='$warehouseId'");
              $sel_branch->execute();
              if ($sel_branch->rowCount()>=1) {
                $ft_sel_branch = $sel_branch->fetch(PDO::FETCH_ASSOC);
                $con->beginTransaction();
                //======= update mainstock
                $upd_head_stock = $con->prepare("UPDATE mainstock SET mainstock.QuantityAdded=(0-$added),mainstock.QuantityBefore=mainstock.QuantityAfter,mainstock.QuantityAfter=(mainstock.QuantityAfter-$added) WHERE mainstock.ProductId='$ProductId' AND  mainstock.WarehouseId='$warehouseId'");
                $ok_upd_head_stock = $upd_head_stock->execute();
                if ($ok_upd_head_stock) {
                  //select in branchstock
                  $sbr = $con->prepare("SELECT * FROM branchstock WHERE branchstock.BranchId=? AND branchstock.ProductId=?");
                  $sbr->bindValue(1,$ProductId);
                  $sbr->bindValue(2,$branch_id);
                  $sbr->execute();
                  if ($sbr->rowCount()>=1) {
                    //====== UPDATE branchstock
                    $upd_branch_stock = $con->prepare("UPDATE branchstock SET branchstock.QuantityBefore=branchstock.QuantityAfter, branchstock.QuantityAdded='$added',branchstock.QuantityAfter=(branchstock.QuantityAfter+$added),branchstock.EmployeeUpdated='$session_user_id',branchstock.AllIn=(branchstock.AllIn+$added) WHERE branchstock.ProductId='$ProductId' AND branchstock.BranchId='$branch_id'");
                    $ok_upd_branch_stock = $upd_branch_stock->execute();
                    if ($ok_upd_branch_stock) {
                      $con->commit();
                      // $response = "success";
                      $cnt++;
                      // $cnt++;
                      // $MainFunctions->SaveStockTransaction($ProductId,$session_user_id,1,2,$IsProductBox,$ft_sel_qnty_in_head["QuantityAfter"],(0-$added),($ft_sel_qnty_in_head["QuantityAfter"]-$added));
                      // $MainFunctions->SaveStockTransaction($ProductId,$session_user_id,2,3,$IsProductBox,$ft_sel_branch['QuantityAfter'],$added,($ft_sel_branch['QuantityAfter']+$added));
                    }else{
                      $con->rollback();
                      // $response='failed';
                    }
                  }else{
                    //  == insert into BranchStock
                    $ins_branch_stock = $con->prepare("INSERT INTO branchstock(BranchId,ProductId,IsProductBox,ProductPrice,QuantityBefore,QuantityAdded,QuantityAfter,EmployeeUpdated,InitialStock) VALUES(?,?,?,?,?,?,?,?,?)");
                    $ins_branch_stock->bindValue(1,$branch_id);
                    $ins_branch_stock->bindValue(2,$ProductId);
                    $ins_branch_stock->bindValue(3,$IsProductBox);
                    $ins_branch_stock->bindValue(4,$ProductPrice);
                    $ins_branch_stock->bindValue(5,0);
                    $ins_branch_stock->bindValue(6,0);
                    $ins_branch_stock->bindValue(7,$added);
                    $ins_branch_stock->bindValue(8,$session_user_id);
                    $ins_branch_stock->bindValue(9,$added);
                    $ok_ins_branch_stock = $ins_branch_stock->execute();
                    if ($ok_ins_branch_stock) {
                      $con->commit();
                      // $response = "success";
                      $cnt++;
                      // $cnt++;
                      // $MainFunctions->SaveStockTransaction($ProductId,$session_user_id,1,2,$IsProductBox,$ft_sel_qnty_in_head["QuantityAfter"],(0-$added),($ft_sel_qnty_in_head["QuantityAfter"]-$added));
                      // $MainFunctions->SaveStockTransaction($ProductId,$session_user_id,2,3,$IsProductBox,0,$added,$added);
                    }else{
                      $con->rollback();
                      // $response = "failed";
                      print_r($ins_branch_stock->errorInfo());
                    }
                  }
                }else{
                  $con->rollback();
                  // $response = "failed";
                }
              }else{
                //============ INSERT NEEW RECORDS IN branchstock
                //  == update HeadStock
                $con->beginTransaction();
                $up_head_stock = $con->prepare("UPDATE mainstock SET mainstock.QuantityAdded=(0-$added),mainstock.QuantityBefore=mainstock.QuantityAfter,mainstock.QuantityAfter=(mainstock.QuantityAfter-$added) WHERE mainstock.ProductId='$ProductId' AND  mainstock.WarehouseId='$warehouseId'");
                $ok_up_head_stock = $up_head_stock->execute();
                if ($ok_up_head_stock) {
                  //  == insert into BranchStock
                  $ins_branch_stock = $con->prepare("INSERT INTO branchstock(BranchId,ProductId,IsProductBox,ProductPrice,QuantityBefore,QuantityAdded,QuantityAfter,EmployeeUpdated,InitialStock) VALUES(?,?,?,?,?,?,?,?,?)");
                  $ins_branch_stock->bindValue(1,$branch_id);
                  $ins_branch_stock->bindValue(2,$ProductId);
                  $ins_branch_stock->bindValue(3,$IsProductBox);
                  $ins_branch_stock->bindValue(4,$ProductPrice);
                  $ins_branch_stock->bindValue(5,0);
                  $ins_branch_stock->bindValue(6,0);
                  $ins_branch_stock->bindValue(7,$added);
                  $ins_branch_stock->bindValue(8,$session_user_id);
                  $ins_branch_stock->bindValue(9,$added);
                  $ok_ins_branch_stock = $ins_branch_stock->execute();
                  if ($ok_ins_branch_stock) {
                    $con->commit();
                    // $response = "success";
                    $cnt++;
                    // $cnt++;
                    $MainFunctions->SaveStockTransaction($ProductId,$session_user_id,1,2,$IsProductBox,$ft_sel_qnty_in_head["QuantityAfter"],(0-$added),($ft_sel_qnty_in_head["QuantityAfter"]-$added));
                    $MainFunctions->SaveStockTransaction($ProductId,$session_user_id,2,3,$IsProductBox,0,$added,$added);
                  }else{
                    $con->rollback();
                    // $response = "failed";
                    print_r($ins_branch_stock->errorInfo());
                  }
                }else{
                  $con->rollback();
                  // $response = "failed";
                }
              }
            }else{
              // $response = "failed";
            }
          }
        }else{
          // $response = "failed";
        }
        // echo $response; 


       }
    }


    $html.="</table>";
    echo $html;
    echo "<span style='font-size:20px'> <span style='font-size:26px;color:green;font-weight:bolder'> ".$cnt. "</span> Data Recorded.</span>";

    echo "<center><br><a href='branch' class='btn btn-success' class='btn btn-success'>OK</a></center>"  ;
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









       <center> <p style="font-weight:bold;font-size:20px;">Download Sample & Guidelines File  <a href="../../../assets/ExcelUploads/GuideLinesForBranchProducts_Champions.zip"><strong style=" text-decoration: underline;">from here</strong></a>.</p></center>
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
