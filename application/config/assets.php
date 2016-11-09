<?php
$vendor = '/assets/vendors/bower_components/';

$config['login_css']   = array(
	'/assets/css/app.min.1.css',
    '/assets/css/app.min.2.css',
    '/assets/css/login.css',
    $vendor.'animate.css/animate.min.css',
    $vendor.'material-design-iconic-font/dist/css/material-design-iconic-font.min.css',
    '/assets/material/css/wizard.css',
    $vendor.'bootstrap-sweetalert/lib/sweet-alert.css',
 );

$config['login_js']    = array(
	$vendor.'jquery/dist/jquery.min.js',
    $vendor.'bootstrap/dist/js/bootstrap.min.js',
    $vendor.'Waves/dist/waves.min.js',
    $vendor.'bootstrap-sweetalert/lib/sweet-alert.min.js',
    '/assets/js/functions.js',
    '/assets/js/pwstrength.js',
    '/assets/js/app/base.js',
    '/assets/js/app/login.js',
    '/assets/material/js/libs/wizard/jquery.bootstrap.wizard.min.js',
    
   	// '/assets/material/js/core/demo/DemoFormWizard.js'
);  

$config['landing_css'] = array(
	'/assets/css/app.min.1.css',
	'/assets/css/app.min.2.css',
	'/assets/css/style.css',
	'/assets/css/style-css.css',
	$vendor.'fullcalendar/dist/fullcalendar.min.css',
	$vendor.'animate.css/animate.min.css',
	// $vendor.'bootstrap-sweetalert/lib/sweet-alert.css',
   	$vendor.'sweetalert/dist/sweetalert.css',
	$vendor.'material-design-iconic-font/dist/css/material-design-iconic-font.min.css',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css',
	'/assets/material/css/wizard.css'
   	);  

$config['landing_js']  = array(
	//PLUGINS
	$vendor.'jquery/dist/jquery.min.js',
   	$vendor.'bootstrap/dist/js/bootstrap.min.js',
   	$vendor.'flot/jquery.flot.js',
   	$vendor.'flot/jquery.flot.resize.js',
   	$vendor.'flot.curvedlines/curvedLines.js',
   	'/assets/vendors/sparklines/jquery.sparkline.min.js',
   	$vendor.'jquery.easy-pie-chart/dist/jquery.easypiechart.min.js',
   	$vendor.'moment/min/moment.min.js',
   	$vendor.'fullcalendar/dist/fullcalendar.min.js',
   	$vendor.'simpleWeather/jquery.simpleWeather.min.js',
   	$vendor.'Waves/dist/waves.min.js',
   	'/assets/vendors/bootstrap-growl/bootstrap-growl.min.js',
   	$vendor.'sweetalert/dist/sweetalert-dev.js',
   	// $vendor.'sweetalert/dist/sweetalert2-dev.js',
   	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
   	//MATERIAL PLUGIN
   	'/assets/material/js/libs/wizard/jquery.bootstrap.wizard.min.js',
   	// '/assets/material/js/core/demo/DemoFormWizard.js',
   	'/assets/js/flot-charts/curved-line-chart.js',
   	'/assets/js/oauthpopup.js',
   	'/assets/js/flot-charts/line-chart.js',
   	'/assets/js/charts.js',
   	'/assets/js/moment.min.js',
   	'/assets/js/functions.js',
   	'/assets/js/demo.js',
   	//APP JS
   	'/assets/js/app/base.js',
   	// '/assets/js/app/login.js',
   	'/assets/js/app/landing.js',
   	// '/assets/js/app/setUp.js'
);

