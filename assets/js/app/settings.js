(function() {
	
	getOrganization();

	$('[href="#settingsUser"]').unbind('click').bind('click', function() {
		getMemberList();
	});
	
	$('[href="#settingsOrg"]').unbind('click').bind('click', function() {
		getOrganization();
	});
	
	$('[href="#settingsActivity"]').unbind('click').bind('click', function() {
		getActivity();
	});
	
	$('#settings-add-user-modal').unbind('click').bind('click', function() {
		$('#modal-add-user').modal('show');
		$('#settings-user-email-address').val('').parent().removeClass('fg-toggled').parent().removeClass('has-error').find('small').html('');
		$('#settings-user-firstname').val('').parent().removeClass('fg-toggled').parent().removeClass('has-error').find('small').html('');
		$('#settings-user-lastname').val('').parent().removeClass('fg-toggled').parent().removeClass('has-error').find('small').html('');
		$('#invite-user-error-message').addClass('hide');
	});

	addMember();	

})();

function getActivity() {
	$('#settings-activity-list').bootgrid({
    	css: {
            icon 		: 'zmdi icon',
            iconColumns	: 'zmdi-view-list',
            iconDown 	: 'zmdi-caret-down',
            iconRefresh : 'zmdi-refresh',
            iconUp	 	: 'zmdi-caret-up',
        },
        ajax 		 : true,
	    url 		 : '/activity/getAllActivity/'
    });

    $('#settings-activity-list').bootgrid('reload');
}
/**
 * Invite email address to access current organization
 * 
 */
function addMember() {

	$('#settings-user-add-member').unbind('click').bind('click', function() {	
		var error 		= false;
		var email 		= $('#settings-user-email-address');
		var firstname 	= $('#settings-user-firstname');
		var lastname 	= $('#settings-user-lastname');
		var role 		= $('#settings-user-role');

		email.parent().parent().removeClass('has-error').find('small').html('');
		firstname.parent().parent().removeClass('has-error').find('small').html('');
		lastname.parent().parent().removeClass('has-error').find('small').html('');

		if(email.val() == '') {
			email.parent().parent().addClass('has-error').find('small').html('Required field');
			error = true;
		}

		if(firstname.val() == '') {
			firstname.parent().parent().addClass('has-error').find('small').html('Required field');
			error = true;
		}

		if(lastname.val() == '') {
			lastname.parent().parent().addClass('has-error').find('small').html('Required field');
			error = true;
		}

		if(!base.isValidEmailAddress(email.val()) && email.val() != '') {
			email.parent().parent().addClass('has-error').find('small').html('Invalid email address');	
			error = true;
		}

		if(!error) {
			//some loading
			$('#settings-user-add-member').
				html('Saving...').
				attr('disabled', 'disabled');

			var url  = '/settings/addMember/';
			var data = {
				'username' 	 : email.val(),
				'first_name' : firstname.val(),
				'last_name'  : lastname.val(),
				'role' 		 : role.val()
			};

			base.
				setUrl(url).
				setData(data).
				post(function(response) {

					$('#settings-user-add-member').
						html('Invite User').
						removeAttr('disabled');

					//if has error
					if(response.error) {
						if(response.message == 'already_member') {
							$('#settings-user-email-address').parent().parent().addClass('has-error');
							$('#invite-user-error-message').removeClass('hide').find('p').html(response.long_message);
						}

					} else {
						$('#modal-add-user').modal('hide');
						$('#settings-user-list').bootgrid('reload');
					}
				}
			); 
		}

	});
}

function getMemberList() {
	var EMPTY_HTML = 
		'<h2 style="text-transform: uppercase;margin-top: 50px;">Oops! No Result were found</h2>'+
        '<p>We\'re sorry, It seems as though we were not able to locate exactly what you were looking for.</p>';
    
    var LOADING_HTML = 
    '<div style="margin-top: 50px">'+
	    '<div class="preloader pls-amber pl-xxl">'+
	        '<svg class="pl-circular" viewBox="25 25 50 50">'+
	            '<circle class="plc-path" cx="50" cy="50" r="20"></circle>'+
	        '</svg>'+
	    '</div>'+
	    '<h4 class="to-uc">Loading Awesomeness!!</h4>'+
    '</div>';

	var url = '/settings/getMember/';

    $('#settings-user-list').bootgrid({
        navigation : 2,
    	css: {
            icon 		: 'zmdi icon',
            iconDown 	: 'zmdi-caret-down',
            iconUp	 	: 'zmdi-caret-up',
        },
       	labels: {
        	noResults 	: EMPTY_HTML,
        	loading 	: LOADING_HTML,
    	},
        ajax 		 	: true,
	    url 		 	: url,
	    selection 		: true,
        multiSelect 	: true,
        keepSelection 	: true,
    }).on('loaded.rs.jquery.bootgrid', function(){
    	//view member detail
    	viewMemberDetail();
	   	//delete member
	   	deleteMember();
	});

    $('#settings-user-list').bootgrid('reload');
}

