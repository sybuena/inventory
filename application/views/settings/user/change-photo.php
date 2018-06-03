
<div class="modal fade in" id="change-photo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form class="modal-content" id="change-photo-form" action="<?php echo '/userDetail/changePhoto/'.$id; ?>">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="simpleModalLabel">Update Profile Picture</h4>
            </div>
            
            <div class="col-lg-12"  style="padding-right: 0px">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <p class="f-500 c-black m-b-20">Image Preview</p>
                            <div class="fileinput-preview thumbnail">
                                <img id="change-photo-preview"/>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="set-modal-desc2">
                                <p><b>Note:</b></p>
                                <p>For best result, upload square photo with maximum size of 150px by 150px and use .jpg, .png or .gif files.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="btn btn-info btn-file waves-effect">
                        <span class="change-photo-new">Select image</span>
                        <span class="change-photo-exists">Change</span>
                        <input type="file" name="..." id="change-photo-input">
                    </span>
                    <!-- <a href="#" class="btn btn-danger fileinput-exists waves-effect" data-dismiss="fileinput">Remove</a> -->
                    <button type="submit" class="btn btn-primary" id="change-photo-save">Save</button>
                    <button type="button" class="btn btn-flat" data-dismiss="modal">Close</button>
                    
                </div>
            </div>
            <div class="clearfix"></div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Save</button>
                <button type="button" class="btn btn-flat" data-dismiss="modal">Close</button>
            </div> -->
        </form>
    </div>
</div>
