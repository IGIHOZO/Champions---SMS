<?php 
require("main_funcs.php");

/**
* =============================================== MAIN VIEW CLASS 
*/


class MainView extends DBConnect
{

	public function available_branches()		//================================= SELECT AVAILABLE BRANCHES
	{
		$con = parent::connect();
		$sel = $con->prepare("SELECT * FROM branches WHERE branches.BranchStatus=1 order by branches.BranchName");
		$sel->execute();
		$arr = [];
		if ($sel->rowCount()>=1) {
			$cnt = 0;
			while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
				$arr['found'] = 1;
				$arr['res'][$cnt]['branch_id'] = $ft_sel['BranchId'];
				$arr['res'][$cnt]['branch_name'] = $ft_sel['BranchName'];
				$cnt++;
			}
		}else{
			$arr['found'] = 0;
		}
		return print(json_encode($arr));
	}

	public function available_warehouses()		//================================= SELECT AVAILABLE BRANCHES
	{
		$con = parent::connect();
		$sel = $con->prepare("SELECT * FROM warehouses WHERE warehouses.WarehouseStatus=1 order by warehouses.WarehouseName");
		$sel->execute();
		$arr = [];
		if ($sel->rowCount()>=1) {
			$cnt = 0;
			while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
				$arr['found'] = 1;
				$arr['res'][$cnt]['warehouse_id'] = $ft_sel['WarehouseId'];
				$arr['res'][$cnt]['warehouse_name'] = $ft_sel['WarehouseName'];
				$cnt++;
			}
		}else{
			$arr['found'] = 0;
		}
		return print(json_encode($arr));
	}

	public function available_warehouses_fo_label_chart()		//================================= SELECT AVAILABLE BRANCHES
	{
		$con = parent::connect();
		$sel = $con->prepare("SELECT * FROM warehouses WHERE warehouses.WarehouseStatus=1 order by warehouses.WarehouseName");
		$sel->execute();
		$arr = [];
		if ($sel->rowCount()>=1) {
			$arr['found'] = 1;
			$respp = '';
			$cc = 0;
			while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
				
				if ($cc==0) {
					$respp = "'".$ft_sel['WarehouseName']."'";
				}else{
					$respp = $respp.",  '".$ft_sel['WarehouseName']."'";
				}
				$_SESSION['available_warehouses_fo_label_chart'] = $respp;
				$cc++;
			}

			$arr['respp'] =  (string) $respp;
		}else{
			$arr['found'] = 0;
		}
		return print(json_encode($arr));
	}


	public function available_categories()		//================================= SELECT AVAILABLE CATEGORIES
	{
		$con = parent::connect();
		$sel = $con->prepare("SELECT * FROM productcategories WHERE productcategories.CategoryStatus=1 order by productcategories.CategoryName");
		$sel->execute();
		$arr = [];
		if ($sel->rowCount()>=1) {
			$cnt = 0;
			while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
				$arr['found'] = 1;
				$arr['res'][$cnt]['catogory_id'] = $ft_sel['CategoryId'];
				$arr['res'][$cnt]['catogory_name'] = $ft_sel['CategoryName'];
				$cnt++;
			}
		}else{
			$arr['found'] = 0;
		}
		return print(json_encode($arr));
	}

	public function available_products()		//================================= SELECT AVAILABLE PRODUCTS
	{
		$con = parent::connect();
		$sel = $con->prepare("SELECT * FROM products WHERE products.ProductSatatus=1 order by products.ProductName");
		$sel->execute();
		$arr = [];
		if ($sel->rowCount()>=1) {
			$cnt = 0;
			while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
				$arr['found'] = 1;
				$arr['res'][$cnt]['product_id'] = $ft_sel['ProductId'];
				$arr['res'][$cnt]['product_name'] = $ft_sel['ProductName'];
				$cnt++;
			}
		}else{
			$arr['found'] = 0;
		}
		return print(json_encode($arr));
	}

	public function recently_registered_products()		//================================= SELECT AVAILABLE PRODUCTS
	{
		$con = parent::connect();
		$sel = $con->prepare("SELECT * FROM products,productcategories WHERE productcategories.CategoryId=products.ProductCategory AND products.ProductSatatus=1 order by products.ProductId DESC LIMIT 5");
		$sel->execute();
		$arr = [];
		if ($sel->rowCount()>=1) {
			$cnt = 0;
			while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
				$arr['found'] = 1;
				$arr['res'][$cnt]['Category'] = $ft_sel['CategoryName'];
				$arr['res'][$cnt]['DateRegistered'] = substr($ft_sel['ProductDate'], 0,16);
				$arr['res'][$cnt]['product_name'] = $ft_sel['ProductName'];
				$cnt++;
			}
		}else{
			$arr['found'] = 0;
		}
		return print(json_encode($arr));
	}

	public function available_products_in_main_stock()		//================================= SELECT AVAILABLE PRODUCTS IN MAIN-STOCK (so that they can be oriented to HEAD-STOCK)
	{
		$con = parent::connect();
		$sel = $con->prepare("SELECT * FROM products,mainstock WHERE products.ProductId=mainstock.ProductId AND products.ProductSatatus=1 order by products.ProductName");
		$sel->execute();
		$arr = [];
		if ($sel->rowCount()>=1) {
			$cnt = 0;
			while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
				$arr['found'] = 1;
				$arr['res'][$cnt]['product_id'] = $ft_sel['ProductId'];
				$arr['res'][$cnt]['product_name'] = $ft_sel['ProductName'];
				$cnt++;
			}
		}else{
			$arr['found'] = 0;
		}
		return print(json_encode($arr));
	}

	public function available_products_in_head_stock()		//================================= SELECT AVAILABLE PRODUCTS IN HEAD-STOCK (so that they can be oriented to BRANCH-STOCK)
	{
		$con = parent::connect();
		$sel = $con->prepare("SELECT * FROM products,headstock WHERE products.ProductId=headstock.ProductId AND products.ProductSatatus=1 order by products.ProductName");
		$sel->execute();
		$arr = [];
		if ($sel->rowCount()>=1) {
			$cnt = 0;
			while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
				$arr['found'] = 1;
				$arr['res'][$cnt]['product_id'] = $ft_sel['ProductId'];
				$arr['res'][$cnt]['product_name'] = $ft_sel['ProductName'];
				$cnt++;
			}
		}else{
			$arr['found'] = 0;
		}
		return print(json_encode($arr));
	}

	public function available_products_in_branch_stock()		//================================= SELECT AVAILABLE PRODUCTS IN Branch-STOCK 
	{
		$branch_id = $_SESSION['sms_user_branch_id'];
		$con = parent::connect();
		$sel = $con->prepare("SELECT * FROM products,branchstock WHERE products.ProductId=branchstock.ProductId AND branchstock.BranchId='$branch_id' AND products.ProductSatatus=1 order by products.ProductName");
		$sel->execute();
		$arr = [];
		if ($sel->rowCount()>=1) {
			$cnt = 0;
			while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
				$arr['found'] = 1;
				$arr['res'][$cnt]['product_id'] = $ft_sel['ProductId'];
				$arr['res'][$cnt]['product_name'] = $ft_sel['ProductName'];
				$cnt++;
			}
		}else{
			$arr['found'] = $branch_id;
		}
		return print(json_encode($arr));
	}

	public function stockDown_Branch()		//================================= SELECT AVAILABLE PRODUCTS IN Branch-STOCK 
	{
		$con = parent::connect();
		$sel = $con->prepare("SELECT ((InitialStock+AllIn)-AllOut) AS remaining,BranchName,productcategories.CategoryName AS CategoryName,products.* FROM products,branchstock,productcategories,branches WHERE products.ProductId=branchstock.ProductId AND productcategories.CategoryId=products.ProductCategory AND branchstock.BranchId=branches.BranchId AND products.ProductSatatus=1 ORDER BY ((InitialStock+AllIn)-AllOut) ASC LIMIT 20");
		$sel->execute();
		$arr = [];
		if ($sel->rowCount()>=1) {
			$cnt = 0;
			while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
				$arr['found'] = 1;
				$arr['res'][$cnt]['remaining'] = $ft_sel['remaining'];
				$arr['res'][$cnt]['category'] = $ft_sel['CategoryName'];
				$arr['res'][$cnt]['product_name'] = $ft_sel['ProductName'];
				$arr['res'][$cnt]['BranchName'] = $ft_sel['BranchName'];
				$cnt++;
			}
		}else{
			$arr['found'] = 0;
		}
		return print(json_encode($arr));
	}

	public function GeneralSallesReport()			//====================================== OVERALL SALES REPORT
	{
		$con = parent::connect();
		$sel = $con->prepare("SELECT * FROM branches WHERE branches.BranchStatus=1");
		$sel->execute();
		$arr = [];
		if ($sel->rowCount()>=1) {
			$cnt = 0;
			while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
				$arr['found'] = 1;
				$arr['res'][$cnt]['branch_name'] = $ft_sel['BranchName'];
				$branch = $ft_sel['BranchId'];
				$ssel = $con->prepare("SELECT * FROM employees,products,branches,stockout WHERE branches.BranchId=stockout.BranchId AND products.ProductId=stockout.ProductId AND employees.EmployeesId=stockout.EmployeeId AND stockout.BranchId='$branch'");
				$ssel->execute();
				if ($ssel->rowCount()>=1) {
					$arr['res'][$cnt]['is_found'] = 1;
					$ccnntt = 0;
					while ($ft_ssel = $ssel->fetch(PDO::FETCH_ASSOC)) {
						$arr['res'][$cnt]['data'][$ccnntt]['product_id'] = $ft_ssel['ProductId'];
						$arr['res'][$cnt]['data'][$ccnntt]['product_name'] = $ft_ssel['ProductName'];
						$arr['res'][$cnt]['data'][$ccnntt]['employee_name'] = $ft_ssel['EmployeeNames'];
						$arr['res'][$cnt]['data'][$ccnntt]['IsProductBox'] = $ft_ssel['IsProductBox'];
						$arr['res'][$cnt]['data'][$ccnntt]['ProductBoxPieces'] = $ft_ssel['ProductBoxPieces'];
						$arr['res'][$cnt]['data'][$ccnntt]['StoskOut_IsProductBox'] = $ft_ssel['IsProductBox'];
						$arr['res'][$cnt]['data'][$ccnntt]['ExpectedPrice'] = $ft_ssel['ExpectedPrice'];
						$arr['res'][$cnt]['data'][$ccnntt]['SoldPrice'] = $ft_ssel['SoldPrice'];
						$arr['res'][$cnt]['data'][$ccnntt]['QuantitySold'] = $ft_ssel['QuantitySold'];
						$arr['res'][$cnt]['data'][$ccnntt]['PaymentMethod'] = $ft_ssel['PaymentMethod'];
						$arr['res'][$cnt]['data'][$ccnntt]['PaymentWay'] = $ft_ssel['PaymentWay'];
						if ($ft_ssel['CompanyName']==NULL) {
							$ft_ssel['CompanyName'] = '-';
						}
						$arr['res'][$cnt]['data'][$ccnntt]['ClientName'] = $ft_ssel['ClientName'];
						$arr['res'][$cnt]['data'][$ccnntt]['CompanyName'] = $ft_ssel['CompanyName'];
						$arr['res'][$cnt]['data'][$ccnntt]['StockOutDate'] = $ft_ssel['StockOutDate'];
						$ccnntt++;
					}
				}else{
					// $arr['is_found'][$cnt] = 0;
					$arr['res'][$cnt]['is_found'] = 0;
				}
				$cnt++;
			}
		}else{
			$arr['found'] = 0;
		}
		return print(json_encode($arr));
	}


