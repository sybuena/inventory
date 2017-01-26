<div class="modal fade in" id="add-job-order-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bgm-blue">
                <h4 class="modal-title">Job Order</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <!-- RIGHT SIDE-->
                    <div class="col-sm-4">
                        <div class="form-group">    
                            <label>Customer Name <span class="required-text">*</span></label>
                            <select class="form-control fg-input select-search" id="add-job-order-customer">
                                <option value="0">Select customer from contacts</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">    
                            <label>Job Order Number <span class="required-text">*</span></label>
                            <input type="text" class="form-control fg-input" placeholder="" id="add-job-order-job-order-number">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">    
                            <label>Reference Number</label>
                            <input type="text" class="form-control fg-input" placeholder="" id="add-job-order-reference-number">
                        </div>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-sm-4">
                        <label>Date <span class="required-text">*</span></label>
                        <div class="input-group form-group">
                            <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                <div class="dtp-container fg-line">
                                <input type="text" class="form-control date-picker" id="add-job-order-date" placeholder="MM/DD/YYYY">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <label>Expiry <span class="required-text">*</span></label>
                        <div class="input-group form-group">
                            <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                <div class="dtp-container fg-line">
                                <input type="text" class="form-control date-picker" id="add-job-order-due-date" placeholder="MM/DD/YYYY">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">    
                            <label>Total Amount <span class="required-text">*</span></label>
                            <input type="text" class="form-control fg-input" placeholder="0.00" id="add-job-order-total-amount" disabled="disabled">
                        </div>
                    </div>
                </div>

                <ul class="tab-nav m-t-20" role="tablist">
                    
                    <li class="active">
                        <a href="#tab-services" data-toggle="tab">Services</a>
                    </li>
                    <li>
                        <a href="#tab-others" data-toggle="tab">Others</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <!-- SERVICE TAB TABLE-->
                    <div class="tab-pane active" id="tab-services">
                        <table class="table table-bordered table-condensed m-b-20" id="add-job-order-service-table">
                            <thead>
                                <tr>
                                    <th class="bgm-blue t-white">Service Name</th>
                                    <th class="bgm-blue t-white">Description</th>
                                    <th class="bgm-blue t-white" style="width: 5%;">Quantity</th>
                                    <th class="bgm-blue t-white" style="width: 10%;">Rate</th>
                                    <th class="bgm-blue t-white" style="width: 10%;">Amount</th>
                                    <th class="bgm-blue t-white" style="width: 5%;"></th>
                                </tr>
                            </thead>
                            <tbody> 
                            </tbody>
                        </table>

                        <button class="btn bgm-blue waves-effect btn-sm" id="add-job-order-add-service">
                            <i class="fa fa-plus"></i> Add Line
                        </button>

                    </div>
                    <!-- OTHER TAB TABLE-->
                    <div class="tab-pane" id="tab-others">
                        <table class="table table-bordered table-condensed m-b-20" id="add-job-order-other-table">
                            <thead>
                                <tr>
                                    <th class="bgm-blue t-white">Name</th>
                                    <th class="bgm-blue t-white">Description</th>
                                    <th class="bgm-blue t-white" style="width: 5%;">Quantity</th>
                                    <th class="bgm-blue t-white" style="width: 10%;">Rate</th>
                                    <th class="bgm-blue t-white" style="width: 10%;">Amount</th>
                                    <th class="bgm-blue t-white" style="width: 5%;"></th>
                                </tr>
                            </thead>
                            <tbody> 
                            </tbody>
                        </table>

                        <button class="btn bgm-blue waves-effect btn-sm" id="add-job-order-add-other">
                            <i class="fa fa-plus"></i> Add Line
                        </button>
                    </div>
                </div>
                <div class="row m-t-20">
                    
                    <div class="col-sm-12">
                        <div class="form-group">    
                            <label>Title</label>
                            <input type="text" class="form-control fg-input" id="add-job-order-title" placeholder="Add optional title for this job order" />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">    
                            <label>Summary/Note</label>
                            <textarea rows="3" class="form-control fg-input" id="add-job-order-summary" placeholder="Summary or Note you want to add in this job order"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">    
                            <label>Terms</label>
                            <textarea rows="3" class="form-control fg-input" id="add-job-order-terms"></textarea>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn bgm-gray waves-effect" data-dismiss="modal">Cancel</button>
                <button class="btn bgm-blue waves-effect add-job-order-save" status="2">Save As Draft</button>
                <button class="btn bgm-blue waves-effect add-job-order-save" status="1">Save and Mark As Sent</button>
                
            </div>
        </div>
    </div>
</div>
