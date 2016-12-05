<style>
span.p-info {
    display: inline-block;
    vertical-align: middle;
    padding: 0 20px 0 10px;
    line-height: 18px;
    margin-top: -20px;
}
.profile-menu > a .profile-info {
    background: none !important;
    position: relative;
    font-weight: 600 !important;
    text-align: left;
    margin-top: 45px !important;
    padding: 0px !important;
    text-transform: capitalize;
}
.profile-menu > a .profile-pic {
    padding: 25px 25px 25px 25px !important;
}

</style>
<aside id="sidebar" class="sidebar c-overflow">
    <div class="profile-menu">
        <a href="">
            <div class="profile-pic">
                <img src="<?php echo $user['image']; ?>" alt="" class="mCS_img_loaded">
                <span class="p-info"> 
                    <div class="profile-info ">
                        <?php echo isset($user) ? ($user['first_name'].' '.$user['last_name']) : 'Rod Dut'; ?>
                    </div>
                    <p class="c-white" style="font-size: 12px; text-align: left;">
                        <?php echo $user['username']; ?>
                        <br/>
                        <span id="user-role-string" role="" style="opacity: 0.8; font-weight: normal;">
                            <?=$user['user_role']; ?>
                        </span>
                    </p>
                </span>
            </div>
        </a>
        <div class="clearfix"></div>
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
        
        <li class="<?=show($purchase); ?> <?=show($purchaseDetail); ?>">
            <a href="/purchase/listing"><i class="zmdi zmdi-local-shipping"></i> Purchase Order </a>
        </li>

        <li class="<?=show($quotation); ?>">
            <a href="/quote/listing"><i class="zmdi zmdi-assignment-o"></i> Quotation </a>
        </li>
        <li class="<?=show($sales); ?>">
            <a href="/sales/listing"><i class="zmdi zmdi-money"></i> Sales Invoice </a>
        </li>

        <li class="<?=show($notes); ?>">
            <a href="/notes"><i class="zmdi zmdi-calendar-note"></i> Notes </a>
        </li>

        <li class="<?=show($settings); ?>">
            <a href="/settings"><i class="zmdi zmdi-settings"></i> Settings </a>
        </li> 
       
    </ul>
</aside>
