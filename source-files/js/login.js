$().ready(function() {
	// validate signup form on keyup and submit
	$("#loginform").validate({
		rules:{
			username: {
				required: true,
				minlength: 2
			},
			password: {
				required: true,
				minlength: 5
			}
		},
		messages:{
			username: {
				required: "Please Enter your Username",
				minlength: "Invalid username. Your username must consist of at least 2 characters"
			},
			password: {
				required: "Please Enter your password",
				minlength: "Invalid Password. Your password must consist of at least 5 characters"
			}

		}
	});

});