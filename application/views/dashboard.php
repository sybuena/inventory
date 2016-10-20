<?php include(APPPATH.'/views/common/header.php'); ?>
<?php include(APPPATH.'/views/common/top_menu.php'); ?>
<style>
.dashboard-loading {
    background-color: #fff; color:#ADADAD
}
</style>
<!-- Content -->
<section id="main" data-layout="layout-1">
	<?php include(APPPATH.'/views/common/sidebar.php'); ?>

	<section id="content">
	    <div class="container">
            <div class="block-header">
                <h2>Dashboard</h2>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="lv-header-alt" style="margin-bottom: 20px;">
                        <h2 class="lvh-label hidden-xs">
                            Search Customer name or Account number
                        </h2>
                        
                        <div class="lvh-search">
                            <input type="text" placeholder="Search Customer Name or Account Number..." class="lvhs-input" id="dashboard-search-customer-direct">
        
                            <i class="lvh-search-close dashboard-loading hidden">
                                <i class="fa fa-cog fa-spin"></i>
                            </i>

                        </div>
                        
                        <ul class="lv-actions actions">
                            <li>
                                <a href="" class="lvh-search-trigger" id="dashboard-trigger1">
                                    <i class="zmdi zmdi-search"></i>
                                </a>
                            </li>
                        </ul>
                    </div><br/>

                    <div class="card m-t-20">
                        <div class="card-header">
                            <h2>Sales Statistics <small>Vestibulum purus quam scelerisque, mollis nonummy metus</small></h2>
                            
                            <ul class="actions">
                                <li>
                                    <a href="">
                                        <i class="zmdi zmdi-refresh-alt"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="card-body">
                            <div class="chart-edge">
                                <div id="curved-line-chart" class="flot-chart "></div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <?php include(APPPATH.'/views/dashboard/zendesk-ticket.php'); ?>
                </div>
            </div>
        </div>
	</section>
</section>

<?php include(APPPATH.'/views/dashboard/zendesk-ticket-modal.php'); ?>
<?php include(APPPATH.'/views/common/footer.php'); ?>
