<?php include(APPPATH.'/views/common/header.php'); ?>
<?php include(APPPATH.'/views/common/top_menu.php'); ?>
<!-- Content -->
<style>
.crm-detail-breadcrums {
	    padding-left: 0px !important;
    border-bottom: none;
    padding-bottom: 0px !important;
}
</style>
<section id="main" data-layout="layout-1">
	<?php include(APPPATH.'/views/common/sidebar.php'); ?>

	<section id="content">
        <div class="container">
            
            <div class="block-header">
                <h2 id="customer-main-id" user-id="<?=$id;?>">Contact Detail</h2>
                <ol class="breadcrumb crm-detail-breadcrums">
                    <li><a href="/app">Home</a></li>
                    <li><a href="/customer/listing">Contact List</a></li>
                    <li class="active">Detail</li>
                </ol>
            </div>
            
            <div class="card" id="profile-main">
                <div class="pm-overview c-overflow">
                    <div class="pmo-pic">
                        <div class="pmo-stats">
                            <h2 class="m-0" id="main-customer-name">
                            	<?=show($customer['company_name']);?>
                            </h2>
                            <span id="main-customer-account">
                            	<?=show($customer['account_number'], ''); ?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="pmo-block pmo-contact hidden-xs">
                        
                        <h2>Contact</h2>
                        
                        <ul>
                            <li><i class="zmdi zmdi-smartphone"></i> 
                            	<span id="main-customer-mobile">
                            		<?=show($customer['mobile'], 1); ?>
                            	</span>
                            </li>
                            <li><i class="zmdi zmdi-phone"></i> 
                            	<span id="main-customer-phone">
                            		<?=show($customer['phone'], 1); ?>
                            	</span>
                            </li>
                            <li><i class="zmdi zmdi-email"></i> 
                            	<span id="main-customer-email">
                            		<?=show($customer['email'], 1); ?>
                            	</span>
                            </li>
                            <li><i class="zmdi zmdi-facebook-box"></i> 
                            	<span id="main-customer-facebook">
                            		<?=show($customer['facebook'], 1); ?>
                            	</span>
                            </li>
                            <li>
                            	<i class="zmdi zmdi-twitter"></i> 
                            	<span id="main-customer-twitter">
                            		<?=show($customer['twitter'], 1); ?>
                            	</span>
                            </li>
                            <li>
                            	<i class="fa fa-skype"></i> 
                            	<span id="main-customer-skype">
                            		<?=show($customer['skype'], 1); ?>
                            	</span>
                            </li>
                            <li>
                                <i class="fa fa-skype"></i> 
                                <span id="main-customer-skype">
                                    <?=show($customer['website'], 1); ?>
                                </span>
                            </li>
                            <!-- <li>
                                <i class="zmdi zmdi-pin"></i>
                                <address class="m-b-0 ng-binding">
                                    44-46 Morningside Road,<br>
                                    Edinburgh,<br>
                                    Scotland
                                </address>
                            </li> -->
                        </ul>
                    </div>
                    
                </div>
                
                <div class="pm-body clearfix">
                    <ul class="tab-nav tn-justified">
                        <li class="active waves-effect">
                        	<a href="#detail-about" data-toggle="tab">
                                About
                            </a>
                        </li>
                        <li class="waves-effect">
                        	<a href="#detail-sales-log" data-toggle="tab">
                                Sales
                            </a>
                        </li>

                        <li class="waves-effect">
                        	<a href="#detail-purchases-log" data-toggle="tab">
                                Purchases
                            </a>
                        </li>
                        <li class="waves-effect">
                       		<a href="#detail-notes" data-toggle="tab">
                                Notes & Activity
                            </a>
                       	</li>
                    </ul>
                    
                    <div class="tab-content">
                    	<div role="tabpanel" class="tab-pane active" id="detail-about">
                            <?php include('detail-about.php'); ?>
                        </div>
                        <div role="tabpanel" class="tab-pane " id="detail-sales-log">
                        	<?php //include('detail-call-log.php'); ?>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="detail-purchases-log">
                        	<?php //include('detail-ticket.php'); ?>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="detail-notes">
                        	<?php include('detail-notes.php'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>

<?php include(APPPATH.'/views/customer/customer-detail-note-add.php'); ?>
<?php include(APPPATH.'/views/common/footer.php'); ?>