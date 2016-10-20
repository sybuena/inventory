(function(){

	wizard();


})();

/**
 * Load the wizards
 *
 */
function wizard() {

	// disabled the fields
	$('li.disabled').unbind('click').bind('click', function(e) {
		return false;
	});

	$('#set-up-form-wizard').bootstrapWizard({
		onTabShow : function(tab, navigation, index) {

			var total = navigation.find('li').length;
			var current = index + 0;
			var percent = (current / (total - 1)) * 100;
			var percentWidth = 100 - (100 / total) + '%';
			var wizard = $('#set-up-form-wizard');
			
			navigation.find('li').removeClass('done');
			navigation.find('li.active').prevAll().addClass('done');
			
			wizard.find('.progress-bar').css({width: percent + '%'});
			$('.form-wizard-horizontal').find('.progress').css({'width': percentWidth});

			// Hide the first and last 
			$('.form-wizard-horizontal .first').remove();
			$('.form-wizard-horizontal .last').remove();


			var tab = index + 1;

			if(tab == 1) {
				getOrganization();
			} else if(tab == 2) {
				getgeneralSettings();
			} else if(tab == 3) {
				addMember();	
				getMemberList();
			} else if(tab == 4) {
				getOrganization();
			}

			return false;

		},

		onNext : function(tab, navigation, index) { 

			$('li.next').removeClass('hide');

			var tab = index + 1;

			if(tab == 2) {
				$('#disabled2').parent().removeClass('disabled');
				$('#disabled2').parent().addClass('tab2-clicked');
			} else if(tab == 3) {	

				var code = $('#organization-settings-set-up-rdo-code').chosen().val();
				var date = $('#organization-settings-set-up-conversion-date').val();

				if(code == '' || date == '') {

					if(code === '') {
						$('#empty-rdo-set-up-error').removeClass('hide');
						$('#organization-settings-set-up-rdo-code').parent().parent().find('small').html('Required Field');		
					} else {
						$('#empty-rdo-set-up-error').addClass('hide');
						$('#organization-settings-set-up-rdo-code').parent().parent().find('small').html('');						
					}

					if(date === '') {
						$('#empty-conversion-date-set-up-error').removeClass('hide');	
						$('#organization-settings-set-up-conversion-date').parent().addClass('has-error');		
						$('#organization-settings-set-up-conversion-date').parent().parent().find('small').html('Required Field');															
					} else {
						$('#empty-conversion-date-set-up-error').addClass('hide');	
						$('#organization-settings-set-up-conversion-date').parent().removeClass('has-error');
						$('#organization-settings-set-up-conversion-date').parent().parent().find('small').html('');	
					}

					$('#empty-rdo-set-up-error').parent().removeClass('hide');

					return false;

				} else {

					$('#empty-conversion-date-set-up-error').parent().addClass('hide');

					$('#disabled3').parent().removeClass('disabled');
					$('#disabled3').parent().addClass('tab3-clicked');
					
				}

			} else if(tab == 4) {
				$('#disabled4').parent().removeClass('disabled');
				$('#disabled4').parent().addClass('tab4-clicked');
				$('li.next').addClass('hide');
			}
			
		},

		onTabClick: function(tab, navigation, index) {

			$('#organization-settings-set-up-rdo-code').parent().parent().find('small').html('');	
			$('#empty-conversion-date-set-up-error').parent().addClass('hide');
			$('#empty-conversion-date-set-up-error').addClass('hide');	
			$('#empty-rdo-set-up-error').addClass('hide');	
			$('li.next').removeClass('hide');

			$('.tab2-clicked').unbind('click').bind('click', function () {
				$('#set-up-form-wizard').bootstrapWizard('show',1);
			});

			$('.tab3-clicked').unbind('click').bind('click', function () {
				$('#set-up-form-wizard').bootstrapWizard('show',2);
			});

			$('.tab4-clicked').unbind('click').bind('click', function () {
				$('#set-up-form-wizard').bootstrapWizard('show',3);
				$('li.next').addClass('hide');
			});

		}

	});

	// On save and complete button
	$('.set-up-save-and-complete').unbind('click').bind('click', function() {

		var id = $(this).attr('id');
        var data = {'id' : id}

        base.
            setUrl('settings/setUpOrgDone').
            setData(data).
            post(function(response) {
                if(!response.error) {

					base.notification('Organization\'s successfully set-up!', 'success');

                    window.location.href = '/';
                }
        });

	});

	return false;

}

