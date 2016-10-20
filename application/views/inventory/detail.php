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
                <div class="card-header ch-alt">
                    <?=$inventory['name']; ?>
                    <ul class="lv-actions actions">
                        <li>
                            <a class="inventory-delete" inventory-id="<?=$id;?>">
                                <i class="zmdi zmdi-delete"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="zmdi zmdi-print"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body card-padding">
                    <div class="row m-b-25">
                    </div>
                </div>
                
                
            </div>
	    </div>
	</section>
</section>

<?php include(APPPATH.'/views/common/footer.php'); ?>