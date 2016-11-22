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
            
            <div class="row">
                <div class="col-sm-3">
                    <div class="mini-charts-item bgm-teal">
                        <div class="count pull-left">
                            <small>In</small>
                            <h2>Quatation</h2>
                        </div>
                        <div class="count box-price">
                            <h2><?=decim($inQuatation);?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="mini-charts-item bgm-green">
                        <div class="count pull-left">
                            <small>In Pending</small>
                            <h2>Sales</h2>
                        </div>
                        <div class="count box-price">
                            <h2><?=decim($salesPending);?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="mini-charts-item bgm-lightgreen">
                        <div class="count pull-left">
                            <small>In Pending</small>
                            <h2>Purchase</h2>
                        </div>
                        <div class="count box-price">
                            <h2><?=decim($purchasePending);?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="mini-charts-item bgm-blue">
                        <div class="count pull-left">
                            <small>Quantity</small>
                            <h2>On Hand</h2>
                        </div>
                        <div class="count box-price">
                            <h2><?=decim($data['stock']);?></h2>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card">
                <ul class="tab-nav tn-justified">
                    <li class="waves-effect active">
                        <a href="#detail-about" data-toggle="tab" aria-expanded="false">
                            Detail
                        </a>
                    </li>
                    <li class="waves-effect">
                        <a href="#detail-quatation-log" data-toggle="tab" aria-expanded="true">
                            Quatation Log
                        </a>
                    </li>
                    <li class="waves-effect">
                        <a href="#detail-sales-log" data-toggle="tab" aria-expanded="true">
                            Sales Log
                        </a>
                    </li>

                    <li class="waves-effect">
                        <a href="#detail-purchases-log" data-toggle="tab">
                            Purchases Log
                        </a>
                    </li>
                    <!-- <li class="waves-effect">
                        <a href="#detail-notes" data-toggle="tab">
                            Notes & Activity
                        </a>
                    </li> -->
                </ul>

                <div class="tab-content p-t-0">
                    <div class="tab-pane card-body card-padding form-horizontal active" id="detail-about">
                        <?php include('block/basic-information.php');?>
                    </div>
                    <div class="tab-pane" id="detail-sales-log">
                        <?php include('block/sales-transaction.php');?>
                    </div>
                    <div class="tab-pane" id="detail-quatation-log">
                        <?php include('block/quatation-transaction.php');?>
                    </div>
                    <div class="tab-pane" id="detail-purchases-log">
                        <?php include('block/purchase-transaction.php');?>
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