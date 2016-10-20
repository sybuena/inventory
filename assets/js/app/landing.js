(function() {

	addOrg();

    //get organization listing
	organisation();
    
})();

function orgClick() {

	$('.dashboard-link-clicked').unbind('click').bind('click', function() {
        var id  = $(this).parent().attr('id');
        var url = '/portal/login/';
        var data = {'id' : id}

        base.
            setUrl(url).
            setData(data).
            post(function(response) {
                if(!response.error) {
                    base.redirect('/');
                }
        });

	});
};

function addOrg() {

	$('#xero-button-intergration-connect').unbind('click').bind('click', function() {
        $('#modal-add-organization').modal('show');

        $('#add-organization-name').parent().removeClass('has-error');
        $('#add-organization-phone').parent().removeClass('has-error');
        $('#add-organization-address').parent().removeClass('has-error');
    });

    $('#add-organization-save').unbind('click').bind('click', function() {
        var name = $('#add-organization-name');
        var phone = $('#add-organization-phone');
        var address = $('#add-organization-address');
        var error = false;
        $('#add-organization-name').parent().removeClass('has-error');
        $('#add-organization-phone').parent().removeClass('has-error');
        $('#add-organization-address').parent().removeClass('has-error');

        if(name.val() == '') {
            $('#add-organization-name').parent().addClass('has-error');
            error = true;
        }

        if(phone.val() == '') {
            $('#add-organization-phone').parent().addClass('has-error');
            error = true;
        }
        if(address.val() == '') {
            $('#add-organization-address').parent().addClass('has-error');
            error = true;
        } 

        if(!error) {
            var url = '/portal/createOrganization/';
            var data = {
                'name'      : name.val(),
                'phone'     : phone.val(),
                'address'   : address.val(),
            }

            base.
                setUrl(url).
                setData(data).
                post(function(response) {

                }
            );
        }

    });
}

function organisation() {

    var LIST = 
        '<div class="col-md-2 col-sm-4 col-xs-6">'+
			'<i class="zmdi zmdi-close zmdi-hc-fw trash-button cursor" id="[ID_ORG]"></i>'+
            '<div class="c-item" id="[ID]">'+
                '<a class="ci-avatar dashboard-link-clicked">'+
                    '<img src="/assets/img/default_avatar_org.png" alt="">'+

                    '<div class="c-info">'+
                        '<strong>[NAME]</strong>'+
                        //'<small>[SYNC]</small>'+
                    '</div>'+
                    '<div class="c-footer">'+
                    '</div>'+
                '</a>'+
            '</div>'+
        '</div>';

    var SYNC = '<span class="sync-loading">Syncing...</span>';

    var LOADING = 
        '<div class="div-center">'+
        	'<div class="preloader pl-xxl">'+
                '<svg class="pl-circular" viewBox="25 25 50 50">'+
                    '<circle class="plc-path" cx="50" cy="50" r="20"></circle>'+
                '</svg>'+
            '</div>'+
        '</div>';

    var EMPTY = 
        '<div class="div-center">'+              
        	'<p class="no-found">No organization found.</p>'+
        '</div>';


    // Unset the listing here gorilla ass looking
    $('#organization-list-connected').html('');
    // Then put the loading thingy    
    $('#organization-list-connected').html(LOADING); 
    
    var url = '/portal/organisationList';

    base.
        setUrl(url).
        get(function(response) {
        	var reload = 0;
            // Remove the loading thingy
            $('#organization-list-connected').html('');

            if(response.data.length != 0) {
                var data = response.data;
                for(i in data) {

                    $('#organization-list-connected').append(LIST.
                        replace('[NAME]', 	data[i]['name']).
                        replace('[ID]',   	data[i]['_id']['$id']).
                        replace('[ID_ORG]', data[i]['_id']['$id'])
                    );
                }

            } else {
   				 $('#organization-list-connected').html(EMPTY); 
            }

            orgClick();
            deleteOrganisation();
    });
}

function deleteOrganisation() {

	$('.trash-button').unbind('click').bind('click', function() {

		var id = $(this).attr('id');

        swal({   
            title: "Are you sure?",   
            text: "You want to delete this organisation?",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete it!", 
            closeOnConfirm: false 
        }, function(){   

        	var data = {'id' : id};

			base.
				setUrl('portal/deleteOrganisation').
				setData(data).
				post(function(response) {

					if(!response.error) {
            			swal("Deleted!", "Organisation got deleted.", "success"); 

						organisation();
					}

				});
        });

	});
};

function checkSync() {

	var url = 'portal/organisationList';

	setTimeout(function(){  

	    base.
	        setUrl(url).
	        get(function(response) {

	            if(response.data.length != 0) {
	                var data = response.data;
	                for(i in data) {

	                	if(data[i]['sync'] == 0) {
	                		// Check syncing status
	                		checkSync();
	                	} else {
	                		organisation();
	                	}
	                }
	            }
	    });

	}, 5000);

	return false;


}

function notification(message, type){
    $.growl({
        message: message
    },{
        type: type,
        allow_dismiss: false,
        label: 'Cancel',
        className: 'btn-xs btn-inverse',
        placement: {
            from: 'top',
            align: 'right'
        },
        delay: 2500,
        animate: {
                enter: 'animated bounceIn',
                exit: 'animated bounceOut'
        },
        offset: {
            x: 20,
            y: 85
        }
    });
};