public function ProductInitialStock($product,$branch)			//======================= product initial stock quantity
{
	$con = parent::connect();
	$sel = $con->prepare("SELECT * FROM branchstock WHERE branchstock.ProductId='$product' AND branchstock.BranchId='$branch' AND branchstock.StockStatus=1 ORDER BY branchstock.BranchStockId ASC LIMIT 1");
	$sel->execute();
	if ($sel->rowCount()>=1) {
		$ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
		$initial = $ft_sel['InitialStock'];
	}else{
		$initial = 0;
	}
	return $initial;
}

public function ProductAllIn($product,$branch)			//======================= Product All Added Quantity
{
	$con = parent::connect();
	$sel = $con->prepare("SELECT * FROM branchstock WHERE branchstock.ProductId='$product' AND branchstock.BranchId='$branch' AND branchstock.StockStatus=1 ORDER BY branchstock.BranchStockId DESC LIMIT 1");
	$sel->execute();
	$allAdded = 0;
	if ($sel->rowCount()>=1) {
		$ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
		$allAdded = $ft_sel['AllIn'];
	}else{
		$allAdded = 0;
	}
	return $allAdded;
}

public function ProductAllOut($product,$branch)			//======================= Product All Out Quantity
{
	$con = parent::connect();
	$sel = $con->prepare("SELECT * FROM branchstock WHERE branchstock.ProductId='$product' AND branchstock.BranchId='$branch' AND branchstock.StockStatus=1 ORDER BY branchstock.BranchStockId DESC LIMIT 1");
	$sel->execute();
	$allOut = 0;
	if ($sel->rowCount()>=1) {
		$ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
		$allOut = $ft_sel['AllOut'];
	}else{
		$allOut = 0;
	}
	return $allOut;
}

	public function GeneralStockReport()			//====================================== OVERALL SALES REPORT
	{
		$con = parent::connect();
		$sel = $con->prepare("SELECT * FROM branches WHERE branches.BranchStatus=1");
		$sel->execute();
		$arr = [];
		if ($sel->rowCount()>=1) {
			$cnt = 0;
			while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
				$arr['found'] = 1;
				$arr['res'][$cnt]['branch_name'] = $ft_sel['BranchName'];
				$branch = $ft_sel['BranchId'];
				$ssel = $con->prepare("SELECT * FROM branchstock,branches,products WHERE branchstock.BranchId=branches.BranchId AND branchstock.ProductId=products.ProductId AND branchstock.BranchId='$branch'");
				$ssel->execute();
				if ($ssel->rowCount()>=1) {
					$arr['res'][$cnt]['is_found'] = 1;
					$ccnntt = 0;
					while ($ft_ssel = $ssel->fetch(PDO::FETCH_ASSOC)) {

						$arr['res'][$cnt]['data'][$ccnntt]['product_id'] = $ft_ssel['ProductId'];
						$arr['res'][$cnt]['data'][$ccnntt]['BranchId'] = $ft_ssel['BranchId'];
						$arr['res'][$cnt]['data'][$ccnntt]['product_name'] = $ft_ssel['ProductName'];
						$arr['res'][$cnt]['data'][$ccnntt]['IsProductBox'] = $ft_ssel['IsProductBox'];
						$arr['res'][$cnt]['data'][$ccnntt]['ProductBoxPieces'] = $ft_ssel['ProductBoxPieces'];
						$arr['res'][$cnt]['data'][$ccnntt]['ProductInitialStock'] = $this->ProductInitialStock($ft_ssel['ProductId'],$branch);
						$arr['res'][$cnt]['data'][$ccnntt]['ProductIn'] = $this->ProductAllIn($ft_ssel['ProductId'],$branch);
						$arr['res'][$cnt]['data'][$ccnntt]['ProductOut'] = $this->ProductAllOut($ft_ssel['ProductId'],$branch);
						$arr['res'][$cnt]['data'][$ccnntt]['ProductDate'] = $ft_ssel['ProductDate'];
						$arr['res'][$cnt]['data'][$ccnntt]['Remaining'] = ($arr['res'][$cnt]['data'][$ccnntt]['ProductInitialStock']+$arr['res'][$cnt]['data'][$ccnntt]['ProductIn'])-$arr['res'][$cnt]['data'][$ccnntt]['ProductOut'];
						$ccnntt++;
					}
				}else{
					// $arr['is_found'][$cnt] = 0;
					$arr['res'][$cnt]['is_found'] = 0;
				}
				$cnt++;
			}
		}else{
			$arr['found'] = 0;
		}
		return print(json_encode($arr));
	}

	public function WarehouseStockReport($warehouse)			//====================================== WAREHOUSE STOCK REPORT
	{
		$con = parent::connect();
		$ssel = $con->prepare("SELECT * FROM mainstock,products WHERE mainstock.ProductId=products.ProductId AND mainstock.WarehouseId='$warehouse'");
		$ssel->execute();
		if ($ssel->rowCount()>=1) {
			$cnt = 0;
			while ($ft_ssel = $ssel->fetch(PDO::FETCH_ASSOC)) {
				$arr['found'] = 1;
				$arr['res'][$cnt]['product_id'] = $ft_ssel['ProductId'];
				$arr['res'][$cnt]['product_name'] = $ft_ssel['ProductName'];
				$arr['res'][$cnt]['IsProductBox'] = $ft_ssel['IsProductBox'];
				$arr['res'][$cnt]['ProductBoxPieces'] = $ft_ssel['ProductBoxPieces'];
				$arr['res'][$cnt]['ProductInitialStock'] = $ft_ssel['InitialStock'];
				$arr['res'][$cnt]['ProductIn'] = $ft_ssel['AllIn'];
				$arr['res'][$cnt]['ProductOut'] = $ft_ssel['AllOut'];
				$arr['res'][$cnt]['ProductDate'] = substr($ft_ssel['ProductDate'], 0,11);
				$arr['res'][$cnt]['Remaining'] = ($ft_ssel['AllIn']+$ft_ssel['InitialStock'])-$ft_ssel['AllOut'];
				$cnt++;
			}
		}else{
			$arr['found'] = 0;
		}
		return print(json_encode($arr));
	}	