$config['digong_css']  = array(
	'/assets/css/app.min.1.css',
	'/assets/css/app.min.2.css',
	'/assets/css/style-css.css',
	'/assets/css/style.css',
   	'/assets/overlay/css/style1.css',
	$vendor.'animate.css/animate.min.css',
	$vendor.'fullcalendar/dist/fullcalendar.min.css',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.css',
	$vendor.'material-design-iconic-font/dist/css/material-design-iconic-font.min.css',
	'/assets/vendors/bootgrid/jquery.bootgrid.min.css',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
	$vendor.'lightgallery/light-gallery/css/lightGallery.css',
	'/assets/font-awesome/css/font-awesome.min.css'

	);

$config['digong_js']   = array(
	$vendor.'jquery/dist/jquery.min.js',
	$vendor.'bootstrap/dist/js/bootstrap.min.js',
	'/assets/material/js/libs/wizard/jquery.bootstrap.wizard.min.js',
	$vendor.'flot/jquery.flot.js',
	$vendor.'flot/jquery.flot.resize.js',
	$vendor.'flot.curvedlines/curvedLines.js',
	'/assets/vendors/sparklines/jquery.sparkline.min.js',
	$vendor.'jquery.easy-pie-chart/dist/jquery.easypiechart.min.js',
	$vendor.'moment/min/moment.min.js',
	$vendor.'fullcalendar/dist/fullcalendar.min.js',
	$vendor.'simpleWeather/jquery.simpleWeather.min.js',
	$vendor.'Waves/dist/waves.min.js',
	'/assets/vendors/bootstrap-growl/bootstrap-growl.min.js',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.min.js',
	$vendor.'lightgallery/light-gallery/js/lightGallery.min.js',
	$vendor.'autosize/dist/autosize.min.js',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
	'/assets/js/flot-charts/curved-line-chart.js',
	'/assets/js/flot-charts/line-chart.js',
	$vendor.'chosen/chosen.jquery.min.js',
	'/assets/vendors/bootgrid/jquery.bootgrid.updated.min.js',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
	'/assets/vendors/fileinput/fileinput.min.js',
	'/assets/vendors/input-mask/input-mask.min.js',
	'/assets/vendors/farbtastic/farbtastic.min.js',
	'/assets/vendors/autocomplete/jquery.autocomplete.min.js',
	'/assets/js/charts.js',
	'/assets/js/timer.jquery.js',
	'/assets/js/functions.js',
	'/assets/js/demo.js',

	
	//APP JS
	'/assets/js/app/base.js',
	'/assets/js/app/dashboard.js',
   	// '/assets/js/app/setUp.js',
	//'/assets/js/app/digong.js',
	//'/assets/js/app/settings.js',
	//'/assets/js/app/taxRates.js',
	//'/assets/js/app/accountSettings.js',
   	// '/assets/material/js/core/demo/DemoFormWizard.js'
);

$config['accountSettings_css']  = array(
	'/assets/css/app.min.1.css',
	'/assets/css/app.min.2.css',
	'/assets/css/style.css',
	'/assets/css/style-css.css',
	$vendor.'animate.css/animate.min.css',
	$vendor.'fullcalendar/dist/fullcalendar.min.css',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.css',
	$vendor.'material-design-iconic-font/dist/css/material-design-iconic-font.min.css',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css',
	$vendor.'lightgallery/light-gallery/css/lightGallery.css',
	'/assets/font-awesome/css/font-awesome.min.css');

