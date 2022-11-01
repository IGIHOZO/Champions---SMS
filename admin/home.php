<?php require("../assets/header2.php");
if (!isset($_SESSION['sms_admin_id'])) {
echo "<script>window.location='../'</script>";
}
@require("../main/view.php");
$MainView = new MainView();
?>
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Version 3.0.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=number_format($MainView->AllProductsNumber())?></h3>

              <p>All Products</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="../admin/actions/register/product" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=number_format($MainView->AllStocksNumber())?><sup style="font-size: 20px"></sup></h3>

              <p>Available Branch Stocks</p>
            </div>
            <div class="icon">
              <i class="ion  ion-bag"></i>
            </div>
            <a href="../admin/actions/orient/branch" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=number_format($MainView->AllEmployeesNumber())?></h3>

              <p>Employees</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="../admin/actions/register/employee" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?=number_format($MainView->AllClientsNumber())?></h3>

              <p>Unique Clients</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="../admin/report/sales" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Daily Branch-Stock Sales Report</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-wrench"></i></button>
<!--                   <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul> -->
                </div>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                    <strong>Sales: <?= date("Y-M-D")?></strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="salesChart" style="height: 180px;"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <p class="text-center">
                    <strong>Categories products</strong>
                  </p>

                  <div class="progress-group">
                    <span class="progress-text">Electronics</span>
                    <span class="progress-number"><b><?=$MainView->ProductsCategoriesStatusRemaining('Electronics')?></b>/<?=$MainView->ProductsCategoriesStatusSold('Electronics')?></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width:<?= ($MainView->ProductsCategoriesStatusRemaining('Electronics')*100)/($MainView->ProductsCategoriesStatusSold('Electronics'))?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Furnitures</span>
                    <span class="progress-number"><b><?=$MainView->ProductsCategoriesStatusRemaining('Furnitures')?></b>/<?=$MainView->ProductsCategoriesStatusSold('Furnitures')?></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-red" style="width:<?= ($MainView->ProductsCategoriesStatusRemaining('Furnitures')*100)/($MainView->ProductsCategoriesStatusSold('Furnitures'))?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">IT</span>
                    <span class="progress-number"><b><?=$MainView->ProductsCategoriesStatusRemaining('IT')?></b>/<?=$MainView->ProductsCategoriesStatusSold('IT')?></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width:<?= ($MainView->ProductsCategoriesStatusRemaining('IT')*100)/($MainView->ProductsCategoriesStatusSold('IT'))?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Networking</span>
                    <span class="progress-number"><b><?=$MainView->ProductsCategoriesStatusRemaining('Networking')?></b>/<?=$MainView->ProductsCategoriesStatusSold('Networking')?></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-yellow" style="width:<?= ($MainView->ProductsCategoriesStatusRemaining('Networking')*100)/($MainView->ProductsCategoriesStatusSold('Networking'))?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Stetioneries</span>
                    <span class="progress-number"><b><?=$MainView->ProductsCategoriesStatusRemaining('Stetioneries')?></b>/<?=$MainView->ProductsCategoriesStatusSold('Stetioneries')?></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width:<?= ($MainView->ProductsCategoriesStatusRemaining('Stetioneries')*100)/($MainView->ProductsCategoriesStatusSold('Stetioneries'))?>%"></div>
                    </div>
                  </div>

                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Hardware</span>
                    <span class="progress-number"><b><?=$MainView->ProductsCategoriesStatusRemaining('Hardware')?></b>/<?=$MainView->ProductsCategoriesStatusSold('Hardware')?></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-red" style="width:<?= ($MainView->ProductsCategoriesStatusRemaining('Hardware')*100)/($MainView->ProductsCategoriesStatusSold('Hardware'))?>%"></div>
                    </div>
                  </div>

                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Others</span>
                    <span class="progress-number"><b><?=$MainView->ProductsCategoriesStatusRemaining('Others')?></b>/<?=$MainView->ProductsCategoriesStatusSold('Others')?></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-violet" style="width:<?= ($MainView->ProductsCategoriesStatusRemaining('Others')*100)/($MainView->ProductsCategoriesStatusSold('Others'))?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> <?=@round(($MainView->TotalImports()*100)/($MainView->TotalImports()+$MainView->TotalPurchases()+$MainView->TotalAllWarehouisesIn()+$MainView->TotalAllWarehouisesRemaining()))?>%</span>
                    <h5 class="description-header"><?=number_format($MainView->TotalImports())?> Record(s)</h5>
                    <span class="description-text">TOTAL IMPORT</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> <?=@round(($MainView->TotalPurchases()*100)/($MainView->TotalImports()+$MainView->TotalPurchases()+$MainView->TotalAllWarehouisesIn()+$MainView->TotalAllWarehouisesRemaining()))?>%</span>
                    <h5 class="description-header"><?=number_format($MainView->TotalPurchases())?> Record(s)</h5>
                    <span class="description-text">TOTAL PURCHASE</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> <?=@round(($MainView->TotalAllWarehouisesIn()*100)/($MainView->TotalImports()+$MainView->TotalPurchases()+$MainView->TotalAllWarehouisesIn()+$MainView->TotalAllWarehouisesRemaining()))?>%</span>
                    <h5 class="description-header"><?=number_format($MainView->TotalAllWarehouisesIn())?> Record(s)</h5>
                    <span class="description-text">TOTAL IN</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block">
                    <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> <?=@round(($MainView->TotalAllWarehouisesRemaining()*100)/($MainView->TotalImports()+$MainView->TotalPurchases()+$MainView->TotalAllWarehouisesIn()+$MainView->TotalAllWarehouisesRemaining()))?>%</span>
                    <h5 class="description-header"><?=number_format($MainView->TotalAllWarehouisesRemaining())?> Record(s)</h5>
                    <span class="description-text">Total Remaining</span>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-8">
          <!-- MAP & BOX PANE -->
 <!--  -->
          <!-- /.box -->
          <div class="row">
            <!-- /.col -->

            <div class="col-md-12">
              <!-- USERS LIST -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Employee Performance</h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger"><?=$MainView->CountEmployeesSellingOrder()?> Employees</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix" id="resp_empls">
                    <span id="resp_empls"></span>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="actions/register/employee" class="uppercase">View All Employees</a>
                </div>
                <!-- /.box-footer -->
              </div>
              <!--/.box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Products going down in stock   -   </h3>
              <h3 class="box-title" style="text-align: right;font-weight: bold;">BRANCH</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Item</th>
                    <th>Remaining</th>
                    <th>Category</th>
                    <th>Stock</th>
                  </tr>
                  </thead>
                  <tbody id="resp_tbl">
                    <!-- <span id="resp_tbl"> -->
