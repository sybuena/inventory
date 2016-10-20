<?php include(APPPATH.'/views/common/header.php'); ?>
<?php include(APPPATH.'/views/common/top_menu.php'); ?>
<!-- Content -->
<section id="main" data-layout="layout-1">
	<?php include(APPPATH.'/views/common/sidebar.php'); ?>

	<section id="content">
	    <div class="container">
	        <div class="block-header">
	            <h2>Settings</h2>
	        </div>

	        <div class="row">
	            <div class="col-sm-12">
	                <div class="card">
                        <div role="tabpanel" class="tabPanel">
                            <ul class="tab-nav" role="tablist">
                            	<li class="active">
                                    <a href="#settingsOrg" data-toggle="tab">Organization Settings</a>
                                </li>
                                
                                <li><a href="#settingsUser" data-toggle="tab">Users</a></li>

                                <li><a href="#settingsActivity" data-toggle="tab">Activity</a></li>
                            </ul>
                              
                            <div class="tab-content">
                            	<div role="tabpanel" class="tab-pane active" id="settingsOrg">
                                    <?php include('settings/organizations.php'); ?>
                                </div>
                                
                                <div role="tabpanel" class="tab-pane" id="settingsUser">
                                    <?php include('settings/users.php'); ?>
                                </div>

                                <div role="tabpanel" class="tab-pane" id="settingsActivity">
                                    <?php include('settings/activity.php'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
	            </div>
	        </div>
	    </div>
	</section>
</section>
<?php include(APPPATH.'/views/settings/modal.php'); ?>

<?php include(APPPATH.'/views/common/footer.php'); ?>