/**
 * For Organization tab data
 *
 */
function getOrganization() {

	var data = {'id' : 1};

	base.
		setUrl('settings/getOrganizationInfo').
		setData(data).
		post(function(response) {

			var info = response.data['organisation_info']['Organisations']['Organisation'];

			$('.resync-organization-detail').attr('id', response.data['_id']['$id']);
			$('.set-up-save-and-complete').attr('id', response.data['_id']['$id']);

			// Display name
			$('#organization-setting-set-up-display-name').html(info['Name']);
			// Legal company name
			$('#organization-setting-set-up-legal-name').html(info['LegalName']);
			// Line of business of the company
			if(info['LineOfBusiness'] != undefined) {
				$('#organization-setting-set-up-line-of-business').html(info['LineOfBusiness']);
			}
			// Organization type
			if(info['OrganisationType'] != undefined) {
				$('#organization-setting-set-up-type').html(fixCasing(info['OrganisationType']));
			}
			// Registration Number
			if(info['RegistrationNumber'] != undefined) {
				$('#organization-setting-set-up-registration-number').html(fixCasing(info['RegistrationNumber']));
			}
			// Addresses
			if(info['Addresses'] != undefined) {
				if(info['Addresses']['Address'].length > 0) {
					for(i in info['Addresses']['Address']){
						if(info['Addresses']['Address'][i]['AddressType'] == 'POBOX') {
							getAddress(info['Addresses']['Address'][i], 'postal');
						} else if(info['Addresses']['Address'][i]['AddressType'] == 'STREET') {
							getAddress(info['Addresses']['Address'][i], 'physical');
						} 
					}
				}
			}
			// Phones
			if(info['Phones'] != undefined) {
				if(info['Phones']['Phone'].length > 0) {
					for(i in info['Phones']['Phone']){
						if(info['Phones']['Phone'][i]['PhoneType'] == 'OFFICE') {
							// For office or telephone number
							$('#organization-setting-set-up-telephone-start').html('+'+info['Phones']['Phone'][i]['PhoneCountryCode']);
							$('#organization-setting-set-up-telephone').html(info['Phones']['Phone'][i]['PhoneNumber']);
						} else if(info['Phones']['Phone'][i]['PhoneType'] == 'FAX') {
							// For fax number
							$('#organization-setting-set-up-fax-start').html('+'+info['Phones']['Phone'][i]['PhoneCountryCode']);
							$('#organization-setting-set-up-fax').html(info['Phones']['Phone'][i]['PhoneNumber']);
						} else if(info['Phones']['Phone'][i]['PhoneType'] == 'DDI') {
							// For DDI numbers
							$('#organization-setting-set-up-ddi-start').html('+'+info['Phones']['Phone'][i]['PhoneCountryCode']);
							$('#organization-setting-set-up-ddi').html(info['Phones']['Phone'][i]['PhoneNumber']);
						} else if(info['Phones']['Phone'][i]['PhoneType'] == 'MOBILE') {
							// For Mobile numbers
							$('#organization-setting-set-up-mobile-start').html('+'+info['Phones']['Phone'][i]['PhoneCountryCode']);
							$('#organization-setting-set-up-mobile').html(info['Phones']['Phone'][i]['PhoneNumber']);
						}
					}
				}
			}
			// Links
			if(info['ExternalLinks'] != undefined) {
				if(info['ExternalLinks']['ExternalLink'].length > 0) {
					for(i in info['ExternalLinks']['ExternalLink']){
						// Facebook
						if(info['ExternalLinks']['ExternalLink'][i]['LinkType'] == 'Facebook') {
							$('#organization-setting-set-up-facebook').html(info['ExternalLinks']['ExternalLink'][i]['Url'].replace('http://', ''));
							$('#organization-setting-set-up-facebook').attr('href', info['ExternalLinks']['ExternalLink'][i]['Url']);
						// Google Plus
						} else if(info['ExternalLinks']['ExternalLink'][i]['LinkType'] == 'GooglePlus') {
							$('#organization-setting-set-up-google').html(info['ExternalLinks']['ExternalLink'][i]['Url'].replace('http://', ''));
							$('#organization-setting-set-up-google').attr('href', info['ExternalLinks']['ExternalLink'][i]['Url']);
						// LinkedIn
						} else if(info['ExternalLinks']['ExternalLink'][i]['LinkType'] == 'LinkedIn') {
							$('#organization-setting-set-up-linkedid').html(info['ExternalLinks']['ExternalLink'][i]['Url'].replace('http://', ''));
							$('#organization-setting-set-up-linkedid').attr('href', info['ExternalLinks']['ExternalLink'][i]['Url']);
						// Twitter
						} else if(info['ExternalLinks']['ExternalLink'][i]['LinkType'] == 'Twitter') {
							$('#organization-setting-set-up-twitter').html(info['ExternalLinks']['ExternalLink'][i]['Url'].replace('http://', ''));
							$('#organization-setting-set-up-twitter').attr('href', info['ExternalLinks']['ExternalLink'][i]['Url']);
						// Website
						} else if(info['ExternalLinks']['ExternalLink'][i]['LinkType'] == 'Website') {
							$('#organization-setting-set-up-website').html(info['ExternalLinks']['ExternalLink'][i]['Url'].replace('http://', ''));
							$('#organization-setting-set-up-website').attr('href', info['ExternalLinks']['ExternalLink'][i]['Url']);
						}
					}
				}
			}
			
		});

}

