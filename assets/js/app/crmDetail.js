(function() {
	editSummary();
	editBasic();
	editContact();

	var id = getUrlParameter('id')
	
	$('a[href="#detail-sales-log"]').unbind('click').bind('click', function() {

		getSalesTransaction(id);
	});

	$('a[href="#detail-purchases-log"]').unbind('click').bind('click', function() {

        getPurchaseTransaction(id);
    });

    $('a[href="#detail-quotation-log"]').unbind('click').bind('click', function() {

		getQuatationTransaction(id);
	});

})();

/**
 * Inventory Item all purchase transaction
 * 
 * @param string
 * @return this
 */
function getPurchaseTransaction(id) {
	var table = '#customer-purchase-table';
	var url = '/customer/detail/purchase/'+id;

    //TABLE LIST
    base.bootgridAction(table);

	$(table).bootgrid({
		navigation : 2,
    	css     : base.icon,
        labels  : base.label,
        ajax 		 	: true,
	    url 		 	: url,
	    selection 		: true,
        multiSelect 	: true,
        keepSelection 	: true,
        formatters      : {
            from     : function(column, row) {
                if(row['supplier_info']['account_number'] != '') {
                    return '<p>'+row['supplier_info']['company_name']+
                    '<br><small style="font-weight: 300;">#'+row['supplier_info']['account_number']+'</small><p>';  
                } else {
                    return '<p>'+row['supplier_info']['company_name']+
                    '<br><small style="font-weight: 300;"></small><p>';
                }
            },
            status_text : function(column, row) {

                if(row['status_text'] == 1) {
                    return '<button class="btn bgm-orange btn-xs waves-effect status-table" status="'+row['status_text']+'">Pending</button>';
                } else if(row['status_text'] == 2) {
                    return '<button class="btn bgm-cyan btn-xs waves-effect status-table" status="'+row['status_text']+'">Draft</button>';
                } else if(row['status_text'] == 3) {
                    return '<button class="btn bgm-lightgreen btn-xs waves-effect status-table" status="'+row['status_text']+'">Approved</button>';
                } else if(row['status_text'] == 4) {
                    return '<button class="btn bgm-red btn-xs waves-effect status-table" status="'+row['status_text']+'">Declined</button>';
                }
            }
        },
    //after the ajax is finish
    }).on('loaded.rs.jquery.bootgrid', function (e){
        var total = $(table).bootgrid('getTotalRowCount');
        
    	//count result
    	$(table+'-count').html(total+' Record(s)');

    	$(table+' tbody tr .text-left, '+table+' tbody tr .text-right').unbind('click').bind('click', function(e) {
	        var id = $(this).parent().data('row-id');
	        
	        window.location = '/purchase/detail/?id='+id;
	    });
	    
    });

    //reload this 
    $(table).bootgrid('reload');

    return this;
}

/**
 * Get all sales transaction of inventory
 * 
 * @param string
 * @return this
 */
function getQuatationTransaction(id) {
	var table = '#customer-quotation-table';
	var url = '/customer/detail/quotation/'+id;

    //TABLE LIST
    base.bootgridAction(table);

	$(table).bootgrid({
		navigation : 2,
    	css     : base.icon,
        labels  : base.label,
        ajax 		 	: true,
	    url 		 	: url,
	    selection 		: true,
        multiSelect 	: true,
        keepSelection 	: true,
        formatters      : {
            to     : function(column, row) {
                if(row['customer_info']['account_number'] != '') {
                    return '<p>'+row['customer_info']['company_name']+
                    '<br><small style="font-weight: 300;">#'+row['customer_info']['account_number']+'</small><p>';  
                } else {
                    return '<p>'+row['customer_info']['company_name']+
                    '<br><small style="font-weight: 300;"></small><p>';
                }
            },
            status_text : function(column, row) {

                if(row['status_text'] == 1) {
                    return '<button class="btn bgm-orange btn-xs waves-effect status-table" status="'+row['status_text']+'">Pending</button>';
                } else if(row['status_text'] == 2) {
                    return '<button class="btn bgm-cyan btn-xs waves-effect status-table" status="'+row['status_text']+'">Draft</button>';
                } else if(row['status_text'] == 3) {
                    return '<button class="btn bgm-lightgreen btn-xs waves-effect status-table" status="'+row['status_text']+'">Approved</button>';
                } else if(row['status_text'] == 4) {
                    return '<button class="btn bgm-red btn-xs waves-effect status-table" status="'+row['status_text']+'">Declined</button>';
                }
            }
        },
    //after the ajax is finish
    }).on('loaded.rs.jquery.bootgrid', function (e){
        var total = $(table).bootgrid('getTotalRowCount');
        
    	//count result
    	$(table+'-count').html(total+' Record(s)');

    	$(table+' tbody tr .text-left, '+table+' tbody tr .text-right').unbind('click').bind('click', function(e) {
	        var id = $(this).parent().data('row-id');

            //first build url
            window.location = '/quatation/detail/?id='+id;
	    });
	    
    });

    //reload this 
    $(table).bootgrid('reload');

    return this;
}

function getSalesTransaction(id) {
    var table = '#customer-sales-table';
    var url = '/customer/detail/sales/'+id;

    //TABLE LIST
    base.bootgridAction(table);

    $(table).bootgrid({
        navigation : 2,
        css     : base.icon,
        labels  : base.label,
        ajax            : true,
        url             : url,
        selection       : true,
        multiSelect     : true,
        keepSelection   : true,
        formatters      : {
            to     : function(column, row) {
                if(row['customer_info']['account_number'] != '') {
                    return '<p>'+row['customer_info']['company_name']+
                    '<br><small style="font-weight: 300;">#'+row['customer_info']['account_number']+'</small><p>';  
                } else {
                    return '<p>'+row['customer_info']['company_name']+
                    '<br><small style="font-weight: 300;"></small><p>';
                }
            },
            status_text : function(column, row) {

                if(row['status_text'] == 1) {
                    return '<button class="btn bgm-orange btn-xs waves-effect status-table" status="'+row['status_text']+'">Pending</button>';
                } else if(row['status_text'] == 2) {
                    return '<button class="btn bgm-cyan btn-xs waves-effect status-table" status="'+row['status_text']+'">Draft</button>';
                } else if(row['status_text'] == 3) {
                    return '<button class="btn bgm-lightgreen btn-xs waves-effect status-table" status="'+row['status_text']+'">Approved</button>';
                } else if(row['status_text'] == 4) {
                    return '<button class="btn bgm-red btn-xs waves-effect status-table" status="'+row['status_text']+'">Declined</button>';
                }
            }
        },
    //after the ajax is finish
    }).on('loaded.rs.jquery.bootgrid', function (e){
        var total = $(table).bootgrid('getTotalRowCount');
        
        //count result
        $(table+'-count').html(total+' Record(s)');

        $(table+' tbody tr .text-left, '+table+' tbody tr .text-right').unbind('click').bind('click', function(e) {
            var id = $(this).parent().data('row-id');

            //first build url
            window.location = '/sales/detail/?id='+id;
        });
        
    });

    //reload this 
    $(table).bootgrid('reload');

    return this;
}

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





