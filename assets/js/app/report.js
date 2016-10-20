(function() {

	init();
	
	$('a[href="#quarterly-profitAndLoss"]').unbind('click').bind('click', function() {
		profitAndLoss('#report-profit-and-loss-quarterly', 'quarterly');
	});
	
	$('a[href="#value-added-tax"]').unbind('click').bind('click', function() {
		vatList('#report-value-added-tax', 'monthly');
	});

	$('a[href="#monthly-profitAndLoss"]').unbind('click').bind('click', function() {
		profitAndLoss('#report-profit-and-loss', 'monthly');
	});

	generatePT();

})();

function init() {
	//first load
	profitAndLoss('#report-profit-and-loss', 'monthly');

    $('[href="#modal-generate-report"]').unbind('click').bind('click', function() {
    	
    	$('#monthly-pt-duplicate').addClass('hide');
    });

    $('[href="#modal-generate-report-quarterly"]').unbind('click').bind('click', function() {
    	
    	$('#monthly-pt-duplicate-quarter').addClass('hide');
    });

    return this;
}

/**
 * From generate percentage tax modal
 * 
 * @return this
 */
function generatePT() {
	//on click generate in modal
	$('#report-generate-pt').unbind('click').bind('click', function() {
		
		var date = $('#report-date-month').val()+' '+$('#report-date-year').val();
		var url  = '/report/generateProfitAndLoss/monthly';
		var data = {
			'date_start' : moment(date).unix(),
			'date_end' 	 : moment(date).unix(),
			'start' 	 : date
		}
		//add loading
		$('#report-generate-pt').
			html('Saving...').
			attr('disabled', 'disabled');
		//ajax
		base.
			setUrl(url).
			setData(data).
			post(function(response) {
				//remove loading
				$('#report-generate-pt').
					html('Generate').
					removeAttr('disabled');

				if(response.error) {
					$('#monthly-pt-duplicate').removeClass('hide');
				} else {
					//hide modal and 
					$('#modal-generate-report').modal('hide');	
					$('#report-profit-and-loss').bootgrid('reload');
				}
			}	
		);
	});

	$('#report-generate-pt-quarter').unbind('click').bind('click', function() {
		var start = $('#report-date-month-quarter').val()+' '+$('#report-date-year-quarter').val();
		var end  = $('#report-date-month-quarter option:selected').attr('end')+' '+$('#report-date-year-quarter').val();
		var url  = '/report/generateProfitAndLoss/quarterly';
		var data = {
			'date_start' : moment(start).unix(),
			'date_end' 	 : moment(end).unix(),
			'start' 	 : $('#report-date-month-quarter').val()+' - '+$('#report-date-month-quarter option:selected').attr('end')+' '+$('#report-date-year-quarter').val()
		}

		//add loading
		$('#report-generate-pt-quarter').
			html('Saving...').
			attr('disabled', 'disabled');

		//ajax
		base.
			setUrl(url).
			setData(data).
			post(function(response) {
				//remove loading
				$('#report-generate-pt-quarter').
					html('Generate').
					removeAttr('disabled');

				if(response.error) {
					$('#monthly-pt-duplicate-quarter').removeClass('hide');
				} else {
					//hide modal and 
					$('#modal-generate-report-quarterly').modal('hide');	
					$('#report-profit-and-loss-quarterly').bootgrid('reload');
				}
			}	
		);

	});	

	return this;
}