/**
 * For General Settings Tab
 *
 */

function getgeneralSettings() {

	var data = {'id' : 1};

	//This is for calendar thingy
	$('#organization-settings-set-up-conversion-date').datetimepicker({
        viewMode: 'years',
        format: 'MM/YYYY'
    });

	// Unset the input
	$('#organization-settings-set-up-tin-number-modal').val('');

	// Get the Id of the organization
	base.
		setUrl('settings/getOrganizationInfo').
		setData(data).
		post(function(response) {

			$('.organization-edit-tin-number-modal').attr('id', response.data['_id']['$id']);

			if(response.data['tin_number'] != undefined) {
				$('#organization-settings-tin-number-modal').val(response.data['tin_number']);
				$('#organization-settings-set-up-tin-number').val(response.data['tin_number']);
			} else {
				$('#organization-settings-tin-number-modal').val('');
				$('#organization-settings-set-up-tin-number').val('');
			}

			if(response.data['conversion_date'] != undefined) {
				$('#organization-settings-set-up-conversion-date').data("DateTimePicker").date(response.data['conversion_date']);
			} else {
				$('#organization-settings-set-up-conversion-date').data("DateTimePicker").date('');
			}


			if(response.data['rdo_code'] != undefined) {	
				$('#organization-settings-set-up-rdo-code').chosen().val(response.data['rdo_code']);
	        	$('#organization-settings-set-up-rdo-code').trigger("chosen:updated");
			} else 	{
				$('#organization-settings-set-up-rdo-code').chosen().val('');
	        	$('#organization-settings-set-up-rdo-code').trigger("chosen:updated");
			}

			// $('#organization-settings-set-up-currency')
			var currency = response.data['organisation_info']['Organisations']['Organisation']['BaseCurrency'];
			// var taxbasis = 

			$('#organization-settings-set-up-currency').val(currency + ' Philippines Pesos');
			$('#organization-settings-set-up-tax-basis').val(response.data['tax_info']['taxBasis']);
			$('#organization-settings-set-up-tax-period').val(response.data['tax_info']['taxPeriod']);

			// organization-settings-set-up-currency

			// This is for the Tin Number Settings
			tinNumberSetting(response.data['_id']['$id']);
			// For loading of datepicker
			datePicker(response.data['_id']['$id']);

			// return false;

		});


		// This is for onchange of RDO 
		$('#organization-settings-set-up-rdo-code').chosen().unbind('change').change('click', function() {

			var code = $(this).chosen().val();
			var data = {'code' : code};

			// Updated the save rdo code
			base.
				setUrl('settings/saveRdoCode').
				setData(data).
				post(function(response) { 

					// swal('Success!', 'RDO Code successfully updated. ', 'success'); 
					base.notification('RDO Code successfully updated.', 'success');

					// getGeneralSettings();

				});

			return false;
		});

		return false;

}

/**
 * Tin Number Settings
 *
 */
