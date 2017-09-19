<?php include(APPPATH.'/views/common/header.php'); ?>
<?php include(APPPATH.'/views/common/top_menu.php'); ?>
<style>
.invoice-total > tbody > tr > td:first-child {
    text-align: right;
}
.invoice-total > tbody > tr > td {
    border: 0 none;
}
.invoice-total > tbody > tr > td:last-child {
    /*border-bottom: 1px solid #DDDDDD;*/
    text-align: right;
    width: 15%;
    font-weight: 600;
}

.button-actions {
    margin-top: 25px;
}
</style>
<!-- Content -->
<section id="main" data-layout="layout-1">
	<?php include(APPPATH.'/views/common/sidebar.php'); ?>

	<section id="content">
		
	    <div class="container">
	    	<div class="block-header pull-left">
                <h2>Purchase Order Detail</h2>
                <ol class="breadcrumb breadcrums2">
                    <li><a href="/app">Home</a></li>
                    <li><a href="/purchase/listing">Purchase List</a></li>
                    <li class="active" id="main-list-breadcrums">
                        Purchase Order Detail
                    </li>
                </ol>
            </div>
            <div class="pull-right m-t-10">
            <?php if(isAdmin()):?>
                <?php if($purchase['status'] == 1) :?>
                    
                    <button class="btn btn-primary btn-icon-text purchase-approve" purchase-id="<?=$id;?>">
                        <i class="zmdi zmdi-check"></i> Approve Purchase
                    </button>
                    <button class="btn btn-danger btn-icon-text purchase-decline" purchase-id="<?=$id;?>">
                        <i class="zmdi zmdi-close"></i> Decline Purchase
                    </button>
                    
                <?php endif;?>
            <?php endif;?>
           </div>
           <div class="clearfix"></div>
            <div class="card">
                <div class="card-header ch-alt">
                    <button class="btn btn-xs <?=$status_class;?>"><?=$status_text;?></button>

                    <ul class="lv-actions actions">
                        <li>
                            <a class="purchase-delete" purchase-id="<?=$id;?>">
                                <i class="zmdi zmdi-delete"></i>
                            </a>
                        </li>
                        <li>
                            <a href="" id="purchase-print">
                                <i class="zmdi zmdi-print"></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- dont load yet the PDF so dont put to src attribute -->
                <iframe id="report-frame" class="hide" data-src="<?=$pdfLink; ?>" allowfullscreen webkitallowfullscreen></iframe>
                
                
                <div class="card-body card-padding" id="section-to-print">
                    <div class="row m-b-25">
                        <div class="col-xs-6">
                            <div class="text-left m-l-20">
                                <h4>
                                    PO Number <br>
                                    <span class="c-blue"><?=$purchase['order_number']; ?></span>
                                </h4>
                                
                                <span class="text-muted">
                                    Ref Number : <?=show($purchase['reference_number'], 'N/A'); ?><br>
                                    Date : <?=show($purchase['date'], 'N/A'); ?><br>
                                    Delivery Date : <?=show($purchase['due_date'], 'N/A'); ?><br>
                                </span>

                            </div>
                        </div>
                        
                        <div class="col-xs-6">
                            <div class="i-to text-right">
                                <h4>
                                    <?=$purchase['supplier']['company_name']; ?> 
                                    <?=show('#'.$purchase['supplier']['account_number']); ?>
                                </h4>
                                
                                <span class="text-muted">
                                    <address>
                                        <?=$purchase['supplier']['address']; ?>
                                        
                                        <?php 
                                            $found = false;
                                            if(hasValue($purchase['supplier']['city'])) {
                                                $found = true;
                                                echo $purchase['supplier']['city'];
                                            }
                                            if(hasValue($purchase['supplier']['province'])) {
                                                $found = true;
                                                echo $purchase['supplier']['province'];
                                            }
                                            if(hasValue($purchase['supplier']['zip'])) {
                                                $found = true;
                                                echo ' ('.$purchase['supplier']['zip'].')'; 
                                            }
                                            if($found) {
                                                echo '<br>';
                                            }
                                        ?>
                                        <br>
                                        <?=$purchase['supplier']['country']; ?>
                                    </address>
        
                                    Phone : <?=show($purchase['supplier']['phone'], 'N/A'); ?><br>
                                    Mobile : <?=show($purchase['supplier']['Mobile'], 'N/A'); ?><br>
                                    Email : <?=show($purchase['supplier']['email'], 'N/A'); ?>
                                </span>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="clearfix"></div>
                    <h5>Items</h5>
                    <table class="table i-table m-t-25 m-b-25">
                        <thead class="text-uppercase">
                            <tr>
                                <th class="c-gray">DESCRIPTION</th>
                                <th class="c-gray">UNIT PRICE</th>
                                <th class="c-gray">QUANTITY</th>
                                <th class="highlight">TOTAL</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php foreach($purchase['line'] as $v) :?>
                                <tr>
                                    <td width="50%">
                                        <h5 class="text-uppercase f-400"><?php echo $v['name']; ?></h5>
                                        <p class="text-muted">
                                            <?php echo show($v['description'], 'N/A'); ?>
                                                
                                        </p>
                                    </td>
                                    
                                    <td><?php echo money($v['rate']); ?></td>
                                    <td><?php echo $v['quantity']; ?></td>
                                    <td class="highlight text-right"><?php echo money($v['amount']); ?></td>
                                </tr>
                            <?php endforeach;?>
                        </tbody> 
                        
                    </table>
                    <h5>Services</h5>
                    <table class="table i-table m-t-25 m-b-25">
                        <thead class="text-uppercase">
                            <tr>
                                <th class="c-gray">DESCRIPTION</th>
                                <th class="c-gray">UNIT PRICE</th>
                                <th class="c-gray">QUANTITY</th>
                                <th class="highlight">TOTAL</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php foreach($purchase['service'] as $v) :?>
                                <tr>
                                    <td width="50%">
                                        <h5 class="text-uppercase f-400"><?php echo $v['name']; ?></h5>
                                        <p class="text-muted">
                                            <?php echo show($v['description'], 'N/A'); ?>
                                                
                                        </p>
                                    </td>
                                    
                                    <td><?php echo money($v['rate']); ?></td>
                                    <td><?php echo $v['quantity']; ?></td>
                                    <td class="highlight text-right"><?php echo money($v['amount']); ?></td>
                                </tr>
                            <?php endforeach;?>
                        </tbody> 
                        
                    </table>
                    <h5>Others</h5>
                    <table class="table i-table m-t-25 m-b-25">
                        <thead class="text-uppercase">
                            <tr>
                                <th class="c-gray">DESCRIPTION</th>
                                <th class="c-gray">UNIT PRICE</th>
                                <th class="c-gray">QUANTITY</th>
                                <th class="highlight">TOTAL</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php foreach($purchase['other'] as $v) :?>
                                <tr>
                                    <td width="50%">
                                        <h5 class="text-uppercase f-400"><?php echo $v['name']; ?></h5>
                                        <p class="text-muted">
                                            <?php echo show($v['description'], 'N/A'); ?>
                                                
                                        </p>
                                    </td>
                                    
                                    <td><?php echo money($v['rate']); ?></td>
                                    <td><?php echo $v['quantity']; ?></td>
                                    <td class="highlight text-right"><?php echo money($v['amount']); ?></td>
                                </tr>
                            <?php endforeach;?>
                        </tbody> 
                        
                    </table>
                    <table class="table invoice-total">
                        <tbody>
                        <tr>
                            <td><strong>Sub Total :</strong></td>
                            <td><?php echo money($purchase['total_amount']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>TOTAL :</strong></td>
                            <td><?php echo money($purchase['total_amount']); ?></td>
                        </tr>
                        </tbody>
                    </table>
                    
                    <div class="clearfix"></div>
                    
                    <div class="p-25 row">
                        
                        <div class="col-lg-4">
                            <h4 class="c-blue f-400">Delivery Address</h4>
                            <address>
                                <?=$org['address']; ?>
                                <br>
                                <?=$org['city'].', '.
                                    $org['province'].' ('.
                                    $org['zip'].')'; ?>
                                <br>
                                <?=$org['country']; ?>
                            </address>
                           
                            <b>Phone :</b> <?=show($org['phone'], 'N/A'); ?><br>
                            <b>Mobile :</b> <?=show($org['Mobile'], 'N/A'); ?><br>
                            <b>Email :</b> <?=show($org['email'], 'N/A'); ?>
                        </div>
                        <div class="col-lg-4">
                            <h4 class="c-blue f-400">Attention</h4>
                            <p class="c-gray"><?=show($purchase['attention'], 'N/A')?></p>
                        </div>
                        <div class="col-lg-4">
                            <h4 class="c-blue f-400">Instruction</h4>
                            <p class="c-gray"><?=show($purchase['instruction'], 'N/A')?></p>
                        </div>
                    </div>
                </div>
                
            </div>
	    </div>
	</section>
</section>

<?php include(APPPATH.'/views/common/footer.php'); ?>