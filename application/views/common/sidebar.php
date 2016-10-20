<aside id="sidebar" class="sidebar c-overflow">
    <div class="profile-menu">
        <a href="">
            <div class="profile-pic">
                <img src="/assets/img/profile-pics/1.jpg" alt="" class="mCS_img_loaded">
            </div>
            <div class="profile-info">
                <?php echo isset($user) ? ($user['first_name'].' '.$user['last_name']) : 'Rod Dut'; ?>
            </div>
        </a>
    </div>

    <ul class="main-menu sidebar-menu">
        <li class="<?=show($dashboard); ?>">
            <a href="/app"><i class="zmdi zmdi-home"></i> Dashboard </a>
        </li>

        <li class="<?=show($crm); ?>">
            <a href="/customer/listing""><i class="zmdi zmdi-accounts-list"></i> Contacts </a>
        </li>

        <li class="<?=show($inventory); ?>">
            <a href="/inventory/listing""><i class="zmdi zmdi-store"></i> Inventory </a>
        </li>

        <li class="sub-menu <?=show($sales); ?>">
            <a href=""><i class="zmdi zmdi-long-arrow-up"></i> Sales </a>
            <ul style="display: none;">
                <li><a href="/quote/listing">Quotes</a></li>
                <li><a href="/sales/listing">Invoices</a></li>
            </ul>
        </li>
        
        <li class="sub-menu <?=show($purchase); ?>">
            <a href=""><i class="zmdi zmdi-long-arrow-down"></i> Purchases </a>
            <ul style="display: none;">
                <li><a href="/purchase/listing">Purchase Order</a></li>
                <li><a href="/settings/users">Bills</a></li>
            </ul>
        </li>

        <li class="<?=show($settings); ?>">
            <a href="/settings"><i class="zmdi zmdi-settings"></i> Settings </a>
        </li> 
       
    </ul>
</aside>