function tinNumberSetting(id) {

	// // This is for tin number
	$('#organization-settings-set-up-tin-number').mask('0000-0000-0000-0000');

	$("#organization-settings-set-up-tin-number").debounce("keyup", function() {

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
						getgeneralSettings();
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
       					swal('Sucess!', 'Organization\'s tin number is successfully updated!', 'success'); 
						$('#modal-edit-tin-number').modal('hide');
						getgeneralSettings();
					}

				});
		}
	});

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
						$('#settings-user-list-set-up').bootgrid('reload');
					}
				}
			); 
		}

	});
}

function getMemberList() {

    var grid = $('#settings-user-list-set-up').bootgrid({
    	css: {
            icon 		: 'zmdi icon',
            iconColumns	: 'zmdi-view-list',
            iconDown 	: 'zmdi-caret-down',
            iconRefresh : 'zmdi-refresh',
            iconUp	 	: 'zmdi-caret-up',
        },
        ajax 		 : true,
	    url 		 : '/settings/getMember/',
	    formatters 	 : {
            commands : function(column, row) {
                return "<button style=\"height: 30px;width: 30px;\" type=\"button\" class=\"btn btn-icon btn-info btn-edit command-edit-user waves-effect waves-circle\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-edit\"></span></button> " + 
                      "<button style=\"height: 30px;width: 30px;\" type=\"button\" class=\"btn btn-icon btn-danger command-delete-user waves-effect waves-circle\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-delete\"></span></button>";            	
            }
        }
    }).on('loaded.rs.jquery.bootgrid', function(){
	    /* Executes after data is loaded and rendered */
	    grid.find(".command-edit-user").on("click", function(e) {
	        var userId = $(this).data("row-id");
	        window.location = '/userDetail';
	       // alert("You pressed edit on row: " + userId);
	   		

	    }).end().find(".command-delete-user").on("click", function(e) {
	    	var userId = $(this).data("row-id");

	        swal({
	        	title : 'Are you sure about this?',   
	        	text  : 'You are about to permanently remove a user',   
	        	type  : 'error',   
	        	showCancelButton: true,   
	        	confirmButtonText: 'Yes, remove this!',   
	        	cancelButtonText: 'No, cancel!',   
	        	closeOnConfirm: false,   
	        	closeOnCancel: true

	       	},function(isConfirm) {
	       		if(isConfirm) {  
	       			var url = '/settings/removeMember/'+userId;
	       			base.
	       				setUrl(url).
	       				get(function(response) {
	       					//success message
	       					swal('Deleted!', 'User has successfully removed. ', 'success'); 
	       					//reload the table
	       					$('#settings-user-list-set-up').bootgrid('reload');

	       				}
	       			);
	       		} 
	       });

	    });

	});

    $('#settings-user-list-set-up').bootgrid('reload');
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
		$('#organization-setting-set-up-'+type+'-address-street').html(address['AddressLine1']);
	}
	// City
	if(address['City'] != undefined || address['City'] != '') {
		$('#organization-setting-set-up-'+type+'-address-city').html(address['City'] + ',');
	}
	// State
	if(address['Region'] != undefined || address['Region'] != '') {
		$('#organization-setting-set-up-'+type+'-address-state').html(address['Region'] + ',');
	}
	// Country
	if(address['Country'] != undefined || address['Country'] != '') {
		$('#organization-setting-set-up-'+type+'-address-country').html(address['Country'] + ';');
	}
	// zip
	if(address['PostalCode'] != undefined || address['PostalCode'] != '') {
		$('#organization-setting-set-up-'+type+'-address-zip').html(address['PostalCode']);
	}
	// zip
	if(address['AttentionTo'] != undefined || address['AttentionTo'] != '') {
		$('#organization-setting-set-up-'+type+'-address-attention').html(address['AttentionTo']);
	}

	return;

}

/**
 * Load the date picker
 *
 */
function datePicker(id) {

	// On change of date
    $('#organization-settings-set-up-conversion-date').unbind('dp.change').bind('dp.change', function(e) {

    	if(e.oldDate !== null) {

	    	var data = {
	    		'id' 	: id,
	    		'date'  : $('#organization-settings-set-up-conversion-date').val()
	    	}

	    	base.
	    		setUrl('settings/setConversionDate').
	    		setData(data).
	    		post(function(response) {

					base.notification('Organization\'s conversion date is successfully updated!', 'success');

	       			// getgeneralSettings();

					return false;

	    		});
    	} else {
    		$('#organization-settings-set-up-conversion-date').val('');
    	}
    });

}