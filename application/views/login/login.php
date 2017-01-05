<?php echo $this->recaptcha->getScriptTag(); ?>

<div class="alert alert-danger alert-dismissible hide" role="alert" id="login-wrong-credential-warning">
    <p>Oh snap! Wrong Username or Password.</p>
</div>
<div class="alert alert-danger alert-dismissible hide" role="alert" id="login-login-attempt">
    
    <p><b>Oh snap! Something went wrong</b></p>
    <p>
        Your account has been locked due to repeated failed login attempts. 
        Answer the Recaptcha below to unlock your account.
    </p>
</div>


<div class="input-group m-b-20">
    <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
    <!-- <div class="fg-line">
        <input type="text" class="form-control" placeholder="Username">
    </div> -->
    <div class="form-group fg-float">
        <div class="fg-line">
            <input type="text" class="form-control fg-input" id="login-username-field" 
            value="<?php echo isset($username) ? $username : ''; ?>"
            from-redirect="<?php echo $redirect;?>"
            >
            <label class="fg-label">Username</label>
        </div>
        <small class="help-block"></small>
    </div>
</div>

<div class="input-group m-b-20">
    <span class="input-group-addon"><i class="zmdi zmdi-male"></i></span>
    <!-- <div class="fg-line">
        <input type="password" class="form-control" placeholder="Password">
    </div> -->
    <div class="form-group fg-float">
        <div class="fg-line">
            <input type="password" class="form-control fg-input" id="login-password-field">
            <label class="fg-label">Password</label>	
        </div>                
        <small class="help-block"></small>
    </div>
</div>

<div class="clearfix"></div>

<?php echo $this->recaptcha->getWidget(); ?>


<!-- <div class="checkbox">
    <label>
        <input type="checkbox" value="">
        <i class="input-helper"></i>
        Keep me signed in
    </label>
</div> -->

<a class="btn btn-login btn-danger btn-float" id="login-button-submit"><i class="zmdi zmdi-arrow-forward"></i></a>

<ul class="login-navigation">
    <!-- <li data-block="#l-register" class="bgm-red">Register</li> -->
    <li data-block="#l-forget-password" class="bgm-orange">Forgot Password?</li>
</ul>
