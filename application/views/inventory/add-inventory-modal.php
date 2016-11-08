<style>
.contact-modal-title {
    margin-bottom: 20px;
    margin-left: -10px;
    font-weight: 400;
    font-size: 17px;
}
.m-t-15 {margin-top: 15px}
</style>
<div class="modal fade in" id="add-inventory-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bgm-blue">
                <h4 class="modal-title">Add new inventory</h4>
            </div>

            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible hide" role="alert" id="add-inventory-error">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <p><b>Oh Snap! Something went wrong</b></p>
                    <p>Duplicate Item Code. 
                    It seems your current Item Code is already in the system.
                    Please try to double check again the Item Code before adding it again.</p>
                </div>

                <div class="alert alert-info alert-dismissible" role="alert" id="add-customer-error">
                    
                    <p><b>Heads Up!</b> All new item that has been added to inventory has 0 quantity. To add quantity to a item, simple go to purchase tab and make purchase to the item.</p>
                </div>

                <div class="row">
                    <!-- RIGHT SIDE-->
                    <div class="col-sm-6">
                        <h4 class="contact-modal-title">Basic Information</h4>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">    
                                    <label>Name <span class="required-text">*</span></label>
                                    <input type="text" class="form-control fg-input" id="add-inventory-name" placeholder="What should we call this inventory Item/ Service ?">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">    
                                    <label>Type <span class="required-text">*</span></label>
                                    <select class="form-control fg-input" id="add-inventory-type">
                                        <option value="0">Select Item</option>
                                        <option value="item">Item</option>
                                        <option value="service">Service</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">    
                                    <label>Code</label> <span class="required-text">*</span></label>
                                    <input type="text" class="form-control fg-input" id="add-inventory-code" placeholder="Code indicator of form this inventory">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">    
                                    <label>Category</label>
                                    <select class="form-control fg-input" id="add-inventory-category">
                                        <option value="">None</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">    
                                    <label>Location </label>
                                    <input type="text" class="form-control fg-input" id="add-inventory-name" placeholder="Inventory Location">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">    
                                    <label>Description</label> </label>
                                    <textarea rows="5" class="form-control fg-input" id="add-inventory-description" placeholder="Tell us more about this inventory Item/Service"></textarea>
                                </div>
                            </div>

                        </div>
                        
                    </div>
                    <!-- END : RIGHT SIDE -->

                    <!-- LEFT SIDE-->
                    <div class="col-sm-6">
                        <h4 class="contact-modal-title">Pricing</h4>

                        <div class="row">
                             <div class="col-sm-4">
                                <div class="form-group">    
                                    <p class="m-t-15">Fill this up if you are selling this item.</p>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">    
                                    <label>Sales Price </label>
                                    <input type="text" class="form-control fg-input" id="add-inventory-sales" placeholder="How much are you selling this item?">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">    
                                    <p class="m-t-15">Fill this up if you are purchasing this item.</p>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">    
                                    <label>Cost Price </label>
                                    <input type="text" class="form-control fg-input" id="add-inventory-cost" placeholder="How much are you purchasing this item?">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn bgm-gray waves-effect" data-dismiss="modal">Cancel</button>
                <button class="btn bgm-blue waves-effect" id="add-inventory-save">Save</button>
                
            </div>
        </div>
    </div>
</div>