function AllMembersWIthStocks(){
	$con = parent::connect();
	$sel = $con->prepare("SELECT * FROM employees,branches WHERE employees.EmployeeBranch=branches.BranchId AND employees.EmployeesType=1 AND employees.EmployeeStatus=1");
	$sel->execute();
	if ($sel->rowCount()>=1) {
		$cnt = 0;
		while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
			$arr['found'] = 1;
			$arr['res'][$cnt]['EmployeesId'] = $ft_sel['EmployeesId'];
			$arr['res'][$cnt]['EmployeeNames'] = $ft_sel['EmployeeNames'];
			$arr['res'][$cnt]['EmployeePhone'] = $ft_sel['EmployeePhone'];
			$arr['res'][$cnt]['BranchName'] = $ft_sel['BranchName'];
			$arr['res'][$cnt]['EmployeeDate'] = substr($ft_sel['EmployeeDate'], 0, 10);
			$cnt++;
		}
	}else{
		$arr['found'] = 0;
	}
	return print(json_encode($arr));
}

function AllProducts(){
	$con = parent::connect();
	$sel = $con->prepare("SELECT * FROM products,productcategories WHERE products.ProductCategory=productcategories.CategoryId AND products.ProductSatatus=1 ORDER BY products.ProductName,products.ProductCategory");
	$sel->execute();
	if ($sel->rowCount()>=1) {
		$cnt = 0;
		while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
			if ($ft_sel['IsProductBox'] == 0) {
				$IsProductBox = "Single";
				$ProductBoxPieces = 1;
			}else{
				$IsProductBox = "Box";
				$ProductBoxPieces = $ft_sel['ProductBoxPieces'];
			}
			$arr['found'] = 1;
			$arr['res'][$cnt]['ProductName'] = $ft_sel['ProductName'];
			$arr['res'][$cnt]['ProductCategory'] = $ft_sel['CategoryName'];
			$arr['res'][$cnt]['IsProductBox'] = $IsProductBox;
			$arr['res'][$cnt]['ProductBoxPieces'] = $ProductBoxPieces;
			$arr['res'][$cnt]['ProductDate'] = substr($ft_sel['ProductDate'], 0, 10);
			$cnt++;
		}
	}else{
		$arr['found'] = 0;
	}
	return print(json_encode($arr));
}


