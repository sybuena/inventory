<div class="modal fade in" id="move-inventory" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bgm-blue">
                <h4 class="modal-title">Move inventory to new cagetory</h4>
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
                    <div class="col-sm-12">
                        <div class="form-group">    
                            <label>Category List <span class="required-text">*</span></label> <small></small>
                            <select class="form-control fg-input" id="move-inventory-category">
                            </select>
                        </div>
                    </div>
                   
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn bgm-gray waves-effect" data-dismiss="modal">Cancel</button>
                <button class="btn bgm-blue waves-effect" id="move-inventory-save">Save</button>
                
            </div>
        </div>
    </div>
</div>
