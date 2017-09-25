function Base() {
    this.url    = '';
    this.offset = 0;
    this.limit  = 10;
    this.page   = 0;
    this.data   = new Array();
    this.empty_html = 
        '<h2 style="text-transform: uppercase;margin-top: 50px;">Oops! No Result were found</h2>'+
        '<p>We\'re sorry, It seems as though we were not able to locate exactly what you were looking for.</p>';
    
    this.loading_html = 
    '<div style="margin-top: 50px">'+
        '<div class="preloader pls-amber pl-xxl">'+
            '<svg class="pl-circular" viewBox="25 25 50 50">'+
                '<circle class="plc-path" cx="50" cy="50" r="20"></circle>'+
            '</svg>'+
        '</div>'+
        '<h4 class="to-uc">Loading Awesomeness!!</h4>'+
    '</div>';

    this.icon = {
        'icon'        : 'zmdi icon',
        'iconColumns' : 'zmdi-view-list',
        'iconDown'    : 'zmdi-caret-down',
        'iconRefresh' : 'zmdi-refresh',
        'iconUp'      : 'zmdi-caret-up',
    };
    
    this.label = {
        'noResults'   : this.empty_html,
        'loading'     : this.loading_html,
    }
}

Base.prototype = {
    constructor : Base,
    setUrl : function (url)  {
        
        //window.location.host is subdomain.domain.com
        if($('title[path="live"]').length == 1) {
            this.url = '/crm'+url;
        } else {
            this.url = url;
        }

        this.page = 0;

        return this;
    },
     keyUpString : function(element) {
        $(element).on('input', function() {
          this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
        });

        return this;
    },
    paginate : function(offset, limit) {
        this.offset   = offset;
        this.limit    = limit;
        this.page = 1;

        return this;
    },
    setData : function (data)  {
        this.data = data;

        return this;
    },
    get : function(successCallback, errorCallback) {
        
        var url = (this.page) ? 
            this.url+'/'+this.offset+'/'+this.limit :
            this.url;
        
        $.ajax({
             type       : 'GET',
             url        : url, 
             dataType   : 'json',  
             success    : successCallback,
             error      : errorCallback
        }); 
    },
    post : function(successCallback, errorCallback) {
        
        $.ajax({
             type       : 'POST',
             data       : this.data,
             url        : this.url, 
             dataType   : 'json',  
             success    : successCallback,
             error      : errorCallback
        }); 
    },
    notificationModal : function(title, messages, type){
        // console.log(message)
        swal({
            title : title, 
            text  : messages, 
            type  : type,
            html  : true
        });
    },
    redirect : function(url) {
        if($('title[path="live"]').length == 1) {
            window.location.href = '/crm'+url;
        } else {
            window.location.href = url;
        }
    },
    /**
     * Validate email address format
     * 
     * @param email
     * @return bool
     */
    isValidEmailAddress : function(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(emailAddress);
    },
    loading : function(colspan) {

       
    },
    toolTip : function() {

        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });

    },
    notification : function(message, type) {
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
    },
    /**
     * Delete action
     * 
     * @param string
     * @param string
     * @return this
     */
    bootgridDelete : function(table, url) {

        $(table+'-delete').unbind('click').bind('click', function() {
            var list = $(table).bootgrid('getSelectedRows');

            //if no selected from listing
            if(list.length == 0) {
                swal({
                    title : 'Hmmm, Really?',
                    text : 'You did not select any item(s) from the list',
                    type : 'info',
                    confirmButtonText: 'Return to listing'
                }); 
                return false;
            }

            swal({
                title : 'Are you sure about this?',   
                text  : 'You are about to permanently remove this item(s)',   
                type  : 'warning',   
                showCancelButton: true,   
                confirmButtonText: 'Yes, remove this please!',   
                cancelButtonText: 'No, Im just kidding!',   
                closeOnConfirm: false,   
                closeOnCancel: true

            },function(isConfirm) {
                if(isConfirm) {  
                    
                    var data = {'items' : $(table).bootgrid('getSelectedRows')};
                    //loading
                    swal({
                        title : "Removing selected item(s)",   
                        text : "Just a sec! This might take some minutes depending on the items",   
                        showConfirmButton : false 
                    });

                    base.
                        setUrl(url).
                        setData(data).
                        post(function(response) {
                            swal.close();
                            //success message
                            base.notification('Item(s) successfully removed', 'inverse');
                            //reload the table
                            $(table).bootgrid('reload');

                        }
                    );
                } 
            });

            return false;

        });

        return this;
    },
    /**
     * Bootgrid function for search, pagination and refresh
     * 
     * @param string
     * @return this
     */
    bootgridAction : function(table) {

        //search on table
        $(table+'-search').on('keyup', function(e) {
            clearTimeout($.data(this, 'timer'));
            var searchString = $(this).val();

            //only search if not empty query
            if(searchString != '') {
                //trigger search after half sec user stop typing
                $(this).data('timer', setTimeout(function() {
                    $(table).bootgrid('search', searchString);
                }, 500));
            } else {
                $(table).bootgrid('search', '');
            }
        });

        //refresh table
        $(table+'-refresh').unbind('click').bind('click', function(e) {
            $(table).bootgrid('reload');
            return false;
        });
        
        $(table+'-page li').unbind('click').bind('click', function() {
            //remove active
            $(table+'-page li').removeClass('active');
            //then make the current link page
            $(this).addClass('active');
            //hide dropdown 
            $(this).closest(".dropdown-menu").prev().dropdown("toggle");
            //parse 
            var page = parseInt($(table+'-page li.active a').attr('page'));
            //reload and reload also pagination
            $(table).bootgrid('reload', page);
            
            return false;
        });

        $(table+'-status li').unbind('click').bind('click', function() {
            //remove active
            $(table+'-status li').removeClass('active');
            //then make the current link page
            $(this).addClass('active');
            //hide dropdown 
            $(this).closest(".dropdown-menu").prev().dropdown("toggle");
            //parse 
            var status = parseInt($(table+'-status li.active a').attr('status'));
            //reload and reload also pagination
            $(table).bootgrid('search', 'status-'+status);
            
            return false;
        });

        return this;

    }


}

