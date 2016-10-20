(function() {

	$('[href="#detail-notes"]').unbind('click').bind('click', function() {
		var id = $('#customer-main-id').attr('user-id')
		loadActivity(id);
	});

	addNote();

})();

/**
 * Add note to report
 * 
 */
function addNote() {
	//trigger show moda
	$('#customer-detail-note-modal').unbind('click').bind('click', function() {
		$('#customer-detail-note-add').modal('show');
		//unset this shit
		$('#customer-detail-note-detail').val('').parent().parent().removeClass('has-error');
	});

	//on save note
	$('#customer-detail-note-save').unbind('click').bind('click', function() {
		var note = $('#customer-detail-note-detail');
		var id   = $('#customer-main-id').attr('user-id');

		note.parent().parent().removeClass('has-error');

		if(note.val() == '') {
			note.parent().parent().addClass('has-error');
		} else {
			//add loading
			$('#customer-detail-note-save').
				html('Saving...').
				attr('disabled', 'disabled');
			//the variable
			var url  = '/activity/addNote/'+id;
			var data = {'note' : note.val()};
			
			base.
				setUrl(url).
				setData(data).
				post(function(response) {
					//remove loading
					$('#customer-detail-note-save').
						html('Save').
						removeAttr('disabled');
					//reload the listing
					loadActivity(id);
					//now hide the modal
					$('#customer-detail-note-add').modal('hide');
				}
			);
		}
	});

	return this;
}

function loadActivity(id) {

	$('#crm-detail-activity-feed').parent().parent().hide();
	$('#crm-detail-activity-feed-loading').show();
	$('#crm-detail-activity-feed-empty').hide();
	$('#crm-detail-activity-feed').html('');

	var url   = '/activity/crmActivity/'+id;
	var NOTE  = '<div class="well" style="margin-top: 10px;">[TEXT]</div>';
	var ROW   = 
	'<li class="media">'+
	    '<a href="" class="tvh-user pull-left">'+
	        '<div class="lv-avatar bgm-red pull-left">SB</div>'+
	    '</a>'+
	    '<div class="media-body">'+
	        '<div class="" style="font-size: 15px">[DESC] <small class="c-gray pull-right">[DATE]</small></div>'+
	    	'<small class="c-gray">[DATE_2]</small>'+
	    	'[NOTE]'+
	    '</div>'+
	'</li>';

	base.
		setUrl(url).
		get(function(response) {
			
			$('#crm-detail-activity-feed-loading').hide();

			var count = 0;

			helper.loop(response.data, function(i) {
				var note = '';	
				
				if(response.data[i]['type'] == 'note') {
					note = NOTE.replace('[TEXT]', response.data[i]['note']);
				}

				$('#crm-detail-activity-feed').append(ROW.
					replace('[NAME]', 	response.data[i]['created_by_name']).
					replace('[DATE]', 	moment.unix(response.data[i]['date_created']).fromNow()).
					replace('[DATE_2]', moment.unix(response.data[i]['date_created']).format('MMMM Do YYYY, h:mm:ss a')).
					replace('[DESC]', 	response.data[i]['description']).
					replace('[NOTE]', 	note)

				);
				count++;
			});

			if(count == 0) {
				$('#crm-detail-activity-feed-empty').show();
			} else {
				$('#crm-detail-activity-feed').parent().parent().show();
			}
		}
	);

}