<div class="modal fade in" id="modal-edit-password" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Password</h4>
            </div>

            <div class="modal-body">

                <div class="alert alert-danger alert-dismissible hide" id="password-dont-matched" role="alert" style="margin-bottom: 50px;">
                    Oh snap! Password dont matched on your current password.
                </div>

                <div class="row top-15">
                    <div class="col-sm-12">
                        <div class="form-group fg-float">
                            <div class="fg-line">
                                <input type="password" class="form-control fg-input" id="settings-current-password">
                                <label class="fg-label">Current Password</label>
                            </div>
                            <small class="help-block"></small>
                        </div>
                    </div>
                </div>

                <div class="row top-15">
                    <div class="col-sm-12">
                        <div class="form-group fg-float">
                            <div class="fg-line">
                                <input type="password" class="form-control fg-input" id="settings-new-password">
                                <label class="fg-label">New Password</label>
                            </div>
                            <small class="help-block"></small>
                        </div>
                    </div>
                </div>

                <div class="row top-15">
                    <div class="col-sm-12">
                        <div class="form-group fg-float">
                            <div class="fg-line">
                                <input type="password" class="form-control fg-input" id="settings-confirm-password">
                                <label class="fg-label">Confirm Password</label>
                            </div>
                            <small class="help-block"></small>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn bgm-gray waves-effect" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary waves-effect" id="change-password-bottom">Save</button>
            </div>
        </div>
    </div>
</div>