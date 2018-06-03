<!--- On the fields, kindly change it to 
date, 
category, 

part no, 
reference, 

unit price, 
total, 

suppliers name, 
customers name

description, -->

<div class="modal fade in" id="add-notes" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bgm-blue">
                <h4 class="modal-title">Add Expense</h4>
            </div>

            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">    
                            <label>Date <span class="required-text">*</span></label>
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                    <div class="dtp-container fg-line">
                                    <input type="text" class="form-control date-picker" id="expense-date" placeholder="MM/DD/YYYY">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">    
                            <label>Category <span class="required-text">*</span></label>
                            <select class="form-control fg-input select-search" id="expense-category">
                                <option value="0">Select Item</option>
                                <option value="Rent">Rent</option>
                                <option value="Utilities">Utilities</option>
                                <option value="Fees">Fees</option>
                                <option value="Wages">Wages</option>
                                <option value="Taxes">Taxes</option>
                                <option value="Interest">Interest</option>
                                <option value="Supplies">Supplies</option>
                                <option value="Maintenance">Maintenance</option>
                                <option value="Travel">Travel</option>
                                <option value="Meals and Entertainment">Meals and Entertainment</option>
                                <option value="Training">Training</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>
                
                    <div class="col-sm-6">
                        <div class="form-group">    
                            <label>Part Number </label>
                             <input type="text" class="form-control fg-input" placeholder="" id="expense-part-number">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">    
                            <label>Reference </label>
                             <input type="text" class="form-control fg-input" placeholder="" id="expense-reference">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">    
                            <label>Quantity</label>
                            <input type="text" class="form-control fg-input numeric" placeholder="0.00" id="expense-quantity">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">    
                            <label>Unit Price</label>
                            <input type="text" class="form-control fg-input numeric" placeholder="0.00" id="expense-unit-price">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">    
                            <label>Total Amount</label>
                            <input type="text" class="form-control fg-input numeric" placeholder="0.00" id="expense-total-amount">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">    
                            <label>Supplier</label>
                            <input type="text" class="form-control fg-input" placeholder="If there is any supplier involve on this expense" id="expense-supplier">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">    
                            <label>Customer</label>
                            <input type="text" class="form-control fg-input" placeholder="If there is any customer involve on this expense" id="expense-customer">
                        </div>
                    </div>


                    <div class="col-sm-12 m-t-20">
                        <div class="form-group">    
                            <label>Description</label>
                            <textarea rows="6" class="form-control fg-input" placeholder="Give us a short descirption about this expense" id="expense-description"></textarea>
                        </div>
                    </div>
                   
                </div>
                
            </div>
            <div class="modal-footer">
                <button class="btn bgm-gray waves-effect" data-dismiss="modal">Cancel</button>
                <button class="btn bgm-blue waves-effect expense-save">Save</button>
                
            </div>
        </div>
    </div>
</div>
