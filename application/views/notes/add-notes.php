<div class="modal fade in" id="add-notes" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bgm-blue">
                <h4 class="modal-title">Add Notes</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">    
                            <label>Title <span class="required-text">*</span></label>
                            <input type="text" class="form-control fg-input" placeholder="What do we call this notes?" id="add-notes-title">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">    
                            <label>Type <span class="required-text">*</span></label>
                            <select class="form-control fg-input select-search" id="add-notes-type">
                                <option value="0">Select Item</option>
                                <option value="notes">Notes</option>
                                <option value="expense">Expense</option>
                            </select>
                        </div>
                    </div>
                   
                    <div class="col-sm-6">
                        <div class="form-group">    
                            <label>Date <span class="required-text">*</span></label>
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                    <div class="dtp-container fg-line">
                                    <input type="text" class="form-control date-picker" id="add-notes-date" placeholder="MM/DD/YYYY">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">    
                            <label>Amount</label>
                            <input type="text" class="form-control fg-input numeric" placeholder="If there is any amount involve on this notes" id="add-notes-amount">
                        </div>
                    </div>

                    <div class="col-sm-12 m-t-20">
                        <div class="form-group">    
                            <label>Description</label>
                            <textarea rows="6" class="form-control fg-input" placeholder="Give us a short descirption about this note" id="add-notes-description"></textarea>
                        </div>
                    </div>
                   
                </div>
                
            </div>
            <div class="modal-footer">
                <button class="btn bgm-gray waves-effect" data-dismiss="modal">Cancel</button>
                <button class="btn bgm-blue waves-effect add-notes-save">Save</button>
                
            </div>
        </div>
    </div>
</div>
