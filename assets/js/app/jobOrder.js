(function() {
	jobOrderModal(0, 0);
	getList();
	header();
})();

function header() {
    var url = '/jobOrder/listing/calculateHeader/';
    base.
        setUrl(url).
        get(function(response) {

            $('#job-order-draft').html(response.data['draft']);
            $('#job-order-sent').html(response.data['sent']);
            $('#job-order-accepted').html(response.data['accepted']);
            $('#job-order-invoiced').html(response.data['invoiced']);
        }
    );
    return this;
}

function jobOrderModal(id, data) {
    var baseId      = '#add-job-order-';
    var customer    = $(baseId+'customer');
    var jobOrderNumber = $(baseId+'job-order-number');
    var refNumber   = $(baseId+'reference-number');
    var date        = $(baseId+'date');
    var dueDate     = $(baseId+'due-date');
    var total       = $(baseId+'total-amount');
    var title 		= $(baseId+'title');
    var summary 	= $(baseId+'summary');
    var terms 		= $(baseId+'terms');
    var model       = $(baseId+'model');
    var serial       = $(baseId+'serial');
    var tech       = $(baseId+'tech');


    var save        = $('.add-job-order-save');
    var table       = $(baseId+'table');
    var table2      = $(baseId+'service-table');
    var table3      = $(baseId+'other-table');
    var addItem     = $(baseId+'add-item');
    var addService  = $(baseId+'add-service');
    var addOther    = $(baseId+'add-other');

    //HTML
    var TABLE_HTML  = tableRow(0, 'job-order');
    var TABLE_HTML_EDIT  = tableRow(1, 'job-order');

    //if making new invoice
	$('#job-order-list-add-show, #job-order-list-add-show2').unbind('click').bind('click', function() {
        //unset fields
        jobOrderNumber.val('').removeAttr('disabled');
        refNumber.val('');
        date.val('');
        title.val('');
        summary.val('');
        terms.val('');
        dueDate.val('');
        total.val('');
        model.val('');
        serial.val('');
        tech.val('');

        //show modal
        $('#add-job-order-modal').modal('show');
        $('#add-job-order-table tbody').html('');
        $('#add-job-order-service-table tbody').html('');
        $('#add-job-order-other-table tbody').html('');

        loadCustomer(0);
        loadNumber();

        return false;
    });
    
    //if there is value in data, then must be from edit draft
    if(data != 0) {
        //show modal
        $('#add-job-order-modal').modal('show');
        $('#add-job-order-table tbody').html('');

        //load customer and select the current selected
        loadCustomer(data['customer_info']['_id']['$id']);
        //load basic fields    
        jobOrderNumber.val(data['job_order_number']).attr('disabled', 'disabled');
        refNumber.val(data['reference_number']);
        date.val(data['date']);
        dueDate.val(data['due_date']);
        total.val(data['total_amount']);
        title.val(data['title']);
        summary.val(data['summary']);
        terms.val(data['terms']);
        model.val(data['model']);
        tech.val(data['tech']);
        
        if(isset(data['line'])) {
            //loop line item
            helper.loop(data['line'], function(i) {
                
                table.append(TABLE_HTML_EDIT.
                    replace('[DESC]',       data['line'][i]['description']).
                    replace('[RATE]',       data['line'][i]['rate']).
                    replace('[QUANTITY]',   data['line'][i]['quantity']).
                    replace('[AMOUNT]',     data['line'][i]['amount']).
                    replace('[ID]',         data['line'][i]['id'])

                ).find('.add-job-order-search-item').select2({
                    placeholder         : 'Search item from inventory...',
                    minimumInputLength  : 1,
                    initSelection : function (element, callback) {
                        //pre populate the input box with the data
                        callback({
                            id   : data['line'][i]['id'],
                            text : data['line'][i]['name']
                        });
                    },
                    ajax: {
                        url         : '/sales/listing/searchItem/',
                        dataType    : 'json',
                        quietMillis : 500,
                        data        : function (term, page) {
                            return { q: term };
                        },
                        results: function (response, page) {
                            
                            return { results: response.data };
                        },
                        cache: true
                    },
                }).select2('val', data['line'][i]['id']).unbind('click').bind('click', function() {
                    var val = $(this).select2('data');
                    //get cost price
                    var salesRate = val['sales'];
                    var quantity = 1;
                    var amount   = parseFloat(parseFloat(salesRate) * quantity).toFixed(2);

                    $(this).parent().parent().find('.add-job-order-body-rate input').val(salesRate);
                    $(this).parent().parent().find('.add-job-order-body-quantity input').val(quantity);
                    $(this).parent().parent().find('.add-job-order-body-amount input').val(amount);
                    $(this).parent().parent().attr('id', val['id']);
                    //for total
                    calculateTotal();

                    return this;
                });
            });
        }

        if(isset(data['service'])) {
            //loop line service
            helper.loop(data['service'], function(i) {
                
                table2.append(TABLE_HTML_EDIT.
                    replace('[DESC]',       data['service'][i]['description']).
                    replace('[RATE]',       data['service'][i]['rate']).
                    replace('[QUANTITY]',   data['service'][i]['quantity']).
                    replace('[AMOUNT]',     data['service'][i]['amount']).
                    replace('[ID]',         data['service'][i]['id'])

                ).find('.add-job-order-search-item').select2({
                    placeholder         : 'Search service from inventory...',
                    minimumInputLength  : 1,
                    initSelection : function (element, callback) {
                        //pre populate the input box with the data
                        callback({
                            id   : data['service'][i]['id'],
                            text : data['service'][i]['name']
                        });
                    },
                    ajax: {
                        url         : '/sales/listing/searchItem/service',
                        dataType    : 'json',
                        quietMillis : 500,
                        data        : function (term, page) {
                            return { q: term };
                        },
                        results: function (response, page) {
                            
                            return { results: response.data };
                        },
                        cache: true
                    },
                }).select2('val', data['service'][i]['id']).unbind('click').bind('click', function() {
                    var val = $(this).select2('data');
                    //get sales price
                    var salesRate = val['sales'];
                    var quantity = 1;
                    var amount   = parseFloat(parseFloat(salesRate) * quantity).toFixed(2);

                    $(this).parent().parent().find('.add-job-order-body-rate input').val(salesRate);
                    $(this).parent().parent().find('.add-job-order-body-quantity input').val(quantity);
                    $(this).parent().parent().find('.add-job-order-body-amount input').val(amount);
                    $(this).parent().parent().attr('id', val['id']);
                    //for total
                    calculateTotal();

                    return this;
                });
            });
        }

        if(isset(data['other'])) {
            //loop line service
            helper.loop(data['other'], function(i) {
                
                table3.append(TABLE_HTML_EDIT.
                    replace('[DESC]',       data['other'][i]['description']).
                    replace('[RATE]',       data['other'][i]['rate']).
                    replace('[QUANTITY]',   data['other'][i]['quantity']).
                    replace('[AMOUNT]',     data['other'][i]['amount']).
                    replace('[ID]',         data['other'][i]['id'])

                ).find('.add-job-order-search-item').val(data['other'][i]['name']);

            });
        }

        //on edit quantity
        editLine();
        //on remove line
        removeLine();
    } 


    //for ADDING LINE SERVICE
    addService.unbind('click').bind('click', function() {
        //only find the last instanse
        table2.append(TABLE_HTML).
            find('.add-job-order-search-item').last().select2({
            placeholder         : 'Search service from inventory...',
            minimumInputLength  : 1,
            ajax: {
                url         : '/sales/listing/searchItem/service',
                dataType    : 'json',
                quietMillis : 500,
                data        : function (term, page) {
                    return { q: term };
                },
                results: function (response, page) {
                    
                    return { results: response.data };
                },
                cache: true
            },
        }).unbind('click').bind('click', function() {
            var val = $(this).select2('data');
            //get cost price
            var salesRate = val['sales'];
            var quantity = 1;
            var amount   = parseFloat(parseFloat(salesRate) * quantity).toFixed(2);

            $(this).parent().parent().find('.add-job-order-body-rate input').val(salesRate);
            $(this).parent().parent().find('.add-job-order-body-quantity input').val(quantity);
            $(this).parent().parent().find('.add-job-order-body-amount input').val(amount);
            $(this).parent().parent().attr('id', val['id']);
            //for total
            calculateTotal();

            return this;
        });

        //on edit quantity
        editLine();

        //on remove line
        removeLine();

        return false;
    });

    addOther.unbind('click').bind('click', function() {

        //only find the last instanse
        table3.append(TABLE_HTML);

        //on edit quantity and rate
        editLine();

        //on remove line
        removeLine();

        return false;
    });

    //save save save
    save.unbind('click').bind('click', function() {
        var error = false;
        var service = new Array();
        var other   = new Array();

        $('#add-job-order-service-table tbody tr').each(function() {
            var id = $(this).attr('id');
            if(typeof id != 'undefined') { 
                service.push({
                    'id'            : id,
                    'description'   : $(this).find('.add-job-order-body-description input').val(),
                    'quantity'      : $(this).find('.add-job-order-body-quantity input').val(),
                    'rate'          : $(this).find('.add-job-order-body-rate input').val(),
                    'amount'        : $(this).find('.add-job-order-body-amount input').val(),
                });
                $(this).removeClass('has-error');
            //else if there is empty item from searc
            } else {
                $(this).addClass('has-error');
                error = true;
            }
        });

        $('#add-job-order-other-table tbody tr').each(function() {
            var name = $(this).find('.add-job-order-body-item input').val();
            if(name != '') {
                other.push({
                    'name'          : name,
                    'description'   : $(this).find('.add-job-order-body-description input').val(),
                    'quantity'      : $(this).find('.add-job-order-body-quantity input').val(),
                    'rate'          : $(this).find('.add-job-order-body-rate input').val(),
                    'amount'        : $(this).find('.add-job-order-body-amount input').val(),
                });
                $(this).removeClass('has-error');
            //else if there is empty item from searc
            } else {
                $(this).addClass('has-error');
                error = true;
            }
        });

        //check for error
        (customer.val() == 0) ? (error = helper.hasError(customer, 1)) : helper.noError(customer, 1);
        (jobOrderNumber.val() == '') ? (error = helper.hasError(jobOrderNumber, 1)) : helper.noError(jobOrderNumber, 1);
        (date.val() == '') ? (error = helper.hasError(date, 1)) : helper.noError(date, 1);
        //(dueDate.val() == '') ? (error = helper.hasError(dueDate, 1)) : helper.noError(dueDate, 1);
        (total.val() == '') ? (error = helper.hasError(total, 1)) : helper.noError(total, 1);

        //if all is correct
        if(!error) {
            
            $(this).
                html('Saving...').
                attr('disabled', 'disabled');
            //change url if has id
            var url = (id != 0) ? '/jobOrder/listing/edit/'+id : '/jobOrder/listing/add/';            

            var data = {
                'status'            : $(this).attr('status'),
                'customer'          : customer.val(),
                'job_order_number'    : jobOrderNumber.val(),
                'reference_number'  : refNumber.val(),
                'date'              : date.val(),
                'due_date'          : dueDate.val(),
                'service'           : service,
                'other'             : other,
                'total_amount'      : total.val(),
                'title'				: title.val(),
                'summary'			: summary.val(),
                'terms'				: terms.val(),
                'model'             : model.val(),
                'serial'             : serial.val(),
                'tech'             : tech.val(),
            };

            base.
                setUrl(url).
                setData(data).
                post(function(response) {
                    
                    save.each(function() {
                        $(this).
                            html($(this).attr('status') == 1 ? 'Save And Mark as Sent' : 'Save As Draft').
                            removeAttr('disabled');
                    });
            
                    base.notification('Job Order successfully saved', 'inverse');

                    $('#add-job-order-modal').modal('hide');
                    $('#job-order-table-list').bootgrid('reload');
                }
            );
        }
        
        return false;
    });

    /**
     * For removing line item, must be after table is build
     * 
     * @return this
     */
    function removeLine() {
        $('.add-job-order-body-close').unbind('click').bind('click', function() {
            $(this).parent().parent().remove();
            calculateTotal();

            return false;
        });
        return this;
    }

    /**
     * After putting value in quantity, will calculate line amount
     * 
     * @return this
     */
    function editLine() {
        $('.add-job-order-body-quantity input').unbind('keyup').bind('keyup', function() {
            
            //get variables we need
            var quantity = $(this).val();
            var salesRate = $(this).parent().parent().find('.add-job-order-body-rate input').val();
            
            quantity = (quantity == '') ? 0 : quantity;
            salesRate = (salesRate == '') ? 0 : salesRate;

            var amount   = parseFloat(parseFloat(salesRate) * quantity).toFixed(2);

            $(this).parent().parent().find('.add-job-order-body-amount input').val(amount);
            $(this).parent().parent().find('.add-job-order-body-rate input').val(salesRate);
            $(this).parent().parent().find('.add-job-order-body-quantity input').val(quantity);
            calculateTotal();
            
            return false;
        });

        $('.add-job-order-body-rate input').unbind('keyup').bind('keyup', function() {
            
            //get variables we need
            var salesRate = $(this).val();
            var quantity = $(this).parent().parent().find('.add-job-order-body-quantity input').val();
            
            quantity = (quantity == '') ? 0 : quantity;
            salesRate = (salesRate == '') ? 0 : salesRate;

            var amount   = parseFloat(parseFloat(quantity) * salesRate).toFixed(2);

            $(this).parent().parent().find('.add-job-order-body-amount input').val(amount);
            $(this).parent().parent().find('.add-job-order-body-rate input').val(salesRate);
            $(this).parent().parent().find('.add-job-order-body-quantity input').val(quantity);
        
            calculateTotal();
            
            return false;
        });

        return this;
    }

    return false;
}

