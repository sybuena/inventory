(function() {
	getList('all');
    addNotes();
    sortByType();
})();

function sortByType() {
    $('#notes-table-list-type li').unbind('click').bind('click', function() {
         //remove active
        $('#notes-table-list-type li').removeClass('active');
        //then make the current link page
        $(this).addClass('active');
        //hide dropdown 
        $(this).closest(".dropdown-menu").prev().dropdown("toggle");
        //parse 
        var type = $('#notes-table-list-type li.active a').attr('type');
        $('#notes-table-list').bootgrid('destroy');
        getList(type);

        return false;
    });

    return this;
}

function addNotes() {
    //fields
    var date        = $('#expense-date');
    var category    = $('#expense-category');
    var partNumber  = $('#expense-part-number');
    var reference   = $('#expense-reference');
    var quantity    = $('#expense-quantity');
    var unitPrice   = $('#expense-unit-price');
    var totalAmount = $('#expense-total-amount');
    var supplier    = $('#expense-supplier');
    var customer    = $('#expense-customer');
    var desc        = $('#expense-description');

    var save = $('.expense-save');

    $('#notes-list-add-show').unbind('click').bind('click', function() {
        $('#add-notes .modal-title').html('Add Expense');
        $('#add-notes').modal('show');
        save.attr('id', '');

        date.val('');
        category.val(0);
        partNumber.val('');
        reference.val('');
        quantity.val('');
        unitPrice.val('');
        totalAmount.val('');
        supplier.val('');
        customer.val('');
        desc.val('');

        helper.noError(date, 1);
        helper.noError(category, 1);

        return false;
    });

    save.unbind('click').bind('click', function() {
        var error = false;

        (date.val() == '') ? (error = helper.hasError(date, 1)) : helper.noError(date, '');
        (category.val() == 0) ? (error = helper.hasError(category, 1)) : helper.noError(category, '');
        // (partNumber.val() == '') ? (error = helper.hasError(partNumber, 1)) : helper.noError(partNumber, '');
        // (reference.val() == '') ? (error = helper.hasError(reference, 1)) : helper.noError(reference, '');
        // (unitPrice.val() == '') ? (error = helper.hasError(unitPrice, 1)) : helper.noError(unitPrice, '');
        // (totalAmount.val() == '') ? (error = helper.hasError(totalAmount, 1)) : helper.noError(totalAmount, '');
        // (supplier.val() == '') ? (error = helper.hasError(supplier, 1)) : helper.noError(supplier, '');
        // (customer.val() == '') ? (error = helper.hasError(customer, 1)) : helper.noError(customer, '');
        // (desc.val() == '') ? (error = helper.hasError(desc, 1)) : helper.noError(desc, '');
        
        if(!error) {
            var id = save.attr('id');
            var url = (id != '') ? '/notes/listing/edit/'+id :'/notes/listing/add/';
            
            var data = {
                'date' : date.val(),
                'category' : category.val(),
                'partNumber' : partNumber.val(),
                'reference' : reference.val(),
                'quantity' : quantity.val(),
                'unitPrice' : unitPrice.val(),
                'totalAmount' : totalAmount.val(),
                'supplier' : supplier.val(),
                'customer' : customer.val(),
                'description' : desc.val(),
            };
            save.
                html('Saving...').
                attr('disabled', 'disabled');
                    
            base.
                setUrl(url).
                setData(data).
                post(function(response) {
                    save.
                        html('Save').
                        removeAttr('disabled');

                    base.notification('Notes succefully saved', 'inverse');    
                    
                    $('#add-notes').modal('hide');

                    $('#notes-table-list').bootgrid('reload');
                }
            );
        }
        return false;
    });

    return this;
}

function getList(type) {
	var table = '#notes-table-list';
	var url = '/notes/listing/getList/'+type;


    //TABLE LIST
    base.
        bootgridAction(table).
        bootgridDelete(table, '/notes/listing/delete');

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
            type : function(column, row) {

                if(row['type'] == 'notes') {
                    return '<button class="btn bgm-orange btn-xs waves-effect">Notes</button>';
                } else {
                    return '<button class="btn bgm-blue btn-xs waves-effect">Expense</button>';
                }
            }
           
        },
    //after the ajax is finish
    }).on('loaded.rs.jquery.bootgrid', function (e){
        var total = $(table).bootgrid('getTotalRowCount');
        
    	//count result
    	$(table+'-count').html(total+' Record(s)');

        $(table+' td.text-left, '+table+' td.text-right').unbind('click').bind('click', function() {
            $('#add-notes .modal-title').html('Edit/View Expense');
            swal({
                title : "Loading item...",   
                text : "Just a sec! This might take some minutes depending on the items",   
                showConfirmButton : false 
            });

            var id = $(this).parent().attr('data-row-id');
            var url = '/notes/listing/detail/'+id;
            base.
                setUrl(url).
                get(function(response) {
                    swal.close();

                    $('#add-notes').modal('show');
                    //prepare variables
                    var date        = $('#expense-date');
                    var category    = $('#expense-category');
                    var partNumber  = $('#expense-part-number');
                    var reference   = $('#expense-reference');
                    var quantity   = $('#expense-quantity');
                    var unitPrice   = $('#expense-unit-price');
                    var totalAmount = $('#expense-total-amount');
                    var supplier    = $('#expense-supplier');
                    var customer    = $('#expense-customer');
                    var desc        = $('#expense-description');
                    //unset fields first
                    date.val('');
                    category.val(0);
                    partNumber.val('');
                    reference.val('');
                    quantity.val('');
                    unitPrice.val('');
                    totalAmount.val('');
                    supplier.val('');
                    customer.val('');
                    desc.val('');

                    helper.noError(date, 1);
                    helper.noError(category, 1);


                    date.val(response.data['date']);
                    category.val(response.data['category']);
                    partNumber.val(response.data['partNumber']);
                    reference.val(response.data['reference']);
                    quantity.val(response.data['quantity']);
                    unitPrice.val(response.data['unitPrice']);
                    totalAmount.val(response.data['totalAmount']);
                    supplier.val(response.data['supplier']);
                    customer.val(response.data['customer']);
                    desc.val(response.data['description']);

                    $('.expense-save').attr('id', response.data['_id']['$id']);
                    
                }
            );
            return false;
        });

    });

    //reload this 
    $(table).bootgrid('reload');
}