$config['accountSettings_js']   = array(
	$vendor.'jquery/dist/jquery.min.js',
	$vendor.'bootstrap/dist/js/bootstrap.min.js',
	$vendor.'flot/jquery.flot.js',
	$vendor.'flot/jquery.flot.resize.js',
	$vendor.'flot.curvedlines/curvedLines.js',
	'/assets/vendors/sparklines/jquery.sparkline.min.js',
	$vendor.'jquery.easy-pie-chart/dist/jquery.easypiechart.min.js',
	$vendor.'moment/min/moment.min.js',
	$vendor.'fullcalendar/dist/fullcalendar.min.js',
	$vendor.'simpleWeather/jquery.simpleWeather.min.js',
	$vendor.'Waves/dist/waves.min.js',
	'/assets/vendors/bootstrap-growl/bootstrap-growl.min.js',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.min.js',
	$vendor.'lightgallery/light-gallery/js/lightGallery.min.js',
	$vendor.'autosize/dist/autosize.min.js',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
	'/assets/js/flot-charts/curved-line-chart.js',
	'/assets/js/flot-charts/line-chart.js',
	$vendor.'chosen/chosen.jquery.min.js',
	'/assets/vendors/fileinput/fileinput.min.js',
	'/assets/vendors/input-mask/input-mask.min.js',
	'/assets/vendors/farbtastic/farbtastic.min.js',
	'/assets/js/charts.js',
	'/assets/js/functions.js',
	'/assets/js/demo.js',
	//APP JS
	'/assets/js/app/base.js',
	'/assets/js/app/accountSettings.js',
);

$config['settings_css']  = array(
	'/assets/css/style.css',
	'/assets/css/style-css.css',
	$vendor.'animate.css/animate.min.css',
	$vendor.'fullcalendar/dist/fullcalendar.min.css',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.css',
	$vendor.'material-design-iconic-font/dist/css/material-design-iconic-font.min.css',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css',
	$vendor.'bootstrap-select/dist/css/bootstrap-select.css',
	'/assets/vendors/bootgrid/jquery.bootgrid.min.css',
	$vendor.'chosen/chosen.min.css',
	'/assets/font-awesome/css/font-awesome.min.css',
	'/assets/css/app.min.1.css',
	'/assets/css/app.min.2.css',
);

$config['settings_js']   = array(
	$vendor.'jquery/dist/jquery.min.js',
	$vendor.'bootstrap/dist/js/bootstrap.min.js',
	$vendor.'flot/jquery.flot.js',
	$vendor.'flot/jquery.flot.resize.js',
	$vendor.'flot.curvedlines/curvedLines.js',
	'/assets/vendors/sparklines/jquery.sparkline.min.js',
	$vendor.'jquery.easy-pie-chart/dist/jquery.easypiechart.min.js',
	$vendor.'moment/min/moment.min.js',
	$vendor.'fullcalendar/dist/fullcalendar.min.js',
	$vendor.'simpleWeather/jquery.simpleWeather.min.js',
	$vendor.'Waves/dist/waves.min.js',
	'/assets/vendors/bootstrap-growl/bootstrap-growl.min.js',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.min.js',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
	$vendor.'bootstrap-select/dist/js/bootstrap-select.js',
	'/assets/js/flot-charts/curved-line-chart.js',
	'/assets/js/jquery-debounce-min.js',
	'/assets/js/flot-charts/line-chart.js',
	$vendor.'chosen/chosen.jquery.min.js',
	'/assets/vendors/fileinput/fileinput.min.js',
	'/assets/vendors/input-mask/input-mask.min.js',
	'/assets/vendors/farbtastic/farbtastic.min.js',
	'/assets/vendors/bootgrid/jquery.bootgrid.updated.min.js',
	'/assets/js/charts.js',
	'/assets/vendors/jquery.oauthpopup.js',
	'/assets/js/timer.jquery.js',
	'/assets/js/functions.js',
	'/assets/js/demo.js',
	//APP JS
	'/assets/js/app/base.js',
	//'/assets/js/app/dashboard.js',
	//'/assets/js/app/digong.js',
	'/assets/js/app/settingsTicket.js',
	'/assets/js/app/settings.js'
);

$config['settingsUser_css']  = array(
	'/assets/css/style.css',
	'/assets/css/style-css.css',
	$vendor.'animate.css/animate.min.css',
	$vendor.'fullcalendar/dist/fullcalendar.min.css',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.css',
	$vendor.'material-design-iconic-font/dist/css/material-design-iconic-font.min.css',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css',
	$vendor.'bootstrap-select/dist/css/bootstrap-select.css',
	'/assets/vendors/bootgrid/jquery.bootgrid.min.css',
	$vendor.'chosen/chosen.min.css',
	'/assets/font-awesome/css/font-awesome.min.css',
	'/assets/css/app.min.1.css',
	'/assets/css/app.min.2.css',
);

