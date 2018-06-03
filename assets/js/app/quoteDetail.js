(function() {
	editQuote();
	deleteQuote();
    markAccepted();
    markSent();
    convertInvoice();
    printPdf();
})();

function printPdf() {
    $('#quote-print').unbind('click').bind('click', function() {
        
        var frame = $('#report-frame');
        swal({
            title : 'Just a Moment!', 
            text : 'Generating PDF forms...',
            showConfirmButton : false
        });
        
        frame.prop('src', function(){
            //Set their src attribute to the value of data-src
            return $(this).data('src');
        }).load(function() {

            document.getElementById('report-frame').contentWindow.print();    
            swal.close();
        });
        

        return false;
    });
    return this;
}

function convertInvoice() {
    $('.quote-convert').unbind('click').bind('click', function() {
        var id = $(this).attr('quote-id');
        var number = $('#quote-number').html();

        swal({
            title : 'Convert Quote('+number+') as Invoice?',   
            text  : 'This will create new invoice for this quotation',   
            type  : 'warning',   
            showCancelButton: true,   
            confirmButtonText: 'Yes, convert this',   
            cancelButtonText: 'Nope, Im just kidding!',   
            closeOnConfirm: false,   
            closeOnCancel: true,

        },function(isConfirm) {
            if(isConfirm) {  
                
                var url = '/quote/detail/convert/'+id;

                //loading
                swal({
                    title : "Converting quotation...",   
                    text : "Just a sec! This might take some minutes depending on the items",   
                    showConfirmButton : false,
                    showLoaderOnConfirm: true,
                });

                base.
                    setUrl(url).
                    get(function(response) {
                        swal.close();

                        //success message
                        setTimeout(function() {
                             swal({ 
                                title : "Sweet!", 
                                text  : "Invoice successfully created ("+response.data['number']+")", 
                                type  : "success",
                                confirmButtonText : "Go to invoice"
                            }, function() {
                                window.location = '/sales/listing#'+response.data['id'];
                            })
                        }, 500);
                       
                    }
                );
            } 
        });
    });
}

function markSent() {

    $('.quote-sent').unbind('click').bind('click', function() {
        var id = $(this).attr('quote-id');

        swal({
            title : 'Mark Quotation as sent?',   
            text  : 'You are about to mark this quotation status as sent',   
            type  : 'warning',   
            showCancelButton: true,   
            confirmButtonText: 'Yes, mark this',   
            cancelButtonText: 'Nope, Im just kidding!',   
            closeOnConfirm: false,   
            closeOnCancel: true

        },function(isConfirm) {
            if(isConfirm) {  
                
                var url = '/quote/detail/action/sent/'+id;

                //loading
                swal({
                    title : "Saving...",   
                    text : "Just a sec! This might take some minutes depending on the items",   
                    showConfirmButton : false 
                });

                base.
                    setUrl(url).
                    get(function(response) {
                        swal.close();
                        //success message
                        base.notification('Successfully Mark as Sent', 'inverse');

                        location.reload();
                    }
                );
            } 
        });
    });

    return this;
}

function markAccepted() {

    $('.quote-accept').unbind('click').bind('click', function() {
        var id = $(this).attr('quote-id');

        swal({
            title : 'Mark Quotation as accepted?',   
            text  : 'You are about to mark this quotation status as accepted',   
            type  : 'warning',   
            showCancelButton: true,   
            confirmButtonText: 'Yes, mark this',   
            cancelButtonText: 'Nope, Im just kidding!',   
            closeOnConfirm: false,   
            closeOnCancel: true

        },function(isConfirm) {
            if(isConfirm) {  
                
                var url = '/quote/detail/action/accept/'+id;

                //loading
                swal({
                    title : "Saving...",   
                    text : "Just a sec! This might take some minutes depending on the items",   
                    showConfirmButton : false 
                });

                base.
                    setUrl(url).
                    get(function(response) {
                        swal.close();
                        //success message
                        base.notification('Successfully Mark as Accepted', 'inverse');

                        location.reload();
                    }
                );
            } 
        });
    });

    return this;
}

function deleteQuote() {

	$('.quote-delete').unbind('click').bind('click', function() {
		var id = $(this).attr('quote-id');

		swal({
            title : 'Delete Sales Quote?',   
            text  : 'You are about to delete this sales quote',   
            type  : 'warning',   
            showCancelButton: true,   
            confirmButtonText: 'Yes, remove this',   
            cancelButtonText: 'Nope, Im just kidding!',   
            closeOnConfirm: false,   
            closeOnCancel: true

        },function(isConfirm) {
            if(isConfirm) {  
                
                var url = '/quote/detail/delete/'+id;

                //loading
                swal({
                    title : "Saving...",   
                    text : "Just a sec! This might take some minutes depending on the items",   
                    showConfirmButton : false 
                });

                base.
                    setUrl(url).
                    get(function(response) {
                        swal.close();
                        //success message
                        base.notification('Successfully Remove', 'inverse');

                        window.location = '/quote/listing/';
                        
                    }
                );
            } 
        });
	});

	return this;
}

