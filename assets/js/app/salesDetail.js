(function() {
	approve();
	decline();
	deleteInvoice();
})();

function deleteInvoice() {

	$('.invoice-delete').unbind('click').bind('click', function() {
		var id = $(this).attr('invoice-id');

		swal({
            title : 'Delete Sales Invoice?',   
            text  : 'You are about to delete this sales invoice',   
            type  : 'warning',   
            showCancelButton: true,   
            confirmButtonText: 'Yes, remove this',   
            cancelButtonText: 'Nope, Im just kidding!',   
            closeOnConfirm: false,   
            closeOnCancel: true

        },function(isConfirm) {
            if(isConfirm) {  
                
                var url = '/sales/detail/delete/'+id;

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

                        window.location = '/sales/listing/';
                        
                    }
                );
            } 
        });
	});

	return this;
}

function approve() {

	$('.invoice-approve').unbind('click').bind('click', function() {
		var id = $(this).attr('invoice-id');

		swal({
            title : 'Approve Sales Invoice?',   
            text  : 'You are about to approve this sales invoice',   
            type  : 'warning',   
            showCancelButton: true,   
            confirmButtonText: 'Yes, approve this',   
            cancelButtonText: 'Nope, Im just kidding!',   
            closeOnConfirm: false,   
            closeOnCancel: true

        },function(isConfirm) {
            if(isConfirm) {  
                
                var url = '/sales/detail/action/approve/'+id;

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
                        base.notification('Successfully Approved', 'inverse');

                        location.reload();
                    }
                );
            } 
        });
	});

	return this;
}

function decline() {
	
	$('.invoice-decline').unbind('click').bind('click', function() {
		var id = $(this).attr('invoice-id');

		swal({
            title : 'Decline Sales Invoice?',   
            text  : 'You are about to decline this sales invoice',   
            type  : 'warning',   
            showCancelButton: true,   
            confirmButtonText: 'Yes, decline this',   
            cancelButtonText: 'Nope, Im just kidding!',   
            closeOnConfirm: false,   
            closeOnCancel: true

        },function(isConfirm) {
            if(isConfirm) {  
                
                var url = '/sales/detail/action/decline/'+id;

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
                        base.notification('Successfully Decline', 'inverse');
                        
                        location.reload();
                        
                    }
                );
            } 
        });
	});

	return this;	
}