$config['settingsUser_js']   = array(
	$vendor.'jquery/dist/jquery.min.js',
	$vendor.'bootstrap/dist/js/bootstrap.min.js',
	$vendor.'flot/jquery.flot.js',
	$vendor.'flot/jquery.flot.resize.js',
	$vendor.'flot.curvedlines/curvedLines.js',
	'/assets/vendors/sparklines/jquery.sparkline.min.js',
	$vendor.'jquery.easy-pie-chart/dist/jquery.easypiechart.min.js',
	$vendor.'moment/min/moment.min.js',
	$vendor.'fullcalendar/dist/fullcalendar.min.js',
	$vendor.'simpleWeather/jquery.simpleWeather.min.js',
	$vendor.'Waves/dist/waves.min.js',
	'/assets/vendors/bootstrap-growl/bootstrap-growl.min.js',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.min.js',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
	$vendor.'bootstrap-select/dist/js/bootstrap-select.js',
	'/assets/js/flot-charts/curved-line-chart.js',
	'/assets/js/jquery-debounce-min.js',
	'/assets/js/flot-charts/line-chart.js',
	$vendor.'chosen/chosen.jquery.min.js',
	'/assets/vendors/fileinput/fileinput.min.js',
	'/assets/vendors/input-mask/input-mask.min.js',
	'/assets/vendors/farbtastic/farbtastic.min.js',
	'/assets/vendors/bootgrid/jquery.bootgrid.updated.min.js',
	'/assets/js/charts.js',
	'/assets/vendors/jquery.oauthpopup.js',
	'/assets/js/timer.jquery.js',
	'/assets/js/functions.js',
	'/assets/js/demo.js',
	//APP JS
	'/assets/js/app/base.js',
	'/assets/js/app/settingsUser.js',
);

$config['report_css']  = array(
	'/assets/css/style.css',
	'/assets/css/style-css.css',
	$vendor.'animate.css/animate.min.css',
	$vendor.'fullcalendar/dist/fullcalendar.min.css',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.css',
	//$vendor.'sweetalert/dist/sweetalert.css',
	
	$vendor.'material-design-iconic-font/dist/css/material-design-iconic-font.min.css',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
	$vendor.'bootstrap-select/dist/css/bootstrap-select.css',
	'/assets/vendors/bootgrid/jquery.bootgrid.min.css',
	'/assets/font-awesome/css/font-awesome.min.css',
	'/assets/css/app.min.1.css',
	'/assets/css/app.min.2.css',
);

$config['report_js']   = array(
	$vendor.'jquery/dist/jquery.min.js',
	$vendor.'bootstrap/dist/js/bootstrap.min.js',
	$vendor.'flot/jquery.flot.js',
	$vendor.'flot/jquery.flot.resize.js',
	$vendor.'flot.curvedlines/curvedLines.js',
	'/assets/vendors/sparklines/jquery.sparkline.min.js',
	$vendor.'jquery.easy-pie-chart/dist/jquery.easypiechart.min.js',
	$vendor.'moment/min/moment.min.js',
	$vendor.'fullcalendar/dist/fullcalendar.min.js',
	$vendor.'simpleWeather/jquery.simpleWeather.min.js',
	$vendor.'Waves/dist/waves.min.js',
	'/assets/vendors/bootstrap-growl/bootstrap-growl.min.js',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.min.js',
	//$vendor.'sweetalert/dist/sweetalert-dev.js',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
	$vendor.'bootstrap-select/dist/js/bootstrap-select.js',
	'/assets/js/flot-charts/curved-line-chart.js',
	'/assets/js/flot-charts/line-chart.js',
	$vendor.'chosen/chosen.jquery.min.js',
	'/assets/vendors/fileinput/fileinput.min.js',
	'/assets/vendors/input-mask/input-mask.min.js',
	'/assets/vendors/farbtastic/farbtastic.min.js',
	'/assets/vendors/bootgrid/jquery.bootgrid.updated.min.js',
	'/assets/js/charts.js',
	'/assets/js/timer.jquery.js',
	'/assets/js/functions.js',
	'/assets/js/demo.js',
	//APP JS
	'/assets/js/app/base.js',
	'/assets/js/app/report.js'
);

