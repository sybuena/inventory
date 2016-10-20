(function() {

	init();
	getListPT();

})();


function init() {

	base.
		setUrl('taxRate/info').
		get(function(response) {

			$('#tax-rates-table-title').html(response.data);

		});

	$('.tab-nav a[href="#pt-taxrate"]').tab('show');


	// Load the PT tab
	$('#tab-pt').unbind('click').bind('click', function() {
		getListPT();
	});

	// Load the VAT tab
	$('#tab-vat').unbind('click').bind('click', function() {
		getListVAT();
	});

};

/**
 * This is for getting the tax rates of Percentage Tax and the mapping of it
 *
 */
function getListPT() {

	//taxRate/getList
    var grid = $('#tax-rates-table').bootgrid({
    	css: {
            icon 		: 'zmdi icon',
            iconColumns	: 'zmdi-view-list',
            iconDown 	: 'zmdi-caret-down',
            iconRefresh : 'zmdi-refresh',
            iconUp	 	: 'zmdi-caret-up',
        },
        ajax 		 : true,
	    url 		 : 'taxRate/getList',
	    formatters 	 : {
            commands : function(column, row) {

    			var BUTTON = '<button id="[ID]" class="charts-add-drop btn btn-default btn-icon-text waves-effect"><i class="zmdi zmdi-plus-circle plus-circle-coa"></i>Add new account</button>';
				var options = loadOptions(row);

            	return '<select class="chosen chosen-chart-of-account" id="'+row['_id']['$id']+'"" multiple data-placeholder="Choose account to map...">'+options+'</select>' ;

            }
        }
    }).on('loaded.rs.jquery.bootgrid', function(){

    	chartOfAccounts();
    	reloadSelect();
    	clickedSelect();
		chosens();

		return false;

	});

	$('#tax-rates-table').find("[data-column-id='code']").css('width', '100px');
	$('#tax-rates-table').find("[data-column-id='tax_rates']").css('width', '100px');

    $('#tax-rates-table').bootgrid('reload');

    return false;

}

/**
 * Get the last of VAT
 *
 */
function getListVAT() {

	//taxRate/getList
    var grid = $('#tax-vat-rates-table').bootgrid({
    	css: {
            icon 		: 'zmdi icon',
            iconColumns	: 'zmdi-view-list',
            iconDown 	: 'zmdi-caret-down',
            iconRefresh : 'zmdi-refresh',
            iconUp	 	: 'zmdi-caret-up',
        },
        ajax 		 : true,
	    url 		 : 'taxRate/getList/vat',
	    formatters 	 : {
            commands : function(column, row) {

    			var BUTTON = '<button id="[ID]" class="charts-add-drop-vat btn btn-default btn-icon-text waves-effect"><i class="zmdi zmdi-plus-circle plus-circle-coa"></i>Add new rate</button>';
				var options = loadOptionsVAT(row);

            	return '<select class="chosen chosen-vat" id="'+row['_id']['$id']+'"" multiple data-placeholder="Choose rate to map...">'+options+'</select>' ;

            }
        }

    }).on('loaded.rs.jquery.bootgrid', function(){

    	ratesVAT();
    	reloadSelectVAT();
    	clickedSelectVAT();
		chosens();

		return false;

	});

	$('#tax-vat-rates-table').find("[data-column-id='code']").css('width', '100px');
	$('#tax-vat-rates-table').find("[data-column-id='tax_rates']").css('width', '100px');

    $('#tax-vat-rates-table').bootgrid('reload');

    return false;

}

/**
 * Mapped the chart of accounts here
 * - This takes effect when they clicked the X button on the list
 *
 */
function chartOfAccounts() {

	$('.chosen-chart-of-account').chosen().unbind('change').bind('change', function(event) {

		var id    = $(this).attr('id');
		var value = $(this).chosen().val();

		var data  = {
			'tax' 		: id,
			'accounts'  : value
		};

		base.
			setUrl('taxRate/taxMapAccount').
			setData(data).
			post(function(response) {

				// Pop up the notif then check if mapped or un-mapped
				if(response.message == 'added') {
					base.notification('Sucessfully mapped with tax rate!', 'success');
				} else if (response.message == 'deleted') {
					base.notification('Sucessfully un-mapped with tax rate!', 'success');
				}

			});

		return false;

	});

}

