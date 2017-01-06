(function() {
	
	addContacts();
	addGroup();
	getCustomerGroup();
	
})();


/**
 * Customer listing
 * 
 * @return this
 */
function getCustomerGroup() {

	var url = '/customer/listing/getGroupList/';
	var A_HTML = 
	'<a href="#" class="list-group-item [ACTIVE]" id="[ID]">'+
	    '[NAME] <span class="badge bgm-amber"></span>'+
    '</a>';
    
    var A_HTML =
    '<a class="lv-item media [ACTIVE]" id="[ID]">'+
        '<!-- <div class="lv-avatar bgm-red pull-left">a</div> -->'+
        '<div class="media-body">'+
            '<div class="lv-title">[NAME]</div>'+
            '<div class="lv-small">[DESC]</div>'+
        '</div>'+
    '</a>';

	base.
		setUrl(url).
		get(function(response) {
			$('.customer-group-list').html(A_HTML.
				replace('[ACTIVE]',   'active').
				replace('[ID]',   'all').
				replace('[NAME]', 'All').
				replace('[DESC]', 'All available group')
			);

			for(i in response.data) {
				
				if($.type(response.data[i]) == 'object') {
					$('.customer-group-list').append(A_HTML.
						replace('[ACTIVE]', '').
						replace('[ID]',   	response.data[i]['_id']['$id']).
						replace('[NAME]', 	response.data[i]['name']).
						replace('[DESC]', 	response.data[i]['description'])
					);
				}
			}
			getCustomerList('all');

			$('.customer-group-list a').unbind('clik').bind('click', function() {
				$('.customer-group-list a').removeClass('active');
				$(this).addClass('active');

				getCustomerList($(this).attr('id'));
			});
		}	
	);
}

/**
 * Create new group for customer
 *
 * @return this
 */
function addGroup() {
	var name 		= $('#add-group-name');
	var description = $('#add-group-description');

	$('#add-group-show').unbind('click').bind('click', function() {
		$('#customer-group-add-modal').modal('show');

		name.val('').parent().removeClass('has-error');
		description.val('').parent().removeClass('has-error');
		$('#add-group-error').addClass('hide');
	});

	$('#add-group-save').unbind('click').bind('click', function() {
		var error 		= false;

		$('#add-group-name').parent().removeClass('has-error');
		$('#add-group-description').parent().removeClass('has-error');
		$('#add-group-error').addClass('hide');

		//now check for empty fields
		(name.val() == '') ? (error = helper.hasError(name, 1, '')) : helper.noError(name, 1);
		(description.val() == '') ? (error = helper.hasError(description, 1, '')) : helper.noError(description, 1);
		
		//if no empty fields
		if(!error) {
			//show some loading
			$('#add-group-save').
				html('Saving...').
				attr('disabled', 'disabled');

			var url = '/customer/listing/addGroup';
			var data = {
				'name' : name.val(),
				'description'  : description.val(),
			}

			//and add now
			base.
				setUrl(url).
				setData(data).
				post(function(response) {
					//remove loading
					$('#add-group-save').
						html('Save').
						removeAttr('disabled');

					//if no error
					if(!response.error) {
						$('#customer-group-add-modal').modal('hide');
						//reload table
						getCustomerGroup();
						
						base.notification('Group succefully added', 'inverse');

					} else {
						$('#add-group-error').removeClass('hide');
					}
				}
			);
		}
	});
}

/**
 * Add Contacts
 * 
 */
