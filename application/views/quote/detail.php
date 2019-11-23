<?php include(APPPATH.'/views/common/header.php'); ?>
<?php include(APPPATH.'/views/common/top_menu.php'); ?>
<!-- Content -->
<section id="main" data-layout="layout-1">
	<?php include(APPPATH.'/views/common/sidebar.php'); ?>

	<section id="content">
		
	    <div class="container">
	    	<div class="block-header pull-left">
                <h2>Sales Quote Detail</h2>
                <ol class="breadcrumb breadcrums2">
                    <li><a href="/app">Home</a></li>
                    <li><a href="/quote/listing">Quote List</a></li>
                    <li class="active" id="main-list-breadcrums">
                        Sales Quote Detail
                    </li>
                </ol>
            </div>
            <div class="pull-right m-t-10">
                <?php if($quote['status'] != 4) : ?>
                    <!-- IF DRAFT -->
                    <?php if($quote['status'] == 2) : ?>
                        <button class="btn bgm-orange btn-icon-text quote-sent" quote-id="<?=$id;?>">
                            <i class="zmdi zmdi-check"></i> Mark as Sent Quotation
                        </button>
                    <!-- IF SENT -->
                    <?php elseif($quote['status'] == 1) : ?>
                        <button class="btn bgm-blue btn-icon-text quote-accept" quote-id="<?=$id;?>">
                            <i class="zmdi zmdi-check"></i> Mark as Accepted Quotation
                        </button>
                    <!-- IF ACCEPTED -->
                    <?php elseif($quote['status'] == 3) : ?>
                        <button class="btn bgm-lightgreen btn-icon-text quote-convert" quote-id="<?=$id;?>">
                            <i class="zmdi zmdi-check"></i> Convert Quotation as Invoice
                        </button>
                    <?php endif;?>
                <?php endif;?>
                
            </div>
            <div class="clearfix"></div>
	       
           <!-- dont load yet the PDF so dont put to src attribute -->
            <iframe id="report-frame" class="hide" data-src="<?=$pdfLink; ?>" allowfullscreen webkitallowfullscreen></iframe>

            <div class="card">
                <div class="card-header ch-alt">
                    <button class="btn btn-xs <?=$status_class;?>"><?=$status_text;?></button>

                    <ul class="lv-actions actions">
                        <?php if($quote['status'] != 4) : ?>
                            <li>
                                <a class="quote-edit" quote-id="<?=$id;?>">
                                    <i class="zmdi zmdi-edit"></i>
                                </a>
                            </li>
                            <li>
                                <a class="quote-delete" quote-id="<?=$id;?>">
                                    <i class="zmdi zmdi-delete"></i>
                                </a>
                            </li>
                            <li>
                                <!-- <a href="" onclick="window.print();"> -->
                                <a href="" id="quote-print">
                                    
                                    <i class="zmdi zmdi-print"></i>
                                </a>
                            </li>
                        <?php endif;?>
                    </ul>
                </div>
                
                <div class="card-body card-padding" id="section-to-print">
                    <div class="row m-b-25">
                        <div class="col-xs-6">
                            <div class="text-left m-l-20">
                                <h4>
                                    Quote Number <br>
                                    <span class="c-blue" id="quote-number"><?=$quote['quote_number']; ?></span>
                                </h4>
                                
                                <span class="text-muted">
                                    Ref Number : <?=show($quote['reference_number'], 'N/A'); ?><br>
                                    Date : <?=show($quote['date'], 'N/A'); ?><br>
                                    Expiry : <?=show($quote['due_date'], 'N/A'); ?><br>
                                </span>

                            </div>
                        </div>
                        
                        <div class="col-xs-6">
                            <div class="i-to text-right">
                                <h4>
                                    <?=$quote['customer']['company_name']; ?> 
                                </h4>
                                
                                <span class="text-muted">
                                    <address>
                                        <?=$quote['customer']['address']; ?>
                                        <br>
                                        <?=$quote['customer']['city'].', '.
                                            $quote['customer']['province'].' ('.
                                            $quote['customer']['zip'].')'; ?>
                                        <br>
                                        <?=$quote['customer']['country']; ?>
                                    </address>
        
                                    Phone : <?=show($quote['customer']['phone'], 'N/A'); ?><br>
                                    Mobile : <?=show($quote['customer']['Mobile'], 'N/A'); ?><br>
                                    Email : <?=show($quote['customer']['email'], 'N/A'); ?>
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
                            <?php foreach($quote['line'] as $v) :?>
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
                    <!-- <h5>Services</h5>
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
                            <?php foreach($quote['service'] as $v) :?>
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
                    </table> -->
                    <h5>Services/ Others</h5>
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
                            <?php foreach($quote['other'] as $v) :?>
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
                            <td><?php echo money($quote['total_amount']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>TOTAL :</strong></td>
                            <td><?php echo money($quote['total_amount']); ?></td>
                        </tr>
                        </tbody>
                    </table>
                
                    <div class="clearfix"></div>
                    <div class="p-25 row">
                        
                        <div class="col-lg-3">
                            <h4 class="c-blue f-400">Title</h4>
                            <p class="c-gray"><?=show($quote['title'], 'N/A')?></p>
                        </div>
                        <div class="col-lg-3">
                            <h4 class="c-blue f-400">Summary</h4>
                            <p class="c-gray"><?=show($quote['summary'], 'N/A')?></p>
                        </div>
                        <div class="col-lg-3">
                            <h4 class="c-blue f-400">Terms</h4>
                            <p class="c-gray"><?=show($quote['terms'], 'N/A')?></p>
                        </div>
                        <div class="col-lg-3">
                            <h4 class="c-blue f-400">Validity</h4>
                            <p class="c-gray"><?=show($quote['validity'], 'N/A')?></p>
                        </div>
                    </div>
                   

                </div>
                <!-- <footer class="m-t-15 p-20">
                    <ul class="list-inline text-center list-unstyled">
                        <li class="m-l-5 m-r-5"><small>support@company.com</small></li>
                        <li class="m-l-5 m-r-5"><small>00971 452 9900</small></li>
                        <li class="m-l-5 m-r-5"><small>www.company.com</small></li>
                    </ul>
                </footer> -->
            </div>
	    </div>
	</section>
</section>

<?php include(APPPATH.'/views/quote/add-quote-modal.php'); ?>
<?php include(APPPATH.'/views/common/footer.php'); ?>