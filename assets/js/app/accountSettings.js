(function() {

	init();
	loadContent();

})();


function init() {

	$('#modal-edit-password-button').unbind('click').bind('click', function() {
		resetModal();
		$('#modal-edit-password').modal('show');
	});


	$('#change-password-bottom').unbind('click').bind('click', function() {
		checkPassword();
		return false;
	});


};

/**
 * Load the content of the page, Account settings info
 *
 */
function loadContent() {

	var data = {'id' : 1};

	base.
		setUrl('portal/loadContent').
		setData(data).
		post(function(response) {

			var data = response.data;

			$('#account-settings-first-name').val(data['first_name']);
			$('#account-settings-last-name').val(data['last_name']);

			$('#account-settings-email').html(data['username']);



		});


} 


/**
 * Change password
 *
 */
function checkPassword() {

	var status = validateForm();

	if(status) {

		var data = {
			'current-password' : $('#settings-current-password').val(),
			'new-password'     : $('#settings-new-password').val(),	
			'confirm-password' : $('#settings-confirm-password').val()
		};

		base.
			setUrl('portal/changePassword').
			setData(data).
			post(function(response) {

				if(!response.error){
					base.notification('Sucessfully change the password', 'success');
					$('#modal-edit-password').modal('hide');
				} else {
					$('#password-dont-matched').html('Oh snap! Password dont matched on your current password.');
					$('#password-dont-matched').removeClass('hide');
				}
			});
	}

}

/**
 * Validate the form, all fields required
 * And Check if passwords matches
 *
 */
function validateForm() {

	var status = true;

	var input = [
		'#settings-current-password',
		'#settings-new-password',
		'#settings-confirm-password'];

	// Check if all fields has value
	for (i in input) {
		if($(input[i]).val() == '') {
			status = false;
			$(input[i]).parent().parent().addClass('has-error');
		} else {
			$(input[i]).parent().parent().removeClass('has-error');
		}
	}

	// Check if password matches
	if(status == true) {
		if($('#settings-new-password').val() !== $('#settings-confirm-password').val()) {
			$('#settings-new-password').parent().parent().addClass('has-error');
			$('#settings-confirm-password').parent().parent().addClass('has-error');

			$('#password-dont-matched').html('Oh snap! New passowrd dont matched with confirm password.');
			$('#password-dont-matched').removeClass('hide');

			status = false;		
		} else {			
			$('#settings-new-password').parent().parent().removeClass('has-error');
			$('#settings-confirm-password').parent().parent().removeClass('has-error');	
		}
	}

	return status;

}

function resetModal() {

	var input = [
		'#settings-current-password',
		'#settings-new-password',
		'#settings-confirm-password'];

	// Check if all fields has value
	for (i in input) {
		$(input[i]).val('');
		$(input[i]).parent().parent().removeClass('has-error');
	}

	$('#password-dont-matched').addClass('hide');

	return;
}

