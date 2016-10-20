<?php include(APPPATH.'/views/common/landing_header.php'); ?>
<header id="header" class="clearfix" data-current-skin="blue">
<ul class="header-inner">

    <li class="logo hidden-xs">
        <a href="/"></a>
    </li>

    <li class="pull-right">
        <ul class="top-menu">
            <li class="dropdown">
                <a data-toggle="dropdown" href=""><i class="tm-icon zmdi zmdi-more-vert"></i></a>
                <ul class="dropdown-menu dm-icon pull-right">
                    <!-- <li>
                        <a href="<?=hardLink('main/logout/0');?> ">
                            <i class="tm-icon zmdi zmdi-device-hub"></i> Portal
                        </a>
                    </li>
                    <li>
                        <a href="<?=hardLink('accountSettings/');?>">
                            <i class="tm-icon zmdi zmdi-settings"></i> Account Settings
                        </a>
                    </li> -->
                    <li>
                        <a href="<?=hardLink('main/logout/');?>"><i class="tm-icon zmdi zmdi-power"></i> Sign out</a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
</ul>
</header>
	<section id="main">
        <div class="landingPage">

        	 <!-- Organization Title -->
            <div class="block-header">
                <h2>Organizations List</h2>
            </div>
                
            <!-- Add button -->
            <button id="xero-button-intergration-connect" class="btn btn-float btn-circle-shape bgm-amber m-btn" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add Organization">
                <i class="zmdi zmdi-plus"></i>
            </button>

            <div class="card">

            	<div class="lv-header-alt clearfix m-b-5">
                    <div class="lvh-search">
                        <input type="text" placeholder="Search Organization..." class="lvhs-input">
                        
                        <i class="lvh-search-close">&times;</i>
                    </div>
                    
                    <ul class="lv-actions actions">
                        <li>
                            <a href="" class="lvh-search-trigger">
                                <i class="zmdi zmdi-search"></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="card-body card-padding">

                	<div class="contacts clearfix row" id="organization-list-connected">

                	</div>
                </div>

            </div>  
            
       	</div>  

    </section>


<div class="modal fade in" id="modal-add-organization" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Organization</h4>
            </div>

            <div class="modal-body">
                
                
                    <div class="col-sm-12">
                        <div class="form-group fg-float">
                            <label>Organization Name</label>
                            <input type="text" class="form-control fg-input" id="add-organization-name">
                        </div>
                        
                    
                        <div class="form-group fg-float">
                            <label>Phone Number</label>
                            <input type="text" class="form-control fg-input" id="add-organization-phone">
                        </div>
                    
                
                        <div class="form-group fg-float">
                            <label>Address</label>
                            <input type="text" class="form-control fg-input" id="add-organization-address">
                        </div>
                    </div>

                

            </div>
            <div class="modal-footer">
                <button class="btn bgm-gray waves-effect" data-dismiss="modal">Cancel</button>
                <button class="btn bgm-amber waves-effect" id="add-organization-save">Save</button>
            </div>
        </div>
    </div>
</div>
  
<?php include(APPPATH.'/views/common/landing_footer.php'); ?>