<script type="text/javascript">
      var stockDown_Branch = true;
      $.ajax({url:"../main/view.php",
        type:"POST",data:{stockDown_Branch:stockDown_Branch},cache:false,success:function(res){  
          var res = JSON.parse(res);
          // console.log(res.found);
          if (res.found===1) {
            var cnt = 1;
            for (const key in res.res) {
              var stt='';
              var vall = parseInt(res.res[key].remaining);
              if (vall<=3) {
                stt = 'danger';
              }else if (vall<=10) {
                stt = 'warning';
              } if (vall<=20){
                stt = 'info';
              }else{
                stt = 'success';
              }
              $("#resp_tbl").append("<tr> <td>"+cnt+"</td> <td> "+res.res[key].product_name+"</td><td><span class='label label-"+stt+"'>"+res.res[key].remaining+"</span></td><td><div class='sparkbar' data-color='#782354' data-height='20'>"+res.res[key].category+"</div></td> <td> "+res.res[key].BranchName+"</td></tr>");
              cnt++;
            }
          }else{
            //$("#resp_pie").html("<tr> <td colspan=6> No Stock available</td></tr>");
          }
          }
      });
</script>

                    <!-- </span> -->

                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>

            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-md-4">
          <!-- Info Boxes Style 2 -->
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Products in Warehouse</span>
              <span class="info-box-number"><?=number_format($MainView->TotalAllWarehouisesRemaining())?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">
                    All products in all warehouses
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Head-Stock</span>
              <span class="info-box-number"><?=number_format($MainView->TotalAllHeadStockRemaining())?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">
                    All products in Head-Stock
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Branch-stock</span>
              <span class="info-box-number"><?=number_format($MainView->TotalAllBranchStockRemaining())?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">
                    All products in Branch stock
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Stock-Out</span>
              <span class="info-box-number"> <span style="font-weight:lighter;font-size: 13px;">#Rwf</span> <?=number_format($MainView->AllStockOut())?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 40%"></div>
              </div>
              <span class="progress-description">
                    All System Stockout Amount
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->


          <!-- /.box -->

          <!-- PRODUCT LIST -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Recently Registered Products</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                <span id="resp_recently">
                <script type="text/javascript">
                      var recently_registered_products = true;
                      $.ajax({url:"../main/view.php",
                        type:"POST",data:{recently_registered_products:recently_registered_products},cache:false,success:function(res){  
                          var res = JSON.parse(res);
                          // console.log(res.found);
                          if (res.found===1) {
                            var cnt = 1;
                            for (const key in res.res) {
                              $("#resp_recently").append("<li class='item'><div class='product-img'></div><div class='product-info'><a href='actions/register/product' class='product-title'>"+res.res[key].product_name+"<span class='label label-warning pull-right'>"+res.res[key].Category+"</span></a><span class='product-description'>Registed on : "+res.res[key].DateRegistered+"</span></div></li>");
                              cnt++;
                            }
                          }else{
                            //$("#resp_pie").html("<tr> <td colspan=6> No Stock available</td></tr>");
                          }
                          }
                      });
                </script>
                </span>

              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="actions/register/product" class="uppercase">View All Products</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>



        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

          <!-- Map box -->
          <div class="box box-solid bg-light-blue-gradient">


          <!-- /.box -->

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php require("../assets/footer.php");?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->

      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