function WarehouseProducts(){
	$con = parent::connect();
	$sel = $con->prepare("SELECT * FROM products,productcategories,mainstock,warehouses WHERE products.ProductCategory=productcategories.CategoryId AND mainstock.ProductId=products.ProductId AND mainstock.WarehouseId=warehouses.WarehouseId AND products.ProductSatatus=1");
	$sel->execute();
	if ($sel->rowCount()>=1) {
		$cnt = 0;
		while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
			if ($ft_sel['IsProductBox'] == 0) {
				$IsProductBox = "Single";
				$ProductBoxPieces = 1;
				$qnt = $ft_sel['QuantityAfter'];
			}else{
				$IsProductBox = "Box";
				$ProductBoxPieces = $ft_sel['ProductBoxPieces'];
				$qnt = $ft_sel['QuantityAfter']/$ProductBoxPieces;
			}
			$arr['found'] = 1;
			$arr['res'][$cnt]['ProductName'] = $ft_sel['ProductName'];
			$arr['res'][$cnt]['WarehouseName'] = $ft_sel['WarehouseName'];
			$arr['res'][$cnt]['ProductCategory'] = $ft_sel['CategoryName'];
			$arr['res'][$cnt]['IsProductBox'] = $IsProductBox;
			$arr['res'][$cnt]['Qnt'] = number_format($qnt);
			$arr['res'][$cnt]['ProductBoxPieces'] = $ProductBoxPieces;
			$arr['res'][$cnt]['ProductDate'] = substr($ft_sel['ProductDate'], 0, 10);
			$cnt++;
		}
	}else{
		$arr['found'] = 0;
	}
	return print(json_encode($arr));
}



