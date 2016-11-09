<?php include(APPPATH.'/views/common/header.php'); ?>
<?php include(APPPATH.'/views/common/top_menu.php'); ?>
<!-- Content -->
<section id="main" data-layout="layout-1">
	<?php include(APPPATH.'/views/common/sidebar.php'); ?>

	<section id="content">
		
	    <div class="container">
	    	<div class="block-header">
                <h2>Inventory Detail</h2>
                <ol class="breadcrumb breadcrums2">
                    <li><a href="/app">Home</a></li>
                    <li><a href="/inventory/listing">Inventory List</a></li>
                    <li class="active" id="main-list-breadcrums">
                        Inventory Detail
                    </li>
                </ol>
            </div>
	      
            <div class="card">
                <ul class="tab-nav tn-justified">
                    <li class="waves-effect active">
                        <a href="#detail-about" data-toggle="tab" aria-expanded="false">
                            Detail
                        </a>
                    </li>
                    <li class="waves-effect">
                        <a href="#detail-sales-log" data-toggle="tab" aria-expanded="true">
                            Sales Transaction
                        </a>
                    </li>

                    <li class="waves-effect">
                        <a href="#detail-purchases-log" data-toggle="tab">
                            Purchases Transaction
                        </a>
                    </li>
                    <li class="waves-effect">
                        <a href="#detail-notes" data-toggle="tab">
                            Notes & Activity
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane card-body card-padding form-horizontal active" id="detail-about">
                        <?php include('block/basic-information.php');?>
                    </div>
                    <div class="tab-pane" id="detail-sales-log">
                        <?php include('block/sales-transaction.php');?>
                    </div>
                    <div class="tab-pane" id="detail-purchases-log">
                        <?php include('block/purchase-transaction');?>
                    </div>
                    <div class="tab-pane" id="detail-notes">
                        <?php include('block/activity.php');?>
                    </div>
                </div>
            </div>
	    </div>
	</section>
</section>

<?php include(APPPATH.'/views/common/footer.php'); ?>