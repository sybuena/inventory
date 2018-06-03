<style>
#invite-user-error-message {margin-bottom: 39px;
    margin-top: -30px;}
</style>
<div class="modal fade in" id="modal-add-user" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Invite user to access your organization</h4>
            </div>

            <div class="modal-body">
                <p>Enter the email adress of the person you want to invite. They will receive an email with an invitation link. When they click the link, they can setup their own personal information together with password.</p>
                
                <div class="alert alert-danger alert-dismissible hide" role="alert" id="invite-user-error-message">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <p></p>
                </div>

                <div class="row top-15">

                    <div class="col-sm-6">
                        <div class="form-group">    
                            <label>Firstname <span class="required-text">*</span></label> <small></small>
                            <input type="text" class="form-control" id="settings-user-firstname">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">    
                            <label>Lastname <span class="required-text">*</span></label> <small></small>
                            <input type="text" class="form-control" id="settings-user-lastname">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">    
                            <label>Email Address <span class="required-text">*</span></label> <small></small>
                            <input type="text" class="form-control" id="settings-user-email-address">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">    
                            <label>Role <span class="required-text">*</span></label> <small></small>
                            <select class="form-control" id="settings-user-role">
                                <option value="1">Administrator</option>
                                <option value="2">User</option>
                            </select>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary waves-effect" id="settings-user-add-member">Invite User</button>
                <button class="btn bgm-gray waves-effect" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>