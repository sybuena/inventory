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
                    &nbsp   
                    <ul class="lv-actions actions">
                        <li>
                            <a class="inventory-delete" inventory-id="<?=$id;?>">
                                <i class="zmdi zmdi-delete"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body card-padding form-horizontal">
                    <div class="row m-b-25">
                        <div class="contact-info-field">
                            
                            <div class="form-group m-b-20">
                                <label class="col-sm-3 control-label textlabel">
                                    Code <span class="required-text">*</span>
                                </label>
                                <div class="col-sm-3">
                                    <div class="fg-line">
                                        <input type="text" class="form-control" id="inventory-code" value="<?=$inventory['code']; ?>">
                                    </div>
                                </div>
                                <label class="col-sm-1 control-label textlabel">
                                    Name <span class="required-text">*</span>
                                </label>
                                <div class="col-sm-4">
                                    <div class="fg-line">
                                        <input type="text" class="form-control" id="inventory-name" value="<?=$inventory['name']; ?>">
                                    </div>
                                </div>
                                <span class="col-sm-1"></span>
                            </div>

                            <div class="form-group m-b-20">
                                <label class="col-sm-3 control-label textlabel">
                                    Type <span class="required-text">*</span>
                                </label>
                                <div class="col-sm-3">
                                    <div class="fg-line">
                                        <select class="form-control" id="inventory-type">
                                            <option value="item">Item</option>
                                            <option value="service">Service</option>
                                        </select>
                                    </div>
                                </div>
                                <label class="col-sm-1 control-label textlabel">
                                    Category
                                </label>
                                <div class="col-sm-4">
                                    <div class="fg-line">
                                        <select class="form-control" id="inventory-category">
                                            <option value="">None</option>
                                        </select>
                                    </div>
                                </div>
                                <span class="col-sm-1"></span>
                            </div>

                            <div class="form-group m-b-20">
                                <label class="col-sm-3 control-label textlabel">Description</label>
                                <div class="col-sm-8">
                                    <div class="fg-line">
                                        <textarea class="form-control" rows="5" id="inventory-description"><?=$inventory['description']; ?></textarea>
                                    </div>
                                </div>
                                <span class="col-sm-1"></span>
                            </div>

                        </div>
                    </div>
                </div>
                
                
            </div>
	    </div>
	</section>
</section>

<?php include(APPPATH.'/views/common/footer.php'); ?>