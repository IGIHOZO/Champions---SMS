$(document).ready(function(){
	function hide(name){
		$(name).css("display","none");
		$(name).removeClass();
	}
	function empty(input) {
			$(input).val('');
		}
//==================================================================== LOGIN
	$("#Login").click(function(){	
		var username = $("#username").val();
		var password = $("#password").val();
		if (username=='' || password=='') {
			$("#respp").addClass("bg-yellow");
			$("#respp").css("display","block");
			$("#respp").html("Fill all fields ...");
			setTimeout(hide,10000,"#respp");
		}else{
			var Login = true;
			$.ajax({url:"main/action.php",
				type:"GET",data:{Login:Login,username:username,password:password},cache:false,success:function(res){
					switch(res){
						case 'wrong':
							$("#respp").addClass("bg-red");
							$("#respp").css("display","block");
							$("#respp").html("Wrong email or password");
							setTimeout(hide,10000,"#respp");
						break;
						case 'admin':
							$("#respp").addClass("bg-green");
							$("#respp").css("display","block");
							$("#respp").html("Redirecting ...");
							window.location="admin/home";
						break;
						case 'user':
							$("#respp").addClass("bg-green");
							$("#respp").css("display","block");
							$("#respp").html("Redirecting ...");
							window.location="seller/home";
						break;
						default:
							$("#respp").addClass("bg-red");
							$("#respp").css("display","block");
							$("#respp").html(res);
							setTimeout(hide,10000,"#respp");
						break;
					}
				}
			});
				}
	});

//=========================================================== REGISTER BRANCH

	$("#RegisterBranch").click(function(){	
		var name = $("#name").val();
		if (name=='') {
			$("#respp").addClass("bg-yellow");
			$("#respp").css("display","block");
			$("#respp").html("Fill all fields ...");
			setTimeout(hide,10000,"#respp");
		}else{
			var RegisterBranch = true;
			$.ajax({url:"../../../main/action.php",
				type:"GET",data:{RegisterBranch:RegisterBranch,name:name},cache:false,success:function(res){
					switch(res){
						case 'already':
							$("#respp").addClass("bg-yellow");
							$("#respp").css("display","block");
							$("#respp").html("Stock name already exist ...");
							setTimeout(hide,10000,"#respp");
						break;
						case 'success':
							$("#respp").addClass("bg-green");
							$("#respp").css("display","block");
							$("#respp").html("Stock successful Registered !");
							setTimeout(hide,10000,"#respp");
							$("#name").val('');
						break;
						case 'failed':
							$("#respp").addClass("bg-red");
							$("#respp").css("display","block");
							$("#respp").html("Redirecting ...");
							setTimeout(hide,10000,"#respp");
						break;
						default:
							$("#respp").addClass("bg-red");
							$("#respp").css("display","block");
							$("#respp").html(res);
							setTimeout(hide,10000,"#respp");
						break;
					}
				}
			});
		}
	});


//================================================== ORIENT EMPLOYEE TO BRANCH
	$("#BranchEmployeeSignUp").click(function(){	
		var names = $("#names").val();
		var phone= $("#phone").val();
		var pass = $("#pass").val();
		var cpass = $("#conf").val();
		var branch = $("#branch").val();
		if (names!='' && phone!='' && pass!='' && cpass!='' && branch!='') {
			if (pass==cpass) {
				// $("#respp").addClass("bg-grey");
				// $("#respp").css("display","block");
				$("#BranchEmployeeSignUp").prop('disabled',true);
				$("#BranchEmployeeSignUp").html('Please wait...');
				var BranchEmployeeSignUp = true;

				$.ajax({url:"../../../main/action.php",
				type:"GET",data:{BranchEmployeeSignUp:BranchEmployeeSignUp,names:names,phone:phone,pass:pass,branch:branch},cache:false,success:function(res){
						$("#BranchEmployeeSignUp").prop('disabled',false);
						$("#BranchEmployeeSignUp").html('Register');
						switch(res){
							case 'success':
								$("#respp").addClass("bg-green");
								$("#respp").css("display","block");
								$("#respp").html('Successful registered !');
								setTimeout(hide,10000,"#respp");
								setTimeout($("#names").val(''),$("#phone").val(''),$("#pass").val(''),$("#branch").val(''),$("#conf").val(''),4000);
							break;
							case 'failed':
								$("#respp").addClass("bg-red");
								$("#respp").css("display","block");
								$("#respp").html("Failed, try again later ...");
								setTimeout(hide,10000,"#respp");
							break;
							case 'already':
								$("#respp").addClass("bg-red");
								$("#respp").css("display","block");
								$("#respp").html('Employee already exists');
								setTimeout(hide,10000,"#respp");
							break;
							default:
								$("#respp").addClass("bg-red");
								$("#respp").css("display","block");
								$("#respp").html(res);
								setTimeout(hide,10000,"#respp");
							break;
						}
					}
				});
			}else{
				$("#respp").addClass("bg-red");
				$("#respp").css("display","block");
				$("#respp").html("Passwords are not matching ...");
				setTimeout(hide,10000,"#respp");
			}
		}else{
			$("#respp").addClass("bg-red");
			$("#respp").css("display","block");
			$("#respp").html("Fill all fields ...");
			setTimeout(hide,10000,"#respp");
		}
	});
//========================== hiding/showing Pieces per Box accordingly
$("#IsProductBox").change(function(){
	var IsProductBox = $("#IsProductBox").val();
	var ProductBoxPieces = null;
	if (IsProductBox==1) {
		$("#ProductBoxPiecesDiv").css("display","block");
		ProductBoxPieces = $("#ProductBoxPieces").val();
	}else{
		$("#ProductBoxPiecesDiv").css("display","none");
		ProductBoxPieces = null;
	}
})
//========================================== Registering new Product

$("#RegisterNewProduct").click(function(){
	var name = $("#name").val();
	var category = $("#category").val();
	var IsProductBox = $("#IsProductBox").val();
	var ProductBoxPieces = $("#ProductBoxPieces").val();
	if ((name=='' ||category=='' || IsProductBox=='') || (IsProductBox==1 && ProductBoxPieces=='')) {
			$("#respp").addClass("bg-red");
			$("#respp").css("display","block");
			$("#respp").html("Fill all fields ...");
			setTimeout(hide,10000,"#respp");
	}else{
		$("#RegisterNewProduct").prop('disabled',true);
		$("#RegisterNewProduct").html('Please wait...');
		var RegisterNewProduct = true;

		$.ajax({url:"../../../main/action.php",
				type:"GET",data:{RegisterNewProduct:RegisterNewProduct,name:name,category:category,IsProductBox:IsProductBox,ProductBoxPieces:ProductBoxPieces},cache:false,success:function(res){
			$("#RegisterNewProduct").prop('disabled',false);
			$("#RegisterNewProduct").html('Register');
			switch(res){
				case 'success':
					$("#respp").addClass("bg-green");
					$("#respp").css("display","block");
					$("#respp").html('Successful registered !');
					setTimeout(hide,10000,"#respp");
					setTimeout($("#names").val(''),$("#name").val(''),$("#category").val(''),$("#IsProductBox").val(''),$("#ProductBoxPieces").val(''),4000);
				break;
				case 'failed':
					$("#respp").addClass("bg-red");
					$("#respp").css("display","block");
					$("#respp").html("Failed, try again later ...");
					setTimeout(hide,10000,"#respp");
				break;
				case 'already':
					$("#respp").addClass("bg-red");
					$("#respp").css("display","block");
					$("#respp").html('product already exists');
					setTimeout(hide,10000,"#respp");
				break;
				default:
					$("#respp").addClass("bg-red");
					$("#respp").css("display","block");
					$("#respp").html(res);
					setTimeout(hide,10000,"#respp");
				break;
			}
		}});
	}
})

$("#OrientProductsToMainStock").click(function(){	//=================================================== ORIENT PRODUCTS TO MAIN WAREHOUSE OFFICE STOCK
	var product = $("#product").val();
	var added = $("#added").val();
	var IsProductBox = $("#IsProductBox").val();
	var AvailableWarehouses = $("#AvailableWarehouses").val();
	if (product=='' || added=='' || IsProductBox=='' || AvailableWarehouses=='') {
		$("#respp").addClass("bg-red");
		$("#respp").css("display","block");
		$("#respp").html("Fill all fields ...");
		setTimeout(hide,10000,"#respp");
	}else{
		$("#OrientProductsToMainStock").prop('disabled',true);
		$("#OrientProductsToMainStock").html('Please wait...');
		var OrientProductsToMainStock = true;

		$.ajax({url:"../../../main/action.php",
				type:"GET",data:{OrientProductsToMainStock:OrientProductsToMainStock,product:product,added:added,IsProductBox:IsProductBox,AvailableWarehouses:AvailableWarehouses},cache:false,success:function(res){
			$("#OrientProductsToMainStock").prop('disabled',false);
			$("#OrientProductsToMainStock").html('Register');
			switch(res){
				case 'success':
					$("#respp").addClass("bg-green");
					$("#respp").css("display","block");
					$("#respp").html('Successful recorded !');
					setTimeout(hide,10000,"#respp");
					setTimeout($("#product").val(''),$("#added").val(''),$("#IsProductBox").val(''),4000);
				break;
				case 'failed':
					$("#respp").addClass("bg-red");
					$("#respp").css("display","block");
					$("#respp").html("Failed, try again later ...");
					setTimeout(hide,10000,"#respp");
				break;
				default:
					$("#respp").addClass("bg-red");
					$("#respp").css("display","block");
					$("#respp").html(res);
					setTimeout(hide,10000,"#respp");
				break;
			}
		}});

	}
})

$("#OrientProductsToHeadStock").click(function(){	//=================================================== ORIENT PRODUCTS head-office stock OFFICE STOCK
	var product = $("#product").val();
	var added = $("#added").val();
	var warehouses = $("#warehouses").val();
	var IsProductBox = $("#IsProductBox").val();
	if (product=='' || added=='' || IsProductBox=='' || warehouses=='') {
		$("#respp").addClass("bg-red");
		$("#respp").css("display","block");
		$("#respp").html("Fill all fields ...");
		setTimeout(hide,10000,"#respp");
	}else{
		$("#OrientProductsToHeadStock").prop('disabled',true);
		$("#OrientProductsToHeadStock").html('Please wait...');
		var OrientProductsToHeadStock = true;

		$.ajax({url:"../../../main/action.php",
				type:"GET",data:{OrientProductsToHeadStock:OrientProductsToHeadStock,product:product,added:added,IsProductBox:IsProductBox,warehouses:warehouses},cache:false,success:function(res){
			$("#OrientProductsToHeadStock").prop('disabled',false);
			$("#OrientProductsToHeadStock").html('Register');
			switch(res){
				case 'seccess':
					$("#respp").addClass("bg-green");
					$("#respp").css("display","block");
					$("#respp").html('Successful recorded !');
					setTimeout(hide,10000,"#respp");
					setTimeout($("#product").val(''),$("#added").val(''),$("#IsProductBox").val(''),4000);
				break;
				case 'failed':
					$("#respp").addClass("bg-red");
					$("#respp").css("display","block");
					$("#respp").html("Failed, try again later ...");
					setTimeout(hide,10000,"#respp");
				break;
				case 'not_enough':
					$("#respp").addClass("bg-yellow");
					$("#respp").css("display","block");
					$("#respp").html("Amount entered is more than the one remaining in stock ...");
					setTimeout(hide,10000,"#respp");
				break;
				default:
					$("#respp").addClass("bg-red");
					$("#respp").css("display","block");
					$("#respp").html(res);
					setTimeout(hide,10000,"#respp");
				break;
			}
		}});

	}
})


$("#OrientProductsToBranchStock").click(function(){	//=================================================== ORIENT PRODUCTS branch-office stock OFFICE STOCK
	var branch_id = $("#branch_id").val();
	var product_id = $("#product_id").val();
	var IsProductBox = $("#IsProductBox").val();
	var product_price = $("#product_price").val();
	var added = $("#added").val();

	if (branch_id=='' || product_id=='' || IsProductBox=='' || product_price=='' || added=='') {
		$("#respp").addClass("bg-red");
		$("#respp").css("display","block");
		$("#respp").html("Fill all fields ...");
		setTimeout(hide,10000,"#respp");
	}else{
		$("#OrientProductsToBranchStock").prop('disabled',true);
		$("#OrientProductsToBranchStock").html('Please wait...');
		var OrientProductsToBranchStock = true;

		$.ajax({url:"../../../main/action.php",
				type:"GET",data:{OrientProductsToBranchStock:OrientProductsToBranchStock,branch_id:branch_id,product_id:product_id,IsProductBox:IsProductBox,product_price:product_price,added:added},cache:false,success:function(res){
			$("#OrientProductsToBranchStock").prop('disabled',false);
			$("#OrientProductsToBranchStock").html('Register');
			switch(res){
				case 'success':
					$("#respp").addClass("bg-green");
					$("#respp").css("display","block");
					$("#respp").html('Successful recorded !');
					window.location.reload();
					setTimeout(hide,10000,"#respp");
					setTimeout($("#branch_id").val(''),$("#product_id").val(''),$("#IsProductBox").val(''),$("#product_price").val(''),$("#added").val(''),4000);
				break;
				case 'failed':
					$("#respp").addClass("bg-red");
					$("#respp").css("display","block");
					$("#respp").html("Failed, try again later ...");
					// $("#respp").html(res);

					setTimeout(hide,10000,"#respp");
				break;
				case 'not_enough':
					$("#respp").addClass("bg-yellow");
					$("#respp").css("display","block");
					$("#respp").html("Amount entered is more than the one remaining in stock ...");
					setTimeout(hide,10000,"#respp");
				break;
				default:
					$("#respp").addClass("bg-red");
					$("#respp").css("display","block");
					$("#respp").html(res);
					setTimeout(hide,10000,"#respp");
				break;
			}
		}});

	}
})

$("#StockOut").click(function(){		//======================================================================================== STOCK-OUT
	var product_id = $("#product_id").val();
	var IsProductBox = $("#IsProductBox").val();
	var soldPrice = $("#soldPrice").val();
	var quantitySold = $("#quantitySold").val();
	var paymentMethod = $("#paymentMethod").val();

	var paymentWayPaid = $("#paymentWayPaid").val();
	var paymentWayDebt = $("#paymentWayDebt").val();
	var clientName = $("#clientName").val();
	var companyName = $("#companyName").val();
	var clientPhone = $("#clientPhone").val();
	var paymentWay = null;
	if (paymentMethod==1 || paymentMethod=='1') {
		paymentWay = paymentWayPaid;
	}else if (paymentMethod==0 || paymentMethod=='0') {
		paymentWay = paymentWayDebt;
	}


	if (product_id=='' || IsProductBox=='' || soldPrice=='' || quantitySold=='' || paymentMethod=='' || paymentWay=='' || clientName=='' || clientPhone=='') {
		$("#respp").addClass("bg-red");
		$("#respp").css("display","block");
		$("#respp").html("Fill all fields ...");
		setTimeout(hide,10000,"#respp");
	}else{
		$("#StockOut").prop('disabled',true);
		$("#StockOut").html('Please wait...');
		var StockOut = true;

		$.ajax({url:"../../main/action.php",
				type:"GET",data:{StockOut:StockOut,product_id:product_id,IsProductBox:IsProductBox,soldPrice:soldPrice,quantitySold:quantitySold,paymentMethod:paymentMethod,paymentWay:paymentWay,clientName:clientName,companyName:companyName,clientPhone:clientPhone},cache:false,success:function(res){
			$("#StockOut").prop('disabled',false);
			$("#StockOut").html('Register');
			switch(res){
				case 'success':
					$("#respp").addClass("bg-green");
					$("#respp").css("display","block");
					$("#respp").html('Successful recorded !');
					setTimeout(hide,10000,"#respp");
					setTimeout($("#product_id").val(''),$("#IsProductBox").val(''),$("#soldPrice").val(''),$("#quantitySold").val(''),$("#paymentMethod").val(''),$("#paymentWayPaid").val(''),$("#paymentWayDebt").val(''),$("#clientName").val(''),$("#clientPhone").val(''),4000);
				break;
				case 'failed':
					$("#respp").addClass("bg-red");
					$("#respp").css("display","block");
					$("#respp").html("Failed, try again later ...");
					// $("#respp").html(res);

					setTimeout(hide,10000,"#respp");
				break;
				case 'not_enough':
					$("#respp").addClass("bg-yellow");
					$("#respp").css("display","block");
					$("#respp").html("Amount entered is more than the one remaining in stock ...");
					setTimeout(hide,10000,"#respp");
				break;
				default:
					$("#respp").addClass("bg-red");
					$("#respp").css("display","block");
					$("#respp").html(res);
					setTimeout(hide,10000,"#respp");
				break;
			}
		}});

	}
})


$("#paymentMethod").change(function(){
	// alert("hello");
  var paymentMethod = $("#paymentMethod").val();
  switch (paymentMethod){
  	case '1':
  		$("#paymentWayPaidDiv").css("display","block");
  		$("#paymentWayDebtDiv").css("display","none");
  	break;

  	case '0':
  		$("#paymentWayPaidDiv").css("display","none");
  		$("#paymentWayDebtDiv").css("display","block");
  	break;

  	default:
  		$("#paymentWayPaidDiv").css("display","none");
  		$("#paymentWayDebtDiv").css("display","none");
  	break;
  }
});


$("#UpdBranchEmployeeSignUp").click(function(){
	var empId = $("#MemberID").val();
	var empName = $("#upd_names").val();
	var empPhone = $("#upd_phone").val();
	var empStock = $("#upd_branch").val();
	if (empId!='' && empName!='' && empPhone!='' && empStock!='') {
		var UpdBranchEmployee = true;
      $.ajax({url:"../../../main/action.php",
        type:"GET",data:{UpdBranchEmployee:UpdBranchEmployee,empId:empId,empName:empName,empPhone:empPhone,empStock:empStock},cache:false,success:function(res){  
        	window.location.reload();
        	// console.log(res);
          }
      });
	}else{
		alert("Fill all fields ...");
	}
})


$("#UpdateProductStockhBtn").click(function(){
	var hdnproductid = $("#hdnproductid").val();
	var initialStock = $("#initialStock").val();
	var totalIn = $("#totalIn").val();
	var totalOut = $("#totalOut").val();
	var remaining = $("#remaining").val();
	var branchid = $("#hdnbranchid").val();
	if (hdnproductid!='' && initialStock!='' && totalIn!='' && totalOut!='' && remaining!='' && branchid!='') {
		var UpdateProductStockh = true;
      $.ajax({url:"../../main/action.php",
        type:"POST",data:{UpdateProductStockh:UpdateProductStockh,hdnproductid:hdnproductid,initialStock:initialStock,totalIn:totalIn,totalOut:totalOut,remaining:remaining,branchid:branchid},cache:false,success:function(res){  
        	window.location.reload();
        	// console.log(res);
          }
      });
      // console.log(branchid);
	}else{
		alert("Fill all fields ...");
	}
})


$("#SavePurchase").click(function(){
  var TINNumber = $("#TINNumber").val();
  var SupplierName = $("#SupplierName").val();
  var ItemName = $("#ItemName").val();
  var InvoiceNumber = $("#InvoiceNumber").val();
  var InvoiceDate = $("#InvoiceDate").val();
  var Inclusive = $("#Inclusive").val();
  var VATAmount = $("#VATAmount").val();
  if (TINNumber!='' && SupplierName!='' && ItemName!='' && InvoiceNumber!='' && InvoiceDate!='' && Inclusive!='' && VATAmount!='') {
    var SavePurchase = true;
      $.ajax({url:"../main/action.php",
        type:"POST",data:{SavePurchase:SavePurchase,TINNumber:TINNumber,SupplierName:SupplierName,ItemName:ItemName,InvoiceNumber:InvoiceNumber,InvoiceDate:InvoiceDate,Inclusive:Inclusive,VATAmount:VATAmount},cache:false,success:function(res){  
          window.location.reload();
          // console.log(res);
          }
      });
  }else{
    alert("Fill all fields ...");
  }
})

$("#SaveImports").click(function(){
  var CustomStation = $("#CustomStation").val();
  var CustomDeclarationNo = $("#CustomDeclarationNo").val();
  var CustomDeclarationDate = $("#CustomDeclarationDate").val();
  var ItemName = $("#ItemName").val();
  var CustomValue = $("#CustomValue").val();
  var VATPaid = $("#VATPaid").val();
  if (CustomStation!='' && CustomDeclarationNo!='' && CustomDeclarationDate!='' && ItemName!='' && CustomValue!='' && VATPaid!='') {
    var SaveImports = true;
      $.ajax({url:"../main/action.php",
        type:"POST",data:{SaveImports:SaveImports,CustomStation:CustomStation,CustomDeclarationNo:CustomDeclarationNo,CustomDeclarationDate:CustomDeclarationDate,ItemName:ItemName,CustomValue:CustomValue,VATPaid:VATPaid},cache:false,success:function(res){  
          window.location.reload();
          // console.log(res);
          }
      });
  }else{
    alert("Fill all fields ...");
  }
})

$("#SaveExpenses").click(function(){
  var ExpenseName = $("#ExpenseName").val();
  var ExpensePrice = $("#ExpensePrice").val();
  var ExpenseQuantity = $("#ExpenseQuantity").val();
  var ExpenseMethod = $("#ExpenseMethod").val();

  if (ExpenseName!='' && ExpensePrice!='' && ExpenseQuantity!='' && ExpenseMethod!='') {
    var SaveExpenses = true;
      $.ajax({url:"../main/action.php",
        type:"POST",data:{SaveExpenses:SaveExpenses,ExpenseName:ExpenseName,ExpensePrice:ExpensePrice,ExpenseQuantity:ExpenseQuantity,ExpenseMethod:ExpenseMethod},cache:false,success:function(res){  
          window.location.reload();
          // console.log(res);
          }
      });
  }else{
    alert("Fill all fields ...");
  }
})


















});