function headsStockProducts(){
	$con = parent::connect();
	$sell = $con->prepare("SELECT * FROM headstock");
	$sell->execute();
	if ($sell->rowCount()>=1) {
		$cnt = 0;
		while ($ft_sell = $sell->fetch(PDO::FETCH_ASSOC)) {
			$headid = $ft_sell['HeadStockId'];
			$sel = $con->prepare("SELECT * FROM products,productcategories,headstock WHERE products.ProductCategory=productcategories.CategoryId AND headstock.ProductId=products.ProductId AND headstock.HeadStockId='$headid' AND products.ProductSatatus=1");
			$sel->execute();
			if ($sel->rowCount()>=1) {
				
				while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
					if ($ft_sel['IsProductBox'] == 0) {
						$IsProductBox = "Single";
						$ProductBoxPieces = 1;
						$qnt = $ft_sel['QuantityAfter'];
					}else{
						$IsProductBox = "Box";
						$ProductBoxPieces = $ft_sel['ProductBoxPieces'];
						$qnt = $ft_sel['QuantityAfter']/$ProductBoxPieces;
					}
					$arr['found'] = 1;
					$arr['res'][$cnt]['ProductName'] = $ft_sel['ProductName'];
					$arr['res'][$cnt]['ProductCategory'] = $ft_sel['CategoryName'];
					$arr['res'][$cnt]['IsProductBox'] = $IsProductBox;
					$arr['res'][$cnt]['Qnt'] = number_format($qnt);
					$arr['res'][$cnt]['ProductBoxPieces'] = $ProductBoxPieces;
					$arr['res'][$cnt]['ProductDate'] = substr($ft_sel['ProductDate'], 0, 10);
					$cnt++;
				}
			}else{
				$arr['found'] = 0;
			}
		}
	}else{
		$arr['found'] = 0;
	}
	return print(json_encode($arr));
}

function branchStockProducts(){
	$con = parent::connect();
	$sell = $con->prepare("SELECT * FROM branchstock");
	$sell->execute();
	$aaa = array();
	if ($sell->rowCount()>=1) {
		$cnt = 0;
		while ($ft_sell = $sell->fetch(PDO::FETCH_ASSOC)) {
			$branchid = $ft_sell['BranchId'];
			$sel = $con->prepare("SELECT * FROM products,productcategories,branchstock,branches WHERE products.ProductCategory=productcategories.CategoryId AND branchstock.ProductId=products.ProductId AND branchstock.BranchId=branches.BranchId  AND branchstock.BranchId='$branchid' AND products.ProductSatatus=1");
			$sel->execute();
			if ($sel->rowCount()>=1) {
				while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
					if (in_array($ft_sel['BranchStockId'], $aaa, true)) {
						continue;
					}else{
						array_push($aaa, $ft_sel['BranchStockId']);
						if ($ft_sel['IsProductBox'] == 0) {
							$IsProductBox = "Single";
							$ProductBoxPieces = 1;
							$qnt = $ft_sel['QuantityAfter'];
						}else{
							$IsProductBox = "Box";
							$ProductBoxPieces = $ft_sel['ProductBoxPieces'];
							$qnt = $ft_sel['QuantityAfter']/$ProductBoxPieces;
						}
						$arr['found'] = 1;
						$arr['res'][$cnt]['StockName'] = $ft_sel['BranchName'];
						$arr['res'][$cnt]['ProductName'] = $ft_sel['ProductName'];
						$arr['res'][$cnt]['ProductCategory'] = $ft_sel['CategoryName'];
						$arr['res'][$cnt]['IsProductBox'] = $IsProductBox;
						$arr['res'][$cnt]['Qnt'] = number_format($qnt);
						$arr['res'][$cnt]['ProductBoxPieces'] = $ProductBoxPieces;
						$arr['res'][$cnt]['ProductDate'] = substr($ft_sel['ProductDate'], 0, 10);
						$cnt++;
					}
				}
			}else{
				$arr['found'] = 0;
			}
		}
	}else{
		$arr['found'] = 0;
	}
	// var_dump($aaa);
	return print(json_encode($arr));
}

function ProductsOfWarehouse($warehouse){
	$con = parent::connect();
	$sel = $con->prepare("SELECT * FROM mainstock,products WHERE mainstock.ProductId=products.ProductId AND mainstock.WarehouseId='$warehouse'");
	$sel->execute();
	if ($sel->rowCount()>=1) {
		$cnt = 0;
		while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
					$arr['found'] = 1;
					$arr['res'][$cnt]['ProductId'] = $ft_sel['ProductId'];
					$arr['res'][$cnt]['ProductName'] = $ft_sel['ProductName'];
					$cnt++;
		}
	}else{
		$arr['found'] = 0;
	}
	return print(json_encode($arr));
}

