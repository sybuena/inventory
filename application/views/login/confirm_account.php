<?php include(APPPATH.'/views/common/login_header.php'); ?>

<body class="login-content">
	<div class="lc-block toggled">
		
		<div class="alert alert-success alert-dismissible <?=$success; ?>" role="alert">
		    <p><b>Horay! Confirmation Complete.</b></p>
		    <p>Your account has been successfully activated and now ready for use. You may now login using the link below.</p>
		</div>

		<div class="alert alert-danger alert-dismissible <?=$error; ?>" role="alert">
		    <p><b>Oh snap! Your link is expired</b></p>
		    <p>Your link has been used once, you have to repeat the proceed you get a new link. </p>
		</div>

		<a href="/login" class="btn btn-info waves-effect">Return to Login Page</a>
	</div>
<?php include(APPPATH.'/views/common/login_footer.php'); ?>

</body>