function Helper() {
    this.url = '';
    this.element = '';
}

Helper.prototype = {
    constructor : Helper,
    loadingTable : function(colspan) {
        
        return '<tr>'+
            '<td colspan="'+colspan+'">'+
                 '<div class="div-center">'+
                    '<div class="preloader pl-xxl">'+
                        '<svg class="pl-circular" viewBox="25 25 50 50">'+
                            '<circle class="plc-path" cx="50" cy="50" r="20"></circle>'+
                        '</svg>'+
                    '</div>'+
                '</div>'+
            '</td>'+
        '</tr>';
    }, 
    emptyTable : function(colspan, message) {
        return '<tr>'+
            '<td colspan="'+colspan+'">'+
                '<div class="div-center">'+              
                        '<p class="no-found">'+message+'</p>'+
                '</div>'+
            '</td>'+
        '</tr>'; 
    },
    loop : function(array, response) {
        Object.keys(array).forEach(response);
    },
    hasError : function(element, type) {
        if(type == 1) {
            element.parent().addClass('has-error').find('small').html(' <i>(Required field)</i>');
        } else {
            element.parent().parent().addClass('has-error').find('small').html(' <i>(Required field)</i>');
        }
        return true;
    },
    noError : function(element, type) {
        if(type == 1) {
            element.parent().removeClass('has-error').find('small').html('');
        } else {
            element.parent().parent().removeClass('has-error').find('small').html('');
        }
    },
    setUrl : function(url) {
        this.url = url;
        return this;
    },
    setElement : function(element) {
        this.element = element;
        return this;
    },
    popUp : function(callback) {
        
        //oauth popup, javascript authentication
        $(this.element).oauthpopup({
            path    : this.url,
            width   : 550,
            height  : 650,
            top     : screen.height/2 - 650 / 2,
            left    : screen.width/2 - 550 / 2,
            onLoad  : function() {
                console.log('loaded')
            },
            //detect popup close
            callback : callback
        });

        return this;
    }
}
function isset(data) {
    return (typeof data !== 'undefined') ? true : false;
}

function tableRow(forEdit, text) {
    if(forEdit) {
        return  '<tr id="[ID]">'+
            '<td class="add-'+text+'-body-item">'+
                //'[ITEM_NAME]'+
                '<input type="text" class="form-control fg-input add-'+text+'-search-item">'+
            '</td>'+
            '<td class="add-'+text+'-body-description">'+
                '<input type="text" class="no-border" value="[DESC]" placeholder="Add Description"/>'+
            '</td>'+
            '<td class="add-'+text+'-body-quantity">'+
                '<input type="text" class="no-border" value="[QUANTITY]" placeholder="Add Quantity" />'+
            '</td>'+
            '<td class="add-'+text+'-body-rate">'+
                '<input type="text" class="no-border" value="[RATE]" placeholder="Add Rate" />'+
            '</td>'+
            '<td class="add-'+text+'-body-disc">'+
                '<input type="text" class="no-border" value="[DISC]" placeholder="Discount" />'+
            '</td>'+
            '<td  class="add-'+text+'-body-amount">'+
                '<input type="text" class="no-border" value="[AMOUNT]" placeholder="Total Amount" disabled="disabled"/>'+
            '</td>'+
            '<td class="">'+
                '<button class="btn bgm-red waves-effect btn-xs add-'+text+'-body-close">'+
                    '<i class="fa fa-times"></i>'+
                '</button>'+
            '</td>'+
        '</tr>';
    } else {
        return '<tr>'+
            '<td class="add-'+text+'-body-item">'+
                //'[ITEM_NAME]'+
                '<input type="text" class="form-control fg-input add-'+text+'-search-item">'+
            '</td>'+
            '<td class="add-'+text+'-body-description">'+
                '<input type="text" class="no-border" placeholder="Add Description"/>'+
            '</td>'+
            '<td class="add-'+text+'-body-quantity">'+
                '<input type="text" class="no-border" placeholder="Add Quantity" />'+
            '</td>'+
            '<td class="add-'+text+'-body-rate">'+
                '<input type="text" class="no-border" placeholder="Add Rate" />'+
            '</td>'+
            '<td class="add-'+text+'-body-disc">'+
                '<input type="text" class="no-border" placeholder="Discount" />'+
            '</td>'+
            '<td  class="add-'+text+'-body-amount">'+
                '<input type="text" class="no-border" placeholder="Total Amount" disabled="disabled"/>'+
            '</td>'+
            '<td class="">'+
                '<button class="btn bgm-red waves-effect btn-xs add-'+text+'-body-close">'+
                    '<i class="fa fa-times"></i>'+
                '</button>'+
            '</td>'+
        '</tr>';
    }
}

