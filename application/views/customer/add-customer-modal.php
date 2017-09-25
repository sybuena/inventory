<style>
.contact-modal-title {
    margin-bottom: 20px;
    margin-left: -10px;
    font-weight: 400;
    font-size: 17px;
}
</style>
<div class="modal fade in" id="customer-add-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bgm-blue">
                <h4 class="modal-title">Add New Contacts</h4>
            </div>

            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible hide" role="alert" id="add-customer-error">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <p><b>Oh Snap! Something went wrong</b></p>
                    <p>Duplicate Email address. 
                    It seems your current email address is already in the system.
                    Please try to double check again the email address before adding it again.</p>
                </div>

                <div class="row">
                    <!-- RIGHT SIDE-->
                    <div class="col-sm-6">
                        <h4 class="contact-modal-title">Basic Information</h4>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">    
                                    <label>Company Name <span class="required-text">*</span></label>
                                    <input type="text" class="form-control fg-input" id="add-customer-company-name" placeholder="Name of company or organization">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">    
                                    <label>Account Number</label>
                                    <input type="text" class="form-control fg-input" id="add-customer-account-number" placeholder="Account Number">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">    
                                    <label>Group</label>
                                    <select class="form-control fg-input" id="add-customer-group">
                                        <option value="">None</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">    
                                    <label>Tin Number </label>
                                    <input type="text" class="form-control fg-input" id="add-customer-tin-number" placeholder="Company tin number">
                                </div>
                            </div>
                        </div>
                        <br/>
                        <h4 class="contact-modal-title">
                            Primary Person 
                            <small><i>(If there is any contact person)</i></small>
                        </h4>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">    
                                    <label>Firstname </label>
                                    <input type="text" class="form-control fg-input" id="add-customer-firstname" placeholder="eg. Juan">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">    
                                    <label>Lastname </label>
                                    <input type="text" class="form-control fg-input" id="add-customer-lastname" placeholder="eg. Dela Cruz">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">    
                                    <label>Email Address </label>
                                    <input type="text" class="form-control fg-input" id="add-customer-email" placeholder="example@example.com">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">    
                                    <label>Job Title</label>
                                    <input type="text" class="form-control fg-input" id="add-customer-title" placeholder="eg. Ninja Unicorn">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END : RIGHT SIDE -->

                    <!-- LEFT SIDE-->
                    <div class="col-sm-6">
                        <h4 class="contact-modal-title">Contact Information</h4>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">    
                                    <label>Address <span class="required-text">*</span></label>
                                    <input type="text" class="form-control fg-input" id="add-customer-address" placeholder="eg. 143 Love St. Pastillas Village">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">    
                                    <label>City </label>
                                    <input type="text" class="form-control fg-input" id="add-customer-city" placeholder="eg. Uraro City">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">    
                                    <label>Province/ Region </label>
                                    <input type="text" class="form-control fg-input" id="add-customer-province" placeholder="eg. Metro Manila">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">    
                                    <label>ZIP/ Postal </label>
                                    <input type="text" class="form-control fg-input" id="add-customer-zip" placeholder="eg. 1234">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">    
                                    <label>Country <span class="required-text">*</span></label>
                                    <select class="form-control fg-input" id="add-customer-country">
                                        <option value="Philippines">Philippines</option>
                                    </select>
                                </div>
                            </div>
                            

                            <div class="col-sm-4">
                                <div class="form-group">    
                                    <label>Phone number</label>
                                    <input type="text" class="form-control fg-input" id="add-customer-phone-number">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">    
                                    <label>Mobile number</label>
                                    <input type="text" class="form-control fg-input" id="add-customer-mobile-number" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">    
                                    <label>Fax number</label>
                                    <input type="text" class="form-control fg-input" id="add-customer-fax-number">
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">    
                                    <label>Facebook</label>
                                    <input type="text" class="form-control fg-input" id="add-customer-facebook" placeholder="example page">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">    
                                    <label>Twitter</label>
                                    <input type="text" class="form-control fg-input" id="add-customer-twitter" placeholder="@example">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">    
                                    <label>Skype Name/ Number</label>
                                    <input type="text" class="form-control fg-input" id="add-customer-skype" placeholder="example skype">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">    
                                    <label>Website</label>
                                    <input type="text" class="form-control fg-input" id="add-customer-website" placeholder="https://example.com">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                   
 
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn bgm-gray waves-effect" data-dismiss="modal">Cancel</button>
                <button class="btn bgm-blue waves-effect" id="add-customer-save">Save</button>
                
            </div>
        </div>
    </div>
</div>