/**
 * Mapped the tax rate here
 * - This takes effect when they clicked the X button on the list
 *
 */
function ratesVAT() {

	$('.chosen-vat').chosen().unbind('change').bind('change', function(event) {

		var id    = $(this).attr('id');
		var value = $(this).chosen().val();

		var data  = {
			'tax' 		: id,
			'accounts'  : value
		};

		base.
			setUrl('taxRate/taxMapVAT').
			setData(data).
			post(function(response) {

				// Pop up the notif then check if mapped or un-mapped
				if(response.message == 'added') {
					base.notification('Sucessfully mapped with tax rate!', 'success');
				} else if (response.message == 'deleted') {
					base.notification('Sucessfully un-mapped with tax rate!', 'success');
				}

			});

		return false;
	});

}

/**
 * Reload the chosen.js
 *
 */
function clickedSelect() {

    var BUTTON = '<button id="[ID]" class="charts-add-drop btn btn-default btn-icon-text waves-effect"><i class="zmdi zmdi-plus-circle plus-circle-coa"></i>Add new account</button>';

	$('.chosen-chart-of-account').on('chosen:showing_dropdown', function(evt, params) {

		var idChosen = $(this).attr('id');

		base.
			setUrl('taxRate/getTaxCOA/'+idChosen).
			get(function(response) {

				var list 	 = response.data;
				var options  = '';
				var ids      = [];
				var disabled = [];

				$('select#'+list['_id']['$id']).html('');

				// generate the accounts for this guy
				var options = loadOptions(list);

				$('select#'+list['_id']['$id']).html(options['options']);

				if(options['options'].length > 0) {
					$('#'+list['_id']['$id']).val(options['ids']).trigger('chosen:updated');
				} else {
					$('#'+list['_id']['$id']).trigger('chosen:updated');
				}
				// Intialize chosen
				chosens();

				$('button#'+ list['_id']['$id']).html('');

				$('#'+list['_id']['$id']+'_chosen')
			       .find('button.charts-add-drop').remove();

				// Add the add button for the adding of chart of accounts
				$('#'+list['_id']['$id']+'_chosen')
			       .find('ul.chosen-results')
			       .before(BUTTON.replace('[ID]', list['_id']['$id']));


				modalAddAccount();

			});

		return false;
  	});
	
	return false;

}


/**
 * Reload the chosen.js
 *
 */
function clickedSelectVAT() {

    var BUTTON = '<button id="[ID]" class="charts-add-drop-vat btn btn-default btn-icon-text waves-effect"><i class="zmdi zmdi-plus-circle plus-circle-coa"></i>Add new rate</button>';

	$('.chosen-vat').on('chosen:showing_dropdown', function(evt, params) {

		var idChosen = $(this).attr('id');

		base.
			setUrl('taxRate/getTaxVAT/'+idChosen).
			get(function(response) {

				var list 	 = response.data;
				var options  = '';
				var ids      = [];
				var disabled = [];

				$('select#'+list['_id']['$id']).html('');

				// generate the accounts for this guy
				var options = loadOptionsVAT(list);

				$('select#'+list['_id']['$id']).html(options['options']);

				if(options['options'].length > 0) {
					$('#'+list['_id']['$id']).val(options['ids']).trigger('chosen:updated');
				} else {
					$('#'+list['_id']['$id']).trigger('chosen:updated');
				}
				// Intialize chosen
				chosens();

				$('button#'+ list['_id']['$id']).html('');

				$('#'+list['_id']['$id']+'_chosen')
			       .find('button.charts-add-drop-vat').remove();

				// Add the add button for the adding of chart of accounts
				$('#'+list['_id']['$id']+'_chosen')
			       .find('ul.chosen-results')
			       .before(BUTTON.replace('[ID]', list['_id']['$id']));


				modalAddVAT();

			});

		return false;
  	});
	
	return false;

}

/**
 * Reload the dropdown listing one you mapped or unmapped the accounts
 *
 */
