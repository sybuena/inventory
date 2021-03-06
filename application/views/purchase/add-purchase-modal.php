<style>

</style>
<div class="modal fade in" id="add-purchase-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bgm-blue">
                <h4 class="modal-title">Purchase Order</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <!-- RIGHT SIDE-->
                    
                    <div class="col-sm-4">
                        <div class="form-group">    
                            <label>Supplier Name <span class="required-text">*</span></label>
                            <select class="form-control fg-input select-search" id="add-purchase-supplier">
                                <option value="0">Select supplier from contacts</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">    
                            <label>Order Number <span class="required-text">*</span></label>
                            <input type="text" class="form-control fg-input" placeholder="" id="add-purchase-order-number">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">    
                            <label>Reference Number</label>
                            <input type="text" class="form-control fg-input" placeholder="" id="add-purchase-reference-number">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label>Date <span class="required-text">*</span></label>
                        <div class="input-group form-group">
                            <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                <div class="dtp-container fg-line">
                                <input type="text" class="form-control date-picker" id="add-purchase-date" placeholder="MM/DD/YYYY">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <label>Delivery Date</label>
                        <div class="input-group form-group">
                            <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                <div class="dtp-container fg-line">
                                <input type="text" class="form-control date-picker" id="add-purchase-due-date" placeholder="MM/DD/YYYY">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">    
                            <label>Total Amount <span class="required-text">*</span></label>
                            <input type="text" class="form-control fg-input" placeholder="0.00" id="add-purchase-total-amount" disabled="disabled">
                        </div>
                    </div>
                </div>
                <ul class="tab-nav no-box-shadow" role="tablist">
                    <li class="active">
                        <a href="#tab-items" data-toggle="tab">Items</a>
                    </li>
                    <!-- <li>
                        <a href="#tab-services" data-toggle="tab">Services</a>
                    </li> -->
                    <li>
                        <a href="#tab-others" data-toggle="tab">Services/ Others</a>
                    </li>
                    
                </ul>
                <div class="tab-content">
                    <!-- ITEM TAB TABLE-->
                    <div class="tab-pane active" id="tab-items">
                        <table class="table table-bordered table-condensed m-b-20" id="add-purchase-table">
                            <thead>
                                <tr>
                                    <th class="bgm-blue t-white">Part Number</th>
                                    <th class="bgm-blue t-white">Description</th>
                                    <th class="bgm-blue t-white" style="width: 5%;">Quantity</th>
                                    <th class="bgm-blue t-white" style="width: 10%;">Unit Price</th>
                                    <th class="bgm-blue t-white" style="width: 10%;">Disc</th>
                                    <th class="bgm-blue t-white" style="width: 10%;">Amount</th>
                                    <th class="bgm-blue t-white" style="width: 5%;"></th>
                                </tr>
                            </thead>
                            <tbody> 
                                
                            </tbody>
                        </table>

                        <button class="btn bgm-blue waves-effect btn-sm" id="add-purchase-add-item">
                            <i class="fa fa-plus"></i> Add Line
                        </button>
                    </div>
                    <!-- SERVICE TAB TABLE-->
                    <div class="tab-pane" id="tab-services">
                        <table class="table table-bordered table-condensed m-b-20" id="add-purchase-service-table">
                            <thead>
                                <tr>
                                    <th class="bgm-blue t-white">Service Name</th>
                                    <th class="bgm-blue t-white">Description</th>
                                    <th class="bgm-blue t-white" style="width: 5%;">Quantity</th>
                                    <th class="bgm-blue t-white" style="width: 10%;">Unit Price</th>
                                    <th class="bgm-blue t-white" style="width: 10%;">Disc</th>
                                    <th class="bgm-blue t-white" style="width: 10%;">Amount</th>
                                    <th class="bgm-blue t-white" style="width: 5%;"></th>
                                </tr>
                            </thead>
                            <tbody> 
                            </tbody>
                        </table>

                        <button class="btn bgm-blue waves-effect btn-sm" id="add-purchase-add-service">
                            <i class="fa fa-plus"></i> Add Line
                        </button>

                    </div>
                    <!-- OTHER TAB TABLE-->
                    <div class="tab-pane" id="tab-others">
                        <table class="table table-bordered table-condensed m-b-20" id="add-purchase-other-table">
                            <thead>
                                <tr>
                                    <th class="bgm-blue t-white">Name</th>
                                    <th class="bgm-blue t-white">Description</th>
                                    <th class="bgm-blue t-white" style="width: 5%;">Quantity</th>
                                    <th class="bgm-blue t-white" style="width: 10%;">Unit Price</th>
                                    <th class="bgm-blue t-white" style="width: 10%;">Disc</th>
                                    <th class="bgm-blue t-white" style="width: 10%;">Amount</th>
                                    <th class="bgm-blue t-white" style="width: 5%;"></th>
                                </tr>
                            </thead>
                            <tbody> 
                            </tbody>
                        </table>

                        <button class="btn bgm-blue waves-effect btn-sm" id="add-purchase-add-other">
                            <i class="fa fa-plus"></i> Add Line
                        </button>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-sm-6">
                        <div class="form-group">    
                            <label>Attention</label>
                            <input type="text" class="form-control fg-input" placeholder="If any person needed to mention special attention for this purchase order" id="add-purchase-attention">
                        </div>
                    
                        <div class="form-group">    
                            <label>Instruction </label>
                            <input type="text" class="form-control fg-input" id="add-purchase-instruction" placeholder="If there is a special instruction for this purchase order">
                        </div>
                        <div class="form-group">    
                            <label>Terms</label>
                            <textarea rows="3" class="form-control fg-input" id="add-purchase-terms">
                            </textarea> 
                        </div>
                        
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="form-group">    
                            <label>Code:</label>
                            <input type="text" class="form-control fg-input" placeholder="" id="add-purchase-code">
                        </div>

                        <div class="form-group">    
                            <label>Prepared By:</label>
                            <input type="text" class="form-control fg-input" placeholder="" id="add-purchase-prepared">
                        </div>
                    
                        <div class="form-group">    
                            <label>Requested By:</label>
                            <input type="text" class="form-control fg-input" placeholder="" id="add-purchase-requested">
                        </div>
                    
                        <div class="form-group">    
                            <label>Approved By:</label>
                            <input type="text" class="form-control fg-input" placeholder="" id="add-purchase-approved">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn bgm-gray waves-effect" data-dismiss="modal">Cancel</button>
                <button class="btn bgm-blue waves-effect add-purchase-save" status="2">Save As Draft</button>
                <button class="btn bgm-blue waves-effect add-purchase-save" status="1">Save</button>
                
            </div>
        </div>
    </div>
</div>