function AllPurchases(){
	$con = parent::connect();
	$sel = $con->prepare("SELECT * FROM purchase WHERE purchase.PurchaseStatus=1");
	$sel->execute();
	if ($sel->rowCount()>=1) {
		$cnt = 0;
		while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
					$arr['found'] = 1;
					$arr['res'][$cnt]['PurchaseId'] = $ft_sel['PurchaseId'];
					$arr['res'][$cnt]['SupplierTin'] = $ft_sel['SupplierTin'];
					$arr['res'][$cnt]['SupplierName'] = $ft_sel['SupplierName'];
					$arr['res'][$cnt]['ItemName'] = $ft_sel['ItemName'];
					$arr['res'][$cnt]['InvoiceNumber'] = $ft_sel['InvoiceNumber'];
					$arr['res'][$cnt]['InvoiceDate'] = $ft_sel['InvoiceDate'];
					$arr['res'][$cnt]['TotalAmountTaxInclusive'] = $ft_sel['TotalAmountTaxInclusive'];
					$arr['res'][$cnt]['VATAmount'] = $ft_sel['VATAmount'];
					$arr['res'][$cnt]['InsertDate'] = $ft_sel['InsertDate'];
					$cnt++;
		}
	}else{
		$arr['found'] = 0;
	}
	return print(json_encode($arr));
}

function AllImports(){
	$con = parent::connect();
	$sel = $con->prepare("SELECT * FROM imports WHERE imports.ImportStatus=1");
	$sel->execute();
	if ($sel->rowCount()>=1) {
		$cnt = 0;
		while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
			$arr['found'] = 1;
			$arr['res'][$cnt]['ImportId'] = $ft_sel['ImportId'];
			$arr['res'][$cnt]['CustomStation'] = $ft_sel['CustomStation'];
			$arr['res'][$cnt]['CustomDeclarationNo'] = $ft_sel['CustomDeclarationNo'];
			$arr['res'][$cnt]['CustomDeclarationDate'] = $ft_sel['CustomDeclarationDate'];
			$arr['res'][$cnt]['ItemName'] = $ft_sel['ItemName'];
			$arr['res'][$cnt]['CustomValue'] = $ft_sel['CustomValue'];
			$arr['res'][$cnt]['VATPaid'] = $ft_sel['VATPaid'];
			$arr['res'][$cnt]['ImportDate'] = substr($ft_sel['ImportDate'],0,10);
			$cnt++;
		}
	}else{
		$arr['found'] = 0;
	}
	return print(json_encode($arr));
}

function WarehouseCategoryProductsQuantitty(){
	$con = parent::connect();
	$sel = $con->prepare("SELECT * FROM imports WHERE imports.ImportStatus=1");
	$sel->execute();
	if ($sel->rowCount()>=1) {
		$cnt = 0;
		while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
					$arr['found'] = 1;
					$arr['res'][$cnt]['ImportId'] = $ft_sel['ImportId'];
					$arr['res'][$cnt]['CustomStation'] = $ft_sel['CustomStation'];
					$arr['res'][$cnt]['CustomDeclarationNo'] = $ft_sel['CustomDeclarationNo'];
					$arr['res'][$cnt]['CustomDeclarationDate'] = $ft_sel['CustomDeclarationDate'];
					$arr['res'][$cnt]['ItemName'] = $ft_sel['ItemName'];
					$arr['res'][$cnt]['CustomValue'] = $ft_sel['CustomValue'];
					$arr['res'][$cnt]['VATPaid'] = $ft_sel['VATPaid'];
					$arr['res'][$cnt]['ImportDate'] = substr($ft_sel['ImportDate'],0,10);
					$cnt++;
		}
	}else{
		$arr['found'] = 0;
	}
	return print(json_encode($arr));
}


function AllExpenses(){
	$con = parent::connect();
	$sel = $con->prepare("SELECT * FROM expenses WHERE expenses.ExpenseStatus=1");
	$sel->execute();
	if ($sel->rowCount()>=1) {
		$cnt = 0;
		while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
					$arr['found'] = 1;
					$arr['res'][$cnt]['ExpenseId'] = $ft_sel['ExpenseId'];
					$arr['res'][$cnt]['ExpenseName'] = $ft_sel['ExpenseName'];
					$arr['res'][$cnt]['ExpensePrice'] = $ft_sel['ExpensePrice'];
					$arr['res'][$cnt]['ExpenseQuantity'] = $ft_sel['ExpenseQuantity'];
					$arr['res'][$cnt]['ExpenseMethod'] = $ft_sel['ExpenseMethod'];
					$arr['res'][$cnt]['ExpenseDate'] = substr($ft_sel['ExpenseDate'],0,10);
					$cnt++;
		}
	}else{
		$arr['found'] = 0;
	}
	return print(json_encode($arr));
}

function AllProductsNumber(){
	$con = parent::connect();
	$sel = $con->prepare("SELECT * FROM products WHERE ProductSatatus=1");
	$sel->execute();
	$num = $sel->rowCount();
	return $num;
}

function AllStocksNumber(){
	$con = parent::connect();
	$sel = $con->prepare("SELECT * FROM branches WHERE BranchStatus=1");
	$sel->execute();
	$num = $sel->rowCount();
	return $num;
}

function AllEmployeesNumber(){
	$con = parent::connect();
	$sel = $con->prepare("SELECT * FROM employees WHERE EmployeeStatus=1");
	$sel->execute();
	$num = $sel->rowCount();
	return $num-1;
}

function AllClientsNumber(){
	$con = parent::connect();
	$sel = $con->prepare("SELECT * FROM stockout WHERE StockOutStatus=1 GROUP BY ClientName");
	$sel->execute();
	$num = $sel->rowCount();
	return $num;
}