<?php 
$labell = $_SESSION['available_warehouses_fo_label_chart'];
?>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="../bower_components/chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

<script type="text/javascript">






      var EmployeesSellingOrder = true;
      $.ajax({url:"../main/view.php",
        type:"POST",data:{EmployeesSellingOrder:EmployeesSellingOrder},cache:false,success:function(res){  
          var res = JSON.parse(res);
          // console.log(res.found);
          if (res.found===1) {
            var cnt = 1;
            for (const key in res.res) {
              // console.log(res.res[key]);
              $("#resp_empls").append("<li>  <a class='users-list-name' href='#'>"+res.res[key].EmployeeName+"</a>  <span class='users-list-date'>Sold &nbsp; <span style='font-weight:bolder'>"+res.res[key].sold+"</span>&nbsp; #Rwf</span></li>");
              cnt++;
            }
          }else{
            $("#resp_empls").html("<tr> <td colspan=6> No Stock available</td></tr>");
          }
          }
      });



  // -----------------------
  // - MONTHLY SALES CHART -
  // -----------------------
      var available_warehouses_fo_label_chart = true;
      var labelsContents = '';
      $.ajax({url:"../main/view.php",
        type:"POST",data:{available_warehouses_fo_label_chart:available_warehouses_fo_label_chart},cache:false,success:function(res){  
          var res = JSON.parse(res);
          // console.log(res.found);
          if (res.found===1) {
            labelsContents = res.respp.toString();
          }else{
            labelsContents = 'None';
            $("#report_div").html("<tr> <td colspan='3'> No warehouse available</td></tr>");
          }

  // Get context with jQuery - using jQuery's .get() method.
  var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
  // This will get the first returned node in the jQuery collection.
  var salesChart       = new Chart(salesChartCanvas);
  // console.log(<?=$labell?>);
  var salesChartData = {
    

    labels  : [<?=$labell?>],
    // labels  : ['Kabuga', 'Gisimenti', 'DownTown', 'Kacyiru', 'Rando', 'Gisozi-ULK', 'Sonatube'],
    datasets: [

      {
        label               : 'Electronics',
        fillColor           : 'rgb(210, 214, 222)',
        strokeColor         : 'rgb(210, 214, 222)',
        pointColor          : 'rgb(210, 214, 222)',
        pointStrokeColor    : 'rgb(210, 214, 222)',
        pointHighlightFill  : 'rgb(210, 214, 222)',
        pointHighlightStroke: 'rgb(210, 214, 222)',
        data                : [<?=$MainView->AllWarehouseQuantityPerCategory('Electronics',2)?>, <?=$MainView->AllWarehouseQuantityPerCategory('Electronics',1)?>, <?=$MainView->AllWarehouseQuantityPerCategory('Electronics',3)?>]
      },
      {
        label               : 'Furnitures',
        fillColor           : 'rgba(60,141,188,0.9)',
        strokeColor         : 'rgba(60,141,188,0.9)',
        pointColor          : 'rgba(60,141,188,0.9)',
        pointStrokeColor    : 'rgba(60,141,188,0.9)',
        pointHighlightFill  : 'rgba(60,141,188,0.9)',
        pointHighlightStroke: 'rgba(60,141,188,0.9)',
        data                : [<?=$MainView->AllWarehouseQuantityPerCategory('Furnitures',2)?>, <?=$MainView->AllWarehouseQuantityPerCategory('Furnitures',1)?>, <?=$MainView->AllWarehouseQuantityPerCategory('Furnitures',3)?>]
      },
      {
        label               : 'IT',
        fillColor           : 'rgba(rgba(80,30,200,0.9)',
        strokeColor         : 'rgba(rgba(80,30,200,0.9)',
        pointColor          : 'rgba(rgba(80,30,200,0.9)',
        pointStrokeColor    : 'rgba(rgba(80,30,200,0.9)',
        pointHighlightFill  : 'rgba(rgba(80,30,200,0.9)',
        pointHighlightStroke: 'rgba(rgba(80,30,200,0.9)',
        data                : [<?=$MainView->AllWarehouseQuantityPerCategory('IT',1)?>, <?=$MainView->AllWarehouseQuantityPerCategory('IT',1)?>, <?=$MainView->AllWarehouseQuantityPerCategory('IT',3)?>]
      },
      {
        label               : 'Networking',
        fillColor           : 'rgba(160,35,200,0.8)',
        strokeColor         : 'rgba(160,35,200,0.8)',
        pointColor          : 'rgba(160,35,200,0.8)',
        pointStrokeColor    : 'rgba(160,35,200,0.8)',
        pointHighlightFill  : 'rgba(160,35,200,0.8)',
        pointHighlightStroke: 'rgba(160,35,200,0.8)',
        data                : [<?=$MainView->AllWarehouseQuantityPerCategory('Networking',2)?>, <?=$MainView->AllWarehouseQuantityPerCategory('Networking',1)?>, <?=$MainView->AllWarehouseQuantityPerCategory('Networking',3)?>]
      },
      {
        label               : 'Digital Goods',
        fillColor           : 'rgba(46,234,123,0.9)',
        strokeColor         : 'rgba(46,234,123,0.9)',
        pointColor          : 'rgba(46,234,123,0.9)',
        pointStrokeColor    : 'rgba(46,234,123,0.9)',
        pointHighlightFill  : 'rgba(46,234,123,0.9)',
        pointHighlightStroke: 'rgba(46,234,123,0.9)',
        data                : [<?=$MainView->AllWarehouseQuantityPerCategory('Digital Goods',2)?>, <?=$MainView->AllWarehouseQuantityPerCategory('Digital Goods',1)?>, <?=$MainView->AllWarehouseQuantityPerCategory('Digital Goods',3)?>]
      },
      {
        label               : 'Stetioneries',
        fillColor           : 'rgba(100,141,18,0.9)',
        strokeColor         : 'rgba(100,141,18,0.9)',
        pointColor          : 'rgba(100,141,18,0.9)',
        pointStrokeColor    : 'rgba(100,141,18,0.9)',
        pointHighlightFill  : 'rgba(100,141,18,0.9)',
        pointHighlightStroke: 'rgba(100,141,18,0.9)',
        data                : [<?=$MainView->AllWarehouseQuantityPerCategory('Stetioneries',2)?>, <?=$MainView->AllWarehouseQuantityPerCategory('Stetioneries',1)?>, <?=$MainView->AllWarehouseQuantityPerCategory('Stetioneries',3)?>]
      },
      {
        label               : 'Hardware',
        fillColor           : 'rgba(234,47,76,0.9)',
        strokeColor         : 'rgba(234,47,76,0.9)',
        pointColor          : 'rgba(234,47,76,0.9)',
        pointStrokeColor    : 'rgba(234,47,76,0.9)',
        pointHighlightFill  : 'rgba(234,47,76,0.9)',
        pointHighlightStroke: 'rgba(234,47,76,0.9)',
        data                : [<?=$MainView->AllWarehouseQuantityPerCategory('Hardware',2)?>, <?=$MainView->AllWarehouseQuantityPerCategory('Hardware',1)?>, <?=$MainView->AllWarehouseQuantityPerCategory('Hardware',3)?>]
      },
      {
        label               : 'Others',
        fillColor           : 'rgba(10,200,178,0.9)',
        strokeColor         : 'rgba(10,200,178,0.9)',
        pointColor          : 'rgba(10,200,178,0.9)',
        pointStrokeColor    : 'rgba(10,200,178,0.9)',
        pointHighlightFill  : 'rgba(10,200,178,0.9)',
        pointHighlightStroke: 'rgba(10,200,178,0.9)',
        data                : [<?=$MainView->AllWarehouseQuantityPerCategory('Others',2)?>, <?=$MainView->AllWarehouseQuantityPerCategory('Others',1)?>, <?=$MainView->AllWarehouseQuantityPerCategory('Others',3)?>]
      }
    ]
  };

  var salesChartOptions = {
    // Boolean - If we should show the scale at all
    showScale               : true,
    // Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines      : false,
    // String - Colour of the grid lines
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    // Number - Width of the grid lines
    scaleGridLineWidth      : 1,
    // Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    // Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines  : true,
    // Boolean - Whether the line is curved between points
    bezierCurve             : true,
    // Number - Tension of the bezier curve between points
    bezierCurveTension      : 0.3,
    // Boolean - Whether to show a dot for each point
    pointDot                : false,
    // Number - Radius of each point dot in pixels
    pointDotRadius          : 4,
    // Number - Pixel width of point dot stroke
    pointDotStrokeWidth     : 1,
    // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius : 20,
    // Boolean - Whether to show a stroke for datasets
    datasetStroke           : true,
    // Number - Pixel width of dataset stroke
    datasetStrokeWidth      : 2,
    // Boolean - Whether to fill the dataset with a color
    datasetFill             : true,
    // String - A legend template
    legendTemplate          : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].lineColor%>\'></span><%=datasets[i].label%></li><%}%></ul>',
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio     : true,
    // Boolean - whether to make the chart responsive to window resizing
    responsive              : true
  };

  // Create the line chart
  salesChart.Line(salesChartData, salesChartOptions);

  // ---------------------------
  // - END MONTHLY SALES CHART -
  // ---------------------------




          }
      });




</script>
</body>
</html>
