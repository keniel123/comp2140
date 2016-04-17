$().ready(function() {
	// validate signup form on keyup and submit
	$("#signupform").validate({
		rules:{
			firstname: "required",
			lastname: "required",
			username: {
				required: true,
				minlength: 2
			},
			email: {
				required: true,
				email: true
			},
			phonenumber: {
				required: true,
				phoneUS: true
			},
			saddress:"required",
			city: "required",
			parish: "required",
			postalcode: "required",
			password: {
				required: true,
				minlength: 5
			},
			passwordConfirm: {
				required: true,
				minlength: 5,
				equalTo : "#password"
			},
			saddress: {
				required: true,
				minlength: 5
			},
			terms: "required"
		},
		messages:{
			firstname: "Please Enter Your First Name",
			lastname: "Please Enter Your Last Name",
			username: {
				required: "Please Enter a Username",
				minlength: "Your username must consist of at least 2 characters"
			},
			phonenumber: {
				required: "Please enter your phonenumber",
				phoneUS: "Please enter a valid US phone number"
			},
			saddress: "Please enter your street address",
			city: "Please enter your city",
			parish: "Please enter your parish",
			postalcode: "Please enter your postalcode",
			password: {
				required: "Please Enter a password",
				minlength: "Your password must consist of at least 5 characters"
			},
			passwordConfirm: {
				required: "Please reenter your password",
				minlength: "Your password must consist of at least 5 characters",
				equalTo: "Please enter the same password as above"
			},
			terms: "Please accept our terms"

		}
	});

});