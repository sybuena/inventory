(function() {
	var id = getUrlParameter('id')
	
	$('a[href="#detail-sales-log"]').unbind('click').bind('click', function() {

		getSalesTransaction(id);
	});

	$('a[href="#detail-purchases-log"]').unbind('click').bind('click', function() {

		getPurchaseTransaction(id);
	});
	
	updateInventory(id);
})();

function updateInventory(id) {
	var bName 		= '#inventory-';
	var name  		= $(bName+'name'); 
	var code  		= $(bName+'code');
	var type  		= $(bName+'type');
	var location  	= $(bName+'location');
	var category  	= $(bName+'category');
	var description	= $(bName+'description');

	var save = $(bName+'update');

	save.unbind('click').bind('click', function() {
		var error = false;

		(name.val() == '') ? (error = helper.hasError(name, 2)) : helper.noError(name, 2);
		(code.val() == '') ? (error = helper.hasError(code, 2)) : helper.noError(code, 2);
		
		if(!error) {
			var url = '/inventory/detail/update/'+id
			var data = {
				'name'	 		: name.val(),
				'code'			: code.val(),
				'type'			: type.val(),
				'location'		: location.val(),
				'category'		: category.val(),
				'description'	: description.val(),
			}

			save.
				html('Updating Information...').
				attr('disabled', 'disabled');

			base.
				setUrl(url).
				setData(data).
				post(function(response) {
					
					save.
						html('Update Information').
						removeAttr('disabled');

					base.notification('Inventory Successfully Updated', 'inverse');
				}
			);
		}
	});

}

/**
 * Inventory Item all purchase transaction
 * 
 * @param string
 * @return this
 */
function getPurchaseTransaction(id) {
	var table = '#inventory-purchase-table';
	var url = '/inventory/detail/purchase/'+id;

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
function getSalesTransaction(id) {
	var table = '#inventory-sales-table';
	var url = '/inventory/detail/sales/'+id;

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
            window.location = '/sales/detail/?id='+id;
	    });
	    
    });

    //reload this 
    $(table).bootgrid('reload');

    return this;
}