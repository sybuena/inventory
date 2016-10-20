(function() {
	
	addPayment();
	radioAction();
	addNote();

	//load the report activity
	$('[href="#report-detail-activity"]').unbind('click').bind('click', function() {
		var id = $(this).attr('sync-id');
		loadActivity(id);
	});

	$('#report-detail-tool-print').unbind('click').bind('click', function() {
		var elementId = 'iFramePdf';
		var getMyFrame = document.getElementById(elementId);
		    getMyFrame.focus();
		    getMyFrame.contentWindow.print()
	});

	$('#report-detail-tool-resync').unbind('click').bind('click', function() {
		var id = $(this).attr('sync-id');

		swal({
			title: "You are about to resync your current data to XERO",   
			text: "Are you sure about this?",   
			type: "info",   
			confirmButtonText : "Yes, resync data",
			showCancelButton: true,   
			closeOnConfirm: false,   
			showLoaderOnConfirm: true, 
		}, function() {   
			//loading UI
			swal({
				title : 'Just a Moment!, Connecting to Xero.....', 
				showConfirmButton : false
			});
			
			var url = '/report/resyncData/'+id;
			
			base.
				setUrl(url).
				get(function(response) {
					swal({ 
						title : "Sweet!", 
						text : "Data successfully resync to XERO!", 
						type : "success",
						confirmButtonText : "Reload"
					}, function() {
						location.reload()
					})
					
				}
			);
		});		
	});

})();

/**
 * Add note to report
 * 
 */
function addNote() {

	$('#report-add-note-btn').unbind('click').bind('click', function() {
		var note = $('#report-add-note-textarea');
		var id = $(this).attr('sync-id');
		if(note.val() == '') {
			$('#report-add-note-textarea').parent().parent().addClass('has-error');
		} else {
			var url = '/report/addNote/'+id;
			var data = {'note' : note.val()};
			
			base.
				setUrl(url).
				setData(data).
				post(function(response) {
					
					loadActivity(id);

					$('#modal-report-add-note').modal('hide');
				}
			);
		}
	});

	return this;
}

function loadActivity(id) {
	$('#report-detail-activity-feed').parent().parent().hide();
	$('#report-detail-activity-feed-loading').show();
	$('#report-detail-activity-feed-empty').hide();

	var url = '/activity/reportActivity/'+id;
	$('#report-detail-activity-feed').html('');
	var NOTE = '<div class="well" style="margin-top: 10px;">[TEXT]</div>';
	var ROW = 
	'<li class="media">'+
	    '<a href="" class="tvh-user pull-left">'+
	        '<img class="img-responsive" src="/assets/img/profile-pics/1.jpg" alt="">'+
	    '</a>'+
	    '<div class="media-body">'+
	        '<div class="m-t-10" style="font-size: 15px">[DESC] <small class="c-gray pull-right">[DATE]</small></div>'+
	    	'<small class="c-gray">[DATE_2]</small>'+
	    	'[NOTE]'+
	    '</div>'+
	'</li>';

	base.
		setUrl(url).
		get(function(response) {
			
			$('#report-detail-activity-feed-loading').hide();

			var count = 0;
			for(i in response.data) {
				var note = '';
				if(response.data[i]['type'] == 'note') {
					note = NOTE.replace('[TEXT]', response.data[i]['note']);
				}
				$('#report-detail-activity-feed').append(ROW.
					replace('[NAME]', 	response.data[i]['created_by_name']).
					replace('[DATE]', 	moment.unix(response.data[i]['date_created']).fromNow()).
					replace('[DATE_2]', moment.unix(response.data[i]['date_created']).format('MMMM Do YYYY, h:mm:ss a')).
					replace('[DESC]', 	response.data[i]['description']).
					replace('[NOTE]', 	note)

				);
				count++;
			}

			if(count == 0) {
				$('#report-detail-activity-feed-empty').show();
			} else {
				$('#report-detail-activity-feed').parent().parent().show();
			}
		}
	);

}

