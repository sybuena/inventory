(function() {

	var table = '#inventory-table-list';

	addCategory();
	getCategory(table);

	addItem(table);
	searchItem(table);
	deleteItem(table);
	
})();

function searchItem(table) {

    //TABLE SEACH
    $('#inventory-table-search').on('keyup', function(e) {
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

    return false;
}
function deleteItem(table) {

    //TABLE DELETE
    $('#inventory-delete').unbind('click').bind('click', function() {
    	var list = $(table).bootgrid('getSelectedRows');

        //if no selected from listing
        if(list.length == 0) {
            swal({
                title : 'Dude, Really?',
                text : 'You did not select any item from the list',
                type : 'warning',
                confirmButtonText: 'Return to listing'
            }); 
            return false;
        }

    	swal({
        	title : 'Are you sure about this?',   
        	text  : 'You are about to permanently remove a item in this inventory',   
        	type  : 'error',   
        	showCancelButton: true,   
        	confirmButtonText: 'Yes, remove this!',   
        	cancelButtonText: 'No, Im just kidding!',   
        	closeOnConfirm: false,   
        	closeOnCancel: true

       	},function(isConfirm) {
       		if(isConfirm) {  
       			
       			var data = {'list' : $(table).bootgrid('getSelectedRows')};

       			var url = '/inventory/listing/delete/';
       			
       			base.
       				setUrl(url).
       				setData(data).
       				post(function(response) {
       					//success message
       					swal('Deleted!', 'Item successfully removed. ', 'success'); 
       					//reload the table
       					$(table).bootgrid('reload');

       				}
       			);
       		} 
    	});

    	return false;

    });
}

function addCategory() {
	var name = $('#add-category-name');
	var description = $('#add-category-description');

	$('#add-category-show').unbind('click').bind('click', function() {
		$('#add-category-modal').modal('show');
		$('#add-category-error').addClass('hide');

		name.val('');
		description.val('');

		helper.noError(name, 1);
		helper.noError(description, 1);

	});

	$('#add-category-save').unbind('click').bind('click', function() {
		var error = false;
		//check for required fields
		(name.val() == '') ? (error = helper.hasError(name, 1)) : helper.noError(name, 1);	
		(description.val() == '') ? (error = helper.hasError(description, 1)) : helper.noError(description, 1);	

		//if no empty fields
		if(!error) {
			//show some loading
			$('#add-category-save').
				html('Saving...').
				attr('disabled', 'disabled');

			var url = '/inventory/listing/createCategory';
			var data = {
				'name' : name.val(),
				'description'  : description.val(),
			}

			//and add now
			base.
				setUrl(url).
				setData(data).
				post(function(response) {
					//remove loading
					$('#add-category-save').
						html('Save').
						removeAttr('disabled');

					//if no error
					if(!response.error) {
						$('#add-category-modal').modal('hide');
						//reload table
						getCategory();
						
						base.notification('Category succefully added', 'inverse');

					} else {
						$('#add-category-error').removeClass('hide');
					}
				}
			);
		}
	});

	return false;
}

function addItem(table) {
	//prepare all variable needed for this
	var addInv = '#add-inventory-';
	//basic info
	var name = $(addInv+'name');
	var code = $(addInv+'code');
	var type = $(addInv+'type');
	var category = $(addInv+'category');
	var description = $(addInv+'description');
	//pricing
	var sales = $(addInv+'sales');
	var cost = $(addInv+'cost');

	//modal show	
	$('#inventory-add-modal').unbind('click').bind('click', function() {
		$('#add-inventory-error').addClass('hide');
		name.val('');
		code.val('');
		type.val(0);
		description.val('');
		sales.val('');
		cost.val('');

		helper.noError(code, 1);
		helper.noError(name, 1);
		helper.noError(type, 1);

		//get available group
		var url = '/inventory/listing/getCategoryList/';
		var OPTION = '<option value="[ID]">[NAME]</option>';

		base.
			setUrl(url).
			get(function(response) {
				$('#add-inventory-category').html(OPTION.
					replace('[ID]',   '').
					replace('[NAME]', 'None')
				);

				for(i in response.data) {
					
					if($.type(response.data[i]) == 'object') {
						$('#add-inventory-category').append(OPTION.
							replace('[ID]',   response.data[i]['_id']['$id']).
							replace('[NAME]', response.data[i]['name'])
						);
					}
				}
			}
		);

		$('#add-inventory-modal').modal('show');
		
		return false;
	});

	//save
	$('#add-inventory-save').unbind('click').bind('click', function() {
		var error = false;
		
		//check for required fields
		(name.val() == '') ? (error = helper.hasError(name, 1)) : helper.noError(name, 1);	
		(code.val() == '') ? (error = helper.hasError(code, 1)) : helper.noError(code, 1);	
		(type.val() == 0) ? (error = helper.hasError(type, 1)) : helper.noError(type, 1);	

		//if no empty fields
		if(!error) {
			//show some loading
			$('#add-inventory-save').
				html('Saving...').
				attr('disabled', 'disabled');

			var url = '/inventory/listing/addItem';
			var data = {
				//basic info
				'name' 	 		: name.val(),
				'code'   		: code.val(),
				'type'  		: type.val(),
				'category'  	: category.val(),
				'description'  	: description.val(),
				'sales'  		: sales.val(),
				'cost'  		: cost.val(),
			}

			//and add now
			base.
				setUrl(url).
				setData(data).
				post(function(response) {
					//remove loading
					$('#add-inventory-save').
						html('Save').
						removeAttr('disabled');

					//if no error
					if(!response.error) {
						$('#add-inventory-modal').modal('hide');
						//reload table
						$(table).bootgrid('reload');
						
						base.notification('item succefully added', 'inverse');

					} else {
						$('#add-inventory-error').removeClass('hide');
					}
				}
			);
		}
	});


	return false;
}

function getCategory(table) {
	var url = '/inventory/listing/getCategoryList/';
	var A_HTML = 
	'<a href="#" class="list-group-item [ACTIVE]" id="[ID]">'+
	    '[NAME] <span class="badge bgm-amber"></span>'+
    '</a>';
    
    var A_HTML =
    '<a class="lv-item media [ACTIVE]" id="[ID]">'+
        '<!-- <div class="lv-avatar bgm-red pull-left">a</div> -->'+
        '<div class="media-body">'+
            '<div class="lv-title">[NAME]</div>'+
            '<div class="lv-small">[DESC]</div>'+
        '</div>'+
    '</a>';

	base.
		setUrl(url).
		get(function(response) {
			$('.inventory-group-list').html(A_HTML.
				replace('[ACTIVE]',   'active').
				replace('[ID]',   'all').
				replace('[NAME]', 'All').
				replace('[DESC]', 'All Available Inventory')
			);

			for(i in response.data) {
				
				if($.type(response.data[i]) == 'object') {
					$('.inventory-group-list').append(A_HTML.
						replace('[ACTIVE]', '').
						replace('[ID]',   	response.data[i]['_id']['$id']).
						replace('[NAME]', 	response.data[i]['name']).
						replace('[DESC]', 	response.data[i]['description'])
					);
				}
			}
			getList('all', table);

			$('.inventory-group-list a').unbind('clik').bind('click', function() {
				$('.inventory-group-list a').removeClass('active');
				$(this).addClass('active');

				getList($(this).attr('id'), table);
			});
		}	
	);
}


function getList(type, table) {
	var url = '/inventory/listing/getList/'+type;

    //TABLE LIST
    $(table).bootgrid('destroy');
	$(table).bootgrid({
		navigation : 2,
    	css     : base.icon,
        labels  : base.label,
        ajax 		 	: true,
	    url 		 	: url,
	    selection 		: true,
        multiSelect 	: true,
        keepSelection 	: true,
        formatters 	 	: {
            name_format 	: function(column, row) {
            	if(row['code'] != '') {
	                return '<p>'+row['name']+
	                '<br><small style="font-weight: 300;">#'+row['code']+'</small><p>';
	                       
            	} else {
            		return '<p>'+row['name']+
	                '<br><small style="font-weight: 300;"></small><p>';
	                    
            	}
            },
        }
    //after the ajax is finish
    }).on('loaded.rs.jquery.bootgrid', function (e){
    	//count result
    	var total = $(table).bootgrid('getTotalRowCount');
    	
    	$('#inventory-table-total').html(total);

    	$(table+' tbody tr .text-left, '+table+' tbody tr .text-right').unbind('click').bind('click', function(e) {
	        var id = $(this).parent().data('row-id');
	        
	        window.location = '/inventory/detail/?id='+id
	    });
	    
    });

    //reload this 
    $(table).bootgrid('reload');
    
}
