<?php include(APPPATH.'/views/common/header.php'); ?>
<?php include(APPPATH.'/views/common/top_menu.php'); ?>
<style>
.h1-font-20 {
    font-size: 20px;
}
a.icons, span.icons, div.icons {
    display: block;
    background: transparent url(/assets/img/icons-18150a92.png) no-repeat 0 0;
    width: 16px;
    height: 16px;
}
span.excel, em.excel {
    background-position: -60px 0;
}
span.icons {
    display: inline-block;
}
.alert-special {
    padding: 20px;
    margin: 20px 0;
    border: 1px solid #eee;
    border-left-width: 5px;
    border-radius: 3px;
    border-left-color: #2196f3;
}
</style>
<!-- Content -->
<section id="main" data-layout="layout-1">
	<?php include(APPPATH.'/views/common/sidebar.php'); ?>

	<section id="content">
	    <div class="container">
	        <div class="block-header">
	            <h2>Inventory Import</h2>
                <ol class="breadcrumb breadcrums2">
                    <li><a href="/app">Home</a></li>
                    <li><a href="/inventory/listing">Inventory List</a></li>
                    <li class="active">Import</li>
                </ol>
	            
            </div>
          
            <div class="card m-b-0" id="messages-main">
                

                <div class="lv-header-alt clearfix m-b-5">
                    <h2 class="lvh-label hidden-xs">
                        To import inventory from another system please follow the steps below:
                    </h2>
                </div>
                                    
                <div class="card-body card-padding m-l-30">
                    <div class="alert alert-danger display-none" id="inventory-import-alert-error">
                        <span class="fa fa-warning fa-4x pull-left" aria-hidden="true"></span>
                        <span class="alert-error-span pull-left">
                            <h4>Oh Snap! Something went wrong</h4>
                            <span class="alert-error-custom"></span>
                        </span>
                        <div class="clearfix"></div>
                    </div>

                    <div class="alert alert-special display-none" id="inventory-import-message">
                        <span class="alert-error-span">
                            <h3 class="c-blue">Heads Up! Before you continue to import</h3>
                            <p>Please take time to review the data that we parse from the CSV file below.</p>
                            <span class="alert-error-custom"></span>
                        </span>
                        <div class="alert-error-confirm m-t-10 m-b-5">
                            If you want to continue with this importing, please click <b>"Continue Import"</b> button, or if you want to import a new csv file, just click the <b>"Browse"</b> button and <b>"Import"</b> again.
                        </div>
                        <br/>
                        <div class="pull-right">
                            <button class="btn btn-primary" id="inventory-import-continue-import">Continue Import</button>
                        </div>
                        
                        <div class="clearfix"></div>

                    </div>

                    <h1 class="h1-font-20">Step 1. Download our inventory template file</h1>
                    <div class="m-l-30">
                        <a class="file" id="import-import-download" download="">
                            <span class="icons excel">&nbsp;
                        </span> 
                            <b>Download template by clicking here</b>
                        </a>
                        <p class="m-l-20">
                            - Required fields :
                            <i>(Name, Type, Code)</i>
                        </p>
                    </div>
                    <h1 class="h1-font-20 step">Step 2. Copy your contacts into the template</h1>
                    <div class="m-l-30">
                        <p>
                            Export your import from your old system as a comma separated list. Using Excel or another spreadsheet editor, copy and paste your import from the exported file into the provided template. Make sure the import data you copy matches the column headings provided in the template.
                        </p>

                        <p class="c-red">
                            IMPORTANT: Do not change the column headings in the template file. These need to be unchanged for the import to work in the next step.
                        </p>
                    </div>
                    <div id="crm-import-form" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
                        
                        <h1 class="h1-font-20 step">Step 3. Import the updated template file</h1>
                        
                        <div class="m-l-30">      
                            <p>Choose a file to import</p>
                            <p class="c-red">
                                IMPORTANT : The file type you need to import must be a CSV (Comma Separated Values) file. Importing differennt file type will cause the import process to error
                            </p>
                            <span class="btn btn-primary btn-file">
                                Browse<input type="file" id="inventory-import-src">
                            </span>
                            <small class="file-selected"> No file selected </small>
                            
                            
                        </div>

                        <div class="modal-footer">           

                            <button class="btn btn-primary" type="submit" id="inventory-import-now">
                                Import Inventory
                            </button>
                        
                            <a href="/inventory/listing" class="btn bgm-gray">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
                

	    </div>
	</section>
</section>

<?php include(APPPATH.'/views/common/footer.php'); ?>