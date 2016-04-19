$().ready(function() {
	// validate signup form on keyup and submit
	$("#addpaymentform").validate({
		rules:{
			bankname: "required",
			accounttype: "required",
			accountnumber: {
				required: true,
				minlength: 8
			},	
			streetaddress:"required",
			city: "required",
			parish: "required",
			postalcode: "required"
			},
		messages:{
			bankname: "Please Enter the name of your bank",
			accounttype: "Please Enter Your Account Type",
			accountnumber: {
				required: "Please Enter your Account Number",
				minlength: "Your account number is invalid"
			},
			streetaddress: "Please enter your street address",
			city: "Please enter your city",
			parish: "Please enter your parish",
			postalcode: "Please enter your postalcode"

		}
	});

});
