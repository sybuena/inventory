<style>
h3.general-settings {
    line-height: 100%;
    font-size: 15px;
    font-weight: 400;
}
</style>
<div class="card-header">
    <h2>Financial Information</h2>
</div>

<div class="card-body card-padding form-horizontal m-l-20">
    <div class="row m-l-m-b m-b-20">
        <div class="col-sm-5">
            <h3 class="general-settings">Invoice Prefix & Sequence</h3>
            <small>Define the number to be used when creating your next invoice.<br/> 
            Number will automatically increment for each new document you create.</small>
        </div>

        <div class="col-sm-7 m-t-15">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group"> 
                        <div class="fg-line">
                            <label style="width: 200px !important;">Invoice prefix <span class="required-text">*</span></label>
                            <input type="text" class="form-control gen-loading" id="gen-inv-prefix">
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                </div>
                <div class="col-sm-4">
                    <div class="form-group"> 
                        <div class="fg-line">
                            <label style="width: 200px !important;">Invoice next number <span class="required-text">*</span></label>
                            <input type="text" class="form-control gen-loading" id="gen-inv-seq">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row m-l-m-b m-b-20">
        <div class="col-sm-5">
            <h3 class="general-settings">Purchase Order Prefix & Sequence</h3>
            <small>Define the number to be used when creating your next purchase order.<br/> 
            Number will automatically increment for each new document you create.</small>
        </div>

        <div class="col-sm-7 m-t-15">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group"> 
                        <div class="fg-line">
                            <label style="width: 200px !important;">Purchase order prefix <span class="required-text">*</span></label>
                            <input type="text" class="form-control gen-loading" id="gen-po-prefix">
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                </div>
                <div class="col-sm-4">
                    <div class="form-group"> 
                        <div class="fg-line">
                            <label style="width: 200px !important;">Purchase order number <span class="required-text">*</span></label>
                            <input type="text" class="form-control gen-loading" id="gen-po-seq">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row m-l-m-b m-b-20">
        <div class="col-sm-5">
            <h3 class="general-settings">Quotation Prefix & Sequence</h3>
            <small>Define the number to be used when creating your next quotation.<br/> 
            Number will automatically increment for each new document you create.</small>
            
        </div>

        <div class="col-sm-7 m-t-15">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group"> 
                        <div class="fg-line">
                            <label style="width: 200px !important;">Quotation prefix <span class="required-text">*</span></label>
                            <input type="text" class="form-control gen-loading" id="gen-quote-prefix">
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                </div>
                <div class="col-sm-4">
                    <div class="form-group"> 
                        <div class="fg-line">
                            <label style="width: 200px !important;">Quotation next number <span class="required-text">*</span></label>
                            <input type="text" class="form-control gen-loading" id="gen-quote-seq">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
     <div class="row m-l-m-b m-b-20">
        <div class="col-sm-5">
            <h3 class="general-settings">Job ORder Prefix & Sequence</h3>
            <small>Define the number to be used when creating your next job order.<br/> 
            Number will automatically increment for each new document you create.</small>
        </div>

        <div class="col-sm-7 m-t-15">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group"> 
                        <div class="fg-line">
                            <label style="width: 200px !important;">Job Order prefix <span class="required-text">*</span></label>
                            <input type="text" class="form-control gen-loading" id="gen-job-order-prefix">
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                </div>
                <div class="col-sm-4">
                    <div class="form-group"> 
                        <div class="fg-line">
                            <label style="width: 200px !important;">Job Order next number <span class="required-text">*</span></label>
                            <input type="text" class="form-control gen-loading" id="gen-job-order-seq">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="m-t-30 form-group">
        <span class="col-sm-3"></span>
        <div class="col-sm-8">
            <button class="btn btn-primary pull-right waves-effect" id="gen-update">
                Update Information
            </button>
        </div>
        <span class="col-sm-1"></span>
    </div>
</div>