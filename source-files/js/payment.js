$().ready(function() {
	// validate signup form on keyup and submit

	 
	$("#bankaccountform").validate({
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
	$("#credit-cardform").validate({
		rules:{
			cctype: "required",
			ccnumber: {
				required: true,
				minlength: 15
			},
			cvc: {
				required: true,
				minlength: 3
			},
			ccexpiry: {
				expiraryDate: true,
				required: true
			},		
			cccardholder:"required",
			ccstreetaddress: "required",
			cccity: "required",
			ccparish: "required",
			ccpostalcode: "required"
			},
		messages:{
			cctype: "Please select a credit card type ",
			ccnumber: {
				required: "Please Enter Your credit card number",
				minlength: "Your credit card number is invalid"
			},
			cvc: {
				required: "Please Enter Your security code",
				minlength: "Your security code is invalid"
			},
			ccexpiry: {
				required: "Please Enter Your credit card expiration date",
				expiraryDate: "Your credit card expiration date is invalid"
			},
			cccardholder:"Please enter the name of the card holder",
			ccstreetaddress: "Please enter your street address",
			cccity: "Please enter your city",
			ccparish: "Please enter your parish",
			ccpostalcode: "Please enter your postalcode" 

		}
	});
	$("#paypalform").validate({
		rules:{
			paypalpassword: "required",
			paypalemail: {
				required: true,
				email: true
			}
			},
		messages:{
			paypalpassword: "Please Enter your paypal password",
			accountnumber: {
				required: "Please Enter your paypal email",
				email: "Your email is invalid"
			}
			

		}
	});

$.validator.addMethod(
        "expiraryDate",
        function (value, element) {
            var today = new Date();
            var startDate = new Date(today.getFullYear(),today.getMonth(),1,0,0,0,0);
            var expDate = value;
            var separatorIndex = expDate.indexOf('/');
            expDate = expDate.substr( 0, separatorIndex ) + '/1' + expDate.substr( separatorIndex );
            return Date.parse(startDate) <= Date.parse(expDate);
        },
        "Must be a valid Expiry Date"
        );
});

