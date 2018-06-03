<div class="pmb-block block-basic">
    <div class="pmbb-header">
        <h2><i class="zmdi zmdi-account m-r-5"></i> Basic Information</h2>
        
        <ul class="actions">
            <li class="dropdown">
                <a href="" data-toggle="dropdown">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                
                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a data-pmb-action="edit" href="" id="detail-user-basic-edit">Edit Basic Information</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="pmbb-body p-l-30">
        <div class="pmbb-view">
            
            <dl class="dl-horizontal">
                <dt>Firstname</dt>
                <dd id="detail-user-basic-first_name-1"><?=show($info['first_name']);?></dd>
            </dl>

            <dl class="dl-horizontal">
                <dt>Lastname</dt>
                <dd id="detail-user-basic-last_name-1"><?=show($info['last_name']);?></dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Role</dt>
                <dd id="detail-user-basic-role-1"><?=show($info['role_name']);?></dd>
            </dl>

        </div>
        
        <div class="pmbb-edit">
            
            <dl class="dl-horizontal">
                <dt class="p-t-10">Firstname</dt>
                <dd>
                    <div class="fg-line">
                        <input type="text" class="form-control" id="detail-user-basic-first_name-2">
                    </div>
                </dd>
            </dl>

            <dl class="dl-horizontal">
                <dt class="p-t-10">Lastname</dt>
                <dd>
                    <div class="fg-line">
                        <input type="text" class="form-control" id="detail-user-basic-last_name-2">
                    </div>
                </dd>
            </dl>

            <dl class="dl-horizontal">
                <dt class="p-t-10">Role</dt>
                <dd>
                    <div class="fg-line">
                        <select class="form-control" id="detail-user-basic-role-2">
                            <option value="1">Administrator</option>
                            <option value="2">Accountant</option>
                        </select>
                        
                    </div>
                </dd>
            </dl>
            
            <div class="m-t-30">
                <!-- <button class="btn btn-primary btn-sm" id="detail-user-basic-save">Save</button>
                <button data-pmb-action="reset" class="btn btn-link btn-sm">Cancel</button> -->

                <button class="btn bgm-blue waves-effect" id="detail-user-basic-save">Save</button>
                <button class="btn bgm-gray waves-effect" data-pmb-action="reset">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="pmb-block block-contact">
    <div class="pmbb-header">
        <h2><i class="zmdi zmdi-phone m-r-5"></i> Contact Information</h2>
        
        <ul class="actions">
            <li class="dropdown">
                <a href="" data-toggle="dropdown">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                
                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a data-pmb-action="edit" href=""  id="detail-user-contact-edit">Edit Contact Information</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="pmbb-body p-l-30">
        <div class="pmbb-view">
        	
            <dl class="dl-horizontal">
                <dt>Mobile Number</dt>
                <dd id="detail-user-contact-mobile-1"><?=show($info['mobile'],'<span class="italic">not specified</span>' );?></dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Phone Number</dt>
                <dd id="detail-user-contact-phone-1"><?=show($info['phone'],'<span class="italic">not specified</span>' );?></dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Facebook</dt>
                <dd id="detail-user-contact-facebook-1"><?=show($info['facebook'], '<span class="italic">not specified</span>');?></dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Twitter</dt>
                <dd id="detail-user-contact-twitter-1"><?=show($info['twitter'], '<span class="italic">not specified</span>');?></dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Skype</dt>
                <dd id="detail-user-contact-skype-1"><?=show($info['skype'], '<span class="italic">not specified</span>');?></dd>
            </dl>
        </div>
        
        <div class="pmbb-edit">
           
            <dl class="dl-horizontal">
                <dt class="p-t-10">Mobile Number</dt>
                <dd>
                    <div class="fg-line">
                        <input type="text" class="form-control input-mask" placeholder="(0905) 555 7965" data-mask="(0000) 000 0000" id="detail-user-contact-mobile-2">
                    </div>
                </dd>
            </dl>

            <dl class="dl-horizontal">
                <dt class="p-t-10">Phone Number</dt>
                <dd>
                    <div class="fg-line">
                        <input type="text" class="form-control" placeholder="eg. (02)-888-5770 " id="detail-user-contact-phone-2">
                    </div>
                </dd>
            </dl>

            <dl class="dl-horizontal">
                <dt class="p-t-10">Facebook</dt>
                <dd>
                    <div class="fg-line">
                        <input type="email" class="form-control" placeholder="eg. ninjaUnicorn" id="detail-user-contact-facebook-2">
                    </div>
                </dd>
            </dl>

            <dl class="dl-horizontal">
                <dt class="p-t-10">Twitter</dt>
                <dd>
                    <div class="fg-line">
                        <input type="text" class="form-control" placeholder="eg. @sample_unicorn" id="detail-user-contact-twitter-2">
                    </div>
                </dd>
            </dl>

            <dl class="dl-horizontal">
                <dt class="p-t-10">Skype</dt>
                <dd>
                    <div class="fg-line">
                        <input type="text" class="form-control" placeholder="eg. my.skype.name" id="detail-user-contact-skype-2">
                    </div>
                </dd>
            </dl>
            
            <div class="m-t-30">

                <button class="btn bgm-blue waves-effect" id="detail-user-contact-save">Save</button>
                <button class="btn bgm-gray waves-effect" data-pmb-action="reset">Cancel</button>
            </div>
        </div>
    </div>
</div>