function reloadSelect() {

    var BUTTON = '<button id="[ID]" class="charts-add-drop btn btn-default btn-icon-text waves-effect"><i class="zmdi zmdi-plus-circle plus-circle-coa"></i>Add new rate</button>';

	base.
		setUrl('taxRate/getSelected').
		get(function(response) {

			var list = response.data;
			var options = '';

				if(list.length > 0) {

					for(i in list) {

						var options  = '';
						var ids      = [];
						var disabled = [];

						// generate the accounts for this guy
						var options = loadOptions(list[i]);

						if(Math.floor(i) == i && $.isNumeric(i)) {
							$('select#'+list[i]['_id']['$id']).html(options['options']);

							if(options['options'].length > 0) {
								$('#'+list[i]['_id']['$id']).val(options['ids']).trigger('chosen:updated');
							} else {
								$('#'+list[i]['_id']['$id']).trigger('chosen:updated');
							}
							// Intialize chosen
							chosens();
						}
					}
				}

				modalAddAccount();

			return false;
		});

		return false;
			
}

/**
 * Reload the dropdown listing one you mapped or unmapped the rates
 *
 */
function reloadSelectVAT() {

    var BUTTON = '<button id="[ID]" class="charts-add-drop btn btn-default btn-icon-text waves-effect"><i class="zmdi zmdi-plus-circle plus-circle-coa"></i>Add new rate</button>';

	base.
		setUrl('taxRate/getSelectedVAT').
		get(function(response) {

			var list = response.data;
			var options = '';

				if(list.length > 0) {

					for(i in list) {

						var options  = '';
						var ids      = [];
						var disabled = [];

						// generate the accounts for this guy
						var options = loadOptionsVAT(list[i]);

						if(Math.floor(i) == i && $.isNumeric(i)) {
							$('select#'+list[i]['_id']['$id']).html(options['options']);

							if(options['options'].length > 0) {
								$('#'+list[i]['_id']['$id']).val(options['ids']).trigger('chosen:updated');
							} else {
								$('#'+list[i]['_id']['$id']).trigger('chosen:updated');
							}
							// Intialize chosen
							chosens();
						}
					}
				}

			modalAddVAT();

			return false;

		});

		return false;
			
}

/**
 * This is for the creation of dropdown and selected values 
 * for chosen.js dropdown
 *
 */
function loadOptions(list) {

	var options  = '';
	var ids      = [];
	var returns  = [];

    var OPTION = '<option value="[ID]" [DISABLED]>[VALUE]</option>';

    //Loop the chart of accounts and create the dropdown
	for(a in list['accounts']) {	

		var disableOption = '';

		if(list['accounts'][a]['mapped'] == 1) {

			if(list['accounts'][a]['tax_mapped'] == list['_id']['$id']) {
				//This part is to get the selected values for tax 
				ids.push(list['accounts'][a]['_id']['$id']);
			} else {

				disableOption = 'disabled';
			}
		}

		if(Math.floor(a) == a && $.isNumeric(a)) {
			options += OPTION.
				replace('[VALUE]', 		list['accounts'][a]['Code'] +' - '+ list['accounts'][a]['Name']).
				replace('[ID]',	   		list['accounts'][a]['_id']['$id']).
				replace('[DISABLED]',	disableOption);

		}

	}

	returns['options'] = options;
	returns['ids']     = ids;

	return returns;

}


/**
 * This is for the creation of dropdown and selected values 
 * for chosen.js dropdown - VAT
 *
 */
function loadOptionsVAT(list) {

	var options  = '';
	var ids      = [];
	var returns  = [];

    var OPTION = '<option value="[ID]" [DISABLED]>[VALUE]</option>';

    //Loop the chart of accounts and create the dropdown
	for(a in list['accounts']) {	

		var disableOption = '';

		if(list['accounts'][a]['mapped'] == 1) {

			if(list['accounts'][a]['tax_mapped'] == list['_id']['$id']) {
				//This part is to get the selected values for tax 
				ids.push(list['accounts'][a]['_id']['$id']);
			} else {

				disableOption = 'disabled';
			}
		}

		if(Math.floor(a) == a && $.isNumeric(a)) {
			options += OPTION.
				replace('[VALUE]', 		list['accounts'][a]['Name'] + ' ( ' + parseFloat(list['accounts'][a]['TaxComponents']['TaxComponent']['Rate'], 2) + '% )').
				replace('[ID]',	   		list['accounts'][a]['_id']['$id']).
				replace('[DISABLED]',	disableOption);

		}

	}

	returns['options'] = options;
	returns['ids']     = ids;

	return returns;

}

