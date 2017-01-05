<div class="modal fade in" id="add-quantity" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header bgm-blue">
                <h4 class="modal-title">Manual Add Quantity</h4>
            </div>

            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible hide" role="alert" id="add-category-error">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <p><b>Oh Snap! Something went wrong</b></p>
                    <p>Duplicate Category Name. 
                    It seems your current "Category Name" is already in the system.
                    Please try to double check again the "Category Name" before adding it again.</p>
                </div>

                <div class="row top-15">
                    <div class="col-sm-12 m-b-20">
                        <div class="form-group">    
                            <label>Quantity/ Stock <span class="required-text">*</span></label>
                            <input type="text" class="form-control fg-input numeric" id="manual-number" placeholder="How many do you want to add? in numeric">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">    
                            <label>Description <span class="required-text">*</span></label>
                            <textarea rows="6" class="form-control fg-input" id="manual-description" placeholder="Can you tell us short description of this manual adding of inventory"></textarea>
                        </div>
                    </div>                   
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn bgm-gray waves-effect" data-dismiss="modal">Cancel</button>
                <button class="btn bgm-blue waves-effect" id="add-quantity-save">Save</button>
                
            </div>
        </div>
    </div>
</div>
