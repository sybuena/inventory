(function() {

	init();
	loginButton();
	registerButton();
	forgotPasswordButton();

})();


function init() {
	passwordMeter();
	// Unset the login warning
	$('#login-wrong-credential-warning').addClass('hide');
	$('#login-login-attempt').addClass('hide');
	$('.g-recaptcha').addClass('hide');

	// Unset fields
	var fields = ['#login-username-field', '#login-password-field'];

	for(i in fields) {
		if(fields[i] == '#login-username-field' && $(fields[i]).attr('from-redirect') != 1) {
			$(fields[i]).val('');
		}
		
		$(fields[i]).parent().parent().removeClass('has-error');		
		$(fields[i]).parent().parent().find('small').html('');
	}
};

function passwordMeter() {
	if($('#login-one-password').val() == '' && $('.password-verdict').html() !== undefined) {
		$('#login-one-password').pwstrength('destroy');	
	}

	$('#login-one-password').pwstrength({
        ui: { showVerdictsInsideProgressBar: true },
        usernameField : '#login-email-address',
        spanError : function (options, key) {
		  var text = options.i18n.t(key);
		  if (!text) { return ''; }
		  return '<span style="color: red">' + text + '</span>';
		}
    });
}

/*** -----------------------------------------------------------------
			        FORGOT PASSWORD HANDLER
     ----------------------------------------------------------------- **/
/**
 * Forgot password button actions
 * unsetters and event handler
 * 
 * @return this
 */
function forgotPasswordButton() {
	//unset fields 
	$('[data-block="#l-forget-password"]').click(function() {
		$('#forgot-password-message').addClass('hide');
		$('#forgot-password-email').val('').parent().removeClass('fg-toggled').parent().removeClass('has-error').find('small').html('');
	});
	//button click
	$('#forgot-password-now').unbind('click').bind('click', function() {
		forgotPasswordAction();
		return false;
	});

	//on press enter
	$('#forgot-password-email').keypress(function(e) {
        if(e.which == 13) {
            forgotPasswordAction();
            return false;
        }
    });

	return this;
}

/**
 * Connect to backend and send email 
 * 
 * @return bool
 */
function forgotPasswordAction() {
	//check fields
	if(forgotPasswordCheckFields()) {
		return false;
	}
	
	var url  = '/login/forgotPassword/';
	var data = {'email' : $('#forgot-password-email').val()}

	base.
		setUrl(url).
		setData(data).
		post(function(response) {
			//always show success even email address is not connected to us
			$('#forgot-password-message').removeClass('hide');
		}
	);

	return false;
	
}
/**
 * Check for required fields
 * 
 * @return bool
 */
function forgotPasswordCheckFields() {
	//unset
	$('#forgot-password-email').parent().parent().removeClass('has-error').find('small').html('');
	
	var error = false;
	var email = $('#forgot-password-email').val();

	if(email == '') {
		$('#forgot-password-email').parent().parent().addClass('has-error').find('small').html('Required field');
		
		error = true
	}
	//check if email is valid
	if(!base.isValidEmailAddress(email) && email != '') {
		$('#forgot-password-email').parent().parent().addClass('has-error').find('small').html('Invalid email address');
		error = true;
	}

	return error;
}


/*** -----------------------------------------------------------------
			         REGISTER HANDLER
     ----------------------------------------------------------------- **/

function registerButton() {
	//reset fields
	$('[data-block="#l-register"]').click(function() {
		
		var fields = ['#login-first-name', '#login-last-name', '#login-email-address', '#login-one-password', '#login-two-password'];
		//unset fields
		for(i in fields) $(fields[i]).val('').parent().removeClass('fg-toggled').parent().removeClass('has-error').find('small').html('');
		$('#register-error-message').addClass('hide');
		$('#register-success-message').addClass('hide');
		passwordMeter();
	});

	$('#create-account-now').unbind('click').bind('click', function() {
		registerAction();
		
		return false;
	});
	$('.create-account-form').keypress(function(e) {
        if(e.which == 13) {
            registerAction();
            return false;
        }
    });

}

