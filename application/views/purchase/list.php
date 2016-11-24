<?php include(APPPATH.'/views/common/header.php'); ?>
<?php include(APPPATH.'/views/common/top_menu.php'); ?>

<!-- Content -->
<section id="main" data-layout="layout-1">
	<?php include(APPPATH.'/views/common/sidebar.php'); ?>

	<section id="content">
	    <div class="container">
	        <div class="block-header">
	            <h2>Purchase Order Listing</h2>
                <ol class="breadcrumb breadcrums2">
                    <li><a href="/app">Home</a></li>
                    <li class="active" id="main-list-breadcrums">
                        Purchase List
                    </li>
                </ol>
            </div>
          
            <div class="row">
               <div class="col-sm-3">
                    <div class="mini-charts-item bgm-cyan">
                        <div class="count pull-left">
                            <small>Draft</small>
                            <h2>Purchase</h2>
                        </div>
                        <div class="count box-price">
                            <h2 id="purchase-draft">0</h2>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="mini-charts-item bgm-orange">
                        <div class="count pull-left">
                            <small>Pending</small>
                            <h2>Purchase</h2>
                        </div>
                        <div class="count box-price">
                            <h2 id="purchase-pending">0</h2>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="mini-charts-item bgm-lightgreen">
                        <div class="count pull-left">
                            <small>Approved</small>
                            <h2>Purchase</h2>
                        </div>
                        <div class="count box-price">
                            <h2 id="purchase-approved">0</h2>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="mini-charts-item bgm-red">
                        <div class="count pull-left">
                            <small>Declined</small>
                            <h2>Purchase</h2>
                        </div>
                        <div class="count box-price">
                            <h2 id="purchase-declined">0</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <button class="btn btn-float btn-primary m-btn waves-effect waves-circle waves-float" id="purchase-list-add-show">
                <i class="zmdi zmdi-plus"></i>
            </button> -->

            <div class="card m-b-0" id="messages-main">
                
                <div class="lv-header-alt clearfix m-b-5">
                    <h2 class="lvh-label hidden-xs" id="purchase-table-list-count">0 Record(s)</h2>

                    <div class="lvh-search">
                        <input type="text" placeholder="Start typing..." class="lvhs-input" id="purchase-table-list-search">
                        <i class="lvh-search-close">×</i>
                    </div>
                    
                    <ul class="lv-actions actions">
                        <li class="user-admin">
                            <a id="purchase-list-add-show" 
                             data-toggle="tooltip" 
                             data-placement="top"
                             data-original-title="Add"
                             class="rotate-image">
                                <i class="zmdi zmdi-plus"></i>
                            </a>
                        </li>
                        <li>
                            <a href="" class="lvh-search-trigger" data-toggle="tooltip" data-placement="top" data-original-title="Search Item">
                                <i class="zmdi zmdi-search"></i>
                            </a>
                        </li>
                        <li class="user-admin">
                            <a href="" id="purchase-table-list-delete" 
                             data-toggle="tooltip" 
                             data-placement="top"
                             data-original-title="Delete Item">
                                <i class="zmdi zmdi-delete"></i>
                            </a>
                        </li>

                        <li>
                            <a href="" data-toggle="tooltip" data-placement="top" data-original-title="Refresh Table" id="purchase-table-list-refresh">
                                <i class="zmdi zmdi-refresh-sync"></i>
                            </a>
                        </li>

                        <li class="dropdown">
                            <a href="" data-toggle="dropdown" aria-expanded="false">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>
                            
                            <ul class="dropdown-menu dropdown-menu-right" id="purchase-table-list-page">
                                <li class="active">
                                    <a href="" page="10">10 per page</a>
                                </li>
                                <li>
                                    <a href="" page="25">25 per page</a>
                                </li>
                                <li>
                                    <a href="" page="50">50 per page</a>
                                </li>
                                <li>
                                    <a href="" page="100">100 per page</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="table-responsive tableUser" >
                    <table id="purchase-table-list" class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th data-column-id="id" data-visible="false" data-identifier="true">ID</th>
                                <th data-column-id="order_number" data-order="asc">Order #</th>
                                <th data-column-id="reference_number" data-order="asc">Reference #</th>
                                <th data-column-id="from" data-formatter="from" data-order="asc">Supplier</th>
                                <th data-column-id="date" data-sortable="false">Date</th>
                                <th data-column-id="due_date" data-sortable="false">Delivery Date</th>
                                <th data-column-id="total_amount" data-sortable="false" data-align="right">Amount</th>
                                <th data-column-id="status_text" data-formatter="status_text" data-sortable="false">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
                

	    </div>
	</section>
</section>

<?php include(APPPATH.'/views/purchase/select-item-modal.php'); ?>
<?php include(APPPATH.'/views/purchase/add-purchase-modal.php'); ?>

<?php include(APPPATH.'/views/common/footer.php'); ?>