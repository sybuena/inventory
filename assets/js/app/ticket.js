(function() {
	
	setTimeout(function() {
		getList('all');
		addTicket();
        searchList();
        deleteList();
        checkList();
	}, 200);
	
})();

function checkList() {
    $('#ticket-table-list-check').unbind('click').bind('click', function() {
        $('#ticket-table-list').bootgrid('select');
        $(this).hide();
        $('#ticket-table-list-uncheck').show();
        return false;
    });

    $('#ticket-table-list-uncheck').unbind('click').bind('click', function() {
        $('#ticket-table-list').bootgrid('deselect');
        $(this).hide();
        $('#ticket-table-list-check').show();
        return false;
    });
}
function deleteList() {

    $('#ticket-table-list-delete').unbind('click').bind('click', function() {
        var list = $('#ticket-table-list').bootgrid('getSelectedRows');

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
            text  : 'You are about to permanently remove a customer',   
            type  : 'error',   
            showCancelButton: true,   
            confirmButtonText: 'Yes, remove this!',   
            cancelButtonText: 'No, Im just kidding!',   
            closeOnConfirm: false,   
            closeOnCancel: true

        },function(isConfirm) {
            if(isConfirm) {  
                
                var data = {'list' : list};
                
                var url = '/ticket/listing/delete/';
                
                base.
                    setUrl(url).
                    setData(data).
                    post(function(response) {
                        //success message
                        swal('Deleted!', 'Ticket successfully removed. ', 'success'); 
                        //reload the table
                        $('#ticket-table-list').bootgrid('reload');

                    }
                );
            } 
        });

        return false;

    });
}
function searchList() {
    $('#ticket-table-list-search').on('keyup', function(e) {
        clearTimeout($.data(this, 'timer'));
        var searchString = $(this).val();

        //only search if not empty query
        if(searchString != '') {
            //trigger search after half sec user stop typing
            $(this).data('timer', setTimeout(function() {
                console.log(searchString);
                $('#ticket-table-list').bootgrid('search', searchString);
            }, 500));
        } else {
            $('#ticket-table-list').bootgrid('search', '');
        }
    });
}
function addTicket() {
	$('#ticket-list-add-modal').unbind('click').bind('click', function() {
		$('#add-ticket-modal').modal('show');

		$('#add-ticket-assigned').select2({
            placeholder         : 'Search User...',
            minimumInputLength  : 1,
            ajax: {
                url         : '/ticket/listing/searchUser/',
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
        });

		//search customer
		$('#add-ticket-customer').select2({
            placeholder         : 'Search Customer...',
            minimumInputLength  : 1,
            ajax: {
                url         : '/ticket/listing/searchCustomer/',
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
        });
	});

	$('#add-ticket-save').unbind('click').bind('click', function() {
		var customer = $('#add-ticket-customer');
		var assigned = $('#add-ticket-assigned');
		var type 	 = $('#add-ticket-type');
		var priority = $('#add-ticket-priority');
		var subject  = $('#add-ticket-subject');
		var content  = $('#add-ticket-content');
		var error    = false;

		//for required fields
		(customer.select2('val') == '') ? (error = helper.hasError(customer, 1))   : helper.noError(customer, 1);
		(assigned.select2('val') == '') ? (error = helper.hasError(assigned, 1))   : helper.noError(assigned, 1);
		(type.val() == 0) ? (error = helper.hasError(type, 1))   : helper.noError(type, 1);
		(priority.val() == 0) ? (error = helper.hasError(priority, 1))   : helper.noError(priority, 1);
		(subject.val() == '') ? (error = helper.hasError(subject, 1))   : helper.noError(subject, 1);
		(content.val() == '') ? (error = helper.hasError(content, 1))   : helper.noError(content, 1);

		if(!error) {
			var url  = '/ticket/listing/save/';
			var data = {
				'customer'  : $('#add-ticket-customer').select2('val'),
				'assigned'  : $('#add-ticket-assigned').select2('val'),
				'type' 		: $('#add-ticket-type').val(),
				'priority'  : $('#add-ticket-priority').val(),
				'subject'   : $('#add-ticket-subject').val(),
				'content'   : $('#add-ticket-content').val(),
			};
			
			$('#add-ticket-save').
				html('Saving').
				attr('disabled', 'disabled');

			base.
				setUrl(url).
				setData(data).
				post(function(response) {
					
					$('#add-ticket-save').
						html('Save').
						removeAttr('disabled');
					//reload the listing
					getList('all');
					//hide modal now
					$('#add-ticket-modal').modal('hide');
				}
			);
		}

		return false;
	});
};

function getList(type) {
	var url = '/ticket/listing/getList/'+type;
	
	var EMPTY_HTML = 
		'<h2 style="text-transform: uppercase;margin-top: 50px;">Oops! No Result were found</h2>'+
        '<p>We\'re sorry, It seems as though we were not able to locate exactly what you were looking for.</p>';
    
    var LOADING_HTML = 
    '<div style="margin-top: 50px">'+
	    '<div class="preloader pls-amber pl-xxl">'+
	        '<svg class="pl-circular" viewBox="25 25 50 50">'+
	            '<circle class="plc-path" cx="50" cy="50" r="20"></circle>'+
	        '</svg>'+
	    '</div>'+
	    '<h4 class="to-uc">Loading Awesomeness!!</h4>'+
    '</div>';

    var VIEW_DETAIL_HTML = 
    	'<div class="lv-item media ticket-listing-row" row-id="[ID]">'+
            '<div class="media-body">'+
                '<div class="lv-title">[TITLE]</div>'+
                '<small class="lv-small">[CUSTOMER] <small><i>([EMAIL])</i></small></small>'+
                '<ul class="lv-attrs">'+
                    '<li class="[COLOR2]" style="color:white; border:none">[STATUS]</li>'+
                    '<li class="[COLOR]" style="color:white; border:none">[PRIORITY]</li>'+
                    '<li>[TYPE]</li>'+
                    '<li>Last Updated: [LAST_UPDATE]</li>'+
                    '<li>Source: [SOURCE]</li>'+
                '</ul>'+
               
                '<div class="lv-actions actions dropdown">'+
                	'<p>[CREATED]</p>'+
                    '<p style="text-align: end;">#[NUMBER]</p>'+
                '</div>'+
            '</div>'+
        '</div>';

    $('#ticket-table-list').bootgrid('destroy');
	$('#ticket-table-list').bootgrid({
		navigation : 2,
    	css: {
            icon 		: 'zmdi icon',
            iconDown 	: 'zmdi-caret-down',
            iconUp	 	: 'zmdi-caret-up',
        },
       	labels: {
        	noResults 	: EMPTY_HTML,
        	loading 	: LOADING_HTML,
    	},
        ajax 		 	: true,
	    url 		 	: url,
	    selection 		: true,
        multiSelect 	: true,
        keepSelection 	: true,
        formatters 	 	: {
            name 	: function(column, row) {
            	
            	if(row['priority'] == 'Normal') {
            		var color = 'bgm-blue';
            	} else if(row['priority'] == 'High') {
            		var color = 'bgm-orange';
            	} else if(row['priority'] == 'Urgent') {
            		var color = 'bgm-deeporange';
            	} else {
            		var color = 'bgm-teal';
            	}

            	if(row['ticket_status'] == 'Open') {
            		var color2 = 'bgm-red';
            	} else if(row['ticket_status'] == 'Pending') {
            		var color2 = 'bgm-gray';
            	} else if(row['ticket_status'] == 'Solved') {
            		var color2 = 'bgm-green';
            	}

                return VIEW_DETAIL_HTML.
                	replace('[CUSTOMER]',    row['customer']['name']).
                	replace('[EMAIL]',       row['customer']['email']).
                    replace('[NUMBER]',          row['number']).
                    replace('[SOURCE]',      row['source']).
                	replace('[ID]', 		 row['id']).
                    replace('[ID]',          row['id']).
                	replace('[TITLE]', 		 row['subject']).
                	replace('[TYPE]', 		 row['type']).
                	replace('[STATUS]',      row['ticket_status']).
                	replace('[COLOR]', 		 color).
                	replace('[COLOR2]',   	 color2).
                	replace('[CREATED]', 	 moment.unix(row['date_created']).fromNow()).
                	replace('[LAST_UPDATE]', moment.unix(row['last_update']).format('MM/DD/YYYY')).
                	replace('[PRIORITY]', 	 row['priority']);
            },
        },
    
    }).on('loaded.rs.jquery.bootgrid', function(){
        /* Executes after data is loaded and rendered */
        $('.ticket-listing-row').on('click', function(e) {
            var id = $(this).attr('row-id');
            //var reportType = $(this).data('row-type');
            
            window.location = '/ticket/detail/id/'+id;
            
        });

    });

 	$('#ticket-table-list').bootgrid('reload');
}