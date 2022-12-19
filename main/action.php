<?php
// session_start();
require("main_funcs.php");

/**
* =============================================== MAIN ACTION CLASS 
*/
class MainActions extends DBConnect
{
	public function RegisterBranch($name)
	{
		$con = parent::connect();
		$sel = $con->prepare("SELECT * FROM branches WHERE branches.BranchName='$name'");
		$sel->execute();
		if ($sel->rowCount()>=1) {
			$response = "already";
		}else{
			$ins = $con->prepare("INSERT INTO branches(BranchName) VALUES('$name')");
			$ok = $ins->execute();
			if ($ok) {
				$response = "success";
			}else{
				$response = "failed";
			}
		}
		echo $response;
	}

	public function RegisterWareHouse($name)
	{
		$con = parent::connect();
		$sel = $con->prepare("SELECT * FROM warehouses WHERE warehouses.WarehouseName='$name'");
		$sel->execute();
		if ($sel->rowCount()>=1) {
			$response = "already";
		}else{
			$ins = $con->prepare("INSERT INTO warehouses(WarehouseName) VALUES('$name')");
			$ok = $ins->execute();
			if ($ok) {
				$response = "success";
			}else{
				$response = "failed";
			}
		}
		echo $response;
	}
	
	function BranchEmployeeSignUp($names,$phone,$pass,$branch,$emptype)		//================================================ Creating an Employee
	{
		$con = parent::connect();
		$sel = $con->prepare("SELECT * FROM systemusers WHERE systemusers.UserPhone=?"); 
		$sel->bindValue(1,$phone);
		$sel->execute();
		if ($sel->rowCount()>=1) {
			$response = "already";
		}else{
			$con->beginTransaction();
			$insert_in_user = $con->prepare("INSERT INTO systemusers(UserNames,UserPhone,UserPassword) VALUES(?,?,?)"); 
			$insert_in_user->bindValue(1,$names);
			$insert_in_user->bindValue(2,$phone);
			$insert_in_user->bindValue(3,md5($pass));
			$ok = $insert_in_user->execute();
			$user_id = $con->lastInsertId(); 
			if ($ok) {
				$insert_employee = $con->prepare("INSERT INTO employees(UserId,EmployeeNames,EmployeePhone,EmployeeBranch,EmployeesType) VALUES(?,?,?,?,?)");
				$insert_employee->bindValue(1,$user_id);
				$insert_employee->bindValue(2,$names);
				$insert_employee->bindValue(3,$phone);
				$insert_employee->bindValue(4,$branch);
				if ($emptype=="manager") {
					$insert_employee->bindValue(5,2);
				}else if ($emptype=="employee") {
					$insert_employee->bindValue(5,1);
				}
				
				$ok_2 = $insert_employee->execute();
				if ($ok_2) {
					$response = "success";
					$con->commit();

				}else{
					$response = "failed";
					$con->rollback();
				}
			}else{
				$response = "failed";
				$con->rollback();
			}
		}
		echo $response;
	}

	function RegisterNewProduct($name,$category,$IsProductBox,$ProductBoxPieces)	//================================================= Creating New Product
	{
		$con = parent::connect();
		if ($ProductBoxPieces<1) {
			$ProductBoxPieces = null;
		}
		$sel = $con->prepare("SELECT * FROM products WHERE products.ProductName=? AND products.ProductCategory=? AND products.IsProductBox=?");
		$sel->bindValue(1,$name);
		$sel->bindValue(2,$category);
		$sel->bindValue(3,$IsProductBox);
		$sel->execute();
		if ($sel->rowCount()>=1) {
			$response = "already";
		}else{
			$ins = @$con->prepare("INSERT INTO products(ProductName,ProductCategory,IsProductBox,ProductBoxPieces) VALUES(?,?,?,?)");
			$ins->bindValue(1,$name);
			$ins->bindValue(2,$category);
			$ins->bindValue(3,$IsProductBox);
			$ins->bindValue(4,$ProductBoxPieces);
			$ok = @$ins->execute();
			if ($ok) {
				$response = "success";
			}else{
				$response = "failed";
			}
		}
		echo $response;
	}

	function OrientProductsToMainStock($product,$added,$IsProductBox,$warehouse)				//=======================================  Orient Products To Main Stock
	{
			$session_user_id = $_SESSION['sms_admin_id'];
			$now = date("Y-m-d m:i:sa");
			$MainFunctions = new MainFunctions();
		if ($added>=1) {
			$con = parent::connect();
			$sel = $con->prepare("SELECT * FROM mainstock WHERE mainstock.ProductId=? AND mainstock.WarehouseId=?");
			$sel->bindValue(1,$product);
			$sel->bindValue(2,$warehouse);
			$sel->execute();
			if ($sel->rowCount()>=1) {
				//============== UPDATE VALUES
				
				$ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
				$pro_added = $MainFunctions->BoxPieces($product);
				$upd = $con->prepare("UPDATE mainstock SET QuantityBefore=?,QuantityAdded=?,QuantityAfter=?,DateUpdated=?,IsProductBox=?,AllIn=(AllIn+?) WHERE mainstock.ProductId='$product' AND mainstock.WarehouseId=?");
				$upd->bindValue(1,$ft_sel['QuantityAfter']);
				if ($IsProductBox==1) {
					$addedd = $added*$pro_added;
					$after = $ft_sel['QuantityAfter']+($added*$pro_added);
				}else{
					$addedd = $added;
					$after = $ft_sel['QuantityAfter']+$added;
				}
				$upd->bindValue(2,$addedd);
				$upd->bindValue(3,$after);
				$upd->bindValue(4,$now);
				$upd->bindValue(5,$IsProductBox);
				$upd->bindValue(6,$addedd);
				$upd->bindValue(7,$warehouse);
				$ok = $upd->execute();
				if ($ok) {
					$response = "success";
					$MainFunctions->SaveStockTransaction($product,$session_user_id,0,1,$IsProductBox,$ft_sel['QuantityAfter'],$addedd,$after);
				}else{
					$response = "failed";
				}
			}else{
				// INSERT NEW RECORDS
				$pro_added = $MainFunctions->BoxPieces($product);
				$ins = $con->prepare("INSERT INTO mainstock(ProductId,IsProductBox,QuantityBefore,QuantityAdded,QuantityAfter,WarehouseId,InitialStock) VALUES(?,?,?,?,?,?,?)");
				$ins->bindValue(1,$product);
				$ins->bindValue(2,$IsProductBox);
				$ins->bindValue(3,0);
				if ($IsProductBox==1) {
					$addedd = $added*$pro_added;
					$after = $added*$pro_added;
				}else{
					$addedd = $added;
					$after = $added;
				}
					$ins->bindValue(4,($addedd));
					$ins->bindValue(5,($after));
					$ins->bindValue(6,($warehouse));
					$ins->bindValue(7,($addedd));
				$ok = $ins->execute();
				if ($ok) {
					$response = "success";
					$MainFunctions->SaveStockTransaction($product,$session_user_id,0,1,$IsProductBox,0,$addedd,$after);
				}else{
					$response = "failed";
					print_r($ins->errorInfo());
				}
			}
		}else{
			$response = "invalid";
		}
		echo $response;
	}