$config['crm_css']  = array(
	'/assets/css/style.css',
	'/assets/css/style-css.css',
	$vendor.'animate.css/animate.min.css',
	$vendor.'fullcalendar/dist/fullcalendar.min.css',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.css',
	$vendor.'material-design-iconic-font/dist/css/material-design-iconic-font.min.css',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
	$vendor.'bootstrap-select/dist/css/bootstrap-select.css',
	'/assets/vendors/bootgrid/jquery.bootgrid.min.css',
	'/assets/font-awesome/css/font-awesome.min.css',
	'/assets/css/app.min.1.css',
	'/assets/css/app.min.2.css',
);

$config['crm_js']   = array(
	$vendor.'jquery/dist/jquery.min.js',
	$vendor.'bootstrap/dist/js/bootstrap.min.js',
	$vendor.'moment/min/moment.min.js',
	$vendor.'Waves/dist/waves.min.js',
	'/assets/vendors/bootstrap-growl/bootstrap-growl.min.js',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.min.js',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
	'/assets/vendors/bootgrid/jquery.bootgrid.updated.min.js',
	'/assets/js/timer.jquery.js',
	'/assets/js/functions.js',
	'/assets/js/demo.js',
	//APP JS
	'/assets/js/app/base.js',
	'/assets/js/app/crm.js'
);

$config['crmDetail_css']  = array(
	'/assets/css/style.css',
	'/assets/css/style-css.css',
	$vendor.'animate.css/animate.min.css',
	$vendor.'fullcalendar/dist/fullcalendar.min.css',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.css',
	//$vendor.'sweetalert/dist/sweetalert.css',
	
	$vendor.'material-design-iconic-font/dist/css/material-design-iconic-font.min.css',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
	$vendor.'bootstrap-select/dist/css/bootstrap-select.css',
	'/assets/vendors/bootgrid/jquery.bootgrid.min.css',
	'/assets/font-awesome/css/font-awesome.min.css',
	'/assets/css/app.min.1.css',
	'/assets/css/app.min.2.css',
);

$config['crmDetail_js']   = array(
	$vendor.'jquery/dist/jquery.min.js',
	$vendor.'bootstrap/dist/js/bootstrap.min.js',
	$vendor.'moment/min/moment.min.js',
	
	 $vendor.'Waves/dist/waves.min.js',
	 '/assets/vendors/bootstrap-growl/bootstrap-growl.min.js',
	 $vendor.'bootstrap-sweetalert/lib/sweet-alert.min.js',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
	'/assets/vendors/bootgrid/jquery.bootgrid.updated.js',
	'/assets/js/timer.jquery.js',
	'/assets/vendors/input-mask/input-mask.min.js',
	'/assets/js/functions.js',
	'/assets/js/demo.js',
	//APP JS
	'/assets/js/app/base.js',
	'/assets/js/app/crmDetail.js',
	'/assets/js/app/crmDetail-activity.js'
);

$config['inventory_css']  = array(
	'/assets/css/style.css',
	'/assets/css/style-css.css',
	$vendor.'animate.css/animate.min.css',
	$vendor.'fullcalendar/dist/fullcalendar.min.css',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.css',
	$vendor.'material-design-iconic-font/dist/css/material-design-iconic-font.min.css',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
	$vendor.'bootstrap-select/dist/css/bootstrap-select.css',
	'/assets/vendors/bootgrid/jquery.bootgrid.min.css',
	'/assets/font-awesome/css/font-awesome.min.css',
	'/assets/css/app.min.1.css',
	'/assets/css/app.min.2.css',
);

