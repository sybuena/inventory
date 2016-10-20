<?php include(APPPATH.'/views/common/header.php'); ?>
<?php include(APPPATH.'/views/common/top_menu.php'); ?>
<!-- Content -->
<section id="main" data-layout="layout-1">
	<?php include(APPPATH.'/views/common/sidebar.php'); ?>

	<section id="content">
	    <div class="container">
	        <div class="block-header">
	            <h2>Report</h2>
	            
	        </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div role="tabpanel" class="tabPanel">
                            <ul class="tab-nav" role="tablist">
                                <li class="active">
                                    <a href="#monthly-profitAndLoss" aria-controls="monthly-profitAndLoss" role="tab" data-toggle="tab">
                                        Percentage Tax Return
                                    </a>
                                </li>

                                <!-- <li >
                                    <a href="#quarterly-profitAndLoss" aria-controls="quarterly-profitAndLoss" role="tab" data-toggle="tab">
                                        Quarterly Percentage Tax Return
                                    </a>
                                </li> -->
                                <li >
                                    <a href="#value-added-tax" aria-controls="value-added-tax" role="tab" data-toggle="tab">
                                        Valua Added Tax (VAT)
                                    </a>
                                </li>
                            </ul>
                              
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="monthly-profitAndLoss">
                                    <?php include('report/monthly-pt.php'); ?>
                                </div>

                                <div role="tabpanel" class="tab-pane " id="quarterly-profitAndLoss">
                                    <?php include('report/quarterly-pt.php'); ?>
                                </div>

                                <div role="tabpanel" class="tab-pane " id="value-added-tax">
                                    <?php include('report/value-added-tax.php'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

	    </div>
	</section>
</section>

<?php include(APPPATH.'/views/report/modal.php'); ?>
<?php include(APPPATH.'/views/common/footer.php'); ?>