	function OrientProductsToHeadStock($product,$added,$IsProductBox,$warehouses)				//=======================================  Orient Products To Head Stock
	{
		$session_user_id = $_SESSION['sms_admin_id'];
		$now = date("Y-m-d m:i:sa");
		if ($added>=1) {
			$MainFunctions = new MainFunctions();

			$con = parent::connect();
			$sel = $con->prepare("SELECT * FROM headstock WHERE headstock.ProductId=?");
			$sel->bindValue(1,$product);
			$sel->execute();

			$sel_main = $con->prepare("SELECT * FROM mainstock WHERE mainstock.ProductId=? AND mainstock.WarehouseId='$warehouses'");
			$sel_main->bindValue(1,$product);
			$sel_main->execute();
			$ft_sel_main = $sel_main->fetch(PDO::FETCH_ASSOC);
			$pro_added = $MainFunctions->BoxPieces($product);
			if ($sel->rowCount()==1) {
				//============== UPDATE VALUES
				$ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
				switch ($IsProductBox) {
					case 1:
						$qnt = $pro_added*$added;
						break;
					
					default:
						$qnt = $added;
						break;
				}
				
				if ($qnt>$ft_sel_main['QuantityAfter']) {
					$response = "not_enough";
				}else{
					$con->beginTransaction();
					$up = $con->prepare("UPDATE mainstock SET QuantityBefore=?,QuantityAdded=?,QuantityAfter=?,DateUpdated=?,IsProductBox=?,AllOut=(AllOut+?) WHERE mainstock.ProductId='$product' AND  mainstock.WarehouseId='$warehouses'"); // update main stocl here products are from

					$up->bindValue(1,$ft_sel_main['QuantityAfter']);
					if ($IsProductBox==1) {
						$adder1 = 0-($added*$pro_added);
						$after1 = $ft_sel_main['QuantityAfter']-($added*$pro_added);
					}else{
						$adder1 = 0-$added;
						$after1 = $ft_sel_main['QuantityAfter']-$added;
					}
					$up->bindValue(2,$adder1);
					$up->bindValue(3,$after1);
					$up->bindValue(4,$now);
					$up->bindValue(5,$IsProductBox);
					$up->bindValue(6,abs($adder1));
					$ok = $up->execute();
					if ($ok) {
						$upd = $con->prepare("UPDATE headstock SET QuantityBefore=?,QuantityAdded=?,QuantityAfter=?,DateUpdated=?,IsProductBox=? WHERE headstock.ProductId='$product'");
						$upd->bindValue(1,$ft_sel['QuantityAfter']);
						if ($IsProductBox==1) {
							$addedd = $added*$pro_added;
							$after = $ft_sel['QuantityAfter']+($added*$pro_added);
						}else{
							$addedd = $added;
							$after = $ft_sel['QuantityAfter']+$added;
						}
						$upd->bindValue(2,$addedd);
						$upd->bindValue(3,$after);
						$upd->bindValue(4,$now);
						$upd->bindValue(5,$IsProductBox);
						$ok = $upd->execute();
						if ($ok) {
							$con->commit();
							$response = "success";
							$MainFunctions->SaveStockTransaction($product,$session_user_id,0,1,$IsProductBox,$ft_sel['QuantityAfter'],$adder1,$after1);
							$MainFunctions->SaveStockTransaction($product,$session_user_id,1,2,$IsProductBox,$ft_sel_main['QuantityAfter'],$addedd,$after);
						}else{
							$con->rollback();
							$response = "failed";
						}
					}else{
						$con->rollback();
						$response = "failed";
					}

				}

			}else{
				// INSERT NEW RECORDS
				$sel = $con->prepare("SELECT * FROM mainstock WHERE mainstock.ProductId=? AND  mainstock.WarehouseId='$warehouses'");
				$sel->bindValue(1,$product);
				$sel->execute();
				if ($sel->rowCount()==1) {
					$ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
					$pro_added = $MainFunctions->BoxPieces($product);
					switch ($IsProductBox) {
						case 1:
							$qnt = $pro_added*$added;
							break;
						
						default:
							$qnt = $added;
							break;
					}
				if ($qnt>$ft_sel['QuantityAfter']) {
						$response = "not_enough";
					}else{
						$con->beginTransaction();
						$up = $con->prepare("UPDATE mainstock SET QuantityBefore=?,QuantityAdded=?,QuantityAfter=?,DateUpdated=?,IsProductBox=?,AllOut=(AllOut+?) WHERE mainstock.ProductId='$product' AND  mainstock.WarehouseId='$warehouses'"); // update main stocl here products are from

						$up->bindValue(1,$ft_sel['QuantityAfter']);
						if ($IsProductBox==1) {
							$adder1 = 0-($added*$pro_added);
							$after1 = $ft_sel['QuantityAfter']-($added*$pro_added);
						}else{
							$adder1 = 0-$added;
							$after1 = $ft_sel['QuantityAfter']-$added;
						}
						$up->bindValue(2,$adder1);
						$up->bindValue(3,$after1);
						$up->bindValue(4,$now);
						$up->bindValue(5,$IsProductBox);
						$up->bindValue(6,abs($adder1));
						$ok = $up->execute();
						if ($ok) {
							$ins = $con->prepare("INSERT INTO headstock(ProductId,IsProductBox,QuantityBefore,QuantityAdded,QuantityAfter) VALUES(?,?,?,?,?)");
							$ins->bindValue(1,$product);
							$ins->bindValue(2,$IsProductBox);
							$ins->bindValue(3,0);
							if ($IsProductBox==1) {
								$addedd = $added*$pro_added;
								$after = $added*$pro_added;
							}else{
								$addedd = $added;
								$after = $added;
							}
							$ins->bindValue(4,$addedd);
							$ins->bindValue(5,$after);
							$up->bindValue(6,$addedd);
							$ok = $ins->execute();
							if ($ok) {
								$con->commit();
								$response = "seccess";
								$MainFunctions->SaveStockTransaction($product,$session_user_id,0,1,$IsProductBox,$ft_sel['QuantityAfter'],$adder1,$after1);
								$MainFunctions->SaveStockTransaction($product,$session_user_id,1,2,$IsProductBox,0,$addedd,$after);
							}else{
								$con->rollback();
								$response = "failed";
								// print_r($ins->errorInfo());
							}
						}else{
							$con->rollback();
							$response = "failed";
						}
					}
				}else{
					$response = "failed";
				}
			}
		}else{
			$response = "invalid";
		}
		echo $response;
	}

