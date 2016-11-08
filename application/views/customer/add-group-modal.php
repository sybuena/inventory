<div class="modal fade in" id="customer-group-add-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bgm-blue">
                <h4 class="modal-title">Add New Group</h4>
            </div>

            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible hide" role="alert" id="add-group-error">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <p><b>Oh Snap! Something went wrong</b></p>
                    <p>Duplicate Group Name. 
                    It seems your current email address is already in the system.
                    Please try to double check again the email address before adding it again.</p>
                </div>

                <div class="row top-15">
                    <div class="col-sm-12">
                        <div class="form-group">    
                            <label>Group Name <span class="required-text">*</span></label> <small></small>
                            <input type="text" class="form-control fg-input" id="add-group-name" placeholder="What should we call this group? Ninja Assasins or Ninja Unicorns?">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">    
                            <label>Description <span class="required-text">*</span></label> <small></small>
                            <textarea rows="5" class="form-control fg-input" id="add-group-description" placeholder="Can you give a short description about this group?"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn bgm-gray waves-effect" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary waves-effect" id="add-group-save">Save</button>
            </div>
        </div>
    </div>
</div>
