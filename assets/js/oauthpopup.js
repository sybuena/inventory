/*
------------------------------------------------------
  www.idiotminds.com
--------------------------------------------------------
*/

(function ($) {
/* For popup */	
    $.fn.oauthpopup = function (options) {
	 this.click(function(){	
			options.windowName = options.windowName || 'ConnectWithOAuth';
			options.windowOptions = options.windowOptions || 'location=0,status=0,width='+options.width+',height='+options.height+',scrollbars=1,left='+options.left+',top='+options.top;
			options.callback = options.callback || function () {
				window.location.reload();
			};

			var that = this;

			that._oauthWindow = window.open(options.path, options.windowName, options.windowOptions);
			that._oauthInterval = window.setInterval(function () {
				if (that._oauthWindow.closed) { 
					window.clearInterval(that._oauthInterval);
					options.callback();
				}
			},10);
	  });
    };

    $.oauthpopups = function(options)
    {
        if (!options || !options.path) {
            throw new Error("options.path must not be empty");
        }
        options = $.extend({
            windowName: 'ConnectWithOAuth' // should not include space for IE
          , windowOptions: 'location=0,status=0,width='+options.width+',height='+options.height+',scrollbars=1,left='+options.left+',top='+options.top
          , callback: function(){ window.location.reload(); }
        }, options);

        var oauthWindow   = window.open(options.path, options.windowName, options.windowOptions);

        var oauthInterval = window.setInterval(function(){
            if (oauthWindow.closed) {
                window.clearInterval(oauthInterval);
                options.callback();
            }
        }, 1000);
    };

    //bind to element and pop oauth when clicked
    $.fn.oauthpopups = function(options) {
        $this = $(this);
        $this.click($.oauthpopups.bind(this, options));
    };
	
	/* For Google account logout */	
	$.fn.googlelogout=function(options){
		options.google_logout= options.google_logout || "true";
		options.iframe= options.iframe || "ggle_logout";
		
			 if(this.length && options.google_logout=='true'){
				 this.after('<iframe name="'+options.iframe+'" id="'+options.iframe+'" style="display:none"></iframe>');		             }
			 if(options.iframe){
				 options.iframe='iframe#'+options.iframe;
			  }else{
				 options.iframe='iframe#ggle_logout';
			  }
		   this.click(function(){
				if(options.google_logout=='true'){				   
					$(options.iframe).attr('src','https://mail.google.com/mail/u/0/?logout');	 
					 var interval=window.setInterval(function () {
						   $(options.iframe).load(function() {
								window.clearInterval(interval);
								window.location=options.redirect_url;
						  });	
					});	
				}
				else{
					window.location=options.redirect_url;					
				}
				 
		   });
	};
})(jQuery);