function vatList(element, type) {
	
	var url = '/report/getVatList/'+type+'/';

	var grid = $(element).bootgrid({
    	css: {
            icon 		: 'zmdi icon',
            iconColumns	: 'zmdi-view-list',
            iconDown 	: 'zmdi-caret-down',
            iconRefresh : 'zmdi-refresh',
            iconUp	 	: 'zmdi-caret-up',
        },
        ajax 		 : true,
	    url 		 : url,
	    formatters 	 : {
            commands : function(column, row) {
                return "<button data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"View Report Detail\" type=\"button\" class=\"btn btn-info report-profit-view waves-effect\" data-row-type=\""+row.type+"\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-search\"></span></button> " + 
                       "<button data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Delete Report\" type=\"button\" class=\"btn btn-danger report-profit-delete waves-effect\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-delete\"></span></button>";
            }
        }
    }).on('loaded.rs.jquery.bootgrid', function(){
	    /* Executes after data is loaded and rendered */
	    grid.find('.report-profit-view').on('click', function(e) {
	        var reportId = $(this).data('row-id');
	        var reportType = $(this).data('row-type');
	        window.location = '/report/reportDetail/'+reportId+'/1/'+reportType;
	        
	    }).end().find('.report-profit-delete').on('click', function(e) {
	    	var reportId = $(this).data('row-id');

	        swal({
	        	title : 'Are you sure about this?',   
	        	text  : 'You are about to permanently remove a report',   
	        	type  : 'error',   
	        	showCancelButton: true,   
	        	confirmButtonText: 'Yes, remove this!',   
	        	cancelButtonText: 'No, cancel!',   
	        	closeOnConfirm: false,   
	        	closeOnCancel: true

	       	},function(isConfirm) {
	       		if(isConfirm) {  
	       			swal('Deleted!', 'Report has successfully removed. ', 'success'); 

	       			var url = '/report/deleteProfitAndLoss/'+reportId;
	       			base.
	       				setUrl(url).
	       				get(function(response) {
	       					//success message
	       					swal('Deleted!', 'Report has successfully removed. ', 'success'); 
	       					//reload the table
	       					$('#report-profit-and-loss').bootgrid('reload');

	       				}
	       			);
	       		} 
	       });

	    });
	    $('[data-toggle="tooltip"]').tooltip()
	});

    $(element).bootgrid('reload');
}

function profitAndLoss(element, type) {

	var grid = $(element).bootgrid({
    	css: {
            icon 		: 'zmdi icon',
            iconColumns	: 'zmdi-view-list',
            iconDown 	: 'zmdi-caret-down',
            iconRefresh : 'zmdi-refresh',
            iconUp	 	: 'zmdi-caret-up',
        },
        ajax 		 : true,
	    url 		 : '/report/profitAndLoss/'+type+'/',
	    formatters 	 : {
            commands : function(column, row) {
                return "<button data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"View Report Detail\" type=\"button\" class=\"btn btn-info report-profit-view waves-effect\" data-row-type=\""+row.type+"\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-search\"></span></button> " + 
                       "<button data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Delete Report\" type=\"button\" class=\"btn btn-danger report-profit-delete waves-effect\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-delete\"></span></button>";
            }
        }
    }).on('loaded.rs.jquery.bootgrid', function(){
	    /* Executes after data is loaded and rendered */
	    grid.find('.report-profit-view').on('click', function(e) {
	        var reportId = $(this).data('row-id');
	        var reportType = $(this).data('row-type');
	        window.location = '/report/reportDetail/'+reportId+'/0/'+reportType;
	        
	    }).end().find('.report-profit-delete').on('click', function(e) {
	    	var reportId = $(this).data('row-id');

	        swal({
	        	title : 'Are you sure about this?',   
	        	text  : 'You are about to permanently remove a report',   
	        	type  : 'error',   
	        	showCancelButton: true,   
	        	confirmButtonText: 'Yes, remove this!',   
	        	cancelButtonText: 'No, cancel!',   
	        	closeOnConfirm: false,   
	        	closeOnCancel: true

	       	},function(isConfirm) {
	       		if(isConfirm) {  
	       			swal('Deleted!', 'Report has successfully removed. ', 'success'); 

	       			var url = '/report/deleteProfitAndLoss/'+reportId;
	       			base.
	       				setUrl(url).
	       				get(function(response) {
	       					//success message
	       					swal('Deleted!', 'Report has successfully removed. ', 'success'); 
	       					//reload the table
	       					$('#report-profit-and-loss').bootgrid('reload');

	       				}
	       			);
	       		} 
	       });

	    });
	    $('[data-toggle="tooltip"]').tooltip()
	});

    $(element).bootgrid('reload');
}