function calculateTotal() {
    var total = 0;
    $('.add-job-order-body-amount input').each(function() {
        var val = $(this).val();
        if(val != '') {
            total += parseFloat(val);
        }
    });
    
    $('#add-job-order-total-amount').val(parseFloat(total).toFixed(2));
    return this;
}

function loadNumber() {
    var number = $('#add-job-order-job-order-number');
    //number.attr('disabled', 'disabled');
    var url = '/settings/getNumber/job_order';

    base.
        setUrl(url).
        get(function(response) {
            number.val(response.data['number']);
        }
    );
    

    return this;
}

/**
 * Load all possible customer
 * 
 * @param int
 * @return this
 */
function loadCustomer(customerId) {
    var customer = $('#add-job-order-customer');

    //get all contacts as supplier
    var url = '/sales/listing/getCustomer/';

    var OPTION_DATA = '<option value="[VALUE]">[TEXT]</option>';

    customer.html(OPTION_DATA.
        replace('[TEXT]',   'Select customer from contacts').
        replace('[VALUE]',  0)
    );

    base.
        setUrl(url).
        get(function(response) {

            helper.loop(response.data, function(i) {
                var name = response.data[i]['company_name']+' (#'+response.data[i]['account_number']+')';

                customer.append(OPTION_DATA.
                    replace('[TEXT]', name).
                    replace('[VALUE]', response.data[i]['_id']['$id'])
                );
            });
            customer.val(customerId);  
        }
    );

    return this;
}