$config['inventory_js']   = array(
	$vendor.'jquery/dist/jquery.min.js',
	$vendor.'bootstrap/dist/js/bootstrap.min.js',
	$vendor.'moment/min/moment.min.js',
	$vendor.'Waves/dist/waves.min.js',
	'/assets/vendors/bootstrap-growl/bootstrap-growl.min.js',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.min.js',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
	'/assets/vendors/bootgrid/jquery.bootgrid.updated.min.js',
	'/assets/js/timer.jquery.js',
	'/assets/js/functions.js',
	'/assets/js/demo.js',
	//APP JS
	'/assets/js/app/base.js',
	'/assets/js/app/inventory.js'
);

$config['inventoryImport_js']   = array(
	$vendor.'jquery/dist/jquery.min.js',
	$vendor.'bootstrap/dist/js/bootstrap.min.js',
	$vendor.'moment/min/moment.min.js',
	$vendor.'Waves/dist/waves.min.js',
	'/assets/vendors/bootstrap-growl/bootstrap-growl.min.js',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.min.js',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
	'/assets/vendors/bootgrid/jquery.bootgrid.updated.min.js',
	'/assets/js/timer.jquery.js',
	'/assets/js/functions.js',
	'/assets/js/demo.js',
	//APP JS
	'/assets/js/app/base.js',
	'/assets/js/app/inventoryImport.js'
);

$config['sales_css']  = array(
	'/assets/css/style.css',
	'/assets/css/style-css.css',
	$vendor.'animate.css/animate.min.css',
	$vendor.'fullcalendar/dist/fullcalendar.min.css',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.css',
	$vendor.'material-design-iconic-font/dist/css/material-design-iconic-font.min.css',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
	$vendor.'bootstrap-select/dist/css/bootstrap-select.css',
	'/assets/vendors/select2/select2.css',
	'/assets/vendors/bootgrid/jquery.bootgrid.min.css',
	'/assets/font-awesome/css/font-awesome.min.css',
	'/assets/css/app.min.1.css',
	'/assets/css/app.min.2.css',
);

$config['sales_js']   = array(
	$vendor.'jquery/dist/jquery.min.js',
	$vendor.'bootstrap/dist/js/bootstrap.min.js',
	$vendor.'moment/min/moment.min.js',
	$vendor.'Waves/dist/waves.min.js',
	'/assets/vendors/bootstrap-growl/bootstrap-growl.min.js',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.min.js',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
	'/assets/vendors/bootgrid/jquery.bootgrid.updated.min.js',
	'/assets/js/timer.jquery.js',
	'/assets/vendors/select2/select2.js',
	'/assets/js/functions.js',
	'/assets/js/demo.js',
	//APP JS
	'/assets/js/app/base.js',
	'/assets/js/app/sales.js'
);

$config['salesDetail_css']  = array(
	'/assets/css/style.css',
	'/assets/css/style-css.css',
	$vendor.'animate.css/animate.min.css',
	$vendor.'fullcalendar/dist/fullcalendar.min.css',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.css',
	$vendor.'material-design-iconic-font/dist/css/material-design-iconic-font.min.css',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
	$vendor.'bootstrap-select/dist/css/bootstrap-select.css',
	'/assets/vendors/select2/select2.css',
	'/assets/vendors/bootgrid/jquery.bootgrid.min.css',
	'/assets/font-awesome/css/font-awesome.min.css',
	'/assets/css/app.min.1.css',
	'/assets/css/app.min.2.css',
);