/**
 * Show the modal for adding the chart of account
 *
 */
function modalAddAccount() {

	$('.charts-add-drop').unbind('click').bind('click', function() {

		var id = $(this).attr('id');

		setTimeout(function(){
			chosens();
			$('#'+id).trigger('chosen:close');
		}, 250);

		unsetModalFields();
		$('#modal-add-chart-of-account').modal('show');

		// Get the list of account type
		base.
			setUrl('taxRate/getAccountType').
			get(function(response) {

				var data = response.data;
                var DROPDOWN = 
	                '<select class="chosen" data-placeholder="">[LISTS]'+
	 				'</select>';

                var OPTGROUP = 
	                    '<optgroup label="[LABEL]">[OPTION]' +
	                    '</optgroup>';

                var OPTION   = 
                	'<option value="[VALUE]">[OPTION]</option>';

               	var dropdown = '';
                // Loop the option group
                for(i in data) {

                	// option group name
                	var optGroup = i;
                	var options  = '';
                	// now loop the sub group
                	for(a in data[i]) {

						if(Math.floor(a) == a && $.isNumeric(a)) {
	                		options += OPTION.
	                			replace('[OPTION]', data[i][a]['account_types_description']).
	                			replace('[VALUE]',  data[i][a]['_id']['$id']);
                		}

                	}

                	dropdown += OPTGROUP.
            			replace('[LABEL]', 	i).
            			replace('[OPTION]', options);

                }

                $('#types-account-list').html('<option value=""></option>'+dropdown);
                $('#types-account-list').trigger('chosen:updated');

			});
		
		// For the text limit validation
		$('#chart-of-account-code').maxlength({max: 10,  feedbackText: '{c}/{m}'});
		$('#chart-of-account-name').maxlength({max: 150, feedbackText: '{c}/{m}'});

		// Here submit the button 
		submitChartOfAccount(id);	

		return false;

	});

}

/**
 * Show the modal for adding the VAT
 *
 */
function modalAddVAT() {

	$('.charts-add-drop-vat').unbind('click').bind('click', function() {

		var id = $(this).attr('id');

		setTimeout(function(){
			chosens();
			$('#'+id).trigger('chosen:close');
		}, 500);

		unsetModalFields();
		$('#modal-add-tax-rates').modal('show');
		
		// This only allow digits int and float
		$('#tax-rates-vat-rate').on('input', function() {
		  this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
		});

		// Here submit the button 
		submitVAT(id);	

		return false;

	});

}

/**
 * Function when check the submit button on modal for adding VAT Rates validation
 *
 */
function submitChartOfAccount(id) {

	$('#chart-of-account-submit').unbind('click').bind('click', function() {

		// Get the value for this
		var inputs = 
			['#types-account-list',
			 '#chart-of-account-code',
			 '#chart-of-account-name',
			 '#chart-of-account-description'
			 ]

		var checks = 
			['#chart-of-account-expense-claims',
		 	 // '#chart-of-account-show-dashboard',
		 	 '#chart-of-account-enable-payment',
			];

		// But first lets validate 
		var valid = validateCOA(inputs);

		if(valid == true) {

			$(this).addClass('disabled');
			$(this).html('Adding...');

			var data = {};

			for(i in inputs) {
				var keyName = $(inputs[i]).attr('data-name');
				var value   = $(inputs[i]).val();

				data[keyName] = value;
			}

			for(i in checks) {
				var keyName = $(checks[i]).attr('data-name');
				var value   = $(checks[i]).is(":checked");

				data[keyName] = value;				
			}

			data['id'] = id;

			base.
				setUrl('taxRate/addChartOfAccount').
				setData(data).
				post(function(response) {

					$('#modal-add-chart-of-account').modal('hide');

					$('#chart-of-account-submit').removeClass('disabled');
					$('#chart-of-account-submit').html('Add');

					if(response.error) {
						base.notification('Oh snap! Something went wrong!', 'danger');
					} else {
						base.notification('Sucessfully added to Xero chart of accounts', 'success');
						// getListPT();
					}

					unsetModalFields();
    				reloadSelect();

				});
		}

	});

}