function AllWarehouseQuantityPerCategory($category,$num){
	$con = parent::connect();
	$sel = $con->prepare("SELECT * FROM products,productcategories,mainstock,warehouses WHERE products.ProductCategory=productcategories.CategoryId AND mainstock.ProductId=products.ProductId AND mainstock.WarehouseId=warehouses.WarehouseId AND products.ProductSatatus=1 AND productcategories.CategoryName='$category'");
	$sel->execute();
	if ($sel->rowCount()>=1) {
		$cnt = 0;
		$qnt1 = $qnt2 = $qnt3 = 0;
		while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
			if ($ft_sel['WarehouseId']==1) {
				if ($ft_sel['IsProductBox'] == 0) {
					$IsProductBox1 = "Single";
					$ProductBoxPieces1 = 1;
					$qnt1 = $ft_sel['QuantityAfter'];
				}else{
					$IsProductBox1 = "Box";
					$ProductBoxPieces1 = $ft_sel['ProductBoxPieces'];
					$qnt1 = $ft_sel['QuantityAfter']/$ProductBoxPieces1;
				}
			}else if ($ft_sel['WarehouseId']==2) {
				if ($ft_sel['IsProductBox'] == 0) {
					$IsProductBox2 = "Single";
					$ProductBoxPieces2 = 1;
					$qnt2 = $ft_sel['QuantityAfter'];
				}else{
					$IsProductBox2 = "Box";
					$ProductBoxPieces2 = $ft_sel['ProductBoxPieces'];
					$qnt2 = $ft_sel['QuantityAfter']/$ProductBoxPieces2;
				}
			}else if ($ft_sel['WarehouseId']==3) {
				if ($ft_sel['IsProductBox'] == 0) {
					$IsProductBox3 = "Single";
					$ProductBoxPieces3 = 1;
					$qnt3 = $ft_sel['QuantityAfter'];
				}else{
					$IsProductBox3 = "Box";
					$ProductBoxPieces3 = $ft_sel['ProductBoxPieces'];
					$qnt3 = $ft_sel['QuantityAfter']/$ProductBoxPieces3;
				}
			}

			$cnt++;
		}
		switch ($num) {
			case 1:
				echo $qnt1;
				break;
			case 2:
				echo $qnt2;
				break;
			case 3:
				echo $qnt3;
				break;
			default:
				// code...
				break;
		}
	}else{
		//$arr['found'] = 0;
	}
	//return print(json_encode($arr));
}

function ProductsCategoriesStatusRemaining($category){
	$con = parent::connect();
	$sel = $con->prepare("SELECT * FROM products,productcategories,mainstock,warehouses WHERE products.ProductCategory=productcategories.CategoryId AND mainstock.ProductId=products.ProductId AND mainstock.WarehouseId=warehouses.WarehouseId AND products.ProductSatatus=1 AND productcategories.CategoryName='$category'");
	$sel->execute();
	if ($sel->rowCount()>=1) {
		$cnt = 0;
		$qnt = 0;
		while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
				$qnt +=($ft_sel['InitialStock']+$ft_sel['AllIn'])-$ft_sel['AllOut'];
			$cnt++;
		}
		return $qnt;

	}else{
		return 0;
	}
}

function ProductsCategoriesStatusSold($category){
	$con = parent::connect();
	$sel = $con->prepare("SELECT * FROM products,productcategories,mainstock,warehouses WHERE products.ProductCategory=productcategories.CategoryId AND mainstock.ProductId=products.ProductId AND mainstock.WarehouseId=warehouses.WarehouseId AND products.ProductSatatus=1 AND productcategories.CategoryName='$category'");
	$sel->execute();
	if ($sel->rowCount()>=1) {
		$cnt = 0;
		$qnt = 0;
		while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
				$qnt += $ft_sel['AllOut']+$ft_sel['InitialStock']+$ft_sel['AllIn'];
			$cnt++;
		}
		return $qnt;

	}else{
		return 0;
	}
}

function TotalImports(){
	$con = parent::connect();
	$sel = $con->prepare("SELECT SUM(CustomValue) AS imports FROM imports WHERE ImportStatus=1");
	$sel->execute();
	if ($sel->rowCount()>=1) {
		$ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
		$imports = $ft_sel['imports'];
	}else{
		$imports = 0;
	}
	return $imports;
}

function TotalPurchases(){
	$con = parent::connect();
	$sel = $con->prepare("SELECT SUM(TotalAmountTaxInclusive) AS purchase FROM purchase WHERE PurchaseStatus=1");
	$sel->execute();
	if ($sel->rowCount()>=1) {
		$ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
		$purchase = $ft_sel['purchase'];
	}else{
		$purchase = 0;
	}
	return $purchase;
}

function TotalAllWarehouisesIn(){
	$con = parent::connect();
	$sel = $con->prepare("SELECT SUM(AllIn+InitialStock) AS AllIn FROM mainstock WHERE StockStatus=1");
	$sel->execute();
	if ($sel->rowCount()>=1) {
		$ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
		$purchase = $ft_sel['AllIn'];
	}else{
		$purchase = 0;
	}
	return $purchase;
}
function TotalAllWarehouisesRemaining(){
	$con = parent::connect();
	$sel = $con->prepare("SELECT SUM(AllIn+InitialStock-AllOut) AS AllIn FROM mainstock WHERE StockStatus=1");
	$sel->execute();
	if ($sel->rowCount()>=1) {
		$ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
		$purchase = $ft_sel['AllIn'];
	}else{
		$purchase = 0;
	}
	return $purchase;
}

