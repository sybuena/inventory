<?php include(APPPATH.'/views/common/header.php'); ?>
<?php include(APPPATH.'/views/common/top_menu.php'); ?>
<!-- Content -->
<section id="main" data-layout="layout-1">
	<?php include(APPPATH.'/views/common/sidebar.php'); ?>

	<section id="content">
		
	    <div class="container">
	    	<div class="block-header pull-left">
                <h2>Job Order Detail</h2>
                <ol class="breadcrumb breadcrums2">
                    <li><a href="/app">Home</a></li>
                    <li><a href="/jobOrder/listing">Job Order List</a></li>
                    <li class="active" id="main-list-breadcrums">
                        Job Order Detail
                    </li>
                </ol>
            </div>
            <div class="pull-right m-t-10">
                <?php if($jobOrder['status'] != 4) : ?>
                    <!-- IF DRAFT -->
                    <?php if($jobOrder['status'] == 2) : ?>
                        <button class="btn bgm-orange btn-icon-text job-order-sent" job-order-id="<?=$id;?>">
                            <i class="zmdi zmdi-check"></i> Mark as Sent Job Order
                        </button>
                    <!-- IF SENT -->
                    <?php elseif($jobOrder['status'] == 1) : ?>
                        <button class="btn bgm-blue btn-icon-text job-order-accept" job-order-id="<?=$id;?>">
                            <i class="zmdi zmdi-check"></i> Mark as Accepted Job Order
                        </button>
                    <!-- IF ACCEPTED -->
                    <?php elseif($jobOrder['status'] == 3) : ?>
                        <button class="btn bgm-lightgreen btn-icon-text job-order-convert" job-order-id="<?=$id;?>">
                            <i class="zmdi zmdi-check"></i> Convert Job Order as Invoice
                        </button>
                    <?php endif;?>
                <?php endif;?>
                
            </div>
            <div class="clearfix"></div>
	      
            <div class="card">
                <div class="card-header ch-alt">
                    <button class="btn btn-xs <?=$status_class;?>"><?=$status_text;?></button>

                    <ul class="lv-actions actions">
                        <?php if($jobOrder['status'] != 4) : ?>
                            <li>
                                <a class="job-order-edit" job-order-id="<?=$id;?>">
                                    <i class="zmdi zmdi-edit"></i>
                                </a>
                            </li>
                            <li>
                                <a class="job-order-delete" job-order-id="<?=$id;?>">
                                    <i class="zmdi zmdi-delete"></i>
                                </a>
                            </li>
                            <li>
                                <a href="" onclick="window.print();">
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
                                    Job Order Number <br>
                                    <span class="c-blue" id="job-order-number"><?=$jobOrder['job_order_number']; ?></span>
                                </h4>
                                
                                <span class="text-muted">
                                    Ref Number : <?=show($jobOrder['reference_number'], 'N/A'); ?><br>
                                    Date : <?=show($jobOrder['date'], 'N/A'); ?><br>
                                    Expiry : <?=show($jobOrder['due_date'], 'N/A'); ?><br>
                                </span>

                            </div>
                        </div>
                        
                        <div class="col-xs-6">
                            <div class="i-to text-right">
                                <h4>
                                    <?=$jobOrder['customer']['company_name']; ?> 
                                    
                                </h4>
                                
                                <span class="text-muted">
                                    <address>
                                        <?=$jobOrder['customer']['tin']; ?>
                                        <?=$jobOrder['customer']['address']; ?>
                                        <br>
                                        <?=$jobOrder['customer']['city'].', '.
                                            $jobOrder['customer']['province'].' ('.
                                            $jobOrder['customer']['zip'].')'; ?>
                                        <br>
                                        <?=$jobOrder['customer']['country']; ?>
                                    </address>
        
                                    Phone : <?=show($jobOrder['customer']['phone'], 'N/A'); ?><br>
                                    Mobile : <?=show($jobOrder['customer']['Mobile'], 'N/A'); ?><br>
                                    Email : <?=show($jobOrder['customer']['email'], 'N/A'); ?>
                                </span>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="clearfix"></div>
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
                            <?php foreach($jobOrder['service'] as $v) :?>
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
                            <?php foreach($jobOrder['other'] as $v) :?>
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
                            <td><?php echo money($jobOrder['total_amount']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>TOTAL :</strong></td>
                            <td><?php echo money($jobOrder['total_amount']); ?></td>
                        </tr>
                        </tbody>
                    </table>
                
                    <div class="clearfix"></div>
                    <div class="p-25 row">
                        
                        <div class="col-lg-4">
                            <h4 class="c-blue f-400">Title</h4>
                            <p class="c-gray"><?=show($jobOrder['title'], 'N/A')?></p>
                        </div>
                        <div class="col-lg-4">
                            <h4 class="c-blue f-400">Summary</h4>
                            <p class="c-gray"><?=show($jobOrder['summary'], 'N/A')?></p>
                        </div>
                        <div class="col-lg-4">
                            <h4 class="c-blue f-400">Terms</h4>
                            <p class="c-gray"><?=show($jobOrder['terms'], 'N/A')?></p>
                        </div>

                        <div class="col-lg-4">
                            <h4 class="c-blue f-400">Engine Model</h4>
                            <p class="c-gray"><?=show($jobOrder['model'], 'N/A')?></p>
                        </div>

                        <div class="col-lg-4">
                            <h4 class="c-blue f-400">Engine Serial Number</h4>
                            <p class="c-gray"><?=show($jobOrder['serial'], 'N/A')?></p>
                        </div>

                        <div class="col-lg-4">
                            <h4 class="c-blue f-400">Technician</h4>
                            <p class="c-gray"><?=show($jobOrder['tech'], 'N/A')?></p>
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

<?php include(APPPATH.'/views/jobOrder/add-job-order-modal.php'); ?>
<?php include(APPPATH.'/views/common/footer.php'); ?>