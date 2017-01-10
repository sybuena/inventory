<?php include(APPPATH.'/views/common/header.php'); ?>
<?php include(APPPATH.'/views/common/top_menu.php'); ?>
<style>

.box-price h2 {font-size: 34px !important; text-align: right !important;}
</style>
<!-- Content -->
<section id="main" data-layout="layout-1">
	<?php include(APPPATH.'/views/common/sidebar.php'); ?>

	<section id="content">
	    <div class="container">
	        <div class="block-header pull-left">
	            <h2>Notes</h2>
                <ol class="breadcrumb breadcrums2">
                    <li><a href="/app">Home</a></li>
                    <li class="active">Notes List</li>
                </ol>
            </div>
             <div class="pull-right m-t-10">
                <a class="btn bgm-blue waves-effect btn-icon-text" id="notes-list-add-show">
                    <i class="zmdi zmdi-plus"></i> Add New
                </a>
            </div>
            <div class="clearfix"></div>

            <div class="card m-b-0" id="messages-main">
                
                <div class="lv-header-alt clearfix m-b-5">
                    <h2 class="lvh-label hidden-xs" id="notes-table-list-count">0 Record(s)</h2>

                    <div class="lvh-search">
                        <input type="text" placeholder="Start typing..." class="lvhs-input" id="notes-table-list-search">
                        <i class="lvh-search-close">×</i>
                    </div>
                    
                    <ul class="lv-actions actions">
                        <!-- <li class="user-admin">
                            <a id="notes-list-add-show" 
                             data-toggle="tooltip" 
                             data-placement="top"
                             data-original-title="Add"
                             class="rotate-image">
                                <i class="zmdi zmdi-plus"></i>
                            </a>
                        </li> -->
                        <li>
                            <a href="" class="lvh-search-trigger" data-toggle="tooltip" data-placement="top" data-original-title="Search Item">
                                <i class="zmdi zmdi-search"></i>
                            </a>
                        </li>
                        <li class="user-admin">
                            <a href="" id="notes-table-list-delete" 
                             data-toggle="tooltip" 
                             data-placement="top"
                             data-original-title="Delete Item">
                                <i class="zmdi zmdi-delete"></i>
                            </a>
                        </li>

                        <li>
                            <a href="" data-toggle="tooltip" data-placement="top" data-original-title="Refresh Table" id="notes-table-list-refresh">
                                <i class="zmdi zmdi-refresh-sync"></i>
                            </a>
                        </li>

                        <li class="dropdown">
                            <a href="" data-toggle="dropdown" >
                                <i class="zmdi zmdi-sort-amount-desc"></i>
                            </a>
                            
                            <ul class="dropdown-menu dropdown-menu-right" id="notes-table-list-type">
                                <li class="active">
                                    <a href="" type="all">All Type</a>
                                </li>
                                <li>
                                    <a href="" type="expense">Expense</a>
                                </li>
                                <li>
                                    <a href="" type="notes">Notes</a>
                                </li>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="" data-toggle="dropdown" aria-expanded="false">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>
                            
                            <ul class="dropdown-menu dropdown-menu-right" id="notes-table-list-page">
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
                    <table id="notes-table-list" class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th data-column-id="id" data-visible="false" data-identifier="true">ID</th>
                                <th data-column-id="title" >Title</th>
                                <th data-column-id="date" >Date</th>
                                <th data-column-id="type" data-formatter="type">Type</th>
                                <th data-column-id="amount" data-align="right">Amount</th>
                                <th data-column-id="created_by">Created By</th>
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
<?php include('add-notes.php'); ?>
<?php include(APPPATH.'/views/purchase/select-item-modal.php'); ?>
<?php include(APPPATH.'/views/purchase/add-purchase-modal.php'); ?>

<?php include(APPPATH.'/views/common/footer.php'); ?>