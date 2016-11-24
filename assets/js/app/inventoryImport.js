(function() {
	importNow();
	downloadCsv();
})();
function downloadCsv() {
	$('#import-import-download').unbind('click').bind('click', function() {
        var link = '/inventory/import/download/';
        $.fileDownload(link);
        return false;
    });
}
function importNow() {
	
	var IMPORT_ERROR_MESSAGE = '<li class="disc-list"><b>Row [NUMBER]</b> : <br/>[MESSAGE]</li>';

	var IMPORT_REPORT = 
	'<p>We found <b>[TOTAL]</b> inventory in the imported file [FILE_NAME] </p>'+
	'<ul>'+
	    '<li class="c-green"><b>[SUCCESS]</b> total inventory will be imported <br/></li>'+
	    '<ul>'+
		    '<li class="disc-list"><b>[INV_TYPE_ITEM]</b> Item Inventory Type <br/></li>'+
			'<li class="disc-list"><b>[INV_TYPE_SERVICE]</b> Service Inventory Type <br/></li>'+
		    '<li class="disc-list">With <b class="c-green">[NEW]</b> new inventory <br/></li>'+
		    '<li class="disc-list">With <b class="c-blue">[UPDATE]</b> updated inventory <br/></li>'+
	    '</ul>'+
	    '<li class="c-red"><b>[ERROR]</b> total inventory has error and will NOT be imported</li>'+
	    '<ul>'+
	        '[ERROR_MESSAGE]'+
	    '</ul>'+
	'</ul>';

	var IMPORT_REPORT_SUCCESS = 
	'<p><b>[TOTAL]</b> contact(s) has been successfully added.</p>';

	var errorModal   = $('#inventory-import-alert-error');
	var errorMessage = $('#inventory-import-alert-error .alert-error-custom');

	$('#inventory-import-src').unbind('change').bind('change', function() {
        var file = document.getElementById('inventory-import-src').files[0];
        if(typeof file !== 'undefined') {
            $('.file-selected').html(file.name);
        } else {
            $('.file-selected').html(' No file selected ');
        }
        return false;
    });

	$('#inventory-import-now').unbind('click').bind('click', function() {    
		var file = document.getElementById('inventory-import-src').files[0];

		//only if there is sleected file
        if(typeof file === 'undefined') {
            
            errorModal.show();
            errorMessage.html('Please select a csv file before importing');
            
            return false;
        }

		//only allow to upload csv file
        if(file.type != 'text/csv' && file.type != 'application/vnd.ms-excel') {
            
            errorModal.show();
            errorMessage.html('Only csv file is allowed to upload');

            return false;
        }
        var fd = new FormData();

		fd.append("afile", file);
		// These extra params aren't necessary but show that you can include other data.
		fd.append("username", "Groucho");
		fd.append("accountnum", 123456);
		var xhr = new XMLHttpRequest();

		xhr.open('POST', '/inventory/import/parse', true);
		  
		xhr.upload.onprogress = function(e) {
		    if(e.lengthComputable) {
		      	var percentComplete = (e.loaded / e.total) * 100;

		      	$('#inventory-import-now').
		      		html('Reading and Parsing the file...').
		      		attr('disabled', 'disabled');
		    }
		};

		xhr.onload = function() {
		    if(this.status == 200) {
		    	
		    	$('#inventory-import-now').
		      		html('Import Inventory').
		      		removeAttr('disabled');

		     	var response = JSON.parse(this.response);
		  		var message = '';
                                    
                for(i in response.data['error_message']) {
                    var errorMessage = '';
                    for(x in response.data['error_message'][i]['message']) {
                        errorMessage += response.data['error_message'][i]['message'][x]+'<br/>';
                    }
                    message += IMPORT_ERROR_MESSAGE.
                        replace('[NUMBER]',     response.data['error_message'][i]['line']).
                        replace('[MESSAGE]',    errorMessage);
                }
                

                $('#inventory-import-message').show();
                $('#inventory-import-message .alert-error-custom').html(IMPORT_REPORT.
                    replace('[TOTAL]',          	response.data['total']).
                    replace('[SUCCESS]',        	response.data['success']).
                    replace('[ERROR]',          	response.data['error']).
                    replace('[NEW]',            	response.data['new']).
                    replace('[UPDATE]',         	response.data['update']).
                    replace('[FILE_NAME]',      	file.name).
                    replace('[ERROR_MESSAGE]',  	message).
                    replace('[INV_TYPE_ITEM]',  	response.data['item_count']).
                    replace('[INV_TYPE_SERVICE]',  	response.data['service_count'])
                );

                continueImport(response.data['id']);
		    };
		};
		
		xhr.send(fd);

	});
}

function continueImport(id) {
	var button = $('#inventory-import-continue-import');
	button.unbind('click').bind('click', function() {
		var url = '/inventory/import/save/'+id;
		button.
			html('Importing...').
			attr('disabled', 'disabled');
		base.
			setUrl(url).
			get(function(response) {
				
				$('#inventory-import-message').hide();
				$('#inventory-import-alert-error').hide();

				button.
					html('Continue Import').
					removeAttr('disabled');

				base.notification('File successfully imported', 'inverse');
				
				$('#inventory-import-src').val('');
                $('.file-selected').html(' No file selected ');

			}
		);
		return false;

	});

	return this;
}
