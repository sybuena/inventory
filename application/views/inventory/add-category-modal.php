<div class="modal fade in" id="add-category-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bgm-blue">
                <h4 class="modal-title">Add new category</h4>
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
                            <label>Category Name <span class="required-text">*</span></label>
                            <input type="text" class="form-control fg-input" id="add-category-name" placeholder="Type something for name of this category">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">    
                            <label>Category Description <span class="required-text">*</span></label>
                            <textarea class="form-control fg-input" id="add-category-description" placeholder="Short description of this category"></textarea>
                        </div>
                    </div>
                   
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn bgm-gray waves-effect" data-dismiss="modal">Cancel</button>
                <button class="btn bgm-blue waves-effect" id="add-category-save">Save</button>
                
            </div>
        </div>
    </div>
</div>