	public function OrientProductsToBranchStock($branch_id,$ProductId,$IsProductBox,$ProductPrice,$added,$warehouseId)		//===================== ORIENT Products To Branch Stock
	{	
		$MainFunctions = new MainFunctions();
		$session_user_id = $_SESSION['sms_admin_id'];
		$pro_added = $MainFunctions->BoxPieces($ProductId);
		switch ($IsProductBox) {
			case 1:
				$added *= $pro_added;
				break;
			
			default:
				$added = $added;
				break;
		}
		$con = parent::connect();
		$sel_qnty_in_head = $con->prepare("SELECT * FROM mainstock WHERE mainstock.ProductId='$ProductId' AND  mainstock.WarehouseId='$warehouseId'");
		$sel_qnty_in_head->execute();
		if ($sel_qnty_in_head->rowCount()>=1) {
			$ft_sel_qnty_in_head = $sel_qnty_in_head->fetch(PDO::FETCH_ASSOC);
			if ($added>$ft_sel_qnty_in_head["QuantityAfter"]) {
				$response = "not_enough";
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
									$response = "success";
									$MainFunctions->SaveStockTransaction($ProductId,$session_user_id,1,2,$IsProductBox,$ft_sel_qnty_in_head["QuantityAfter"],(0-$added),($ft_sel_qnty_in_head["QuantityAfter"]-$added));
									$MainFunctions->SaveStockTransaction($ProductId,$session_user_id,2,3,$IsProductBox,$ft_sel_branch['QuantityAfter'],$added,($ft_sel_branch['QuantityAfter']+$added));
								}else{
									$con->rollback();
									$response='failed';
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
									$response = "success";
									$MainFunctions->SaveStockTransaction($ProductId,$session_user_id,1,2,$IsProductBox,$ft_sel_qnty_in_head["QuantityAfter"],(0-$added),($ft_sel_qnty_in_head["QuantityAfter"]-$added));
									$MainFunctions->SaveStockTransaction($ProductId,$session_user_id,2,3,$IsProductBox,0,$added,$added);
								}else{
									$con->rollback();
									$response = "failed";
									print_r($ins_branch_stock->errorInfo());
								}
							}
						}else{
							$con->rollback();
							$response = "failed";
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
								$response = "success";
								$MainFunctions->SaveStockTransaction($ProductId,$session_user_id,1,2,$IsProductBox,$ft_sel_qnty_in_head["QuantityAfter"],(0-$added),($ft_sel_qnty_in_head["QuantityAfter"]-$added));
								$MainFunctions->SaveStockTransaction($ProductId,$session_user_id,2,3,$IsProductBox,0,$added,$added);
							}else{
								$con->rollback();
								$response = "failed";
								print_r($ins_branch_stock->errorInfo());
							}
						}else{
							$con->rollback();
							$response = "failed";
						}
					}
				}else{
					$response = "failed";
				}
			}
		}else{
			$response = "failed";
		}
		echo $response;
	}