function deleteMember() {
	//user delete
   	$('#settings-user-delete').unbind('click').bind('click', function() {
	   	var list = $('#settings-user-list').bootgrid('getSelectedRows');

        //if no selected from listing
        if(list.length == 0) {
            swal({
                title : 'Dude, Really?',
                text : 'You did not select any ticket from the list',
                type : 'warning',
                confirmButtonText: 'Return to listing'
            }); 
            return false;
        }

        swal({
            title : 'Are you sure about this?',   
            text  : 'You are about to permanently remove a user',   
            type  : 'error',   
            showCancelButton: true,   
            confirmButtonText: 'Yes, remove this!',   
            cancelButtonText: 'No, Im just kidding!',   
            closeOnConfirm: false,   
            closeOnCancel: true

        },function(isConfirm) {
            if(isConfirm) {  
                var data = {'list' : list};
                var url  = '/settings/removeMemberBatch/'
                
                base.
                    setUrl(url).
                    setData(data).
                    post(function(response) {
                        //success message
                        swal('Deleted!', 'Users successfully removed. ', 'success'); 
                        //reload the table
                        $('#settings-user-list').bootgrid('reload');
                    }
                );
            } 
        });
        return false;
   	});
}

function viewMemberDetail() {
	//view detail
   	$('#settings-user-list td.text-left').unbind('click').bind('click', function() {
   		var userId = $(this).parent().data("row-id");
        window.location = '/userDetail';
   	});	
}

/**
 * For Organization tab data
 *
 */

