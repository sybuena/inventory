<?php include(APPPATH.'/views/common/header.php'); ?>
<?php include(APPPATH.'/views/common/top_menu.php'); ?>
<style>
#crm-table-holder-right {width: 80%; float: right}
#crm-table-holder-left {width: 20%; float: left; padding-right: 0px;}
.to-uc {text-transform: uppercase;}
#add-group-name-description {min-height: 100px}
.big-icons {
    padding-left: 5px;
    padding-right: 5px;
}
#button-holder-crm {
    margin-bottom: 10px;
    margin-right: 20px;
}
#crm-table-list tr {cursor: pointer;}
th[data-column-id="image"] {
    width: 100px
}
</style>
<!-- Content -->
<section id="main" data-layout="layout-1">
	<?php include(APPPATH.'/views/common/sidebar.php'); ?>

	<section id="content">
	    <div class="container">
	        <div class="block-header pull-left">
	            <h2>Contact List</h2>
                <ol class="breadcrumb breadcrums2">
                    <li><a href="/app">Home</a></li>
                    <li class="active">Contact List</li>
                </ol>
            </div>
            <div class="pull-right m-t-10">
                <a class="btn bgm-blue waves-effect btn-icon-text" id="customer-add-modal-show">
                    <i class="zmdi zmdi-plus"></i> Add New
                </a>
                
            </div>
            <div class="clearfix"></div>
            
            <div class="card m-b-0" id="messages-main">
                <div class="ms-menu">
                    <div class="ms-block">
                        <div class="dropdown">
                            <button class="btn btn-primary bgm-black btn-block" id="add-group-show">
                                Add Contact Group
                            </button>
                        </div>
                    </div>
                    <br/>
                    
                    <div class="listview lv-user customer-group-list">
                    </div>

                </div>
                <div class="ms-body" style="height: 100%">
                    <div class="lv-header-alt clearfix m-b-5">
                        <h2 class="lvh-label hidden-xs"><span id="crm-table-list-total">19,453</span> Record(s)</h2>
                        
                        <div class="lvh-search">
                            <input type="text" placeholder="Start typing..." class="lvhs-input" id="crm-table-list-search">
                            <i class="lvh-search-close">×</i>
                        </div>
                    
                        <ul class="lv-actions actions">
                            <li>
                                <a href="" class="lvh-search-trigger">
                                    <i class="zmdi zmdi-search"></i>
                                </a>
                            </li>
                            <li>
                                <a href="" class="" id="crm-table-list-delete" 
                                    data-toggle="tooltip" 
                                    data-placement="top" 
                                    data-original-title="Delete Selected Customer"
                                >
                                    <i class="zmdi zmdi-delete"></i>
                                </a>
                            </li>

                            <!-- <li>
                                <a href="" class="" id="crm-table-list-move" 
                                    data-toggle="tooltip" 
                                    data-placement="top" 
                                    data-original-title="Move Selected Customer"
                                >
                                    <i class="zmdi zmdi-folder"></i>
                                </a>
                            </li> -->
                            <li class="dropdown">
                                <a href="" data-toggle="dropdown" aria-expanded="false">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </a>
                                
                                <ul class="dropdown-menu dropdown-menu-right" id="crm-table-list-page">
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
                                    <li>
                                        <a href="" page="-1">All</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <div class="table-responsive tableUser" >
                        <table id="crm-table-list" class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th data-column-id="id" data-visible="false" data-identifier="true">ID</th>
                                    <th data-column-id="image" data-sortable="false"></th>
                                    <th data-column-id="name" data-order="asc" data-formatter="name_format">Contacts</th>
                                    <th data-column-id="email">Email</th>
                                    <th data-column-id="group" data-sortable="false">Group</th>
                                    <th data-column-id="created_by" data-sortable="false">Created By</th>
                                    <th data-column-id="last_update" data-sortable="false" data-formatter="last_update">Last Modified</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                

	    </div>
	</section>
</section>

<?php include(APPPATH.'/views/customer/add-group-modal.php'); ?>
<?php include(APPPATH.'/views/customer/add-customer-modal.php'); ?>
<?php include(APPPATH.'/views/common/footer.php'); ?>