function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

function supportPageInt() {

    //show overlay for support page
    $('#beppo-supprt').click(function() {
        $('.overlay').addClass('overlay-open');
        
        //load support page
        window.supportPage.
            unsetters().
            listener().
            getPageData();
        
        return false;
    });
    
    //close 
    $('.overlay-close').click(function() {
        $('.overlay').removeClass('overlay-open');
    });

}

var base    = new Base(); 
var helper  = new Helper();


$('#support').click (function() {
     $('#support').load ('Support');
});

(function() {

    $('#main-record-call').unbind('click').bind('click', function(response) {
        $('#main-record-call-modal').modal('show');
        return false;
    });

    var hasTimer = false;
    var timer = '#main-record-call-timer';
    var start = '#main-record-call-start';
    var pause = '#main-record-call-pause';
    var resume = '#main-record-call-resume';
    var save = '#main-record-call-save';

    // Init timer start
    $(start).unbind('click').bind('click', function() {
        //button manipulation
        $(this).addClass('hidden');
        $(pause).removeClass('hidden');
        $(save).attr('disabled', 'disabled');

        //timer start 
        $(timer).
            timer({format : '%H:%M:%S'}).
            addClass('color-go').
            removeClass('color-stop');

        hasTimer = true;
    });

    $(pause).unbind('click').bind('click', function() {
        //button manipulation
        $(this).addClass('hidden');
        $(resume).removeClass('hidden');
        $(save).removeAttr('disabled');

        //timer manipulation
        $(timer).
            timer('pause').
            removeClass('color-go').
            addClass('color-stop');
    });

    // Init timer resume
    $(resume).unbind('click').bind('click', function() {
        //button manipulation
        $(this).addClass('hidden');
        $(pause).removeClass('hidden');
        $(save).attr('disabled', 'disabled');

        $(timer).
            timer('resume').
            addClass('color-go').
            removeClass('color-stop');        
    });


    // Init timer pause
    $(pause).unbind('click').bind('click', function() {
        //button manipulation
        $(this).addClass('hidden');
        $(resume).removeClass('hidden');
        $(save).removeAttr('disabled');

        $(timer).
            timer('pause').
            removeClass('color-go').
            addClass('color-stop');

        
    });

    // Remove timer
    $('.remove-timer-btn').unbind('click').bind('click', function() {
        hasTimer = false;
        $('.timer').timer('remove');
        $('.timer').val('');
        $(this).attr('disabled', 'disabled');
        $('#record-call-save').attr('disabled', 'disabled');
        $('.start-timer-btn').removeClass('hidden');
        $('.pause-timer-btn, .resume-timer-btn').addClass('hidden');
    });

    // Additional focus event for this demo
    $('.timer').on('focus', function() {
        if(hasTimer) {
            $('.pause-timer-btn').addClass('hidden');
            $('.resume-timer-btn').removeClass('hidden');
        }
    });

    // Additional blur event for this demo
    $('.timer').on('blur', function() {
        if(hasTimer) {
            $('.pause-timer-btn').removeClass('hidden');
            $('.resume-timer-btn').addClass('hidden');
        }
    });
    if($('#global-search')[0]) {
        $('#global-search').autocomplete({
            serviceUrl      : '/app/search/',
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
                
                if(response.type == 'inventory') {
                    window.location = '/inventory/detail?id='+response['id'];  
                } else {
                    window.location = '/customer/detail?id='+response['id'];  
                }
            }
        });
    }

    // $(document).on("input", ".numeric", function() {
    //     this.value = this.value.replace(/[^\d\.\-]/g,'');
    // });

    if($('input.numeric')[0]) {
        $('input.numeric').numeric();
    }
    

})();