function registerAction() {
	
	if(registerCheckFields()) {
		return false;
	}

	var url  = '/login/register';
	var data = {
		'user_id'    : $('#create-account-now').attr('user-id'),
		'nonce'		 : $('#create-account-now').attr('user-nonce'),
		'first_name' : $('#login-first-name').val(),
		'last_name'  : $('#login-last-name').val(),	
		'username'   : $('#login-email-address').val(),	
		'password'	 : $('#login-one-password').val()	
	}
	
	base.
		setUrl(url).
		setData(data).
		post(function(response) {

			if(response.error) {
        		$('#register-error-message').removeClass('hide');
        		$('#register-error-message p').html(response.long_message);

        		if(response.message == 'already_register') {
        			$('#login-email-address').parent().parent().addClass('has-error');
        		}
        	} else {
        		// $('#register-success-message-main').html(response.success);
        		// $('#register-success-message').removeClass('hide');
        		swal({ 
					title : "Sweet!", 
					text  : "Account successfully created", 
					type  : "success",
					confirmButtonText : "Return to Login"
				}, function() {
					window.location = '/'
				})
        	}
		}
	);

	return false;
}

function registerCheckFields() {
	var fields = ['#login-first-name', '#login-last-name', '#login-email-address', '#login-one-password', '#login-two-password'];
	var error  = false;

	//check for empty fields
	for(i in fields) {
		if($(fields[i]).val() == '') {
			$(fields[i]).parent().parent().addClass('has-error');			
			$(fields[i]).parent().parent().find('small').html('Required field');

			error = true;
		} else {
			$(fields[i]).parent().parent().removeClass('has-error');		
			$(fields[i]).parent().parent().find('small').html('');
		}
	}

	//check invalid email
	if(!base.isValidEmailAddress($('#login-email-address').val()) && $('#login-email-address').val() != '') {
		$('#login-email-address').parent().parent().addClass('has-error');		
		$('#login-email-address').parent().parent().find('small').html('Invalid email address');	
	}
	
	if(($('#login-one-password').val() != '' && $('#login-two-password').val() != '') && ($('#login-one-password').val()  != $('#login-two-password').val()) ) {
		$('#login-one-password').parent().parent().addClass('has-error');	
		$('#login-two-password').parent().parent().addClass('has-error');
		$('#login-two-password').parent().parent().find('small').html('Password confirmation doesnt match Password');			
	}
	
	if($('.password-verdict').html() == 'Very Weak' || 
		$('.password-verdict').html() == 'Weak' ||
		$('.password-verdict').html() == 'Normal') {
		$('#login-one-password').parent().parent().addClass('has-error');
		error = true;

	}

	return error;
}

/*** -----------------------------------------------------------------
			         LOGIN HANDLER
     ----------------------------------------------------------------- **/
/**
 * LOGIN ACTION
 * 
 */
function loginButton() {
	//on click button
	$('#login-button-submit').unbind('click').bind('click', function() {
		loginAction();
	});
	//on enter password field
	$('#login-password-field').keypress(function(e) {
        if(e.which == 13) {
            loginAction();
            return false;
        }
    });

    //on enter username field
    $('#login-username-field').keypress(function(e) {
        if(e.which == 13) {
            loginAction();
            return false;
        }
    });
    $('[data-block="#l-login"]').unbind('click').bind('click', function() {
		$('#login-wrong-credential-warning').addClass('hide');
		$('#login-login-attempt').addClass('hide');
		$('.g-recaptcha').addClass('hide');
	});

};

function loginAction() {
	
	if(checkFields()) {
		return false;
	}

	var url = '/login/login';
	var data = {
		'username' : $('#login-username-field').val(),
		'password' : $('#login-password-field').val(),
	}
	
	if($('.g-recaptcha').is(':visible')) {
		data['recaptcha'] = grecaptcha.getResponse();
	}

	//unset all error first
	$('#login-wrong-credential-warning').addClass('hide');
	$('#login-login-attempt').addClass('hide');
	$('.g-recaptcha').addClass('hide');

	base.
		setUrl(url).
		setData(data).
		post(function(response) {

			if(response.error) {
         		//what errorr
         		
         		if(response.message == 'login_attempt') {
         			$('#login-login-attempt').removeClass('hide');
         			$('.g-recaptcha').removeClass('hide');
         		} else {
         			$('#login-wrong-credential-warning').removeClass('hide');
         			$('#login-wrong-credential-warning p').html(response.long_message);	
         		}
         	} else {
         		base.redirect('/portal');
         	}
		}
	);
}

function checkFields() {

	var error = false;
	var fields = ['#login-username-field', '#login-password-field'];

	for(i in fields) {
		if($(fields[i]).val() == '') {
			$(fields[i]).parent().parent().addClass('has-error');			
			$(fields[i]).parent().parent().find('small').html('Required field');

			error = true;
		} else {
			$(fields[i]).parent().parent().removeClass('has-error');		
			$(fields[i]).parent().parent().find('small').html('');
		}
	}

	return error;
}