/**
 * Function when check the submit button on modal for adding VAT Rates, add to Xero
 *
 */
function submitVAT(id) {

	$('#tax-rates-vat-submit').unbind('click').bind('click', function() {

		// Get the value for this
		var inputs = 
			['#tax-rates-vat-display-names',
			 '#tax-rates-vat-tax-components',
			 '#tax-rates-vat-rate'
			 ];

		// But first lets validate 
		var valid = validateCOA(inputs);

		if(valid == true) {

			$(this).addClass('disabled');
			$(this).html('Adding...');

			var data = {};

			data['id'] = id;

			for(i in inputs) {
				var keyName = $(inputs[i]).attr('data-name');
				var value   = $(inputs[i]).val();

				if(keyName !== undefined) {
					data[keyName] = value;
				}
			}

			base.
				setUrl('taxRate/addVAT').
				setData(data).
				post(function(response) {

					$('#modal-add-tax-rates').modal('hide');

					$('#tax-rates-vat-submit').removeClass('disabled');
					$('#tax-rates-vat-submit').html('Add');

					if(response.error) {
						base.notification('Oh snap! Something went wrong!', 'danger');
					} else {
						base.notification('Sucessfully added to Xero tax rates', 'success');
						// getListPT();
					}

					unsetModalFields();
    				reloadSelectVAT();

    				return false;

				});
		}

	});


}

/**
 * Validation of modal, COA
 *
 */
function validateCOA(inputs) {

	var status = true;

	for(i in inputs) {

		if(Math.floor(i) == i && $.isNumeric(i)) {

			if(inputs[i] != '#chart-of-account-description') {

				var inputValue = $(inputs[i]).val();

				if(inputValue == '' || inputValue == 0) {
					$(inputs[i]).parent().parent().addClass('has-error');	
					status = false;
				} else {
					$(inputs[i]).parent().parent().removeClass('has-error');
				}
			}
		}
	}

	return status;

}

/**
 * Unset the modal fields
 *
 */
function unsetModalFields() {

	// Get the value for this
	var inputs = 
		['#types-account-list',
		 '#chart-of-account-code',
		 '#chart-of-account-name',
		 '#chart-of-account-description',
		 '#tax-rates-vat-display-names',
		 '#tax-rates-vat-tax-components',
		 '#tax-rates-vat-rate'
		 ]

	var checks = 
		['#chart-of-account-expense-claims',
	 	 // '#chart-of-account-show-dashboard',
	 	 '#chart-of-account-enable-payment',
		];

	// Clear the input
	for(i in inputs) {

		if(inputs[i] !== '#types-account-list') {
			$(inputs[i]).val('');
			$(inputs[i]).parent().parent().removeClass('has-error');
		} else {
			$(inputs[i]).val('').trigger("chosen:updated");
			chosens();
		}

	}

	// Uncheck the input
	for(i in checks) {
		$(checks[i]).prop('checked', false);
	}

	$('#chart-of-account-submit').removeClass('disabled');
	$('#chart-of-account-submit').html('Add');

	return;

}

/**
 * Add tax Xero
 *
 */
function xero() {

	$('.add-tax-rates-to-xero').unbind('click').bind('click', function() {

		var data = {'id' : $(this).attr('id')};

		base.
			setUrl('integration/xero/addTaxRatesXero').
			setData(data).
			post(function(response) {

				if(!response.error) {
					base.notification('Sucessfully added to Xero tax rates', 'success');
					getListPT();
				} else {
					base.notification('Something went wrong', 'danger');					
				}

			});

	});

	$('.unmap-existing-tax-rates').unbind('click').bind('click', function() {

		var data = {'id' : $(this).attr('id')};

		base.
			setUrl('integration/xero/removeTaxRatesXero').
			setData(data).
			post(function(response) {

				if(!response.error) {
					base.notification('Sucessfully remove to Xero tax rates', 'success');
					getListPT();
				} else {
					base.notification('Something went wrong', 'danger');					
				}

			});

	});

}

function chosens() {

    if($('.chosen')[0]) {
        $('.chosen').chosen({
            width: '100%',
            allow_single_deselect: true
        });
    }

    return;

}