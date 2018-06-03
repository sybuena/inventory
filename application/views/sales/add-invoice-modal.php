<div class="modal fade in" id="add-invoice-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bgm-blue">
                <h4 class="modal-title">Invoice</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <!-- RIGHT SIDE-->
                    
                    <div class="col-sm-4">
                        <div class="form-group">    
                            <label>Customer Name <span class="required-text">*</span></label>
                            <select class="form-control fg-input select-search" id="add-invoice-customer">
                                <option value="0">Select customer from contacts</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">    
                            <label>Invoice Number <span class="required-text">*</span></label>
                            <input type="text" class="form-control fg-input" placeholder="" id="add-invoice-invoice-number">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">    
                            <label>Reference Number</label>
                            <input type="text" class="form-control fg-input" placeholder="" id="add-invoice-reference-number">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label>Date <span class="required-text">*</span></label>
                        <div class="input-group form-group">
                            <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                <div class="dtp-container fg-line">
                                <input type="text" class="form-control date-picker" id="add-invoice-date" placeholder="MM/DD/YYYY">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <label>Due Date</label>
                        <div class="input-group form-group">
                            <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                <div class="dtp-container fg-line">
                                <input type="text" class="form-control date-picker" id="add-invoice-due-date" placeholder="MM/DD/YYYY">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">    
                            <label>Total Amount <span class="required-text">*</span></label>
                            <input type="text" class="form-control fg-input" placeholder="0.00" id="add-invoice-total-amount" disabled="disabled">
                        </div>
                    </div>
                </div>
                 <ul class="tab-nav no-box-shadow" role="tablist">
                    <li class="active">
                        <a href="#tab-items" data-toggle="tab">Items</a>
                    </li>
                    <li>
                        <a href="#tab-services" data-toggle="tab">Services</a>
                    </li>
                    <li>
                        <a href="#tab-others" data-toggle="tab">Others</a>
                    </li>
                    
                </ul>
                <div class="tab-content">
                    <!-- ITEM TAB TABLE-->
                    <div class="tab-pane active" id="tab-items">
                        <table class="table table-bordered table-condensed m-b-20" id="add-invoice-table">
                            <thead>
                                <tr>
                                    <th class="bgm-blue t-white">Item Name</th>
                                    <th class="bgm-blue t-white">Description</th>
                                    <th class="bgm-blue t-white" style="width: 5%;">Quantity</th>
                                    <th class="bgm-blue t-white" style="width: 10%;">Rate</th>
                                    <th class="bgm-blue t-white" style="width: 10%;">Disc</th>
                                    <th class="bgm-blue t-white" style="width: 10%;">Amount</th>
                                    <th class="bgm-blue t-white" style="width: 5%;"></th>
                                </tr>
                            </thead>
                            <tbody> 
                                
                            </tbody>
                        </table>

                        <button class="btn bgm-blue waves-effect btn-sm" id="add-invoice-add-item">
                            <i class="fa fa-plus"></i> Add Line
                        </button>
                    </div>
                    <!-- SERVICE TAB TABLE-->
                    <div class="tab-pane" id="tab-services">
                        <table class="table table-bordered table-condensed m-b-20" id="add-invoice-service-table">
                            <thead>
                                <tr>
                                    <th class="bgm-blue t-white">Service Name</th>
                                    <th class="bgm-blue t-white">Description</th>
                                    <th class="bgm-blue t-white" style="width: 5%;">Quantity</th>
                                    <th class="bgm-blue t-white" style="width: 10%;">Rate</th>
                                    <th class="bgm-blue t-white" style="width: 10%;">Disc</th>
                                    <th class="bgm-blue t-white" style="width: 10%;">Amount</th>
                                    <th class="bgm-blue t-white" style="width: 5%;"></th>
                                </tr>
                            </thead>
                            <tbody> 
                            </tbody>
                        </table>

                        <button class="btn bgm-blue waves-effect btn-sm" id="add-invoice-add-service">
                            <i class="fa fa-plus"></i> Add Line
                        </button>

                    </div>
                    <!-- OTHER TAB TABLE-->
                    <div class="tab-pane" id="tab-others">
                        <table class="table table-bordered table-condensed m-b-20" id="add-invoice-other-table">
                            <thead>
                                <tr>
                                    <th class="bgm-blue t-white">Name</th>
                                    <th class="bgm-blue t-white">Description</th>
                                    <th class="bgm-blue t-white" style="width: 5%;">Quantity</th>
                                    <th class="bgm-blue t-white" style="width: 10%;">Rate</th>
                                    <th class="bgm-blue t-white" style="width: 10%;">Disc</th>
                                    <th class="bgm-blue t-white" style="width: 10%;">Amount</th>
                                    <th class="bgm-blue t-white" style="width: 5%;"></th>
                                </tr>
                            </thead>
                            <tbody> 
                            </tbody>
                        </table>

                        <button class="btn bgm-blue waves-effect btn-sm" id="add-invoice-add-other">
                            <i class="fa fa-plus"></i> Add Line
                        </button>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn bgm-gray waves-effect" data-dismiss="modal">Cancel</button>
                <button class="btn bgm-blue waves-effect add-invoice-save" status="2">Save As Draft</button>
                <button class="btn bgm-blue waves-effect add-invoice-save" status="1">Save</button>
                
            </div>
        </div>
    </div>
</div>