$config['salesDetail_js']   = array(
	$vendor.'jquery/dist/jquery.min.js',
	$vendor.'bootstrap/dist/js/bootstrap.min.js',
	$vendor.'moment/min/moment.min.js',
	$vendor.'Waves/dist/waves.min.js',
	'/assets/vendors/bootstrap-growl/bootstrap-growl.min.js',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.min.js',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
	'/assets/vendors/bootgrid/jquery.bootgrid.updated.min.js',
	'/assets/js/timer.jquery.js',
	'/assets/vendors/select2/select2.js',
	'/assets/js/functions.js',
	'/assets/js/demo.js',
	//APP JS
	'/assets/js/app/base.js',
	'/assets/js/app/salesDetail.js'
);

$config['notes_css']  = array(
	'/assets/css/style.css',
	'/assets/css/style-css.css',
	$vendor.'animate.css/animate.min.css',
	$vendor.'fullcalendar/dist/fullcalendar.min.css',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.css',
	$vendor.'material-design-iconic-font/dist/css/material-design-iconic-font.min.css',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
	$vendor.'bootstrap-select/dist/css/bootstrap-select.css',
	'/assets/vendors/select2/select2.css',
	'/assets/vendors/bootgrid/jquery.bootgrid.min.css',
	'/assets/font-awesome/css/font-awesome.min.css',
	'/assets/css/app.min.1.css',
	'/assets/css/app.min.2.css',
);

$config['notes_js']   = array(
	$vendor.'jquery/dist/jquery.min.js',
	$vendor.'bootstrap/dist/js/bootstrap.min.js',
	$vendor.'moment/min/moment.min.js',
	$vendor.'Waves/dist/waves.min.js',
	'/assets/vendors/bootstrap-growl/bootstrap-growl.min.js',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.min.js',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
	'/assets/vendors/bootgrid/jquery.bootgrid.updated.min.js',
	'/assets/js/timer.jquery.js',
	'/assets/vendors/select2/select2.js',
	'/assets/js/functions.js',
	'/assets/js/demo.js',
	//APP JS
	'/assets/js/app/base.js',
	'/assets/js/app/notes.js'
);

$config['purchase_css']  = array(
	'/assets/css/style.css',
	'/assets/css/style-css.css',
	$vendor.'animate.css/animate.min.css',
	$vendor.'fullcalendar/dist/fullcalendar.min.css',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.css',
	$vendor.'material-design-iconic-font/dist/css/material-design-iconic-font.min.css',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
	$vendor.'bootstrap-select/dist/css/bootstrap-select.css',
	'/assets/vendors/select2/select2.css',
	'/assets/vendors/bootgrid/jquery.bootgrid.min.css',
	'/assets/font-awesome/css/font-awesome.min.css',
	'/assets/css/app.min.1.css',
	'/assets/css/app.min.2.css',
);

$config['purchase_js']   = array(
	$vendor.'jquery/dist/jquery.min.js',
	$vendor.'bootstrap/dist/js/bootstrap.min.js',
	$vendor.'moment/min/moment.min.js',
	$vendor.'Waves/dist/waves.min.js',
	'/assets/vendors/bootstrap-growl/bootstrap-growl.min.js',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.min.js',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
	'/assets/vendors/bootgrid/jquery.bootgrid.updated.min.js',
	'/assets/js/timer.jquery.js',
	'/assets/vendors/select2/select2.js',
	'/assets/js/functions.js',
	'/assets/js/demo.js',
	//APP JS
	'/assets/js/app/base.js',
	'/assets/js/app/purchase.js'
);

$config['purchaseDetail_css']  = array(
	'/assets/css/style.css',
	'/assets/css/style-css.css',
	$vendor.'animate.css/animate.min.css',
	$vendor.'fullcalendar/dist/fullcalendar.min.css',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.css',
	$vendor.'material-design-iconic-font/dist/css/material-design-iconic-font.min.css',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
	$vendor.'bootstrap-select/dist/css/bootstrap-select.css',
	'/assets/vendors/select2/select2.css',
	'/assets/vendors/bootgrid/jquery.bootgrid.min.css',
	'/assets/font-awesome/css/font-awesome.min.css',
	'/assets/css/app.min.1.css',
	'/assets/css/app.min.2.css',
);

