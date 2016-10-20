(function() {
	
	$('a[href="#settingsTicket"]').unbind('click').bind('click', function() {
		connectTwitter();
		//test();
	});

})();

function test() {
	 var last_response_len = false;
        $.ajax('/integration/twitter/stream/', {
            xhrFields: {
                onprogress: function(e)
                {
                    var this_response, response = e.currentTarget.response;
                    if(last_response_len === false)
                    {
                        this_response = response;
                        last_response_len = response.length;
                    }
                    else
                    {
                        this_response = response.substring(last_response_len);
                        last_response_len = response.length;
                    }
                    console.log(this_response);
                }
            }
        })
        .done(function(data)
        {
            console.log('Complete response = ' + data);
        })
        .fail(function(data)
        {
            console.log('Error: ', data);
        });
        console.log('Request Sent');

}

/**
 * Check if account is connected to twitter
 * If not connected, it will request login url 
 * to twitter
 * 
 * @return {[type]} [description]
 */
function connectTwitter() {

	$('#ticket-source-connect-twitter').
		html('Just a moment...').
		attr('disabled', 'disabled');

	var url = '/integration/twitter/status/';
	base.
		setUrl(url).
		get(function(response) {
			
			//if connected
			if(response.data['is_connected'] == 1) {
				var button = '<i class="zmdi zmdi-twitter bgm-amber-text"></i> Disconnect Twitter';
			//else not connected
			} else {
				var button = '<i class="zmdi zmdi-twitter bgm-amber-text"></i> Connect To Twitter';
				//append the login url
				helper.
					setElement('#ticket-source-connect-twitter').
					setUrl(response.data['url']).
					popUp(function(response) {
						//recheck status
						connectTwitter();

						base.notification('Twitter successfully connected', 'inverse');

			        }
				);
			}

			$('#ticket-source-connect-twitter').
				html(button).
				removeAttr('disabled');
		}
	);
	
}