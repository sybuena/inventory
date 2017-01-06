(function() {
	approve();
	decline();
	deletePurchase();
    printPdf();
})();

function printPdf() {
    $('#purchase-print').unbind('click').bind('click', function() {
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

function deletePurchase() {

	$('.purchase-delete').unbind('click').bind('click', function() {
		var id = $(this).attr('purchase-id');

		swal({
            title : 'Delete Purchase Order?',   
            text  : 'You are about to delete this purchase order',   
            type  : 'warning',   
            showCancelButton: true,   
            confirmButtonText: 'Yes, remove this',   
            cancelButtonText: 'Nope, Im just kidding!',   
            closeOnConfirm: false,   
            closeOnCancel: true

        },function(isConfirm) {
            if(isConfirm) {  
                
                var url = '/purchase/detail/delete/'+id;

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

                        window.location = '/purchase/listing/';
                        
                    }
                );
            } 
        });
	});

	return this;
}

function approve() {

	$('.purchase-approve').unbind('click').bind('click', function() {
		var id = $(this).attr('purchase-id');

		swal({
            title : 'Approve Purchase Order?',   
            text  : 'You are about to approve this purchase order',   
            type  : 'warning',   
            showCancelButton: true,   
            confirmButtonText: 'Yes, approve this',   
            cancelButtonText: 'Nope, Im just kidding!',   
            closeOnConfirm: false,   
            closeOnCancel: true

        },function(isConfirm) {
            if(isConfirm) {  
                
                var url = '/purchase/detail/action/approve/'+id;

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
	
	$('.purchase-decline').unbind('click').bind('click', function() {
		var id = $(this).attr('purchase-id');

		swal({
            title : 'Decline Purchase Order?',   
            text  : 'You are about to decline this purchase order',   
            type  : 'warning',   
            showCancelButton: true,   
            confirmButtonText: 'Yes, decline this',   
            cancelButtonText: 'Nope, Im just kidding!',   
            closeOnConfirm: false,   
            closeOnCancel: true

        },function(isConfirm) {
            if(isConfirm) {  
                
                var url = '/purchase/detail/action/decline/'+id;

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
