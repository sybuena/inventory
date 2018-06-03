<div class="modal fade in" id="minus-quantity" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header bgm-blue">
                <h4 class="modal-title">Manual Remove Quantity</h4>
            </div>

            <div class="modal-body">
                
                <div class="row top-15">
                    <div class="col-sm-12 m-b-20">
                        <div class="form-group">    
                            <label>Quantity/ Stock <span class="required-text">*</span></label>
                            <input type="text" class="form-control fg-input numeric" id="manual-number-minus" placeholder="How many do you want to remove? in numeric">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">    
                            <label>Description <span class="required-text">*</span></label>
                            <textarea rows="6" class="form-control fg-input" id="manual-description-minus" placeholder="Can you tell us short description of this manual adjustments of inventory"></textarea>
                        </div>
                    </div>                   
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn bgm-gray waves-effect" data-dismiss="modal">Cancel</button>
                <button class="btn bgm-blue waves-effect" id="minus-quantity-save">Save</button>
                
            </div>
        </div>
    </div>
</div>