function getList() {
	var table = '#job-order-table-list';
	var url = '/jobOrder/listing/getList/';

    //TABLE LIST
    base.bootgridAction(table);

	$(table).bootgrid({
		navigation : 2,
    	css     : base.icon,
        labels  : base.label,
        ajax 	: true,
	    url 	: url,
        formatters : {
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

    	$('#job-order-table-list tbody tr .text-left, #job-order-table-list tbody tr .text-right').unbind('click').bind('click', function(e) {
	        var id = $(this).parent().data('row-id');
            //1 == PENDING
            //2 == DRAFT
            //3 == APPROVED
            //4 == DECLINED
            //if still draft
            window.location = '/jobOrder/detail/?id='+id;

	    });

        if(total == 0 && $(table+'-search').val() == ''){
            var FIRST_ENTRY = 
            '<tr><td colspan="7" class="no-results">'+
            '<div style="margin-top: 50px;">'+
                '<i class="fa fa-file-o fa-4x"></i>'+
                '<h2 style="text-transform: uppercase;">No Job Order Yet!</h2>'+
                '<p>Be the first to create job order to get started</p>'+
                
                '<button class="btn bgm-blue waves-effect" id="job-order-list-add-show2">Create Job Order</button>'+
            '</div>'+
            '</td></tr>';

            $(table+' tbody').html(FIRST_ENTRY);
            //we have unbind in click so its possible to double call function
            jobOrderModal(0, 0);
        }
	    
    });

    //reload this 
    $(table).bootgrid('reload');
}