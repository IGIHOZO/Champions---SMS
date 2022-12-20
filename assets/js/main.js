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
						case 'no':
							$("#respp").addClass("bg-red");
							$("#respp").css("display","block");
							$("#respp").html("Not authorized ...");
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
		var path = window.location.pathname;
		var page = path.split("/").pop();
		
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
				if(page=='manager'){
					var BranchEmployeeSignUp = "manager";
				}else if(page=='employee'){
					var BranchEmployeeSignUp = "employee";
				}
				// var BranchEmployeeSignUp = true;

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
		// $("#ProductBoxPiecesDiv").css("display","block");
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
	// var ProductBoxPieces = $("#ProductBoxPieces").val();
	var ProductBoxPieces = 1;

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
					setTimeout(window.location.reload(true),4000);
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
	var product_price = 1;
	var warehouseId = $("#warehouseId").val();
	var added = $("#added").val();

	if (branch_id=='' || product_id=='' || IsProductBox=='' || added=='' || warehouseId=='') {
		$("#respp").addClass("bg-red");
		$("#respp").css("display","block");
		$("#respp").html("Fill all fields ...");
		setTimeout(hide,10000,"#respp");
	}else{
		$("#OrientProductsToBranchStock").prop('disabled',true);
		$("#OrientProductsToBranchStock").html('Please wait...');
		var OrientProductsToBranchStock = true;
		console.log(OrientProductsToBranchStock+"\n");
		console.log(branch_id+"\n");
		console.log(product_id+"\n");
		console.log(IsProductBox+"\n");
		console.log(product_price+"\n");
		console.log(added+"\n");
		console.log(warehouseId+"\n");
		$.ajax({url:"../../../main/action.php",
				type:"GET",data:{
					OrientProductsToBranchStock:OrientProductsToBranchStock,
					branch_id:branch_id,
					product_id:product_id,
					IsProductBox:IsProductBox,
					product_price:product_price,
					added:added,
					warehouseId:warehouseId},cache:false,success:function(res){
			$("#OrientProductsToBranchStock").prop('disabled',false);
			$("#OrientProductsToBranchStock").html('Register');
			switch(res){
				case 'success':
					$("#respp").addClass("bg-green");
					$("#respp").css("display","block");
					$("#respp").html('Successful recorded !');
					// window.location.reload();
					setTimeout(hide,10000,"#respp");
					setTimeout($("#branch_id").val(''),$("#product_id").val(''),$("#IsProductBox").val(''),$("#product_price").val(''),$("#warehouseId").val(''),$("#added").val(''),4000);
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
	var invNumbr = $("#invNumbr").val();

	var paymentWayPaid = $("#paymentWayPaid").val();
	var paymentWayDebt = $("#paymentWayDebt").val();
	var clientName = $("#clientName").val();
	var companyName = $("#companyName").val();
	var clientPhone = $("#clientPhone").val();
	var member = $("#mmbrName").val();
	var mpin = $("#memberspin1").val();
	var rempin = $("#re_memberspin1").val();
	var paymentWay = null;
	if (paymentMethod==1 || paymentMethod=='1') {
		paymentWay = paymentWayPaid;
	}else if (paymentMethod==0 || paymentMethod=='0') {
		paymentWay = paymentWayDebt;
	}

	if(mpin==rempin){
		if (mpin=='' || rempin=='' || product_id=='' || IsProductBox=='' || soldPrice=='' || quantitySold=='' || paymentMethod=='' || paymentWay=='' || clientName=='' || clientPhone=='' || invNumbr=='' || member=='') {

			// console.log("mpin: "+mpin);
			// console.log("rempin: "+rempin);
			// console.log("product_id: "+product_id);
			// console.log("IsProductBox: "+IsProductBox);
			// console.log("soldPrice: "+soldPrice);
			// console.log("quantitySold: "+quantitySold);
			// console.log("paymentMethod: "+paymentMethod);
			// console.log("paymentWay: "+paymentWay);
			// console.log("clientName: "+clientName);
			// console.log("clientPhone: "+clientPhone);
			// console.log("invNumbr: "+invNumbr);
			// console.log("member: "+member);

			$("#respp").addClass("bg-red");
			$("#respp").css("display","block");
			$("#respp").html("Fill all fields ...");
			setTimeout(hide,10000,"#respp");
		}else{
			$("#StockOut").prop('disabled',true);
			$("#StockOut").html('Please wait...');
			var StockOut = true;
	
			$.ajax({url:"../../main/action.php",
					type:"GET",data:{StockOut:StockOut,product_id:product_id,IsProductBox:IsProductBox,soldPrice:soldPrice,quantitySold:quantitySold,paymentMethod:paymentMethod,paymentWay:paymentWay,clientName:clientName,companyName:companyName,clientPhone:clientPhone,invNumbr:invNumbr,member:member,mpin:mpin},cache:false,success:function(res){
				$("#StockOut").prop('disabled',false);
				$("#StockOut").html('Ok, Save');
				switch(res){
					case 'success':
						$("#respp").addClass("bg-green");
						$("#respp").css("display","block");
						$("#respp").html('Successful recorded !');
						setTimeout(window.location.reload(true),10000);
						setTimeout(hide,10000,"#respp");
						setTimeout($("#product_id").val(''),$("#IsProductBox").val(''),$("#soldPrice").val(''),$("#quantitySold").val(''),$("#paymentMethod").val(''),$("#paymentWayPaid").val(''),$("#paymentWayDebt").val(''),$("#clientName").val(''),$("#clientPhone").val(''),$("#companyName").val(''),4000);
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
					case 'invalid':
						$("#respp").addClass("bg-yellow");
						$("#respp").css("display","block");
						$("#respp").html("Invalid PIN ...");
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
	}else{
		$("#respp").addClass("bg-red");
		$("#respp").css("display","block");
		$("#respp").html("PIN not match ...");
		setTimeout(hide,10000,"#respp");
		console.log(mpin+" - "+rempin);
	}

})

$("#StockOutAllTrans").click(function(){		//========================================================= STOCK-OUT FOR ALL TRANSACTIONS
	// console.log("New Button");
	var product_id = $("#hdn_product_id").val();
	var IsProductBox = $("#hdn_IsProductBox").val();
	var soldPrice = $("#hdn_soldPrice").val();
	var quantitySold = $("#hdn_quantitySold").val();
	var paymentMethod = $("#paymentMethod").val();
	var invNumbr = $("#hdn_invNumbr").val();

	var paymentWayPaid = $("#paymentWayPaid").val();
	var paymentWayDebt = $("#paymentWayDebt").val();
	var clientName = $("#hdn_clientName").val();
	var companyName = $("#hdn_companyName").val();
	var clientPhone = $("#hdn_clientPhone").val();
	var memberID = $("#hdn_mmbrName").val();
	var mpin = $("#memberspin2").val();
	var rempin = $("#re_memberspin2").val();
	var paymentWay = null;
	if (paymentMethod==1 || paymentMethod=='1') {
		paymentWay = paymentWayPaid;
	}else if (paymentMethod==0 || paymentMethod=='0') {
		paymentWay = paymentWayDebt;
	}

if(mpin==rempin){
	if (memberID=='' || mpin=='' || rempin=='' || product_id=='' || IsProductBox=='' || soldPrice=='' || quantitySold=='' || paymentMethod=='' || paymentWay=='' || clientName=='' || clientPhone=='' || invNumbr=='') {
		$("#respp_alltr").addClass("bg-red");
		$("#respp_alltr").css("display","block");
		$("#respp_alltr").html("Fill all fields ...");
		setTimeout(hide,10000,"#respp_alltr");
	}else{
		$("#StockOutAllTrans").prop('disabled',true);
		$("#StockOutAllTrans").html('Please wait...');
		var StockOutAllTrans = true;

		$.ajax({url:"../../main/action.php",
				type:"GET",data:{memberID:memberID,StockOutAllTrans:StockOutAllTrans,product_id:product_id,IsProductBox:IsProductBox,soldPrice:soldPrice,quantitySold:quantitySold,paymentMethod:paymentMethod,paymentWay:paymentWay,clientName:clientName,companyName:companyName,clientPhone:clientPhone,invNumbr:invNumbr,mpin:mpin},cache:false,success:function(res){
			$("#StockOutAllTrans").prop('disabled',false);
			$("#StockOutAllTrans").html('Ok, Save');
			$("resp_newItm").html("");
			switch(res){
				case 'success':
					$("#respp_alltr").addClass("bg-green");
					$("#respp_alltr").css("display","block");
					$("#respp_alltr").html('Successful recorded !');
					setTimeout(hide,10000,"#respp_alltr");
					setTimeout(window.location.reload(true),10000);
					setTimeout($("#product_id").val(''),$("#IsProductBox").val(''),$("#soldPrice").val(''),$("#quantitySold").val(''),$("#paymentMethod").val(''),$("#paymentWayPaid").val(''),$("#paymentWayDebt").val(''),$("#clientName").val(''),$("#clientPhone").val(''),$("#companyName").val(''),4000);
				break;
				case 'failed':
					$("#respp_alltr").addClass("bg-red");
					$("#respp_alltr").css("display","block");
					$("#respp_alltr").html("Failed, try again later ...");
					// $("#respp").html(res);

					setTimeout(hide,10000,"#respp_alltr");
				break;
				case 'not_enough':
					$("#respp_alltr").addClass("bg-yellow");
					$("#respp_alltr").css("display","block");
					$("#respp_alltr").html("Amount entered is more than the one remaining in stock ...");
					setTimeout(hide,10000,"#respp_alltr");
				break;
				case 'invalid':
					$("#respp_alltr").addClass("bg-red");
					$("#respp_alltr").css("display","block");
					$("#respp_alltr").html("Incorrect member PIN ...");
					setTimeout(hide,10000,"#respp_alltr");
				break;
				default:
					$("#respp_alltr").addClass("bg-red");
					$("#respp_alltr").css("display","block");
					$("#respp_alltr").html(res);
					setTimeout(hide,10000,"#respp_alltr");
				break;
			}
		}});

	}
}else{
	$("#respp_alltr").addClass("bg-red");
	$("#respp_alltr").css("display","block");
	$("#respp_alltr").html("PIN not match ...");
	setTimeout(hide,10000,"#respp_alltr");
	// console.log(mpin);
	// console.log(re_memberspin);
}


})

$("#AddNewTrans").click(function(){		//======================================================================================== Add New StockOut
	console.log("synced");
	
	var product_id = $("#product_id").val();
	var IsProductBox = $("#IsProductBox").val();
	var soldPrice = $("#soldPrice").val();
	var quantitySold = $("#quantitySold").val();
	var paymentMethod = $("#paymentMethod").val();
	var invNumbr = $("#invNumbr").val();

	var paymentWayPaid = $("#paymentWayPaid").val();
	var paymentWayDebt = $("#paymentWayDebt").val();
	var clientName = $("#clientName").val();
	var companyName = $("#companyName").val();
	var clientPhone = $("#clientPhone").val();
	var mmbrName = $("#mmbrName").val();
	var memberspin = $("#memberspin").val();
	var paymentWay = null;
	var pp = document.getElementById("product_id");
	var ut = document.getElementById("IsProductBox");
	var sm = document.getElementById("paymentMethod");
	var mn = document.getElementById("mmbrName");


	var textProduct = pp.options[pp.selectedIndex].innerHTML;
	var textMember = mn.options[mn.selectedIndex].innerHTML;
	// var textUnitType = ut.options[ut.selectedIndex].innerHTML;
	var textUnitType = 1;
	var textPaymentMethod = sm.options[sm.selectedIndex].innerHTML;
	if (paymentMethod==1 || paymentMethod=='1') {
		paymentWay = paymentWayPaid;
	}else if (paymentMethod==0 || paymentMethod=='0') {
		paymentWay = paymentWayDebt;
	}
	console.log("NEW-paymentWay: "+paymentWay);
	console.log("NEW-paymentWayDebt: "+paymentWayDebt);
	console.log("NEW-paymentWayPaid: "+paymentWayPaid);
	console.log("NEW-paymentWay: "+paymentWay);
	console.log("NEW-paymentMethod: "+paymentMethod);

	// if (product_id=='' || soldPrice=='' || quantitySold=='' || paymentMethod=='' || paymentWay=='' || clientName=='' || clientPhone=='' || invNumbr=='') {
	if (product_id=='' || soldPrice=='' || quantitySold=='' || clientName=='' || clientPhone=='' || invNumbr=='') {

		console.log("one");
			// console.log("mpin: "+mpin);
			// console.log("rempin: "+rempin);
			var IsProductBox = 0;
			console.log("product_id: "+product_id);
			console.log("IsProductBox: "+IsProductBox);
			console.log("soldPrice: "+soldPrice);
			console.log("quantitySold: "+quantitySold);
			console.log("paymentMethod: "+paymentMethod);
			console.log("paymentWay: "+paymentWay);
			console.log("clientName: "+clientName);
			console.log("clientPhone: "+clientPhone);
			console.log("invNumbr: "+invNumbr);
			var hdn_ttl = $("#hdn_product_id").val();
			// console.log("memberspin: "+memberspin);

		$("#respp").addClass("bg-red");
		$("#respp").css("display","block");
		$("#respp").html("Fill all fields ...");
		setTimeout(hide,10000,"#respp");
	}else{
		console.log("two");
		$("#StockOut").prop('disabled',true);
		$("#StockOut").html('Please wait...');
		// var StockOut = true;
		$("#StockOut").css("display","none");
		var hdn_product_id = $("#hdn_product_id").val();
		var hdn_IsProductBox = $("#hdn_IsProductBox").val();
		var hdn_soldPrice = $("#hdn_soldPrice").val();
		var hdn_quantitySold = $("#hdn_quantitySold").val();
		var hdn_paymentMethod = $("#hdn_paymentMethod").val();
		var hdn_paymentWay = $("#hdn_paymentWay").val();
		var hdn_invNumbr = $("#hdn_invNumbr").val();
		var hdn_paymentWayPaid = $("#hdn_paymentWayPaid").val();
		var hdn_paymentWayDebt = $("#hdn_paymentWayDebt").val();
		var hdn_clientName = $("#hdn_clientName").val();
		var hdn_companyName = $("#hdn_companyName").val();
		var hdn_clientPhone = $("#hdn_clientPhone").val();
		var hdn_mmbrName = $("#hdn_mmbrName").val();
		var hdn_memberspin = $("#hdn_memberspin").val();
		var hhdndnTtl = $("#hhdndn_ttl").val();
		if(hhdndnTtl=='' || hhdndnTtl==null){
			hhdndnTtl=0;
		}
		

		$("#product_id").val('');$("#IsProductBox").val('');$("#soldPrice").val('');$("#quantitySold").val('');$("#ttl").val('0');
		if(hdn_product_id==""){
			console.log("First IN");
			document.getElementById("hdn_product_id").value = product_id;
			document.getElementById("hdn_IsProductBox").value = IsProductBox;
			document.getElementById("hdn_soldPrice").value = soldPrice;
			document.getElementById("hdn_quantitySold").value = quantitySold;
			document.getElementById("hdn_paymentMethod").value = paymentMethod;
			document.getElementById("hdn_invNumbr").value = invNumbr;
			document.getElementById("hdn_paymentWayPaid").value = paymentWayPaid;
			document.getElementById("hdn_paymentWayDebt").value = paymentWayDebt;
			document.getElementById("hdn_paymentWay").value = hdn_paymentWay;
			document.getElementById("hdn_clientName").value = clientName;
			document.getElementById("hdn_companyName").value = companyName;
			document.getElementById("hdn_clientPhone").value = clientPhone;
			document.getElementById("hdn_mmbrName").value = mmbrName;
			document.getElementById("hdn_memberspin").value = memberspin;
			var ttl = parseInt(parseInt(hhdndnTtl)+(soldPrice*quantitySold));
			document.getElementById("hhdndn_ttl").value = ttl;
			document.getElementById("resttl").value = ttl;
			console.log("ttl 1 : "+hhdndnTtl);
			$("#ApproveBtn").css("display","none");
			$("#SaveBtn").css("display","block");
			$("#resp_newItm").append("<tr> <td>*</td>  <td>"+textProduct+"</td> <td>"+quantitySold+"</td> <td>"+soldPrice+"</td> <td>"+(soldPrice*quantitySold)+"</td></tr>");
			$("#respBtn").css("display","block");
		}else{
			console.log("Second IN");
			document.getElementById("hdn_product_id").value = hdn_product_id+","+product_id;
			document.getElementById("hdn_IsProductBox").value = hdn_IsProductBox+","+IsProductBox;
			document.getElementById("hdn_soldPrice").value = hdn_soldPrice+","+soldPrice;
			document.getElementById("hdn_quantitySold").value = hdn_quantitySold+","+quantitySold;
			document.getElementById("hdn_paymentMethod").value = hdn_paymentMethod+","+paymentMethod;
			document.getElementById("hdn_paymentWay").value = hdn_paymentWay+","+paymentMethod;
			document.getElementById("hdn_invNumbr").value = hdn_invNumbr+","+invNumbr;
			document.getElementById("hdn_paymentWayPaid").value = hdn_paymentWayPaid+","+paymentWayPaid;
			document.getElementById("hdn_paymentWayDebt").value = hdn_paymentWayDebt+","+paymentWayDebt;
			document.getElementById("hdn_clientName").value = hdn_clientName+","+clientName;
			document.getElementById("hdn_companyName").value = hdn_companyName+","+companyName;
			document.getElementById("hdn_clientPhone").value = hdn_clientPhone+","+clientPhone;
			document.getElementById("hdn_mmbrName").value = hdn_mmbrName+","+mmbrName;
			document.getElementById("hdn_memberspin").value = hdn_memberspin+","+memberspin;
			var ttl = parseInt(parseInt(hhdndnTtl)+(soldPrice*quantitySold));
			document.getElementById("hhdndn_ttl").value = ttl;
			document.getElementById("resttl").value = ttl;
			console.log("ttl 2 : "+hhdndnTtl);
			$("#ApproveBtn").css("display","none");
			$("#SaveBtn").css("display","block");
			$("#resttl").html(ttl);
			$("#resp_newItm").append("<tr> <td>*</td> <td>"+textProduct+"</td> <td>"+quantitySold+"</td> <td>"+soldPrice+"</td> <td>"+(soldPrice*quantitySold)+"</td></tr>");
		}

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

$("#SavePurchaseBranch").click(function(){
	var TINNumber = $("#TINNumber").val();
	var SupplierName = $("#SupplierName").val();
	var ItemName = $("#ItemName").val();
	var InvoiceNumber = $("#InvoiceNumber").val();
	var InvoiceDate = $("#InvoiceDate").val();
	var Inclusive = $("#Inclusive").val();
	var VATAmount = $("#VATAmount").val();
	if (TINNumber!='' && SupplierName!='' && ItemName!='' && InvoiceNumber!='' && InvoiceDate!='' && Inclusive!='' && VATAmount!='') {
	  var SavePurchaseBranch = true;
		$.ajax({url:"../../main/action.php",
		  type:"POST",data:{SavePurchaseBranch:SavePurchaseBranch,TINNumber:TINNumber,SupplierName:SupplierName,ItemName:ItemName,InvoiceNumber:InvoiceNumber,InvoiceDate:InvoiceDate,Inclusive:Inclusive,VATAmount:VATAmount},cache:false,success:function(res){  
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

$("#SaveImportsBranch").click(function(){
	var CustomStation = $("#CustomStation").val();
	var CustomDeclarationNo = $("#CustomDeclarationNo").val();
	var CustomDeclarationDate = $("#CustomDeclarationDate").val();
	var ItemName = $("#ItemName").val();
	var CustomValue = $("#CustomValue").val();
	var VATPaid = $("#VATPaid").val();
	if (CustomStation!='' && CustomDeclarationNo!='' && CustomDeclarationDate!='' && ItemName!='' && CustomValue!='' && VATPaid!='') {
	  var SaveImportsBranch = true;
		$.ajax({url:"../../main/action.php",
		  type:"POST",data:{SaveImportsBranch:SaveImportsBranch,CustomStation:CustomStation,CustomDeclarationNo:CustomDeclarationNo,CustomDeclarationDate:CustomDeclarationDate,ItemName:ItemName,CustomValue:CustomValue,VATPaid:VATPaid},cache:false,success:function(res){  
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

$("#SaveExpensesBranch").click(function(){
	var ExpenseName = $("#ExpenseName").val();
	var ExpensePrice = $("#ExpensePrice").val();
	var ExpenseQuantity = $("#ExpenseQuantity").val();
	var ExpenseMethod = $("#ExpenseMethod").val();
	if (ExpenseName!='' && ExpensePrice!='' && ExpenseQuantity!='' && ExpenseMethod!='') {
	var SaveExpensesBranch = true;
		$.ajax({url:"../../main/action.php",
		type:"POST",data:{SaveExpensesBranch:SaveExpensesBranch,ExpenseName:ExpenseName,ExpensePrice:ExpensePrice,ExpenseQuantity:ExpenseQuantity,ExpenseMethod:ExpenseMethod},cache:false,success:function(res){  
			window.location.reload();
			// console.log(res);
			}
		});
	}else{
	alert("Fill all fields ...");
	}
})



















});