public function StockOut($product,$IsProductBox,$SoldPrice,$QuantitySold,$ClientName,$CompanyName,$ClientPhone,$PaymentMethod,$PaymentWay,$invNumbr,$member,$member_pin)   //=========================== STOCK OUT
{
		$MainFunctions = new MainFunctions();
		$session_user_id = $_SESSION['sms_user_id'];
		$branch = $_SESSION['sms_user_branch_id'];
	$con = parent::connect();
	$sel_auth = $con->prepare("SELECT * FROM employees,systemusers WHERE employees.UserId=systemusers.UserId AND employees.EmployeesId='$member' AND systemusers.UserPassword=? AND employees.EmployeesType=1");
	$sel_auth->bindValue(1,md5($member_pin));
	$sel_auth->execute();
	if ($sel_auth->rowCount()==1) {
		$sel = $con->prepare("SELECT products.ProductId AS p_id,products.IsProductBox AS p_bx,products.ProductBoxPieces AS p_bpcs,branchstock.ProductPrice AS st_prc,branchstock.QuantityAfter AS st_qnt FROM branchstock,products WHERE products.ProductId=branchstock.ProductId AND products.ProductId='$product' AND branchstock.BranchId='$branch'");
		$sel->execute();
		if ($sel->rowCount()>=1) {
			$ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
			$pro_added = $MainFunctions->BoxPieces($product);
			switch ($IsProductBox) {
				case 1:
					$QuantitySold *= $pro_added;
					break;
				default:
					$QuantitySold = $QuantitySold;
					break;
			}
			if ($QuantitySold<=$ft_sel['st_qnt']) {
				$con->beginTransaction();
				//===== update BranchStock
				$upd_branch = $con->prepare("UPDATE branchstock SET branchstock.QuantityBefore=branchstock.QuantityAfter, branchstock.QuantityAdded=(0-$QuantitySold),branchstock.QuantityAfter=(branchstock.QuantityAfter-$QuantitySold),branchstock.AllOut=(branchstock.AllOut+$QuantitySold) WHERE branchstock.ProductId='$product' AND branchstock.BranchId='$branch'");
				$ok_upd_branch = $upd_branch->execute();
				if ($ok_upd_branch) {
					//==== Update StockOut
					$upd_stockout = $con->prepare("INSERT INTO stockout(EmployeeId,BranchId,ProductId,IsProductBox,ExpectedPrice,SoldPrice,QuantityBefore,QuantitySold,QuantityRemaining,ClientName,CompanyName,ClientPhone,PaymentMethod,PaymentWay,InvoiceNumber,MemberId) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
					$QuantityRemaining = $ft_sel['st_qnt'] - $QuantitySold;
					$upd_stockout->bindValue(1,$session_user_id);						$upd_stockout->bindValue(8,$QuantitySold);
					$upd_stockout->bindValue(2,$branch);								$upd_stockout->bindValue(9,$QuantityRemaining);
					$upd_stockout->bindValue(3,$product);								$upd_stockout->bindValue(10,$ClientName);
					$upd_stockout->bindValue(11,$CompanyName);
					$upd_stockout->bindValue(4,$IsProductBox);							$upd_stockout->bindValue(12,$ClientPhone);
					$upd_stockout->bindValue(5,$ft_sel['st_prc']); 						$upd_stockout->bindValue(13,$PaymentMethod);
					$upd_stockout->bindValue(6,$SoldPrice);								$upd_stockout->bindValue(14,$PaymentWay);
					$upd_stockout->bindValue(7,$ft_sel['st_qnt']);						$upd_stockout->bindValue(15,$invNumbr);$upd_stockout->bindValue(16,$member);
					$ok = $upd_stockout->execute();
	
					if ($ok) {
						$con->commit();
							$MainFunctions->SaveStockTransaction($product,$session_user_id,2,3,$IsProductBox,$ft_sel['st_qnt'],(0-$QuantitySold),$QuantityRemaining);
							$response = "success";
					}else{
						$con->rollback();
						$response = "failed";
					}
				}else{
					$con->rollback();
					$response = "failed";
				}
			}else{
				// $response = "Error".$ft_sel['st_qnt'];
				$response = "not_enough";
			}
		}else{
			$response = "failed";
		}
	}else{
		$response = "invalid";
	}
	echo $response;
}

public function StockOutAllTrans($product,$IsProductBox,$SoldPrice,$QuantitySold,$ClientName,$CompanyName,$ClientPhone,$PaymentMethod,$PaymentWay,$invNumbr,$member,$mpin)   //=========================== STOCK OUT
{
		$MainFunctions = new MainFunctions();
		$session_user_id = $_SESSION['sms_user_id'];
		$branch = $_SESSION['sms_user_branch_id'];
	$con = parent::connect();
	
	$arr_product = explode(',', $product);
	$arr_IsProductBox = explode(',', $IsProductBox);
	$arr_SoldPrice = explode(',', $SoldPrice);
	$arr_QuantitySold = explode(',', $QuantitySold);
	$arr_ClientName = explode(',', $ClientName);
	$arr_CompanyName = explode(',', $CompanyName);
	$arr_ClientPhone = explode(',', $ClientPhone);
	$arr_PaymentMethod = explode(',', $PaymentMethod);
	$arr_PaymentWay = explode(',', $PaymentWay);
	$arr_invNumbr = explode(',', $invNumbr);
	$arr_MemberId = explode(',', $member);
	$arr_MemberPin = explode(',', $mpin);
	$error_holder = false;
	$error_value = "";
	// $con->beginTransaction();
	for ($i=0; $i < count($arr_product); $i++) { 
		$last = count($arr_product)-1;
		$product = $arr_product[$i];
		$IsProductBox = $arr_IsProductBox[$i];
		$SoldPrice = $arr_SoldPrice[$i];
		$QuantitySold = $arr_QuantitySold[$i];
		$ClientName = $arr_ClientName[$i];
		$CompanyName = $arr_CompanyName[$i];
		$ClientPhone = $arr_ClientPhone[$i];
		$MemberId = $arr_MemberId[$i];
		$MemberPin = $arr_MemberPin[0];
		$PaymentMethod = $PaymentMethod;
		$PaymentWay = $PaymentWay;
		$invNumbr = $arr_invNumbr[$i];
		// $con->beginTransaction();

		$sel_auth = $con->prepare("SELECT * FROM employees,systemusers WHERE employees.UserId=systemusers.UserId AND employees.EmployeesId='$MemberId' AND systemusers.UserPassword=? AND employees.EmployeesType=1");
		$sel_auth->bindValue(1,md5($MemberPin));
		$sel_auth->execute();
		if ($sel_auth->rowCount()==1) {
			$sel = $con->prepare("SELECT products.ProductId AS p_id,products.IsProductBox AS p_bx,products.ProductBoxPieces AS p_bpcs,branchstock.ProductPrice AS st_prc,branchstock.QuantityAfter AS st_qnt FROM branchstock,products WHERE products.ProductId=branchstock.ProductId AND products.ProductId='$product' AND branchstock.BranchId='$branch'");
			$sel->execute();
			if ($sel->rowCount()>=1) {
				$ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
				$pro_added = $MainFunctions->BoxPieces($product);
				switch ($IsProductBox) {
					case 1:
						$QuantitySold *= $pro_added;
						break;
					
					default:
						$QuantitySold = $QuantitySold;
						break;
				}
				if ($QuantitySold<=$ft_sel['st_qnt']) {
					$con->beginTransaction();
					//===== update BranchStock
					$upd_branch = $con->prepare("UPDATE branchstock SET branchstock.QuantityBefore=branchstock.QuantityAfter, branchstock.QuantityAdded=(0-$QuantitySold),branchstock.QuantityAfter=(branchstock.QuantityAfter-$QuantitySold),branchstock.AllOut=(branchstock.AllOut+$QuantitySold) WHERE branchstock.ProductId='$product' AND branchstock.BranchId='$branch'");
					$ok_upd_branch = $upd_branch->execute();
					if ($ok_upd_branch) {
						//==== Update StockOut
						$upd_stockout = $con->prepare("INSERT INTO stockout(EmployeeId,BranchId,ProductId,IsProductBox,ExpectedPrice,SoldPrice,QuantityBefore,QuantitySold,QuantityRemaining,ClientName,CompanyName,ClientPhone,PaymentMethod,PaymentWay,InvoiceNumber,MemberId) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
						$QuantityRemaining = $ft_sel['st_qnt'] - $QuantitySold;
						$upd_stockout->bindValue(1,$session_user_id);						$upd_stockout->bindValue(8,$QuantitySold);
						$upd_stockout->bindValue(2,$branch);								$upd_stockout->bindValue(9,$QuantityRemaining);
						$upd_stockout->bindValue(3,$product);								$upd_stockout->bindValue(10,$ClientName);
						$upd_stockout->bindValue(11,$CompanyName);
						$upd_stockout->bindValue(4,$IsProductBox);							$upd_stockout->bindValue(12,$ClientPhone);
						$upd_stockout->bindValue(5,$ft_sel['st_prc']); 						$upd_stockout->bindValue(13,$PaymentMethod);
						$upd_stockout->bindValue(6,$SoldPrice);								$upd_stockout->bindValue(14,$PaymentWay);
						$upd_stockout->bindValue(7,$ft_sel['st_qnt']);						$upd_stockout->bindValue(15,$invNumbr);$upd_stockout->bindValue(16,$MemberId);
						$ok = $upd_stockout->execute();
	
						if ($ok) {
								$con->commit();
								$MainFunctions->SaveStockTransaction($product,$session_user_id,2,3,$IsProductBox,$ft_sel['st_qnt'],(0-$QuantitySold),$QuantityRemaining);
								$response = "success";
						}else{
							$con->rollback();
							$response = "failed";
							$error_holder = true;
							$error_value = $response;
						}
					}else{
						$con->rollback();
						$response = "failed";
						$error_holder = true;
						$error_value = $response;
					}
				}else{
					// $response = "Error: ".$ft_sel['st_qnt'];
					$response = "not_enough";
					$error_holder = true;
					$error_value = $response;
				}
			}else{
				$response = "failed";
				$error_holder = true;
				$error_value = $response;
			}
		}else{
			$response = "invalid";
			// $response = $MemberId."  -  ".$MemberPin."  -  ".$sel_auth->rowCount()." - ".$ClientName;
		}



	
	}
	echo $response;
}


public function Login($username,$password)			//==================================== LOGIN
{
	$con = parent::connect();
	$sel = $con->prepare("SELECT systemusers.UserId AS idd,systemusers.UserNames AS nname,employees.EmployeesType AS emp_type,employees.EmployeeBranch AS emp_branch FROM systemusers,employees WHERE employees.UserId=systemusers.UserId AND systemusers.UserPhone=? AND systemusers.UserPassword=? AND systemusers.Status=?");
	$sel->bindValue(1,$username);
	$sel->bindValue(2,md5($password));
	$sel->bindValue(3,1);
	$sel->execute();
	if ($sel->rowCount()==1) {
		$ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
		if ($ft_sel['emp_type']==2) {		// 2    reserved for normal employees who're not allowed to logIn to the System
			$_SESSION['sms_user_branch_id'] = $ft_sel['emp_branch'];
			$_SESSION['sms_user_id'] = $ft_sel['idd'];
			$_SESSION['user']['name'] = $ft_sel['nname'];
			$response = "user";
		}elseif ($ft_sel['emp_type']==0) {
			$_SESSION['sms_admin_id'] = $ft_sel['idd'];
			$_SESSION['sms_admin_branch_id'] = $ft_sel['emp_branch'];
			$_SESSION['user']['name'] = $ft_sel['nname'];
			$response = "admin";
			// $response = $_SESSION['sms_admin_id'];
		}else{
			$response = "no";
		}
	}else{
		$response = "wrong";
	}
	echo $response;
}

public function UpdateBranch($branchId, $newBrancName)
{
		$con = parent::connect();
		$upd = $con->prepare("UPDATE branches SET branches.BranchName='$newBrancName' WHERE branches.BranchId='$branchId'");
		$ok = $upd->execute();
		if ($ok) {
			echo "success";
		}else{
			echo "failed";
		}
}
public function UpdateWareHouse($warehouseId, $newWarehousecName)
{
		$con = parent::connect();
		$upd = $con->prepare("UPDATE warehouses SET warehouses.WarehouseName='$newWarehousecName' WHERE warehouses.WarehouseId='$warehouseId'");
		$ok = $upd->execute();
		if ($ok) {
			echo "success";
		}else{
			echo "failed";
		}
}
public function deleteBranch($branchid)
{
		$con = parent::connect();
		$upd = $con->prepare("SELECT * FROM branchstock WHERE branchstock.BranchId='$branchid'");
		$upd->execute();
		if ($upd->rowCount()>=1) {
			echo "used";
		}else{
			$upd = $con->prepare("UPDATE branches SET branches.BranchStatus=2 WHERE branches.BranchId='$branchid'");
			$ok = $upd->execute();
			if ($ok) {
				echo "success";
			}else{
				echo "failed";
			}
		}
}
public function deleteWarehouse($branchid)
{
		$con = parent::connect();
		$upd = $con->prepare("SELECT * FROM mainstock WHERE mainstock.WarehouseId='$branchid'");
		$upd->execute();
		if ($upd->rowCount()>=1) {
			echo "used";
		}else{
			$upd = $con->prepare("UPDATE warehouses SET warehouses.WarehouseStatus=2 WHERE warehouses.WarehouseId='$branchid'");
			$ok = $upd->execute();
			if ($ok) {
				echo "success";
			}else{
				echo "failed";
			}
		}
}

public function UpdBranchEmployee($empId, $empNmae, $empPhone, $empStock)
{
	$con = parent::connect();
	$upd = $con->prepare("UPDATE employees SET employees.EmployeeNames='$empNmae',employees.EmployeePhone='$empPhone',employees.EmployeeBranch='$empStock' WHERE employees.EmployeesId='$empId'");
	$ok = $upd->execute();
	if ($ok) {
		echo "success";
	}else{
		echo "failed";
	}
}

public function deleteEmployee($empl_id)
{
		$con = parent::connect();
		$upd = $con->prepare("SELECT * FROM systemusers,employees,stocktransactions WHERE systemusers.UserId=employees.UserId AND systemusers.UserId=stocktransactions.UserId AND employees.EmployeesId='$empl_id'");
		$upd->execute();
		if ($upd->rowCount()>=1) {
			echo "used";
		}else{
			$upd = $con->prepare("UPDATE employees SET employees.EmployeeStatus=2 WHERE employees.EmployeesId='$empl_id'");
			$ok = $upd->execute();
			if ($ok) {
				echo "success";
			}else{
				echo "failed";
			}
		}
}

function UpdateProductStockh($hdnproductid,$initialStock,$totalIn,$totalOut,$remaining,$branchid){
	(int) $hdnproductid = (int)$hdnproductid;
	(int) $initialStock = (int)$initialStock;
	(int) $totalIn = (int)$totalIn;
	(int) $totalOut = (int)$totalOut;
	(int) $remaining = (int)$remaining;
	(int) $branchid = (int)$branchid;
	$user = $_SESSION['sms_admin_id'];
	$date = date("Y-m-d h:i:sa");
	$con = parent::connect();
	$con->beginTransaction();
	$sel = $con->prepare("SELECT * FROM branchstock WHERE branchstock.BranchId='$branchid' ORDER BY branchstock.BranchStockId ASC LIMIT 1");
	$sel->execute();
	$ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
	$BranchStockId = $ft_sel['BranchStockId'];
	$upd = $con->prepare("UPDATE branchstock SET branchstock.QuantityBefore=0,branchstock.QuantityAdded=0,branchstock.QuantityAfter=0,branchstock.InitialStock='$initialStock',branchstock.AllIn='$totalIn',branchstock.AllOut='$totalOut' WHERE branchstock.ProductId='$hdnproductid' AND branchstock.BranchId='$branchid' AND branchstock.StockStatus=1 AND branchstock.BranchStockId='$BranchStockId'");
	$ok_upd = $upd->execute();
	if($ok_upd){
		$upd2 = $con->prepare("UPDATE branchstock SET branchstock.QuantityBefore='$initialStock',branchstock.QuantityAdded='$totalIn',branchstock.QuantityAfter='$remaining',branchstock.EmployeeUpdated='$user',branchstock.DateUpdated='$date',branchstock.InitialStock='$initialStock',branchstock.AllIn='$totalIn',branchstock.AllOut='$totalOut' WHERE branchstock.ProductId='$hdnproductid' AND branchstock.BranchId='$branchid' AND branchstock.StockStatus=1 ORDER BY branchstock.BranchStockId DESC LIMIT 1");
		$ok_upd2 = $upd2->execute();
		if ($ok_upd2) {
			$con->commit();
			echo "success";
		}else{
			$con->rollback();
			echo "failed2";
		}
	}else{
		echo "failed1";
	}
}

public function SavePurchase($TINNumber,$SupplierName,$ItemName,$InvoiceNumber,$InvoiceDate,$Inclusive,$VATAmount)
{
	$con = parent::connect();
	$ins = $con->prepare("INSERT INTO purchase(SupplierTin,SupplierName,ItemName,InvoiceNumber,InvoiceDate,TotalAmountTaxInclusive,VATAmount) VALUES(?,?,?,?,?,?,?)");
	$ins->bindValue(1,$TINNumber);
	$ins->bindValue(2,$SupplierName);
	$ins->bindValue(3,$ItemName);
	$ins->bindValue(4,$InvoiceNumber);
	$ins->bindValue(5,$InvoiceDate);
	$ins->bindValue(6,$Inclusive);
	$ins->bindValue(7,$VATAmount);
	$ok = $ins->execute();
	if ($ok) {
		echo "success";
	}else{
		echo "failed";
	}

}

public function SavePurchaseBranch($TINNumber,$SupplierName,$ItemName,$InvoiceNumber,$InvoiceDate,$Inclusive,$VATAmount)
{
	$con = parent::connect();
	$ins = $con->prepare("INSERT INTO purchase(SupplierTin,SupplierName,ItemName,InvoiceNumber,InvoiceDate,TotalAmountTaxInclusive,VATAmount,BranchId) VALUES(?,?,?,?,?,?,?,?)");
	$ins->bindValue(1,$TINNumber);
	$ins->bindValue(2,$SupplierName);
	$ins->bindValue(3,$ItemName);
	$ins->bindValue(4,$InvoiceNumber);
	$ins->bindValue(5,$InvoiceDate);
	$ins->bindValue(6,$Inclusive);
	$ins->bindValue(7,$VATAmount);
	$ins->bindValue(8,$_SESSION['sms_user_branch_id']);
	$ok = $ins->execute();
	if ($ok) {
		echo "success";
	}else{
		echo "failed";
	}

}

public function SaveImports($CustomStation,$CustomDeclarationNo,$CustomDeclarationDate,$ItemName,$CustomValue,$VATPaid)
{
	$con = parent::connect();
	$ins = $con->prepare("INSERT INTO imports(CustomStation,CustomDeclarationNo,CustomDeclarationDate,ItemName,CustomValue,VATPaid) VALUES(?,?,?,?,?,?)");
	$ins->bindValue(1,$CustomStation);
	$ins->bindValue(2,$CustomDeclarationNo);
	$ins->bindValue(3,$CustomDeclarationDate);
	$ins->bindValue(4,$ItemName);
	$ins->bindValue(5,$CustomValue);
	$ins->bindValue(6,$VATPaid);
	$ok = $ins->execute();
	if ($ok) {
		echo "success";
	}else{
		echo "failed";
		// print_r($ins->errorInfo());
	}

}
public function SaveImportsBranch($CustomStation,$CustomDeclarationNo,$CustomDeclarationDate,$ItemName,$CustomValue,$VATPaid)
{
	$con = parent::connect();
	$ins = $con->prepare("INSERT INTO imports(CustomStation,CustomDeclarationNo,CustomDeclarationDate,ItemName,CustomValue,VATPaid,BranchId) VALUES(?,?,?,?,?,?,?)");
	$ins->bindValue(1,$CustomStation);
	$ins->bindValue(2,$CustomDeclarationNo);
	$ins->bindValue(3,$CustomDeclarationDate);
	$ins->bindValue(4,$ItemName);
	$ins->bindValue(5,$CustomValue);
	$ins->bindValue(6,$VATPaid);
	$ins->bindValue(7,$_SESSION['sms_user_branch_id']);
	$ok = $ins->execute();
	if ($ok) {
		echo "success";
	}else{
		echo "failed";
		// print_r($ins->errorInfo());
	}

}

public function SaveExpenses($ExpenseName,$ExpensePrice,$ExpenseQuantity,$ExpenseMethod)
{
	$con = parent::connect();
	$ins = $con->prepare("INSERT INTO expenses(ExpenseName,ExpensePrice,ExpenseQuantity,ExpenseMethod) VALUES(?,?,?,?)");
	$ins->bindValue(1,$ExpenseName);
	$ins->bindValue(2,$ExpensePrice);
	$ins->bindValue(3,$ExpenseQuantity);
	$ins->bindValue(4,$ExpenseMethod);
	$ok = $ins->execute();
	if ($ok) {
		echo "success";
	}else{
		// echo "failed";
		print_r($ins->errorInfo());
	}

}

public function SaveExpensesBranch($ExpenseName,$ExpensePrice,$ExpenseQuantity,$ExpenseMethod)
{
	$con = parent::connect();
	$ins = $con->prepare("INSERT INTO expenses(ExpenseName,ExpensePrice,ExpenseQuantity,ExpenseMethod,BranchId) VALUES(?,?,?,?,?)");
	$ins->bindValue(1,$ExpenseName);
	$ins->bindValue(2,$ExpensePrice);
	$ins->bindValue(3,$ExpenseQuantity);
	$ins->bindValue(4,$ExpenseMethod);
	$ins->bindValue(5,$_SESSION['sms_user_branch_id']);
	$ok = $ins->execute();
	if ($ok) {
		echo "success";
	}else{
		// echo "failed";
		print_r($ins->errorInfo());
	}

}

public function updSavePurchase($purchaseId,$SupplierTin,$SupplierName,$ItemName,$InvoiceNumber,$InvoiceDate,$TotalAmountTaxInclusive,$VATAmount)
{
	$con = parent::connect();
	$ins = $con->prepare("UPDATE purchase SET SupplierTin=?,SupplierName=?,ItemName=?,InvoiceNumber=?,InvoiceDate=?,TotalAmountTaxInclusive=?,VATAmount=? WHERE PurchaseId=?");
	$ins->bindValue(1,$SupplierTin);
	$ins->bindValue(2,$SupplierName);
	$ins->bindValue(3,$ItemName);
	$ins->bindValue(4,$InvoiceNumber);
	$ins->bindValue(5,$InvoiceDate);
	$ins->bindValue(6,$TotalAmountTaxInclusive);
	$ins->bindValue(7,$VATAmount);
	$ins->bindValue(8,$purchaseId);
	$ok = $ins->execute();
	if ($ok) {
		echo "success";
	}else{
		echo "failed";
	}

}

public function updSaveImports($importId, $updCustomStation, $updCustomDeclarationNo, $updCustomDeclarationDate, $updItemName, $updCustomValue, $updVATPaid)
{
	$con = parent::connect();
	$ins = $con->prepare("UPDATE imports SET CustomStation=?,CustomDeclarationNo=?,CustomDeclarationDate=?,ItemName=?,CustomValue=?,VATPaid=? WHERE ImportId=?");
	$ins->bindValue(1,$updCustomStation);
	$ins->bindValue(2,$updCustomDeclarationNo);
	$ins->bindValue(3,$updCustomDeclarationDate);
	$ins->bindValue(4,$updItemName);
	$ins->bindValue(5,$updCustomValue);
	$ins->bindValue(6,$updVATPaid);
	$ins->bindValue(7,$importId);
	$ok = $ins->execute();
	if ($ok) {
		echo "success";
	}else{
		echo "failed";
	}

}

public function updSaveExpenses($expenseId, $updExpenseName, $updExpensePrice, $updExpenseQuantity, $updExpenseMethod)
{
	$con = parent::connect();
	$ins = $con->prepare("UPDATE expenses SET ExpenseName=?,ExpensePrice=?,ExpenseQuantity=?,ExpenseMethod=? WHERE ExpenseId=?");
	$ins->bindValue(1,$updExpenseName);
	$ins->bindValue(2,$updExpensePrice);
	$ins->bindValue(3,$updExpenseQuantity);
	$ins->bindValue(4,$updExpenseMethod);
	$ins->bindValue(5,$expenseId);
	$ok = $ins->execute();
	if ($ok) {
		echo "success";
	}else{
		echo "failed";
	}

}

public function deletePurchases($idd)
{
	$con = parent::connect();
	$ins = $con->prepare("UPDATE purchase SET purchase.PurchaseStatus=? WHERE PurchaseId=?");
	$ins->bindValue(1,2);
	$ins->bindValue(2,$idd);
	$ok = $ins->execute();
	if ($ok) {
		echo "success";
	}else{
		echo "failed";
	}

}

public function deleteImports($idd)
{
	$con = parent::connect();
	$ins = $con->prepare("UPDATE imports SET imports.ImportStatus=? WHERE ImportId=?");
	$ins->bindValue(1,2);
	$ins->bindValue(2,$idd);
	$ok = $ins->execute();
	if ($ok) {
		echo "success";
	}else{
		echo "failed";
	}

}
public function deleteExpenses($idd)
{
	$con = parent::connect();
	$ins = $con->prepare("UPDATE expenses SET expenses.ExpenseStatus=? WHERE ExpenseId=?");
	$ins->bindValue(1,2);
	$ins->bindValue(2,$idd);
	$ok = $ins->execute();
	if ($ok) {
		echo "success";
	}else{
		echo "failed";
	}

}


















}
$MainActions = new MainActions();

if (isset($_GET['BranchEmployeeSignUp'])) {
	$MainActions->BranchEmployeeSignUp($_GET['names'],$_GET['phone'],$_GET['pass'],$_GET['branch'],$_GET['BranchEmployeeSignUp']);
}elseif (isset($_GET['RegisterNewProduct'])) {
	$MainActions->RegisterNewProduct($_GET['name'],$_GET['category'],$_GET['IsProductBox'],$_GET['ProductBoxPieces']);
}elseif (isset($_GET['OrientProductsToMainStock'])) {
	$MainActions->OrientProductsToMainStock($_GET['product'],$_GET['added'],$_GET['IsProductBox'],$_GET['AvailableWarehouses']);
}elseif (isset($_GET['OrientProductsToHeadStock'])) {
	$MainActions->OrientProductsToHeadStock($_GET['product'],$_GET['added'],$_GET['IsProductBox'],$_GET['warehouses']);
}elseif (isset($_GET['OrientProductsToBranchStock'])) {
	$MainActions->OrientProductsToBranchStock($_GET['branch_id'],$_GET['product_id'],$_GET['IsProductBox'],$_GET['product_price'],$_GET['added'],$_GET['warehouseId']);
}elseif (isset($_GET['StockOut'])) {
	$MainActions->StockOut($_GET['product_id'],$_GET['IsProductBox'],$_GET['soldPrice'],$_GET['quantitySold'],$_GET['clientName'],$_GET['companyName'],$_GET['clientPhone'],$_GET['paymentMethod'],$_GET['paymentWay'],$_GET['invNumbr'],$_GET['member'],$_GET['mpin']);
}elseif (isset($_GET['StockOutAllTrans'])) {
	$MainActions->StockOutAllTrans($_GET['product_id'],$_GET['IsProductBox'],$_GET['soldPrice'],$_GET['quantitySold'],$_GET['clientName'],$_GET['companyName'],$_GET['clientPhone'],$_GET['paymentMethod'],$_GET['paymentWay'],$_GET['invNumbr'],$_GET['memberID'], $_GET['mpin']);
}elseif (isset($_GET['Login'])) {
	$MainActions->Login($_GET['username'],$_GET['password']);
}elseif (isset($_GET['RegisterBranch'])) {
	$MainActions->RegisterBranch($_GET['name']);
}elseif (isset($_GET['RegisterWareHouse'])) {
	$MainActions->RegisterWareHouse($_GET['name']);
}elseif (isset($_GET['UpdateBranch'])) {
	$MainActions->UpdateBranch($_GET['branchId'],$_GET['newBrancName']);
}elseif (isset($_GET['UpdateWareHouse'])) {
	$MainActions->UpdateWareHouse($_GET['branchId'],$_GET['newBrancName']);
}elseif (isset($_GET['deleteBranch'])) {
	$MainActions->deleteBranch($_GET['iid']);
}elseif (isset($_GET['deleteWarehouse'])) {
	$MainActions->deleteWarehouse($_GET['iid']);
}elseif (isset($_POST['UpdBranchEmployee'])) {
	$MainActions->UpdBranchEmployee($_POST['empId'],$_POST['empName'],$_POST['empPhone'],$_POST['empStock']);
}elseif (isset($_POST['deleteEmployee'])) {
	$MainActions->deleteEmployee($_POST['empid']);
}elseif (isset($_POST['UpdateProductStockh'])) {
	$MainActions->UpdateProductStockh($_POST['hdnproductid'],$_POST['initialStock'],$_POST['totalIn'],$_POST['totalOut'],$_POST['remaining'],$_POST['branchid']);
}elseif (isset($_POST['SavePurchase'])) {
	$MainActions->SavePurchase($_POST['TINNumber'],$_POST['SupplierName'],$_POST['ItemName'],$_POST['InvoiceNumber'],$_POST['InvoiceDate'],$_POST['Inclusive'],$_POST['VATAmount']);
}elseif (isset($_POST['SavePurchaseBranch'])) {
	$MainActions->SavePurchaseBranch($_POST['TINNumber'],$_POST['SupplierName'],$_POST['ItemName'],$_POST['InvoiceNumber'],$_POST['InvoiceDate'],$_POST['Inclusive'],$_POST['VATAmount']);
}elseif (isset($_POST['SaveImports'])) {
	$MainActions->SaveImports($_POST['CustomStation'],$_POST['CustomDeclarationNo'],$_POST['CustomDeclarationDate'],$_POST['ItemName'],$_POST['CustomValue'],$_POST['VATPaid']);
}elseif (isset($_POST['SaveImportsBranch'])) {
	$MainActions->SaveImportsBranch($_POST['CustomStation'],$_POST['CustomDeclarationNo'],$_POST['CustomDeclarationDate'],$_POST['ItemName'],$_POST['CustomValue'],$_POST['VATPaid']);
}elseif (isset($_POST['SaveExpenses'])) {
	$MainActions->SaveExpenses($_POST['ExpenseName'],$_POST['ExpensePrice'],$_POST['ExpenseQuantity'],$_POST['ExpenseMethod']);
}elseif (isset($_POST['SaveExpensesBranch'])) {
	$MainActions->SaveExpensesBranch($_POST['ExpenseName'],$_POST['ExpensePrice'],$_POST['ExpenseQuantity'],$_POST['ExpenseMethod']);
}elseif (isset($_POST['updSavePurchase'])) {
	$MainActions->updSavePurchase($_POST['purchaseId'],$_POST['SupplierTin'],$_POST['SupplierName'],$_POST['ItemName'],$_POST['InvoiceNumber'],$_POST['InvoiceDate'],$_POST['TotalAmountTaxInclusive'],$_POST['VATAmount']);
}elseif (isset($_POST['updSaveImports'])) {
	$MainActions->updSaveImports($_POST['importId'],$_POST['updCustomStation'],$_POST['updCustomDeclarationNo'],$_POST['updCustomDeclarationDate'],$_POST['updItemName'],$_POST['updCustomValue'],$_POST['updVATPaid']);
}elseif (isset($_POST['updSaveExpenses'])) {
	$MainActions->updSaveExpenses($_POST['expenseId'],$_POST['updExpenseName'],$_POST['updExpensePrice'],$_POST['updExpenseQuantity'],$_POST['updExpenseMethod']);
}elseif (isset($_POST['deletePurchases'])) {
	$MainActions->deletePurchases($_POST['idd']);
}elseif (isset($_POST['deleteImports'])) {
	$MainActions->deleteImports($_POST['idd']);
}elseif (isset($_POST['deleteExpenses'])) {
	$MainActions->deleteExpenses($_POST['idd']);
}







?>