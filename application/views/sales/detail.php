<?php include(APPPATH.'/views/common/header.php'); ?>
<?php include(APPPATH.'/views/common/top_menu.php'); ?>
<!-- Content -->
<section id="main" data-layout="layout-1">
	<?php include(APPPATH.'/views/common/sidebar.php'); ?>

	<section id="content">
		
	    <div class="container">
	    	<div class="block-header pull-left">
                <h2>Sales Invoice Detail</h2>
                <ol class="breadcrumb breadcrums2">
                    <li><a href="/app">Home</a></li>
                    <li><a href="/sales/listing">Invoice List</a></li>
                    <li class="active" id="main-list-breadcrums">
                        Sales Invoice Detail
                    </li>
                </ol>
            </div>
            <div class="pull-right m-t-10">
                <?php if(isAdmin()):?>
                    <?php if($invoice['status'] == 1) :?>
                        <button class="btn btn-primary btn-icon-text invoice-approve" invoice-id="<?=$id;?>">
                            <i class="zmdi zmdi-check"></i> Approve Invoice
                        </button>
                        <button class="btn btn-danger btn-icon-text invoice-decline" invoice-id="<?=$id;?>">
                            <i class="zmdi zmdi-close"></i> Decline Invoice
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
                            <a class="invoice-delete" invoice-id="<?=$id;?>">
                                <i class="zmdi zmdi-delete"></i>
                            </a>
                        </li>
                        <li>
                            <a href="" id="invoice-print">
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
                                    Invoice Number <br>
                                    <span class="c-blue"><?=$invoice['invoice_number']; ?></span>
                                </h4>
                                
                                <span class="text-muted">
                                    Ref Number : <?=show($invoice['reference_number'], 'N/A'); ?><br>
                                    Date : <?=show($invoice['date'], 'N/A'); ?><br>
                                    Due Date : <?=show($invoice['due_date'], 'N/A'); ?><br>
                                </span>

                            </div>
                        </div>
                        
                        <div class="col-xs-6">
                            <div class="i-to text-right">
                                <h4>
                                    <?=$invoice['customer']['company_name']; ?> 
                                    <?=show('#'.$invoice['customer']['account_number']); ?>
                                </h4>
                                
                                <span class="text-muted">
                                    <address>
                                        <?=$invoice['customer']['address']; ?>
                                        <br>
                                        <?=$invoice['customer']['city'].', '.
                                            $invoice['customer']['province'].' ('.
                                            $invoice['customer']['zip'].')'; ?>
                                        <br>
                                        <?=$invoice['customer']['country']; ?>
                                    </address>
        
                                    Phone : <?=show($invoice['customer']['phone'], 'N/A'); ?><br>
                                    Mobile : <?=show($invoice['customer']['Mobile'], 'N/A'); ?><br>
                                    Email : <?=show($invoice['customer']['email'], 'N/A'); ?>
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
                                <th class="c-gray">DISC</th>
                                <th class="highlight">TOTAL</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php foreach($invoice['line'] as $v) :?>
                                <tr>
                                    <td width="50%">
                                        <h5 class="text-uppercase f-400"><?php echo $v['name']; ?></h5>
                                        <p class="text-muted">
                                            <?php echo show($v['description'], 'N/A'); ?>
                                                
                                        </p>
                                    </td>
                                    
                                    <td><?php echo money($v['rate']); ?></td>
                                    <td><?php echo $v['quantity']; ?></td>
                                    <td><?php echo $v['disc']; ?></td>
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
                                <th class="c-gray">DISC</th>
                                <th class="highlight">TOTAL</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php foreach($invoice['service'] as $v) :?>
                                <tr>
                                    <td width="50%">
                                        <h5 class="text-uppercase f-400"><?php echo $v['name']; ?></h5>
                                        <p class="text-muted">
                                            <?php echo show($v['description'], 'N/A'); ?>
                                                
                                        </p>
                                    </td>
                                    
                                    <td><?php echo money($v['rate']); ?></td>
                                    <td><?php echo $v['quantity']; ?></td>
                                    <td><?php echo $v['disc']; ?></td>

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
                                <th class="c-gray">DISC</th>
                                <th class="highlight">TOTAL</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php foreach($invoice['other'] as $v) :?>
                                <tr>
                                    <td width="50%">
                                        <h5 class="text-uppercase f-400"><?php echo $v['name']; ?></h5>
                                        <p class="text-muted">
                                            <?php echo show($v['description'], 'N/A'); ?>
                                                
                                        </p>
                                    </td>
                                    
                                    <td><?php echo money($v['rate']); ?></td>
                                    <td><?php echo $v['quantity']; ?></td>
                                    <td><?php echo $v['disc']; ?></td>
                                    <td class="highlight text-right"><?php echo money($v['amount']); ?></td>
                                </tr>
                            <?php endforeach;?>
                        </tbody> 
                    </table>

                    <table class="table invoice-total">
                        <tbody>
                        <tr>
                            <td><strong>Sub Total :</strong></td>
                            <td><?php echo money($invoice['total_amount']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>TOTAL :</strong></td>
                            <td><?php echo money($invoice['total_amount']); ?></td>
                        </tr>
                        </tbody>
                    </table>
                    
                    <div class="clearfix"></div>
                </div>
            </div>
	    </div>
	</section>
</section>

<?php include(APPPATH.'/views/common/footer.php'); ?>