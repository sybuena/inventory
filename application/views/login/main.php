<?php include(APPPATH.'/views/common/login_header.php'); ?>

<body class="login-content">
	<!-- Login -->
	
	<div class="lc-block <?=$login; ?>" id="l-login" >
		<img src="/assets/img/circle-logo.png" width="100px">
		<h3 class="m-b-20">Welcome To Apgars</h3>
		<?php include(APPPATH.'/views/login/login.php'); ?>
	</div>
	<!-- Register -->
	<div class="lc-block <?=$register; ?>" id="l-register">
		<?php include(APPPATH.'/views/login/register.php'); ?>
	</div>
	<!-- Forgot Password -->
	<div class="lc-block <?=$forgot; ?>" id="l-forget-password">
		<?php include(APPPATH.'/views/login/forget.php'); ?>
	</div>
	
<?php include(APPPATH.'/views/common/login_footer.php'); ?>

</body>