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
	            <h2>Inventory List</h2>
                <ol class="breadcrumb breadcrums2">
                    <li><a href="/app">Home</a></li>
                    <li class="active">Inventory List</li>
                </ol>

            </div>
            <div class="pull-right m-t-10">
                <a class="btn bgm-blue waves-effect btn-icon-text" id="inventory-add-modal">
                    <i class="zmdi zmdi-plus"></i> Add New
                </a>
                <a class="btn bgm-blue waves-effect btn-icon-text" href="/inventory/import" >
                    <i class="zmdi zmdi-upload"></i> Import
                </a>
            </div>
            <div class="clearfix"></div>
            <div class="card m-b-0" id="messages-main">
                <div class="ms-menu">
                    <div class="ms-block">
                        <div class="dropdown">
                            <button class="btn btn-primary bgm-black btn-block" id="add-category-show">
                                Add Category
                            </button>
                        </div>
                    </div>
                    <br/>
                    
                    <div class="listview lv-user inventory-group-list">
                    </div>

                </div>
                <div class="ms-body">
                    <div class="lv-header-alt clearfix m-b-5">
                        <h2 class="lvh-label hidden-xs"><span id="inventory-table-total">19,453</span> Records</h2>
                        
                        <div class="lvh-search">
                            <input type="text" placeholder="Start typing..." class="lvhs-input" id="inventory-table-search">
                            <i class="lvh-search-close">×</i>
                        </div>
                        
                        <ul class="lv-actions actions">
                            <!-- <li>
                                <a href="" class="" id="inventory-add-modal"
                                    data-toggle="tooltip" 
                                    data-placement="right" 
                                    data-original-title="Add New"
                                >
                                    <i class="zmdi zmdi-plus"></i>
                                </a>
                            </li>
                            <li>
                                <a href="/inventory/import" class=""
                                    data-toggle="tooltip" 
                                    data-placement="right" 
                                    data-original-title="Import"
                                >
                                    <i class="zmdi zmdi-upload"></i>
                                </a>
                            </li>
 -->
                            <li>
                                <a href="" class="lvh-search-trigger"
                                    data-toggle="tooltip" 
                                    data-placement="right" 
                                    data-original-title="Search Items"
                                >
                                    <i class="zmdi zmdi-search"></i>
                                </a>
                            </li>
                            <li>
                                <a href="" class="" id="inventory-delete" 
                                    data-toggle="tooltip" 
                                    data-placement="right" 
                                    data-original-title="Delete Selected Item(s)"
                                >
                                    <i class="zmdi zmdi-delete"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="table-responsive tableUser" >
                        <table id="inventory-table-list" class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th data-column-id="id" data-visible="false" data-identifier="true">ID</th>
                                    <!-- <th data-column-id="code" data-order="asc">Code</th> -->
                                    <th data-column-id="name" data-order="asc" data-width="700px" data-formatter="name_format">Name</th>
                                    <th data-column-id="type" data-order="asc">Type</th>
                                    <th data-column-id="category" data-sortable="false">Category</th>
                                    <th data-column-id="cost" data-order="asc" data-align="right">Cost Price</th>
                                    <th data-column-id="sales" data-order="asc" data-align="right">Sale Price</th>
                                    <th data-column-id="stock" data-formatter="stock"  data-align="right">Quantity</th>
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

<?php include(APPPATH.'/views/inventory/add-category-modal.php'); ?>
<?php include(APPPATH.'/views/inventory/add-inventory-modal.php'); ?>
<?php include(APPPATH.'/views/common/footer.php'); ?>