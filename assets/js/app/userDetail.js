(function() {

	editInfo();
	
	$('a[href="#detail-activity"]').unbind('click').bind('click', function() {
		activity();
	});

	//changePhoto();
})();

function changePhoto() {

	$('#change-primary-image').unbind('click').bind('click', function() {
		//unse fields
		var defaultImg = $('#change-primary-image img').attr('src');

		$('#change-photo-name').html('No file selected');
		$('#change-photo-preview').attr('src', defaultImg);

		$('#change-photo').modal('show');
		$('#change-photo-save').hide();
		$('.change-photo-new').show();
	    $('.change-photo-exists').hide();

		return false;
	});


	$("#change-photo-input").change(function(){
	    readURL(this);
	    
	    $('#change-photo-save').show();
	    $('.change-photo-new').hide();
	    $('.change-photo-exists').show();
	});

	$('#change-photo-form').fileUpload({
        //on click the submit button
        before : function(){

            $('#change-photo-save').
            	html('Saving...').
            	attr('disabled', 'disabled');
        },
        //success response actually
        beforeSubmit : function(response) {

          	$('#change-photo-save').
            	html('Save').
            	removeAttr('disabled');
            
            $('#change-photo').modal('hide');
            
        	//change the current user image
        	$('#change-primary-image img').attr('src', '/'+response.data['path']);
        	
        	if(response.data['is_login'] == true) {
        		//only if login user
        		$('.profile-menu img').attr('src', '/'+response.data['path']);
        		$('.img-idle-avatar').attr('src', '/'+response.data['path']);
        		
        	}

        	base.notification('Successfully updated profile picture', 'inverse');
            
            return true;
        }
    });

	return this;
}

function readURL(input) {

    if(input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
        	var info = document.getElementById('change-photo-input').files[0];
        	$('#change-photo-name').html(info['name']);

            $('#change-photo-preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function editInfo() {

	/*FOR EDITTING*/
	// For Basic info
	showInfo('#detail-user-basic-edit', 'getBasicInformation', 'basic');
	// For Contact info
	showInfo('#detail-user-contact-edit', 'getContactInformation', 'contact');

	/*FOR SAVING*/
	// For Basic saving
	saveInfo('#detail-user-basic-save', 'saveBasicInformation', 'basic');
	// For Contact saving
	saveInfo('#detail-user-contact-save', 'saveContactInformation', 'contact');

	return this;
}

/**
 * This bitch is for geting and showing the info of the user
 *
 * @param string
 * @param string
 * @param string
 * @return this
 */
function showInfo(element, functions, infoType) {

	$(element).unbind('click').bind('click', function() {

		fillFields(functions, infoType);
	
		$('#detail-user-contact-twitter-2').removeClass('has-error');
	});

	// Check if number fields
	base.keyUpString('#detail-user-contact-mobile-2');
	base.keyUpString('#detail-user-contact-phone-2');

	return this;
}

function fillFields(functions, infoType, input = '2') {

	var id     = window.location.href.split('/').slice(-1).pop();//$('#user-main-id').attr('user-id');
	var fields = fieldsList(infoType);

	base.
		setUrl('/userDetail/'+functions+'/'+id).
		get(function(response) {

			var data = response.data;

			// This is for the ABOUT Tab
			for(i in fields) {
				if($.isNumeric(i)) {
					// For display of info
					if(input == '1') {
						// if field is role we need to convert the values of 1 & 2
						if(fields[i] == 'role') {
							if(data[fields[i]] == '1') {
								data[fields[i]] = 'Administrator';
							} else if(data[fields[i]] == '2') {
								data[fields[i]] = 'Accountant';
							}
							// For the role in the contact detail
							$('#main-user-role').html(data[fields[i]]);
						}

						$('#detail-user-'+infoType+'-'+fields[i]+'-'+input).html(data[fields[i]]);

					// For editting 
					} else if(input == '2') {	
					
						$('#detail-user-'+infoType+'-'+fields[i]+'-'+input).val(data[fields[i]]);
						// for role thingy 
						if(fields[i] == 'role') {
							$('#main-user-role').html(data['role_name']);							
						} else {
							$('#main-user-'+fields[i]).html((data[fields[i]] == '') ? '---' : data[fields[i]]);
						}
						
					}
				}
			}

			// INFO CONTACT
			if(input == '1') {
				if(data['name'] != undefined) {
					$('#main-user-name').html(data['name']);
				} else {
					$('#main-user-name').html(data['first_name'] + ' ' + data['last_name']);
				}
			}

		});

	return;

}

/**
 * This mother f-ing fucker saves the revision of the user info
 *
 * @param string
 * @param string
 * @param string
 */
function saveInfo(element, functions, infoType) {

	var fields = fieldsList(infoType);

	$(element).unbind('click').bind('click', function() {

		var data  = {};
		var error = false;
		var id    = window.location.href.split('/').slice(-1).pop();//$('#user-main-id').attr('user-id');

		// Set the data needed for POST
		for(i in fields) {
			if($.isNumeric(i)) {
				var key = fields[i];
				data[key] = $('#detail-user-'+infoType+'-'+fields[i]+'-2').val();		
			}
		}
		
		// check if twitter is valid
		// if(data['twitter'] != undefined) {	
		// 	error = checkTwitter(data['twitter']);
		// }

		if(!error) {

			base.
				setUrl('/userDetail/'+functions+'/'+id).
				setData(data).
				post(function(response) {

		            base.notification(capitalise(infoType) + ' information is successfully updated!', 'inverse');	

		            // Check if basic or contact then load the display
					if(infoType == 'basic') {
						fillFields('getBasicInformation', infoType, '1');
					} else if(infoType == 'contact') {
						fillFields('getContactInformation', infoType, '1');					
					}

					$('.block-'+infoType).removeClass('toggled');

				});

			$('#detail-user-contact-twitter-2').removeClass('has-error');

		} else {
			$('#detail-user-contact-twitter-2').addClass('has-error');
		}

	});


}

/**
 * User login activity
 * 
 * @return this
 */
function activity() {

	var id = window.location.href.split('/').slice(-1).pop();;
	var url = '/userDetail/userActivity/'+id;

	$('#user-detail-activity').bootgrid({
        css 	: helper.icon,
        labels  : helper.label,
        navigation   : 2,
        ajax 		 : true,
	    url 		 : url,
	    formatters 	 	: {
	    	//format date
            login_date : function(column, row) {
            	
            	var dateAgo = moment.unix(row['login_date']).fromNow();
            	var date 	= moment.unix(row['login_date']).format('MMM DD, YYYY');
            	var time 	= moment.unix(row['login_date']).format('h:mm a');
            	return  date+' at '+time+' <br/><small><i>'+dateAgo+'</i></small>';
            }
        }
    });

	return this;
}

/**
 * Get the fields that need depending the info type
 *
 * @param string
 * @return array
 */
function fieldsList(infoType) {

	var fields = [];

	if(infoType == 'basic') {
		fields   = ['first_name', 'last_name', 'role'];		
	} else if(infoType == 'contact') {		
		fields = ['username', 'mobile', 'phone', 'facebook', 'twitter', 'skype'];
	}

	return fields;

}

/**
 * Capitalise the first letter
 *
 * @param string
 * @return string
 */
function capitalise(string) {
    return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
}

function checkTwitter(twitter) {

	var error = false;

	if(twitter.indexOf("@") != 0 && twitter.length != '') {
		error = true;
	}

	return error;

}