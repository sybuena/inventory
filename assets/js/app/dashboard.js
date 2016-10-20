(function() {

	getList('all');
    searchList();
    searchDashboard();
    replyToTicket();
})();

function searchDashboard() {
    //this is a workaround, not good idea
    setTimeout(function() {
        $('#dashboard-trigger1').trigger('click')   
    }, 200)
    
    $('#dashboard-search-customer-direct').autocomplete({
        serviceUrl      : '/customer/listing/searchDashboard/',
        //on type something on input box
        onSearchStart   : function(query) {
            //show loading
            $('.dashboard-loading').removeClass('hidden');
        },
        //on ajax complete
        onSearchComplete : function(query, response) {
            //remove loading
            $('.dashboard-loading').addClass('hidden');
        },
        //on select
        onSelect: function (response) {
            //go to detail page
            window.location = '/customer/detail/id/'+response['id']
        }
    });

}

function searchList() {
    $('#ticket-dashboard-list-search').on('keyup', function(e) {
        clearTimeout($.data(this, 'timer'));
        var searchString = $(this).val();

        //only search if not empty query
        if(searchString != '') {
            //trigger search after half sec user stop typing
            $(this).data('timer', setTimeout(function() {
                
                $('#ticket-dashboard-list').bootgrid('search', searchString);
            }, 500));
        } else {
            $('#ticket-dashboard-list').bootgrid('search', '');
        }
    });
}

function getList(type) {
	var url = '/ticket/listing/getListDashboard/'+type;
	
	var EMPTY_HTML = 
        '<h2 class="dashboard-no-result">Oops! No Result were found</h2>'+
        '<div>We\'re sorry, It seems as though we were not able to locate exactly what you were looking for.</div>';
    
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
	'<div class="lv-item media dashboard-ticket-list" row-id="[ID]" row-url="[ZENDESK_URL]" row-number="[NUMBER2]">'+
        '<div class="media-body">'+
            '<div class="lv-title">[TITLE]</div>'+
            '<small class="lv-small">[CUSTOMER] <small><i>([EMAIL])</i></small></small>'+
            '<ul class="lv-attrs">'+
                '<li class="[COLOR2]" style="color:white; border:none">[STATUS]</li>'+
                '<li>Ticket#: [NUMBER]</li>'+
            '</ul>'+
           
            '<div class="lv-actions actions dropdown">'+
            	'<p>&nbsp</p>'+
                '<p><small>[CREATED]</small></p>'+
            '</div>'+
        '</div>'+
    '</div>';

    $('#ticket-dashboard-list').bootgrid('destroy');
	$('#ticket-dashboard-list').bootgrid({
		navigation : 0,
    	css: {
            icon 		: 'zmdi icon',
            iconDown 	: 'zmdi-caret-down',
            iconUp	 	: 'zmdi-caret-up',
            infos 		: 'hidden'
        },
       	labels: {
        	noResults 	: EMPTY_HTML,
        	loading 	: LOADING_HTML,
    	},
        ajax 		 	: true,
	    url 		 	: url,
        formatters 	 	: {
            name 	: function(column, row) {
            
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
                    replace('[NUMBER]',      row['zendesk_id']).
                    replace('[NUMBER2]',     row['zendesk_id']).
                    replace('[SOURCE]',      row['source']).
                    replace('[ZENDESK_URL]', row['zendesk_url']).
                	replace('[ID]', 		 row['id']).
                    replace('[ID]',          row['id']).
                	replace('[TITLE]', 		 row['subject']).
                	replace('[TYPE]', 		 row['type']).
                	replace('[STATUS]',      row['ticket_status']).
                	replace('[COLOR2]',   	 color2).
                	replace('[CREATED]', 	 moment.unix(row['date_created']).fromNow()).
                	replace('[LAST_UPDATE]', moment.unix(row['last_update']).format('MM/DD/YYYY')).
                	replace('[PRIORITY]', 	 row['priority']);
            },
        },
    
    }).on('loaded.rs.jquery.bootgrid', function(){
        
        var total = $('#ticket-dashboard-list').bootgrid('getTotalRowCount');
        
        $('#ticket-dashboard-total').html(total);

        /* Executes after data is loaded and rendered */
        $('.dashboard-ticket-list').on('click', function(e) {
            var zendeskUrl = $(this).attr('row-url');
            var id  = $(this).attr('row-number');

            //unset modal
            $('#zendesk-ticket-reply-comment').val('');
            $('#zendesk-ticket-reply-comment').parent().removeClass('has-error');

            $('#zendesk-ticket-modal').modal('show');

            $('.zendesk-ticket-reply-save').attr('zendesk-id', id);
                
            //window.open(zendeskUrl, '_blank');
        });

    });

 	$('#ticket-dashboard-list').bootgrid('reload');
}

function replyToTicket() {

    $('.zendesk-ticket-reply-save').unbind('click').bind('click', function() {
        var status    = $(this).attr('save-as');
        var zendeskId = $(this).attr('zendesk-id');
        var error     = false;
        var comment   = $('#zendesk-ticket-reply-comment');
        
        $('#zendesk-ticket-reply-comment').parent().removeClass('has-error');

        if(comment.val() == '') {
            $('#zendesk-ticket-reply-comment').parent().addClass('has-error');
            error = true;
        } 

        if(!error) {
            
            //make some shit loading
            $('#zendesk-ticket-reply-save-as').
                attr('disabled', 'disabled').
                html('Saving...');

            var url = '/integration/email/replyToTicket/'+zendeskId;
            var data = {
                'comment' : comment.val(),
                'status'  : status
            }

            base.
                setUrl(url).
                setData(data).
                post(function(response) {
                    
                    $('#zendesk-ticket-reply-save-as').
                        removeAttr('disabled').
                        html('Save As <span class="caret"></span>');

                    base.notification('Ticket successfully updated', 'inverse');

                    $('#zendesk-ticket-modal').modal('hide');
            });
        }

        return false;
    });
}