function editQuote() {
    $('.quote-edit').unbind('click').bind('click', function() {
        $('#add-quote-modal').modal('show');
        var id = $(this).attr('quote-id');
        var url = '/quote/listing/draftDetail/'+id;
        base.
            setUrl(url).
            get(function(response) {
                
                quoteModal(id, response.data)
            }
        );
    });

    return this;
}

/**
 * Load all possible customer
 * 
 * @param int
 * @return this
 */
function loadCustomer(customerId) {
    var customer = $('#add-quote-customer');

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

function calculateTotal() {
    var total = 0;
    $('.add-quote-body-amount input').each(function() {
        var val = $(this).val();
        if(val != '') {
            total += parseFloat(val);
        }
    });
    
    $('#add-quote-total-amount').val(parseFloat(total).toFixed(2));
    return this;
}

/**
 * Use for Edit or Add quote
 * 
 * @param string
 * @param object|empty
 * @return this
 */
function quoteModal(id, data) {
    var baseId      = '#add-quote-';
    var customer    = $(baseId+'customer');
    var quoteNumber = $(baseId+'quote-number');
    var refNumber   = $(baseId+'reference-number');
    var date        = $(baseId+'date');
    var dueDate     = $(baseId+'due-date');
    var total       = $(baseId+'total-amount');
    var title       = $(baseId+'title');
    var summary     = $(baseId+'summary');
    var terms       = $(baseId+'terms');


    var save        = $('.add-quote-save');
    var table       = $(baseId+'table');
    var table2      = $(baseId+'service-table');
    var table3      = $(baseId+'other-table');
    var addItem     = $(baseId+'add-item');
    var addService  = $(baseId+'add-service');
    var addOther    = $(baseId+'add-other');

    //HTML
    var TABLE_HTML  = tableRow(0, 'quote');
    var TABLE_HTML_EDIT  = tableRow(1, 'quote');
 
    //if there is value in data, then must be from edit draft
    if(data != 0) {
        //show modal
        $('#add-quote-modal').modal('show');
        $('#add-quote-table tbody').html('');
        $('#add-quote-service-table tbody').html('');
        $('#add-quote-other-table tbody').html('');

        //load customer and select the current selected
        loadCustomer(data['customer_info']['_id']['$id']);
        //load basic fields    
        quoteNumber.val(data['quote_number']).attr('disabled', 'disabled');
        refNumber.val(data['reference_number']);
        date.val(data['date']);
        dueDate.val(data['due_date']);
        total.val(data['total_amount']);
        title.val(data['title']);
        summary.val(data['summary']);
        terms.val(data['terms']);
        
        if(isset(data['line'])) {
            //loop line item
            helper.loop(data['line'], function(i) {
                
                table.append(TABLE_HTML_EDIT.
                    replace('[DESC]',       data['line'][i]['description']).
                    replace('[RATE]',       data['line'][i]['rate']).
                    replace('[QUANTITY]',   data['line'][i]['quantity']).
                    replace('[AMOUNT]',     data['line'][i]['amount']).
                    replace('[ID]',         data['line'][i]['id'])

                ).find('.add-quote-search-item').select2({
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

                    $(this).parent().parent().find('.add-quote-body-rate input').val(salesRate);
                    $(this).parent().parent().find('.add-quote-body-quantity input').val(quantity);
                    $(this).parent().parent().find('.add-quote-body-amount input').val(amount);
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

                ).find('.add-quote-search-item').select2({
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

                    $(this).parent().parent().find('.add-quote-body-rate input').val(salesRate);
                    $(this).parent().parent().find('.add-quote-body-quantity input').val(quantity);
                    $(this).parent().parent().find('.add-quote-body-amount input').val(amount);
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

                ).find('.add-quote-search-item').val(data['other'][i]['name']);

            });
        }

        //on edit quantity
        editLine();
        //on remove line
        removeLine();
    } 

    addItem.unbind('click').bind('click', function() {
        //only find the last instanse
        table.append(TABLE_HTML).
            find('.add-quote-search-item').last().select2({
            placeholder         : 'Search item from inventory...',
            minimumInputLength  : 1,
            ajax: {
                url         : '/sales/listing/searchItem/item',
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

            $(this).parent().parent().find('.add-quote-body-rate input').val(salesRate);
            $(this).parent().parent().find('.add-quote-body-quantity input').val(quantity);
            $(this).parent().parent().find('.add-quote-body-amount input').val(amount);
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

    //for ADDING LINE SERVICE
    addService.unbind('click').bind('click', function() {
        //only find the last instanse
        table2.append(TABLE_HTML).
            find('.add-quote-search-item').last().select2({
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

            $(this).parent().parent().find('.add-quote-body-rate input').val(salesRate);
            $(this).parent().parent().find('.add-quote-body-quantity input').val(quantity);
            $(this).parent().parent().find('.add-quote-body-amount input').val(amount);
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
        var line  = new Array();
        var service = new Array();
        var other   = new Array();

        $('#add-quote-table tbody tr').each(function() {
            var id = $(this).attr('id');
            if(id != '') {
                line.push({
                    'id'            : id,
                    'description'   : $(this).find('.add-quote-body-description input').val(),
                    'quantity'      : $(this).find('.add-quote-body-quantity input').val(),
                    'rate'          : $(this).find('.add-quote-body-rate input').val(),
                    'amount'        : $(this).find('.add-quote-body-amount input').val(),
                });
            }
        });

        $('#add-quote-service-table tbody tr').each(function() {
            var id = $(this).attr('id');
            if(id != '') {
                service.push({
                    'id'            : id,
                    'description'   : $(this).find('.add-quote-body-description input').val(),
                    'quantity'      : $(this).find('.add-quote-body-quantity input').val(),
                    'rate'          : $(this).find('.add-quote-body-rate input').val(),
                    'amount'        : $(this).find('.add-quote-body-amount input').val(),
                });
            }
        });

        $('#add-quote-other-table tbody tr').each(function() {
            var name = $(this).find('.add-quote-body-item input').val();
            if(name != '') {
                other.push({
                    'name'          : name,
                    'description'   : $(this).find('.add-quote-body-description input').val(),
                    'quantity'      : $(this).find('.add-quote-body-quantity input').val(),
                    'rate'          : $(this).find('.add-quote-body-rate input').val(),
                    'amount'        : $(this).find('.add-quote-body-amount input').val(),
                });
            }
        });

        //check for error
        (customer.val() == 0) ? (error = helper.hasError(customer, 1)) : helper.noError(customer, 1);
        (quoteNumber.val() == '') ? (error = helper.hasError(quoteNumber, 1)) : helper.noError(quoteNumber, 1);
        //(refNumber.val() == '') ? (error = helper.hasError(refNumber, 1)) : helper.noError(refNumber, 1);
        (date.val() == '') ? (error = helper.hasError(date, 1)) : helper.noError(date, 1);
        (dueDate.val() == '') ? (error = helper.hasError(dueDate, 1)) : helper.noError(dueDate, 1);
        (total.val() == '') ? (error = helper.hasError(total, 1)) : helper.noError(total, 1);

        //if all is correct
        if(!error) {
            
            $(this).
                html('Saving...').
                attr('disabled', 'disabled');
            //change url if has id
            var url = (id != 0) ? '/quote/listing/edit/'+id : '/quote/listing/add/';            

            var data = {
                'status'            : $(this).attr('status'),
                'customer'          : customer.val(),
                'quote_number'    : quoteNumber.val(),
                'reference_number'  : refNumber.val(),
                'date'              : date.val(),
                'due_date'          : dueDate.val(),
                'line'              : line,
                'service'           : service,
                'other'             : other,
                'total_amount'      : total.val(),
                'title'             : title.val(),
                'summary'           : summary.val(),
                'terms'             : terms.val()
            };

            base.
                setUrl(url).
                setData(data).
                post(function(response) {
                    
                    save.each(function() {
                        $(this).
                            html($(this).attr('status') == 1 ? 'Save' : 'Save As Draft').
                            removeAttr('disabled');
                    });
            
                    base.notification('Invoice successfully saved', 'inverse');

                    $('#add-quote-modal').modal('hide');
                    location.reload();
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
        $('.add-quote-body-close').unbind('click').bind('click', function() {
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
        $('.add-quote-body-quantity input').unbind('keyup').bind('keyup', function() {
            
            //get variables we need
            var quantity = $(this).val();
            var salesRate = $(this).parent().parent().find('.add-quote-body-rate input').val();
            
            quantity = (quantity == '') ? 0 : quantity;
            salesRate = (salesRate == '') ? 0 : salesRate;

            var amount   = parseFloat(parseFloat(salesRate) * quantity).toFixed(2);

            $(this).parent().parent().find('.add-quote-body-amount input').val(amount);
            $(this).parent().parent().find('.add-quote-body-rate input').val(salesRate);
            $(this).parent().parent().find('.add-quote-body-quantity input').val(quantity);
            calculateTotal();
            
            return false;
        });

        $('.add-quote-body-rate input').unbind('keyup').bind('keyup', function() {
            
            //get variables we need
            var salesRate = $(this).val();
            var quantity = $(this).parent().parent().find('.add-quote-body-quantity input').val();
            
            quantity = (quantity == '') ? 0 : quantity;
            salesRate = (salesRate == '') ? 0 : salesRate;

            var amount   = parseFloat(parseFloat(quantity) * salesRate).toFixed(2);

            $(this).parent().parent().find('.add-quote-body-amount input').val(amount);
            $(this).parent().parent().find('.add-quote-body-rate input').val(salesRate);
            $(this).parent().parent().find('.add-quote-body-quantity input').val(quantity);
        
            calculateTotal();
            
            return false;
        });

        return this;
    }

    return false;
}