function addContacts() {
	//prepare all variable needed for this
	var addCustomer = '#add-customer-';
	//basic info
	var companyName 	= $(addCustomer+'company-name');
	var accountNumber 	= $(addCustomer+'account-number');
	var group 			= $(addCustomer+'group');
	var tin 			= $(addCustomer+'tin-number');
	//primary person
	var firstname 	= $(addCustomer+'firstname');
	var lastname 	= $(addCustomer+'lastname');
	var email 		= $(addCustomer+'email');
	var title 		= $(addCustomer+'title');
	//address info
	var address 	= $(addCustomer+'address');
	var city 		= $(addCustomer+'city');
	var province 	= $(addCustomer+'province');
	var zip 		= $(addCustomer+'zip');
	var country 	= $(addCustomer+'country');
	//contact info
	var phoneNumber  = $(addCustomer+'phone-number');
	var mobileNumber = $(addCustomer+'mobile-number');
	var facebook 	 = $(addCustomer+'facebook');
	var twitter 	 = $(addCustomer+'twitter');
	var skype 		 = $(addCustomer+'skype');
	var website      = $(addCustomer+'website');

	//ON SHOWING MODAL
	$('#customer-add-modal-show').unbind('click').bind('click', function() {
		//show freaking modal
		$('#customer-add-modal').modal('show');
		
		companyName.val('');
		accountNumber.val('');
		firstname.val('');
		lastname.val('');
		email.val('');
		title.val('');
		address.val('');
		city.val('');
		province.val('');
		zip.val('');
		phoneNumber.val('');
		mobileNumber.val('');
		facebook.val('');
		twitter.val('');
		skype.val('');
		website.val('');

		helper.noError(companyName, 1);
		helper.noError(firstname, 1);
		helper.noError(lastname, 1);
		helper.noError(email, 1);
		helper.noError(address, 1);
		helper.noError(city, 1);
		helper.noError(province, 1);
		helper.noError(zip, 1);
		helper.noError(country, 1);

		$('#add-customer-error').addClass('hide');

		//get available group
		var url = '/customer/listing/getGroupList/';
		var OPTION = '<option value="[ID]">[NAME]</option>';

		base.
			setUrl(url).
			get(function(response) {
				$('#add-customer-group').html(OPTION.
					replace('[ID]',   '').
					replace('[NAME]', 'None')
				);

				for(i in response.data) {
					
					if($.type(response.data[i]) == 'object') {
						$('#add-customer-group').append(OPTION.
							replace('[ID]',   response.data[i]['_id']['$id']).
							replace('[NAME]', response.data[i]['name'])
						);
					}
				}
			}
		);
	});

	//ON SAVE
	$('#add-customer-save').unbind('click').bind('click', function() {
		var error = false;
		
		//check for required fields
		(companyName.val() == '') ? (error = helper.hasError(companyName, 1)) : helper.noError(companyName, 1);
		(firstname.val() == '') ? (error = helper.hasError(firstname, 1)) : helper.noError(firstname, 1);
		(lastname.val() == '') ? (error = helper.hasError(lastname, 1)) : helper.noError(lastname, 1);
		(email.val() == '') ? (error = helper.hasError(email, 1)): helper.noError(email, 1);
		(address.val() == '') ? (error = helper.hasError(address, 1)) : helper.noError(address, 1);
		(city.val() == '') ? (error = helper.hasError(city, 1)) : helper.noError(city, 1);
		(province.val() == '') ? (error = helper.hasError(province, 1)) : helper.noError(province, 1);
		(zip.val() == '') ? (error = helper.hasError(zip, 1)) : helper.noError(zip, 1);
		(country.val() == '') ? (error = helper.hasError(country, 1)) : helper.noError(country, 1);
		
		//if no empty fields
		if(!error) {
			//show some loading
			$('#add-customer-save').
				html('Saving...').
				attr('disabled', 'disabled');

			var url = '/customer/listing/addCustomer';
			var data = {
				//basic info
				'company_name' 	 : companyName.val(),
				'account_number' : accountNumber.val(),
				'group' 	 	 : group.val(),
				'tin_number'     : tin.val(),
				//primary person
				'first_name' 	: firstname.val(),
				'last_name' 	: lastname.val(),
				'email' 		: email.val(),
				'title' 		: title.val(),
				//address
				'address' 	: address.val(),
				'city' 		: city.val(),
				'province' 	: province.val(),
				'zip' 		: zip.val(),
				'country' 	: country.val(),
				//contact info
				'phone' 	: phoneNumber.val(),
				'mobile' 	: mobileNumber.val(),
				'facebook' 	: facebook.val(),
				'twitter' 	: twitter.val(),
				'skype' 	: skype.val(),
				'website' 	: website.val(),
			}

			
			//and add now
			base.
				setUrl(url).
				setData(data).
				post(function(response) {
					//remove loading
					$('#add-customer-save').
						html('Save').
						removeAttr('disabled');

					//if no error
					if(!response.error) {
						$('#customer-add-modal').modal('hide');
						//reload table
						$('#crm-table-list').bootgrid('reload');
						
						base.notification('Customer succefully added', 'inverse');

					} else {
						$('#add-customer-error').removeClass('hide');
					}
				}
			);
		}

		return this;
	});
}

function getCustomerList(type) {
	
	var url = '/customer/listing/getList/'+type;
	var table = '#crm-table-list';
	
	base.
		bootgridAction(table).
		bootgridDelete(table, '/customer/listing/delete/');

	$(table).bootgrid('destroy');
	$(table).bootgrid({
		navigation : 2,
    	css     : base.icon,
        labels  : base.label,
        ajax 		 	: true,
	    url 		 	: url,
	    selection 		: true,
        multiSelect 	: true,
        keepSelection 	: true,
        formatters 	 	: {
            name_format 	: function(column, row) {
            	if(row['account_number'] != '') {
	                return '<p>'+row['name']+
	                '<br><small style="font-weight: 300;">#'+row['account_number']+'</small><p>';
	                       
            	} else {
            		return '<p>'+row['name']+
	                '<br><small style="font-weight: 300;"></small><p>';
	                    
            	}
            },
            last_update : function(column, row) {
                return moment.unix(row['last_update']).fromNow();
            }
        },
    //after the ajax is finish
    }).on('loaded.rs.jquery.bootgrid', function (e){
    	//count result
    	var total = $(table).bootgrid('getTotalRowCount');
    	$(table+'-total').html(total);

    	
    	$('#crm-table-list tbody tr .text-left').unbind('click').bind('click', function(e) {
	        var id = $(this).parent().data('row-id');
	        
	        window.location = '/customer/detail?id='+id
	    });

    });

    //reload this 
    $(table).bootgrid('reload');

	return this;    
}