function getOrganization() {

	var data = {'id' : 1};
	var url = '/settings/getOrganizationInfo';
	// base.
	// 	setUrl().
	// 	setData(data).
	// 	post(function(response) {

	// 		var info = response.data['organisation_info']['Organisations']['Organisation'];

	// 		$('.resync-organization-detail').attr('id', response.data['_id']['$id']);

	// 		// Display name
	// 		$('#organization-setting-display-name').val(info['Name']);
	// 		// Legal company name
	// 		$('#organization-setting-legal-name').val(info['LegalName']);
	// 		// Line of business of the company
	// 		if(info['LineOfBusiness'] != undefined) {
	// 			$('#organization-setting-line-of-business').val(info['LineOfBusiness']);
	// 		}
	// 		// Organization type
	// 		if(info['OrganisationType'] != undefined) {
	// 			$('#organization-organization-type').val(fixCasing(info['OrganisationType']));
	// 		}
	// 		// Registration Number
	// 		if(info['RegistrationNumber'] != undefined) {
	// 			$('#organization-setting-registration-number').val(fixCasing(info['RegistrationNumber']));
	// 		}
	// 		// Addresses
	// 		if(info['Addresses'] != undefined) {
	// 			if(info['Addresses']['Address'].length > 0) {
	// 				for(i in info['Addresses']['Address']){
	// 					if(info['Addresses']['Address'][i]['AddressType'] == 'POBOX') {
	// 						getAddress(info['Addresses']['Address'][i], 'postal');
	// 					} else if(info['Addresses']['Address'][i]['AddressType'] == 'STREET') {
	// 						getAddress(info['Addresses']['Address'][i], 'physical');
	// 					} 
	// 				}
	// 			}
	// 		}
	// 		// Phones
	// 		if(info['Phones'] != undefined) {
	// 			if(info['Phones']['Phone'].length > 0) {
	// 				for(i in info['Phones']['Phone']){
	// 					if(info['Phones']['Phone'][i]['PhoneType'] == 'OFFICE') {
	// 						// For office or telephone number
	// 						$('#organization-setting-telephone-start').val(info['Phones']['Phone'][i]['PhoneCountryCode']);
	// 						$('#organization-setting-telephone').val(info['Phones']['Phone'][i]['PhoneNumber']);
	// 					} else if(info['Phones']['Phone'][i]['PhoneType'] == 'FAX') {
	// 						// For fax number
	// 						$('#organization-setting-fax-start').val(info['Phones']['Phone'][i]['PhoneCountryCode']);
	// 						$('#organization-setting-fax').val(info['Phones']['Phone'][i]['PhoneNumber']);
	// 					} else if(info['Phones']['Phone'][i]['PhoneType'] == 'DDI') {
	// 						// For DDI numbers
	// 						$('#organization-setting-ddi-start').val(info['Phones']['Phone'][i]['PhoneCountryCode']);
	// 						$('#organization-setting-ddi').val(info['Phones']['Phone'][i]['PhoneNumber']);
	// 					} else if(info['Phones']['Phone'][i]['PhoneType'] == 'MOBILE') {
	// 						// For Mobile numbers
	// 						$('#organization-setting-mobile-start').val(info['Phones']['Phone'][i]['PhoneCountryCode']);
	// 						$('#organization-setting-mobile').val(info['Phones']['Phone'][i]['PhoneNumber']);
	// 					}
	// 				}
	// 			}
	// 		}
	// 		// Links
	// 		if(info['ExternalLinks'] != undefined) {
	// 			if(info['ExternalLinks']['ExternalLink'].length > 0) {
	// 				for(i in info['ExternalLinks']['ExternalLink']){
	// 					// Facebook
	// 					if(info['ExternalLinks']['ExternalLink'][i]['LinkType'] == 'Facebook') {
	// 						$('#organization-setting-facebook').val(info['ExternalLinks']['ExternalLink'][i]['Url']);
	// 					// Google Plus
	// 					} else if(info['ExternalLinks']['ExternalLink'][i]['LinkType'] == 'GooglePlus') {
	// 						$('#organization-setting-google').val(info['ExternalLinks']['ExternalLink'][i]['Url']);
	// 					// LinkedIn
	// 					} else if(info['ExternalLinks']['ExternalLink'][i]['LinkType'] == 'LinkedIn') {
	// 						$('#organization-setting-linkedid').val(info['ExternalLinks']['ExternalLink'][i]['Url']);
	// 					// Twitter
	// 					} else if(info['ExternalLinks']['ExternalLink'][i]['LinkType'] == 'Twitter') {
	// 						$('#organization-setting-twitter').val(info['ExternalLinks']['ExternalLink'][i]['Url']);
	// 					// Website
	// 					} else if(info['ExternalLinks']['ExternalLink'][i]['LinkType'] == 'Website') {
	// 						$('#organization-setting-website').val(info['ExternalLinks']['ExternalLink'][i]['Url']);
	// 					}
	// 				}
	// 			}
	// 		}
			
	// 	});

}

/**
 * For General Settings Tab
 *
 */

function getGeneralSettings() {

	var data = {'id' : 1};

	//This is for calendar thingy
	$('#organization-settings-conversion-date').datetimepicker({
        viewMode: 'years',
        format: 'MM/YYYY'
    });

	// Unset the input
	$('#organization-settings-tin-number-modal').val('');

	// Get the Id of the organization
	base.
		setUrl('settings/getOrganizationInfo').
		setData(data).
		post(function(response) {

			$('.organization-edit-tin-number-modal').attr('id', response.data['_id']['$id']);

			if(response.data['tin_number'] != undefined) {
				$('#organization-settings-tin-number-modal').val(response.data['tin_number']);
				$('#organization-settings-tin-number').val(response.data['tin_number']);
			} else {
				$('#organization-settings-tin-number-modal').val('');
				$('#organization-settings-tin-number').val('');
			}


			if(response.data['conversion_date'] != undefined) {
				$('#organization-settings-conversion-date').data("DateTimePicker").date(response.data['conversion_date']);
			} else {
				$('#organization-settings-conversion-date').data("DateTimePicker").date('');
			}

			if(response.data['rdo_code'] != undefined) {	
				$('#organization-settings-rdo-code').chosen().val(response.data['rdo_code']);
	        	$('#organization-settings-rdo-code').trigger("chosen:updated");
			} else {
				$('#organization-settings-rdo-code').chosen().val('');
	        	$('#organization-settings-rdo-code').trigger("chosen:updated");				
			}

			// This is for the Tin Number Settings
			tinNumberSetting(response.data['_id']['$id']);
			// For loading of datepicker
			datePicker(response.data['_id']['$id']);

			return false;


		});

		// This is for onchange of RDO 
		$('#organization-settings-rdo-code').chosen().unbind('change').change('click', function() {

			var code = $(this).chosen().val();
			var data = {'code' : code};

			// Updated the save rdo code
			base.
				setUrl('settings/saveRdoCode').
				setData(data).
				post(function(response) { 

					base.notification('RDO Code successfully updated.', 'success');
					// swal('Success!', 'RDO Code successfully updated. ', 'success'); 
					// getGeneralSettings();

				});
		});
}

