<header id="header" class="clearfix" data-current-skin="blue">
	<ul class="header-inner">
	    <li id="menu-trigger" data-trigger="#sidebar">
	        <div class="line-wrap">
	            <div class="line top"></div>
	            <div class="line center"></div>
	            <div class="line bottom"></div>
	        </div>
	    </li>

	    <li class="logo hidden-xs">
	        <a href="/"><?php echo isset($org_name) ? $org_name : 'Digong'; ?></a>
	    </li>
	    <li class="pull-right">
	        <ul class="top-menu">
	        	
	            <li class="dropdown">
		            <a data-toggle="dropdown" href=""><i class="tm-icon zmdi zmdi-more-vert"></i></a>
		            <ul class="dropdown-menu dm-icon pull-right">
		                <li>
		                    <a href="<?=hardLink('/main/logout/0'); ?>">
		                    	<i class="tm-icon zmdi zmdi-device-hub"></i> Portal
		                    </a>
		                </li>
		                <li>
		                    <a href="<?=hardLink('/accountSettings'); ?>">
		                    	<i class="tm-icon zmdi zmdi-settings"></i> Account Settings
		                    </a>
		                </li>
		                <li>
		                    <a href="<?=hardLink('/main/logout'); ?>">
		                    	<i class="tm-icon zmdi zmdi-power"></i> Sign out
		                    </a>
		                </li>
		            </ul>
		        </li>
	        </ul>
	    </li>

	   	<!-- <li class="logo pull-right">
	    	<a href="#" id="support">Support</a>
	   	</li> -->
	</ul>

	<!-- Top Search Content -->
	<div id="top-search-wrap">
	    <div class="tsw-inner">
	        <i id="top-search-close" class="zmdi zmdi-arrow-left"></i>
	        <input type="text">
	    </div>
	</div>
</header>

<?php include(APPPATH.'/views/main-record-call-modal.php'); ?>