function TotalAllHeadStockRemaining(){
	$con = parent::connect();
	$sel = $con->prepare("SELECT SUM(QuantityAfter) AS alll FROM headstock WHERE StockStatus=1");
	$sel->execute();
	if ($sel->rowCount()>=1) {
		$ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
		$purchase = $ft_sel['alll'];
	}else{
		$purchase = 0;
	}
	return $purchase;
}

function TotalAllBranchStockRemaining(){
	$con = parent::connect();
	$sel = $con->prepare("SELECT SUM(QuantityAfter) AS alll FROM branchstock WHERE StockStatus=1");
	$sel->execute();
	if ($sel->rowCount()>=1) {
		$ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
		$purchase = $ft_sel['alll'];
	}else{
		$purchase = 0;
	}
	return $purchase;
}

function AllStockOut(){
	$con = parent::connect();
	$sel = $con->prepare("SELECT SUM(SoldPrice) AS alll FROM stockout WHERE StockOutStatus=1");
	$sel->execute();
	if ($sel->rowCount()>=1) {
		$ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
		$purchase = $ft_sel['alll'];
	}else{
		$purchase = 0;
	}
	return $purchase;
}


function EmployeesSellingOrder()
{
	$con = parent::connect();
	$sel = $con->prepare("SELECT SUM(stockout.SoldPrice) AS SoldPrice,employees.EmployeeNames AS EmployeeName FROM stockout,employees WHERE employees.EmployeesId=stockout.EmployeeId AND stockout.StockOutStatus=1 GROUP BY employees.EmployeesId ORDER BY SoldPrice DESC");
	$sel->execute();
	if ($sel->rowCount()>=1) {
		$cnt = 0;
		while ($ft_sel = $sel->fetch(PDO::FETCH_ASSOC)) {
			$arr['found'] = 1;
			$arr['res'][$cnt]['EmployeeName'] = $ft_sel['EmployeeName'];
			$arr['res'][$cnt]['sold'] = number_format($ft_sel['SoldPrice']);
			$cnt++;
		}
	}else{
		$arr['found'] = 0;
	}
	return print(json_encode($arr));
}
function CountEmployeesSellingOrder()
{
	$con = parent::connect();
	$sel = $con->prepare("SELECT SUM(stockout.SoldPrice) AS SoldPrice,employees.EmployeeNames AS EmployeeName FROM stockout,employees WHERE employees.EmployeesId=stockout.EmployeeId AND stockout.StockOutStatus=1 GROUP BY employees.EmployeesId ORDER BY SoldPrice DESC");
	$sel->execute();
	return $sel->rowCount();
}








}
$MainView = new MainView();
$MainFunctions = new MainFunctions();

if (isset($_POST['available_branches'])) {
	$MainView->available_branches();
}elseif (isset($_POST['available_warehouses'])) {
	$MainView->available_warehouses();
}elseif (isset($_POST['available_warehouses_fo_label_chart'])) {
	$MainView->available_warehouses_fo_label_chart();
}else if (isset($_POST['available_categories'])) {
	$MainView->available_categories();
}else if (isset($_POST['available_products'])) {
	$MainView->available_products();
}else if (isset($_POST['IsProductBox'])) {
	echo $MainFunctions->IsProductBox($_POST['product_id']);
}else if (isset($_POST['available_products_in_head_stock'])) {
	$MainView->available_products_in_head_stock();
}else if (isset($_POST['available_products_in_main_stock'])) {
	$MainView->available_products_in_main_stock();
}else if (isset($_POST['available_products_in_branch_stock'])) {
	$MainView->available_products_in_branch_stock();
}else if (isset($_POST['GeneralSallesReport'])) {
	$MainView->GeneralSallesReport();
}else if (isset($_POST['GeneralStockReport'])) {
	$MainView->GeneralStockReport();
}else if (isset($_POST['WarehouseStockReport'])) {
	$MainView->WarehouseStockReport($_POST['warehouse']);
}else if (isset($_POST['AllMembersWIthStocks'])) {
	$MainView->AllMembersWIthStocks();
}else if (isset($_POST['AllProducts'])) {
	$MainView->AllProducts();
}else if (isset($_POST['WarehouseProducts'])) {
	$MainView->WarehouseProducts();
}else if (isset($_POST['headsStockProducts'])) {
	$MainView->headsStockProducts();
}else if (isset($_POST['branchStockProducts'])) {
	$MainView->branchStockProducts();
}else if (isset($_POST['branchStockProducts'])) {
	$MainView->branchStockProducts();
}else if (isset($_POST['ProductsOfWarehouse'])) {
	$MainView->ProductsOfWarehouse($_POST['warehouse']);
}else if (isset($_POST['AllPurchases'])) {
	$MainView->AllPurchases();
}else if (isset($_POST['AllImports'])) {
	$MainView->AllImports();
}else if (isset($_POST['AllExpenses'])) {
	$MainView->AllExpenses();
}else if (isset($_POST['EmployeesSellingOrder'])) {
	$MainView->EmployeesSellingOrder();
}else if (isset($_POST['stockDown_Branch'])) {
	$MainView->stockDown_Branch();
}else if (isset($_POST['recently_registered_products'])) {
	$MainView->recently_registered_products();
}





 ?>