/**
 * Tin Number Settings
 *
 */
function tinNumberSetting(id) {

	// // This is for tin number
	$('#organization-settings-tin-number').mask('0000-0000-0000-0000');

	$("#organization-settings-tin-number").debounce("keyup", function() {
// console.log('sdjb')
		var tin  = $(this).val();

		// Check if tin is not empty
		if(tin == '' || tin.length < 19) {
			$(this).parent().parent().addClass('has-error');
			$(this).parent().parent().find('small.help-block').html('Invalid TIN Number!');
		} else {						
			$(this).parent().parent().removeClass('has-error');
			$(this).parent().parent().find('small.help-block').html('');

			var data = {
				'id'  : id,
				'tin' : tin
			};	

			base.
				setUrl('settings/tinNumberUpdate').
				setData(data).
				post(function(response) {

					if(!response.error) {
       					swal('Sucess!', 'Organization\'s tin number is successfully updated!', 'success'); 
						$('#modal-edit-tin-number').modal('hide');
						getGeneralSettings();
					}

				});
		}

	}, 1000);



	// Submit button
	$('.organization-edit-tin-number-modal').unbind('click').bind('click', function() {

		var id 	 = $(this).attr('id');
		var tin  = $('#organization-settings-tin-number-modal').val();

		// Check if tin is not empty
		if(tin == '') {
			$('#organization-settings-tin-number-modal').parent().parent().addClass('has-error');
		} else {						
			$('#organization-settings-tin-number-modal').parent().parent().removeClass('has-error');

			var data = {
				'id'  : id,
				'tin' : tin
			};

			base.
				setUrl('settings/tinNumberUpdate').
				setData(data).
				post(function(response) {

					if(!response.error) {
       					// swal('Sucess!', 'Organization\'s tin number is successfully updated!', 'success'); 
						base.notification('Organization\'s tin number is successfully updated!', 'success');

						$('#modal-edit-tin-number').modal('hide');
						getgeneralSettings();
					}

				});
		}
	});

}
/**
 * Fix casing of the value
 *
 */
function fixCasing(string) {
    return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
}

/**
 * Get the address depending the type
 *
 */
function getAddress(address, type) {
	// Address Line 1
	if(address['AddressLine1'] != undefined || address['AddressLine1'] != '') {
		$('#organization-setting-'+type+'-address-street').val(address['AddressLine1']);
	}
	// City
	if(address['City'] != undefined || address['City'] != '') {
		$('#organization-setting-'+type+'-address-city').val(address['City']);
	}
	// State
	if(address['Region'] != undefined || address['Region'] != '') {
		$('#organization-setting-'+type+'-address-state').val(address['Region']);
	}
	// Country
	if(address['Country'] != undefined || address['Country'] != '') {
		$('#organization-setting-'+type+'-address-country').val(address['Country']);
	}
	// zip
	if(address['PostalCode'] != undefined || address['PostalCode'] != '') {
		$('#organization-setting-'+type+'-address-zip').val(address['PostalCode']);
	}
	// zip
	if(address['AttentionTo'] != undefined || address['AttentionTo'] != '') {
		$('#organization-setting-'+type+'-address-attention').val(address['AttentionTo']);
	}

	return;

}

/**
 * Load the date picker
 *
 */
function datePicker(id) {

	// On change of date
    $('#organization-settings-conversion-date').unbind('dp.change').bind('dp.change', function(e) {

    	if(e.oldDate !== null) {

	    	var data = {
	    		'id' 	: id,
	    		'date'  : $('#organization-settings-conversion-date').val()
	    	}

	    	base.
	    		setUrl('settings/setConversionDate').
	    		setData(data).
	    		post(function(response) {

	       			// swal('Sucess!', 'Organization\'s conversion date is successfully updated!', 'success'); 
					base.notification('Organization\'s conversion date is successfully updated!', 'success');

	       			getGeneralSettings();

	       			return false;

	    		});
    	}
    });


}