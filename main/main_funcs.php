<?php
require("drive/config.php");
/**
* =========================================== MAIN FUNCTIONS
*/
class MainFunctions extends DBConnect
{
	
	function BoxPieces($product_id)		// RETURNS NUMBERS OF PIECES IN ONE BO (IF YES)
	{
		$con = parent::connect();
		$sel = $con->prepare("SELECT * FROM products WHERE products.ProductId='$product_id'");
		$sel->bindValue(1,$product_id);
		$sel->execute();
		if ($sel->rowCount()==1) {
			$ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
			if ($ft_sel['IsProductBox']==1) {
				$res = $ft_sel['ProductBoxPieces'];
			}else{
				$res = 1;
			}
		}else{
			$res = 0;
		}
		return $res;
	}
	function IsProductBox($product_id)		// RETURNS EITHER OR NOT THE PRODUCT IS BOX type
	{
		$con = parent::connect();
		$sel = $con->prepare("SELECT * FROM products WHERE products.ProductId='$product_id'");
		$sel->bindValue(1,$product_id);
		$sel->execute();
		if ($sel->rowCount()==1) {
			$res = false;
			$ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
			if ($ft_sel['IsProductBox']==1) {
				$res = true;
			}else{
				$res = false;
			}
		}
		return $res;
	}

	public function SaveStockTransaction($product,$UserId,$FromStock,$ToStock,$IsProductBox,$QuantityBefore,$QuantityAdded,$QuantityAfter)		//======= saving every transction done (in or out)
	{
		$con = parent::connect();
		$ins = $con->prepare("INSERT INTO stocktransactions(ProductId,UserId,FromStock,ToStock,IsProductBox,QuantityBefore,QuantityAdded,QuantityAfter) VALUES(?,?,?,?,?,?,?,?)");
		$ins->bindValue(1,$product);
		$ins->bindValue(2,$UserId);
		$ins->bindValue(3,$FromStock);
		$ins->bindValue(4,$ToStock);
		$ins->bindValue(5,$IsProductBox);
		$ins->bindValue(6,$QuantityBefore);
		$ins->bindValue(7,$QuantityAdded);
		$ins->bindValue(8,$QuantityAfter);
		$ok = $ins->execute();
		if ($ok) {
			$resp = true;
		}else{
			$resp = true;
		}
		return $resp;
	}
}
?>