/**
 * Update profit and loss
 * 
 * @return this
 */
function radioAction() {
	$('[name="report-detail-amended-return"]').unbind('change').bind('change', function() {
		var id   = $(this).attr('sync-id');
		var url  = '/report/updateAmended/'+id;	
		var data = {'amended_return' : $(this).val()};

		base.
			setUrl(url).
			setData(data).
			post(function(response) {
				
				swal({ 
					title : "Sweet!", 
					text  : "Amended Return successfully updated", 
					type  : "success",
					confirmButtonText : "Ok"
				})
			}
		);
	});

	$('[name="report-detail-is-paid"]').unbind('change').bind('change', function() {
		var id   = $(this).attr('sync-id');
		var url  = '/report/markAsPaid/'+id;	
		var data = {'is_paid' : $(this).val()};

		base.
			setUrl(url).
			setData(data).
			post(function(response) {
				
				swal({ 
					title : "Sweet!", 
					text  : "Report successfully updated", 
					type  : "success",
					confirmButtonText : "Ok"
				})
			}
		);


	});

	$('[name="report-detail-is-filed"]').unbind('change').bind('change', function() {
		var id    = $(this).attr('sync-id');
		var value = $(this).val();
		
		if(value == 'yes') {
			var title = "You are about to mark this report as Filed.";
			var text  = "Once filed, report cannot be resync to XERO again or update payments, Are you sure about this?";
		} else {
			var title = "You are about to remove filed status of this report";
			var text  = "Once remove filed, report can be resync to XERO or update payments again, Are you sure about this?";
		}

		swal({
			title : title,   
			text: text,   
			type: "info",   
			confirmButtonText : "Yes, update this",
			showCancelButton: true,   
			closeOnConfirm: false,   
			showLoaderOnConfirm: true, 
		}, function(isConfirm) {
			
			if(isConfirm) {   
				//loading UI
				swal({
					title : 'Just a Moment!', 
					showConfirmButton : false
				});
				
				var url  = '/report/markAsFiled/'+id;	
				var data = {'is_filed' : value};

				base.
					setUrl(url).
					setData(data).
					post(function(response) {
						
						swal({ 
							title : "Sweet!", 
							text  : "Report successfully updated", 
							type  : "success",
							confirmButtonText : "Reload"
						}, function() {
							location.reload();
						});
					}
				);
			} else {
				if(value = 'yes') {
					
					$('[name="report-detail-is-filed"][value="no"]').prop("checked", true);

				} else {
					$('[name="report-detail-is-filed"][value="yes"]').prop("checked", true);
				}
			}

		});	
	})

	return this;
}

//LAZY CODING AF
function addPayment() {
	$('#report-detail-update-payment').unbind('click').bind('click', function() {
		var error = false;
		var id = $(this).attr('report-id');
		var particulars = ['Cash/ Bank Debit Memo', 'Check', 'Tax Debit Memo', 'Others'];

		if(!error) {
			
			$('#report-detail-update-payment').
				html('Saving...').
				attr('disabled', 'disabled');

			var url  = '/report/updatePayments/'+id;
			var list = [];

			for(var i in particulars) {
				
				list.push({
					'particulars' 	: particulars[i],
					'agency' 	 	: $('#'+i+'-report-detail-agency').val(),
					'number' 		: $('#'+i+'-report-detail-number').val(),
					'date' 	 		: $('#'+i+'-report-detail-date').val(),
					'amount' 		: $('#'+i+'-report-detail-amount').val()
				})
			}

			var data = {'payments' : list};
			
			base.
				setUrl(url).
				setData(data).
				post(function(response) {

					$('#report-detail-update-payment').
						html('Update Payment').
						removeAttr('disabled');

					swal({ 
						title : "Sweet!", 
						text : "Payment detail successfully updated", 
						type : "success",
						confirmButtonText : "Reload"
					}, function() {
						location.reload()
					})
				}
			);
		}
		
	});

	$('.add-payment-date-input').datetimepicker({
		format: 'MM/DD/YYYY'
	});
}