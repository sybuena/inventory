(function() {
	getList();
    addNotes();
})();

function addNotes() {
    var title = $('#add-notes-title');
    var amount = $('#add-notes-amount');
    var date  = $('#add-notes-date');
    var type  = $('#add-notes-type');
    var desc  = $('#add-notes-description');
    var save = $('.add-notes-save');

    $('#notes-list-add-show').unbind('click').bind('click', function() {
        $('#add-notes .modal-title').html('Add Notes');
        $('#add-notes').modal('show');
        $('.add-notes-save').attr('id', '');
        title.val('');
        date.val('');
        amount.val('');
        type.val(0);
        desc.val('');

        helper.noError(title, '');
        helper.noError(date, '');
        helper.noError(amount, '');
        helper.noError(type, '');

        return false;
    });

    save.unbind('click').bind('click', function() {
        var error = false;

        (title.val() == '') ? (error = helper.hasError(title, 1)) : helper.noError(title, '');
        (date.val() == '') ? (error = helper.hasError(date, 1)) : helper.noError(date, '');
        (type.val() == 0) ? (error = helper.hasError(type, 1)) : helper.noError(type, '');
        
        if(!error) {
            var id = $('.add-notes-save').attr('id');
            var url = (id != '') ? '/notes/listing/edit/'+id :'/notes/listing/add/';
            
            var data = {
                'title' : title.val(),
                'date' : date.val(),
                'type' : type.val(),
                'amount' : amount.val(),
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

function getList() {
	var table = '#notes-table-list';
	var url = '/notes/listing/getList/';

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
            $('#add-notes .modal-title').html('Edit/View Notes');
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
                    
                    $('#add-notes-title').val(response.data['title']);
                    $('#add-notes-amount').val(response.data['amount']);
                    $('#add-notes-date').val(response.data['date']);
                    $('#add-notes-type').val(response.data['type']);
                    $('#add-notes-description').val(response.data['description']);
                    $('.add-notes-save').attr('id', response.data['_id']['$id']);
                    
                }
            );
            return false;
        });

    });

    //reload this 
    $(table).bootgrid('reload');
}