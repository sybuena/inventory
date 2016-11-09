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
	var email 		= $('#settings-user-email-address');
	var firstname 	= $('#settings-user-firstname');
	var lastname 	= $('#settings-user-lastname');
	var role 		= $('#settings-user-role');

	//unset fields
	$('[href="#modal-add-user"]').unbind('click').bind('click', function() {
		helper.noError(firstname, 1);
		helper.noError(email, 1);
		helper.noError(lastname, 1);
		firstname.val('');
		email.val('');
		lastname.val('');

		$('#invite-user-error-message').addClass('hide');
	});

	$('#settings-user-add-member').unbind('click').bind('click', function() {	
		var error 		= false;
	
		(email.val() == '') ? (error = helper.hasError(email, 1)) : helper.noError(email, 1);
		(firstname.val() == '') ? (error = helper.hasError(firstname, 1)) : helper.noError(firstname, 1);
		(lastname.val() == '') ? (error = helper.hasError(lastname, 1)) : helper.noError(lastname, 1);

		
		if(!base.isValidEmailAddress(email.val()) && email.val() != '') {
			email.parent().addClass('has-error').find('small').html(' <i>Invalid email address</i>');	
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

	var url   = '/settings/getMember/';
    var table = '#settings-user-list';

    base.bootgridAction(table)
    
    $(table).bootgrid({
    	css 	: base.icon,
        labels  : base.label,
        navigation 	 	: 2,
        ajax 		 	: true,
        selection 		: true,
        multiSelect 	: true,
        keepSelection 	: true,
	    url 		 : url,
	    formatters 	 : {
	    	active 	: function(column, row) {
            	if(row['active'] == 'Active') {
	                return '<button class="btn bgm-blue btn-xs waves-effect">Active</button>';
	                       
            	} else if(row['active'] == 'Pending') {
            		return '<button class="btn btn-warning btn-xs waves-effect">Pending</button>';
            	}
            },
            last_login : function(column, row) {
                
                if(typeof row['last_login'] !== 'undefined') {
                    return  moment.unix(row['last_login']).calendar();
                } else {
                    return '----';
                }

            }
            
        }
    }).on('loaded.rs.jquery.bootgrid', function(){
    	var total = $(table).bootgrid('getTotalRowCount');
    	
    	$('#settings-user-list-count').html(total+' Record(s)');

    	$('#settings-user-list td.text-left').unbind('click').bind('click', function() {
	   		var userId = $(this).parent().data('row-id');
	        window.location = '/userDetail/info/'+userId;

	   	});	
	});

    $(table).bootgrid('reload');

    return this;
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

/**
 * For Organization tab data
 *
 */

function getOrganization() {
	var bName 		 = '#settings-';
	//basic info
	var name 		 = $(bName+'name');
	var legalName 	 = $(bName+'legal-name');
	var lineBusiness = $(bName+'line-business');
	var tinNumber 	 = $(bName+'tin-number');
	var description  = $(bName+'description');
	//address
	var street 		 = $(bName+'street-address');
	var city 		 = $(bName+'city');
	var province     = $(bName+'province');
	var zip     	 = $(bName+'zip');
	var country      = $(bName+'country');
	//contact
	var telephone	 = $(bName+'telephone');
	var phone	 	 = $(bName+'phone');
	var fax	 	 	 = $(bName+'fax');
	var website	 	 = $(bName+'website');
	var skype	 	 = $(bName+'skype');
	var twitter	 	 = $(bName+'twitter');
	var linkedin	 = $(bName+'linkedin');
	var facebook	 = $(bName+'facebook');
	//save
	var save 		 = $(bName+'org-update');

	var data = {'id' : 1};
	var url = '/settings/getCurrentOrg';

	base.
		setUrl(url).
		get(function(response) {
			
			var data = response.data;
			//basic
			name.val(data['name']);
			legalName.val(isset(data['legal_name']) ? data['legal_name'] : data['name']);
			lineBusiness.val(isset(data['line_business']) ? data['line_business'] : '');
			tinNumber.val(isset(data['tin_number']) ? data['tin_number'] : '');
			description.val(isset(data['description']) ? data['description'] : '');
			//address
			street.val(isset(data['address']) ? data['address'] : '');
			city.val(isset(data['city']) ? data['city'] : '');
			province.val(isset(data['province']) ? data['province'] : '');
			zip.val(isset(data['zip']) ? data['zip'] : '');
			country.val(isset(data['country']) ? data['country'] : '');
			//contact
			telephone.val(isset(data['telephone']) ? data['telephone'] : '');
			phone.val(isset(data['phone']) ? data['phone'] : '');
			fax.val(isset(data['fax']) ? data['fax'] : '');
			website.val(isset(data['website']) ? data['website'] : '');
			skype.val(isset(data['skype']) ? data['skype'] : '');
			twitter.val(isset(data['twitter']) ? data['twitter'] : '');
			linkedin.val(isset(data['linkedin']) ? data['linkedin'] : '');
			facebook.val(isset(data['facebook']) ? data['facebook'] : '');
		}
	);

	save.unbind('click').bind('click', function(response) {
		var error = false;
		(name.val() == '') ? (error = helper.hasError(name, 1, '')) : helper.noError(name, 1);
		
		if(!error) {
			
			save.
				html('Updating Information...').
				attr('disabled', 'disabled');

			var url = '/settings/updateORg';
			var data = {
				'name' 			: name.val(),
				'legal_name'    : legalName.val(),
				'line_business' : lineBusiness.val(),
				'tin_number'    : tinNumber.val(),
				'description'   : description.val(),
				'address'		: street.val(),
				'city'			: city.val(),
				'province'		: province.val(),
				'zip'			: zip.val(),
				'country'		: country.val(),
				'telephone'		: telephone.val(),
				'phone'			: phone.val(),
				'fax'			: fax.val(),
				'website'		: website.val(),
				'skype'			: skype.val(),
				'twitter'		: twitter.val(),
				'linkedin'		: linkedin.val(),
				'facebook'		: facebook.val()
			}
			base.
				setUrl(url).
				setData(data).
				post(function(response) {
					save.
						html('Update Information').
						removeAttr('disabled');

					base.notification('Organization successfully updated', 'inverse');
				}
			);
		}
	});

	return this;
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