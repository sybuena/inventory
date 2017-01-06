<div class="pmb-block">
    <div class="pmbb-header">
        <h2><i class="zmdi zmdi-equalizer m-r-5"></i> Summary</h2>
        
        <ul class="actions">
            <li class="dropdown">
                <a href="" data-toggle="dropdown">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                
                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a data-pmb-action="edit" href="" id="detail-customer-summary-edit">Edit Summary</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="pmbb-body p-l-30">
        <div class="pmbb-view" id="detail-customer-summary-text-1">
            <?=show($customer['text'], 'N/A');?>
        </div>
        
        <div class="pmbb-edit">
            <div class="fg-line">
                <textarea id="detail-customer-summary-text-2" class="form-control" rows="5" placeholder="Summary..."></textarea>
            </div>
            <div class="m-t-10">
                <button class="btn btn-primary btn-sm" id="detail-customer-summary-save">Save</button>
                <button data-pmb-action="reset" class="btn btn-link btn-sm">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="pmb-block">
    <div class="pmbb-header">
        <h2><i class="zmdi zmdi-account m-r-5"></i> Basic Information</h2>
        
        <ul class="actions">
            <li class="dropdown">
                <a href="" data-toggle="dropdown">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                
                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a data-pmb-action="edit" href="" id="detail-customer-basic-edit">Edit Basic Information</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="pmbb-body p-l-30">
        <div class="pmbb-view">
            <dl class="dl-horizontal">
                <dt>Company Name</dt>
                <dd id="detail-customer-basic-company_name-1"><?=show($customer['company_name']);?></dd>
            </dl>

            <dl class="dl-horizontal">
                <dt>Account Number</dt>
                <dd id="detail-customer-basic-account_number-1"><?=show($customer['account_number']);?></dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Tin Number</dt>
                <dd id="detail-customer-basic-tin_number-1"><?=show($customer['tin_number']);?></dd>
            </dl>

            <dl class="dl-horizontal">
                <dt>Primary Person Firstname</dt>
                <dd id="detail-customer-basic-first_name-1"><?=show($customer['first_name']);?></dd>
            </dl>

            <dl class="dl-horizontal">
                <dt>Primary Person Lastname</dt>
                <dd id="detail-customer-basic-last_name-1"><?=show($customer['last_name']);?></dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Primary Person Title</dt>
                <dd id="detail-customer-basic-title-1"><?=show($customer['title'], 1);?></dd>
            </dl>

        </div>
        
        <div class="pmbb-edit">
            <dl class="dl-horizontal">
                <dt class="p-t-10">Company Name</dt>
                <dd>
                    <div class="fg-line">
                        <input type="text" class="form-control" id="detail-customer-basic-company_name-2">
                    </div>
                </dd>
            </dl>
            <dl class="dl-horizontal">
                <dt class="p-t-10">Account Number</dt>
                <dd>
                    <div class="fg-line">
                        <input type="text" class="form-control" id="detail-customer-basic-account_number-2">
                    </div>
                </dd>
            </dl>
            <dl class="dl-horizontal">
                <dt class="p-t-10">Tin Number</dt>
                <dd>
                    <div class="fg-line">
                        <input type="text" class="form-control" id="detail-customer-basic-tin_number-2">
                    </div>
                </dd>
            </dl>

            <dl class="dl-horizontal">
                <dt class="p-t-10">Primary Person Firstname</dt>
                <dd>
                    <div class="fg-line">
                        <input type="text" class="form-control" id="detail-customer-basic-first_name-2">
                    </div>
                </dd>
            </dl>

            <dl class="dl-horizontal">
                <dt class="p-t-10">Primary Person Lastname</dt>
                <dd>
                    <div class="fg-line">
                        <input type="text" class="form-control" id="detail-customer-basic-last_name-2">
                    </div>
                </dd>
            </dl>

            <dl class="dl-horizontal">
                <dt class="p-t-10">Primary Person Title</dt>
                <dd>
                    <div class="fg-line">
                        <input type="text" class="form-control" id="detail-customer-basic-title-2" placeholder="ex. CEO, Accountant, Programmer, Ninja">
                    </div>
                </dd>
            </dl>

            
            <div class="m-t-30">
                <button class="btn btn-primary btn-sm" id="detail-customer-basic-save">Save</button>
                <button data-pmb-action="reset" class="btn btn-link btn-sm">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="pmb-block">
    <div class="pmbb-header">
        <h2><i class="zmdi zmdi-phone m-r-5"></i> Contact Information</h2>
        
        <ul class="actions">
            <li class="dropdown">
                <a href="" data-toggle="dropdown">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                
                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a data-pmb-action="edit" href=""  id="detail-customer-contact-edit">Edit Contact Information</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="pmbb-body p-l-30">
        <div class="pmbb-view">
        	<dl class="dl-horizontal">
                <dt>Email Address</dt>
                <dd id="detail-customer-contact-email-1"><?=show($customer['email'], 1);?></dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Mobile Number</dt>
                <dd id="detail-customer-contact-mobile-1"><?=show($customer['mobile'],1 );?></dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Phone Number</dt>
                <dd id="detail-customer-contact-phone-1"><?=show($customer['phone'],1 );?></dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Facebook</dt>
                <dd id="detail-customer-contact-facebook-1"><?=show($customer['facebook'], 1);?></dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Twitter</dt>
                <dd id="detail-customer-contact-twitter-1"><?=show($customer['twitter'], 1);?></dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Skype</dt>
                <dd id="detail-customer-contact-skype-1"><?=show($customer['skype'], 1);?></dd>
            </dl>
        </div>
        
        <div class="pmbb-edit">
            <dl class="dl-horizontal">
                <dt class="p-t-10">Email Address</dt>
                <dd>
                    <div class="fg-line">
                        <input type="text" class="form-control" id="detail-customer-contact-email-2">
                    </div>
                </dd>
            </dl>

            <dl class="dl-horizontal">
                <dt class="p-t-10">Mobile Number</dt>
                <dd>
                    <div class="fg-line">
                        <input type="text" class="form-control" placeholder="ex. 0936-650-3992" id="detail-customer-contact-mobile-2">
                    </div>
                </dd>
            </dl>

            <dl class="dl-horizontal">
                <dt class="p-t-10">Phone Number</dt>
                <dd>
                    <div class="fg-line">
                        <input type="text" class="form-control" placeholder="eg. (02)-888-5770 " id="detail-customer-contact-phone-2">
                    </div>
                </dd>
            </dl>

            <dl class="dl-horizontal">
                <dt class="p-t-10">Facebook</dt>
                <dd>
                    <div class="fg-line">
                        <input type="email" class="form-control" placeholder="eg. tenelleven" id="detail-customer-contact-facebook-2">
                    </div>
                </dd>
            </dl>

            <dl class="dl-horizontal">
                <dt class="p-t-10">Twitter</dt>
                <dd>
                    <div class="fg-line">
                        <input type="text" class="form-control" placeholder="eg. @tenelleven" id="detail-customer-contact-twitter-2">
                    </div>
                </dd>
            </dl>

            <dl class="dl-horizontal">
                <dt class="p-t-10">Skype</dt>
                <dd>
                    <div class="fg-line">
                        <input type="text" class="form-control" placeholder="eg. tenelleven.ph" id="detail-customer-contact-skype-2">
                    </div>
                </dd>
            </dl>
            
            <div class="m-t-30">
                <button class="btn btn-primary btn-sm"  id="detail-customer-contact-save">Save</button>
                <button data-pmb-action="reset" class="btn btn-link btn-sm">Cancel</button>
            </div>
        </div>
    </div>
</div>