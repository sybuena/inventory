(function() {
	var id = getUrlParameter('id')
	
	$('a[href="#detail-sales-log"]').unbind('click').bind('click', function() {

		getSalesTransaction(id);
	});

	$('a[href="#detail-quatation-log"]').unbind('click').bind('click', function() {

		getQuatationTransaction(id);
	});

    $('a[href="#detail-purchases-log"]').unbind('click').bind('click', function() {

        getPurchaseTransaction(id);
    });

    $('a[href="#detail-job-order-log"]').unbind('click').bind('click', function() {

        getJobOrderTransaction(id);
    });


    $('a[href="#detail-quantity-log"]').unbind('click').bind('click', function() {

        getQuantityLog(id);
    });

	
	updateInventory(id);
    manualAdd(id);
    manualMinus(id);
})();

function manualMinus(id) {

    var quantity = $('#manual-number-minus');
    var description = $('#manual-description-minus');

    $('#inventory-minus-quantity').unbind('click').bind('click', function() {
        $('#minus-quantity').modal('show');
        helper.noError(quantity, 1);
        helper.noError(description, 1);
        description.val('');
        quantity.val('');

        return false;
    });

    $('#minus-quantity-save').unbind('click').bind('click', function() {
        var error = false;
        
        (quantity.val() == '' || quantity.val() == 0) ? (error = helper.hasError(quantity, 1)) : helper.noError(quantity, 1);
        (description.val() == '' ) ? (error = helper.hasError(description, 1)) : helper.noError(description, 1);

        if(!error) {
            $('#minus-quantity-save').
                html('Saving...').
                attr('disabled', 'disabled');

            var url = '/inventory/detail/manualMinus/'+id;
            var data = {
                'quantity' : quantity.val(),
                'description' : description.val()
            };

            base.
                setUrl(url).
                setData(data).
                post(function(response) {
                    
                    $('#minus-quantity').modal('hide');

                    $('#minus-quantity-save').
                        html('Save').
                        removeAttr('disabled');
                    
                    base.notification('Successfully removed quantity', 'inverse');

                    $('#hard-update-stock').html(response.data['stock']);
                }
            );
        }

        return false;
    });

   return false; 
}

function manualAdd(id) {

    var quantity = $('#manual-number');
    var description = $('#manual-description');

    $('#inventory-add-quantity').unbind('click').bind('click', function() {
        $('#add-quantity').modal('show');
        helper.noError(quantity, 1);
        helper.noError(description, 1);
        description.val('');
        quantity.val('');

        return false;
    });

    $('#add-quantity-save').unbind('click').bind('click', function() {
        var error = false;
        
        (quantity.val() == '' || quantity.val() == 0) ? (error = helper.hasError(quantity, 1)) : helper.noError(quantity, 1);
        (description.val() == '' ) ? (error = helper.hasError(description, 1)) : helper.noError(description, 1);

        if(!error) {
            $('#add-quantity-save').
                html('Saving...').
                attr('disabled', 'disabled');

            var url = '/inventory/detail/manualAdd/'+id;
            var data = {
                'quantity' : quantity.val(),
                'description' : description.val()
            };

            base.
                setUrl(url).
                setData(data).
                post(function(response) {
                    
                    $('#add-quantity').modal('hide');

                    $('#add-quantity-save').
                        html('Save').
                        removeAttr('disabled');
                    
                    base.notification('Successfully added quantity', 'inverse');

                    $('#hard-update-stock').html(response.data['stock']);

                }
            );
        }

        return false;
    });

   return false; 
}

function updateInventory(id) {
	var bName 		= '#inventory-';
	var name  		= $(bName+'name'); 
	var code  		= $(bName+'code');
	var type  		= $(bName+'type');
	var location  	= $(bName+'location');
	var category  	= $(bName+'category');
    var unit = $(bName+'unit');
    var brand = $(bName+'brand');
    var model = $(bName+'model');
    var ref = $(bName+'ref');
	var description	= $(bName+'description');

    var purchaseCost = $(bName+'purchase-cost');
    var salesCost = $(bName+'sales-cost');

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
                'unit'   : unit.val(),
                'brand'   : brand.val(),
                'model'   : model.val(),
                'ref'   : ref.val(),
				'description'	: description.val(),
                'cost'          : purchaseCost.val(),
                'sales'         : salesCost.val(),
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
                    window.location.reload();
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
function getQuantityLog(id) {
    var table = '#inventory-quantity-table';
    var url = '/inventory/detail/quantityLog/'+id;

    //TABLE LIST
    base.bootgridAction(table);

    $(table).bootgrid({
        navigation : 2,
        css     : base.icon,
        labels  : base.label,
        ajax    : true,
        url     : url,
    //after the ajax is finish
    }).on('loaded.rs.jquery.bootgrid', function (e){
        var total = $(table).bootgrid('getTotalRowCount');
        
        //count result
        $(table+'-count').html(total+' Record(s)');
    });

    //reload this 
    $(table).bootgrid('reload');

    return this;
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
function getJobOrderTransaction(id) {
    var table = '#inventory-job-order-table';
    var url = '/inventory/detail/jobOrder/'+id;

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
                    return '<button class="btn bgm-orange btn-xs waves-effect status-table" status="'+row['status_text']+'">Sent</button>';
                } else if(row['status_text'] == 2) {
                    return '<button class="btn bgm-cyan btn-xs waves-effect status-table" status="'+row['status_text']+'">Draft</button>';
                } else if(row['status_text'] == 3) {
                    return '<button class="btn bgm-blue btn-xs waves-effect status-table" status="'+row['status_text']+'">Accepted</button>';
                } else if(row['status_text'] == 4) {
                    return '<button class="btn bgm-lightgreen btn-xs waves-effect status-table" status="'+row['status_text']+'">Invoiced</button>';
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
            window.location = '/jobOrder/detail/?id='+id;
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
	var table = '#inventory-quotation-table';
	var url = '/inventory/detail/quotation/'+id;

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
                    return '<button class="btn bgm-orange btn-xs waves-effect status-table" status="'+row['status_text']+'">Sent</button>';
                } else if(row['status_text'] == 2) {
                    return '<button class="btn bgm-cyan btn-xs waves-effect status-table" status="'+row['status_text']+'">Draft</button>';
                } else if(row['status_text'] == 3) {
                    return '<button class="btn bgm-blue btn-xs waves-effect status-table" status="'+row['status_text']+'">Accepted</button>';
                } else if(row['status_text'] == 4) {
                    return '<button class="btn bgm-lightgreen btn-xs waves-effect status-table" status="'+row['status_text']+'">Invoiced</button>';
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
    var table = '#inventory-sales-table';
    var url = '/inventory/detail/sales/'+id;

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