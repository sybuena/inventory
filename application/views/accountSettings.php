<?php include(APPPATH.'/views/common/landing_header.php'); ?>
<header id="header" class="clearfix" data-current-skin="blue">
<ul class="header-inner">
    <!-- <li id="menu-trigger" data-trigger="#sidebar">
        <div class="line-wrap">
            <div class="line top"></div>
            <div class="line center"></div>
            <div class="line bottom"></div>
        </div>
    </li> -->

    <li class="logo hidden-xs">
        <a href="/">Digong</a>
    </li>

    <li class="pull-right">
        <ul class="top-menu">
            <li class="dropdown">
                <a data-toggle="dropdown" href=""><i class="tm-icon zmdi zmdi-more-vert"></i></a>
                <ul class="dropdown-menu dm-icon pull-right">
                    <li>
	                    <a href="/main/logout/0"><i class="tm-icon zmdi zmdi-device-hub"></i> Portal</a>
	                </li>
	                <li>
	                    <a href="/accountSettings"><i class="tm-icon zmdi zmdi-settings"></i> Account Settings</a>
	                </li>
	                <li>
	                    <a href="/main/logout"><i class="tm-icon zmdi zmdi-power"></i> Sign out</a>
	                </li>
                </ul>
            </li>
        </ul>
    </li>
</ul>
</header>

	<section id="main">
        <div class="landingPage">
        	<div class="block-header">
                <h2>Account Settings</h2>
            </div>
            
            <div class="card">

                <div class="card-body card-padding">
                	<div class="row">
					    <div class="col-sm-10">
					        <div class="form-horizontal topOrg">
					            <!-- <div class="form-group">
					                <h2  class="col-sm-2 basicInfo-title">Basic Information</h2>
					            </div>-->
					            <div class="form-group top-31">
					                <label class="col-sm-2 control-label textlabel">First Name</label>
					                <div class="col-sm-10">
					                    <div class="fg-line">
					                        <input type="text" class="form-control input-sm" id="account-settings-first-name" placeholder="">
					                    </div>
					                </div>
					            </div>

					            <div class="form-group top-31">
					                <label class="col-sm-2 control-label textlabel">Last Name</label>
					                <div class="col-sm-10">
					                    <div class="fg-line">
					                        <input type="text" class="form-control input-sm" id="account-settings-last-name" placeholder="">
					                    </div>
					                </div>
					            </div>

					            <div class="form-group top-31">
					                <label class="col-sm-2 control-label textlabel">Email</label>
					                <div class="col-sm-10 col-email">
					                	<div class="fg-line">
					                        <div class="col-lg-6">
					                        	<span id="account-settings-email" type="text" class="form-control emailAccountsettings" placeholder="Email"></span>
					                        </div>

					                        <div class="col-lg-6">
					                        	<button class="btn btn-primary btn-editEmail" data-toggle="modal" href="#modal-edit-email"><i class="zmdi zmdi-email"></i> Edit Email</button>
					                        </div>
					                    </div>
					                </div>
					            </div>

					            <div class="form-group top-31">
					                <label class="col-sm-2 control-label textlabel">Password</label>
					                <div class="col-sm-10">
					                    <div class="fg-line">

											<div class="input-group">
					                    		<button class="btn btn-primary btn-pwdAccount" data-toggle="modal" id="modal-edit-password-button"><i class="zmdi zmdi-lock"></i> Edit Password</button>
		                                    </div>
					                    	<small>Change password used to access this account. To change your password, enter your current password and the new password.</small>
					                    </div>
					                </div>
					            </div>

					            <div class="form-group top-31">
					                <label class="col-sm-2 control-label textlabel">Two-Step Authentication</label>
					                <div class="col-sm-10">
					                    <div class="fg-line">
		                                    <div class="toggle-switch" data-ts-color="blue">
		                                        <input id="ts3" type="checkbox" hidden="hidden">
		                                        <label for="ts3" class="ts-helper"></label>
		                                    </div>
			                                <br/>
			                                <br/>
			                                
					                    	<small>Two-step authentication adds an extra layer of security to your account. Once enabled, logging in will require you to enter a unique passcode generated by an app on your mobile device, in addition to your username and password. </small>
					                    </div>
					                </div>
					            </div>

					            <div class="top-100">
					                <button class="btn btn-primary pull-right">Save</button>
					            </div>

					        </div>
					    </div>
					    <div class="col-sm-2"></div>
					 
					</div>
                </div>

            </div>
       	</div>  

    </section>

  
<?php include(APPPATH.'/views/edit-email.php'); ?>
<?php include(APPPATH.'/views/edit-password.php'); ?>
<?php include(APPPATH.'/views/common/landing_footer.php'); ?>

