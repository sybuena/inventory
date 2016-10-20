<?php include(APPPATH.'/views/common/header.php'); ?>
<?php include(APPPATH.'/views/common/top_menu.php'); ?>
<style>

#report-detail-info-detail {
	margin-bottom: 30px;
    margin-top: 20px;
}

</style>
<!-- Content -->
<section id="main" data-layout="layout-1">
	<?php include(APPPATH.'/views/common/sidebar.php'); ?>

	<section id="content">
		
	    <div class="container">
	    	<div class="block-header">
                <h2>
                	<?php echo $type; ?> Percentage Tax Return
	                <small>Profit and Loss report from xero.</small>
                </h2>
               <ul class="actions">
                
                    <li data-toggle="tooltip" data-placement="bottom" title="Print Report">
                        <button id="report-detail-tool-print" class="btn btn-primary btn-icon waves-effect waves-circle waves-float">
                            <i class="zmdi zmdi-print"></i>
                        </button>
                        <?php //DIRTY SHIT LOL ?>
                        <iframe id="iFramePdf" src="<?php echo $pdfLink; ?>" style="display:none;"></iframe>
                    </li>
                    <li 
                        data-toggle="tooltip" 
                        data-placement="bottom" 
                        title="Resync" 
                        sync-id="<?php echo $id?>" 
                        id="report-detail-tool-resync"
                    >
                        <button class="btn bgm-lightblue btn-icon waves-effect waves-circle waves-float <?php echo $isFiled_btn; ?>">
                            <i class="zmdi zmdi-refresh-sync"></i>
                        </button>
                    </li>
                </ul>
            </div>
	      
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div role="tabpanel" class="tabPanel">
                            <ul class="tab-nav" role="tablist">
                                <li class="active">
                                    <a href="#report-detail-detail" aria-controls="report-detail-detail" role="tab" data-toggle="tab">
                                        Report Detail
                                    </a>
                                </li>

                                <li >
                                    <a href="#report-detail-activity" aria-controls="report-detail-activity" role="tab" data-toggle="tab" sync-id="<?php echo $id; ?>">
                                        Notes & Activity
                                    </a>
                                </li>
                            </ul>
                              
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="report-detail-detail">
                                    <?php include('report/detail/detail.php'); ?>
                                </div>

                                <div role="tabpanel" class="tab-pane " id="report-detail-activity">
                                    <?php include('report/detail/activity.php'); ?>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
	    </div>
	</section>
</section>

<?php include(APPPATH.'/views/report/detail/modal.php'); ?>
<?php include(APPPATH.'/views/common/footer.php'); ?>