$config['purchaseDetail_js']   = array(
	$vendor.'jquery/dist/jquery.min.js',
	$vendor.'bootstrap/dist/js/bootstrap.min.js',
	$vendor.'moment/min/moment.min.js',
	$vendor.'Waves/dist/waves.min.js',
	'/assets/vendors/bootstrap-growl/bootstrap-growl.min.js',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.min.js',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
	'/assets/vendors/bootgrid/jquery.bootgrid.updated.min.js',
	'/assets/js/timer.jquery.js',
	'/assets/vendors/select2/select2.js',
	'/assets/js/functions.js',
	'/assets/js/demo.js',
	//APP JS
	'/assets/js/app/base.js',
	'/assets/js/app/purchaseDetail.js'
);

$config['quote_css']  = array(
	'/assets/css/style.css',
	'/assets/css/style-css.css',
	$vendor.'animate.css/animate.min.css',
	$vendor.'fullcalendar/dist/fullcalendar.min.css',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.css',
	$vendor.'material-design-iconic-font/dist/css/material-design-iconic-font.min.css',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
	$vendor.'bootstrap-select/dist/css/bootstrap-select.css',
	'/assets/vendors/select2/select2.css',
	'/assets/vendors/bootgrid/jquery.bootgrid.min.css',
	'/assets/font-awesome/css/font-awesome.min.css',
	'/assets/css/app.min.1.css',
	'/assets/css/app.min.2.css',
);

$config['quote_js']   = array(
	$vendor.'jquery/dist/jquery.min.js',
	$vendor.'bootstrap/dist/js/bootstrap.min.js',
	$vendor.'moment/min/moment.min.js',
	$vendor.'Waves/dist/waves.min.js',
	'/assets/vendors/bootstrap-growl/bootstrap-growl.min.js',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.min.js',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
	'/assets/vendors/bootgrid/jquery.bootgrid.updated.min.js',
	'/assets/js/timer.jquery.js',
	'/assets/vendors/select2/select2.js',
	'/assets/js/functions.js',
	'/assets/js/demo.js',
	//APP JS
	'/assets/js/app/base.js',
	'/assets/js/app/quote.js'
);


$config['quoteDetail_js']   = array(
	$vendor.'jquery/dist/jquery.min.js',
	$vendor.'bootstrap/dist/js/bootstrap.min.js',
	$vendor.'moment/min/moment.min.js',
	$vendor.'Waves/dist/waves.min.js',
	'/assets/vendors/bootstrap-growl/bootstrap-growl.min.js',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.min.js',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
	'/assets/vendors/bootgrid/jquery.bootgrid.updated.min.js',
	'/assets/js/timer.jquery.js',
	'/assets/vendors/select2/select2.js',
	'/assets/js/functions.js',
	'/assets/js/demo.js',
	//APP JS
	'/assets/js/app/base.js',
	'/assets/js/app/quoteDetail.js'
);
$config['quoteDetail_css']  = array(
	'/assets/css/style.css',
	'/assets/css/style-css.css',
	$vendor.'animate.css/animate.min.css',
	$vendor.'fullcalendar/dist/fullcalendar.min.css',
	$vendor.'bootstrap-sweetalert/lib/sweet-alert.css',
	$vendor.'material-design-iconic-font/dist/css/material-design-iconic-font.min.css',
	$vendor.'malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css',
	$vendor.'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
	$vendor.'bootstrap-select/dist/css/bootstrap-select.css',
	'/assets/vendors/select2/select2.css',
	'/assets/vendors/bootgrid/jquery.bootgrid.min.css',
	'/assets/font-awesome/css/font-awesome.min.css',
	'/assets/css/app.min.1.css',
	'/assets/css/app.min.2.css',
);
















?>