(function() {
	editSummary();
	editBasic();
	editContact();

})();

function editSummary() {
	var fields   = ['text'];
	var required = [];
	var baseElem = '#detail-customer-summary-';

	baseEdit(baseElem, fields, required, []);
}

function editBasic() {

	var fields   = ['company_name', 'account_number', 'first_name', 'last_name', 'title', ];
	var required = ['company_name', 'firstname', 'lastname'];
	var baseElem = '#detail-customer-basic-';
	var special = {
		'#main-customer-name'  : 'company_name',
		'#main-customer-account' : 'account_number'
	};

	baseEdit(baseElem, fields, required, special);
}

function editContact() {
	var fields 		= ['email', 'mobile', 'phone', 'facebook', 'twitter', 'skype'];
	var required 	= ['email'];
	var baseElem 	= '#detail-customer-contact-';
	var special 	= {
		'#main-customer-mobile' 	: 'mobile',
		'#main-customer-phone' 		: 'phone',
		'#main-customer-email' 		: 'email',
		'#main-customer-facebook' 	: 'facebook',
		'#main-customer-twitter' 	: 'twitter',
		'#main-customer-skype' 		: 'skype',
	}

	baseEdit(baseElem, fields, required, special);
}

function baseEdit(baseElem, fields, required, special) {
	var EMPTY 		= '<span style="font-style: italic;">not specified</span>';
	var ELEMENT 	= baseElem;
	var EDIT_BUTTON = ELEMENT+'edit';
	var SAVE_BUTTON = ELEMENT+'save';
	
	//reset everything in every click edit 
	$(EDIT_BUTTON).unbind('click').bind('click', function() {
		//reset fields
	    helper.loop(required, function(i) {
	    	$(ELEMENT+required[i]+'-2').parent().removeClass('has-error');
	    });

	    //common fields
	    helper.loop(fields, function(i) {
	    	$(ELEMENT+fields[i]+'-2').val(
				($(ELEMENT+fields[i]+'-1').html() == EMPTY) ? '' : $(ELEMENT+fields[i]+'-1').html()
			);
	    });
	});

	//now on save
	$(SAVE_BUTTON).unbind('click').bind('click', function() {
		var id    	= $('#customer-main-id').attr('user-id');
		var url   	= '/customer/detail/editCustomer/'+id;
		var error 	= false;
		var data 	= {};
		//ge the fields and value we need
		helper.loop(fields, function(i) {
			data[fields[i]] = $(ELEMENT+fields[i]+'-2').val();
		});

		//reset fields
		helper.loop(required, function(i) {
			$(ELEMENT+required[i]+'-2').parent().removeClass('has-error');
			//for required fields
			if(data[required[i]] == '') {
				$(ELEMENT+required[i]+'-2').parent().addClass('has-error');
				error = true;
			}
		});
		//if no error found
		if(!error) {
			//show loading in button
			$(SAVE_BUTTON).html('Saving...').attr('disabled', 'disabled');
			//now do ajax
			base.
				setUrl(url).
				setData(data).
				post(function(response) {
					
					$(SAVE_BUTTON).html('Save').removeAttr('disabled');
					//reset element from main view
					helper.loop(fields, function(i) {
						$(ELEMENT+fields[i]+'-1').html((data[fields[i]] == '') ? EMPTY : data[fields[i]]);
					});

					//special case 
					helper.loop(special, function(i) {
						$(i).html(data[special[i]]);
					});

					base.notification('Customer Information succefully updated', 'inverse');
				}
			);
		}		
	});
}





