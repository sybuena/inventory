<style>
#invite-user-error-message {margin-bottom: 39px;
    margin-top: -30px;}
</style>
<div class="modal fade in" id="modal-add-user" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create User</h4>
            </div>

            <div class="modal-body">
                <!-- <p>Enter the email adress of the person you want to invite. They will receive an email with an invitation link. When they click the link, they can setup their own personal information together with password.</p> -->
                
                <div class="alert alert-danger alert-dismissible hide" role="alert" id="invite-user-error-message">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <p></p>
                </div>

                <div class="row top-15">
                    <div class="col-sm-6">
                        <div class="form-group fg-float">
                            <div class="fg-line">
                                <input type="text" class="form-control fg-input" id="settings-user-firstname">
                                <label class="fg-label">First Name</label>
                            </div>
                            <small class="help-block"></small>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group fg-float">
                            <div class="fg-line">
                                <input type="text" class="form-control fg-input" id="settings-user-lastname">
                                <label class="fg-label">Last Name</label>
                            </div>
                            <small class="help-block"></small>
                        </div>
                    </div>
                </div>

                <div class="row top-15">
                    <div class="col-sm-6">
                        <div class="form-group fg-float">
                            <div class="fg-line">
                                <input type="text" class="form-control fg-input" id="settings-user-email-address">
                                <label class="fg-label">Email Address</label>
                            </div>
                            <small class="help-block"></small>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group fg-float">
                            <div class="fg-line">
                                <select class="form-control fg-input" id="settings-user-role">
                                    <option value="1">Administrator</option>
                                    <option value="2">Agent</option>
                                </select>
                                
                                <label class="fg-label">Role</label>
                            </div>
                            <small class="help-block"></small>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn bgm-gray waves-effect" data-dismiss="modal">Cancel</button>
                <button class="btn bgm-amber waves-effect" id="settings-user-add-member">Save</button>
            </div>
        </div>
    </div>
</div>