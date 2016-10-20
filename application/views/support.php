<?php include(APPPATH.'/views/common/support_header.php'); ?>

<style>
.overlay-close{
	position: absolute;
    right: 10px;
    top: 10px;
    border: none;
    font-size: 40px;
    background-color: transparent;
    font-weight: 300;
}

.overlay {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
}

.logo a {
    color: #313534;
    text-transform: initial!important; 
    display: table-cell!important;
    font-size: 13px!important;
}

a.text-medium.text-lg.text-primary {
    padding: 0px!important;
}

a.text-primary:hover {
    color: #0c7cd5!important;
}

.pagination > li > a, .pagination > li > span {
    padding: 0!important;
}

</style>
<!-- Content -->
<div class="overlay"  id="support">
<section id="main" data-layout="layout-1">
	<div class="container">

		 <button type="button" class="overlay-close">X</button>
		<!-- Add button -->
        <button id="" class="btn btn-float btn-circle-shape btn-primary-color m-btn" data-toggle="tooltip" data-placement="left" title="" data-original-title=""><i class="zmdi zmdi-plus"></i></button>

    	<h3 class="support center">Welcome to Knowledge Base and Forum</h3>

    	<div class="row">
            <div class="col-lg-12">
                <!-- BEGIN SEARCH BAR -->
				<div class="card-body style-primary no-y-padding">
					<form class="form form-inverse">
						<div class="form-group">
							<div class="input-group input-group-lg">
								<div class="input-group-content">
									<input type="text" class="form-control" id="searchInput" placeholder="Enter your search here">
									<div class="form-control-line"></div>
								</div>
								<div class="input-group-btn">
									<button class="btn btn-floating-action btn-default-bright" type="button"><i class="fa fa-search"></i></button>
								</div>
							</div>
						</div><!--end .form-group -->
					</form>
				</div><!--end .card-body -->
				<!-- END SEARCH BAR -->

				<!-- BEGIN TAB CONTENT -->
				<div class="card-body tab-content style-default-bright">
					<div class="tab-pane active" id="web1">
						<div class="row">
							<div class="col-lg-12">

								<!-- BEGIN PAGE HEADER -->
								<div class="margin-bottom-xxl">
									<span class="text-light text-lg">Search results <strong>34</strong></span>
								</div><!--end .margin-bottom-xxl -->
								<!-- END PAGE HEADER -->

								<!-- BEGIN RESULT LIST -->
								<div class="list-results list-results-underlined">
									<div class="col-xs-12">
										<p>
											<a class="text-medium text-lg text-primary" href="#">Sample Article</a>
											<small class="updated-time">Last Updated : in a few seconds at 8:22 am - 06/07/2016</small>
										</p>
										<div class="contain-xs pull-left">
											Search results where only texts will be shown. You can decide for yourself how much text you want to display in this field.
										</div>

										<div class="supportEdit-icon pull-right">
											<a class="btn btn-flat ink-reaction btn-default">
												<i class="fa fa-edit"></i>
											</a>
											<a class="btn btn-flat ink-reaction btn-default">
												<i class="fa fa-trash"></i>
											</a>
										</div>
									</div>

									<div class="col-xs-12">
										<p>
											<a class="text-medium text-lg text-primary" href="#">Sample Article</a>
											<small class="updated-time">Last Updated : in a few seconds at 8:22 am - 06/07/2016</small>
										</p>
										<div class="contain-xs pull-left">
											Search results where only texts will be shown. You can decide for yourself how much text you want to display in this field.
										</div>

										<div class="supportEdit-icon pull-right">
											<a class="btn btn-flat ink-reaction btn-default">
												<i class="fa fa-edit"></i>
											</a>
											<a class="btn btn-flat ink-reaction btn-default">
												<i class="fa fa-trash"></i>
											</a>
										</div>
									</div>
								</div><!--end .list-results -->
								<!-- END RESULTS LIST -->

								<!-- BEGIN PAGING -->
								<ul class="pagination">
									<li class="disabled"><a href="#">«</a></li>
									<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
									<li><a href="#">2</a></li>
									<li><a href="#">3</a></li>
									<li><a href="#">4</a></li>
									<li><a href="#">5</a></li>
									<li><a href="#">»</a></li>
								</ul>
								<!-- END PAGING -->

							</div><!--end .col -->
						</div><!--end .row -->
					</div><!--end .tab-pane -->
				</div><!--end .card-body -->
				<!-- END TAB CONTENT -->
            </div>
        </div>
    </div>
</section>
</div>


