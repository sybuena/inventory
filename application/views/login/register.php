<style>
.no-padding-left {
    padding-left: 0px
}
#l-register .progress {
    margin-top: 35px;
    height: 20px;
}
.popover{
    width: 100%; /* Max Width of the popover (depending on the container!) */
}
</style>

<div class="alert alert-danger alert-dismissible <?=$expired; ?>" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <p><b>Oh snap! Something went wrong</b></p>

    <p>It seems the link you are using has been expired or already been used.
    Contact your Administrator to fix this issue</p>
</div>

<div class="alert alert-danger alert-dismissible hide" role="alert" id="register-error-message">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <p>Oh snap! Wrong Username or Password.</p>
</div>

<div class="alert alert-success alert-dismissible hide" role="alert" id="register-success-message">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <p>Horray! Your account has been successfully created.</p>
    <p id="register-success-message-main"></p>
    <a href="/" class="alert-link">Return to Login Page</a>
</div>

<!-- <div style="margin-bottom: 40px;"></div> -->

<div class="input-group m-b-20">
    <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>

    <div class="form-group fg-float col-lg-12 no-padding-left">
        <div class="fg-line">
            <input type="text" class="form-control fg-input create-account-form" id="login-first-name" 
            value="<?php echo isset($user['first_name']) ? $user['first_name'] : ''; ?>" <?=$disabled; ?>>
            <label class="fg-label">Firstname</label>
        </div>
        <small class="help-block"></small>
    </div>

  

</div>

<div class="input-group m-b-20">
    <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>


    <div class="form-group fg-float col-lg-12 no-padding-left">
        <div class="fg-line">
            <input type="text" class="form-control fg-input create-account-form" id="login-last-name"
            value="<?php echo isset($user['last_name']) ? $user['last_name'] : ''; ?>" <?=$disabled; ?>>
            <label class="fg-label">Lastname</label>
        </div>
        <small class="help-block"></small>
    </div>

</div>

<div class="input-group m-b-20">
    <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
    <div class="form-group fg-float">
        <div class="fg-line">
            <input type="text" class="form-control fg-input create-account-form" id="login-email-address" 
            value="<?php echo isset($user['username']) ? $user['username'] : ''; ?>" <?=$disabled; ?>>
            <label class="fg-label">Email Address</label>
        </div>
        <small class="help-block"></small>
    </div>
</div>

<div class="input-group m-b-20">
    <span class="input-group-addon"><i class="zmdi zmdi-male"></i></span>
    <div class="form-group fg-float">
        <div class="fg-line">
            <input type="password" class="form-control fg-input create-account-form" id="login-one-password"
             data-toggle="popover" data-trigger="focus" data-html="true" 
             title="Password Strength Criteria" 
             data-content="
                <b>Required<b>
                <ul>
                    <li><small>At least 6 characters</small></li>
                    <li><small>At least 1 capital letter</small></li>
                    <li><small>At least 1 number</small></li>
                </ul>
                <b>Required<b>
                <ul>
                    <li><small>At least 8 characters</small></li>
                    <li><small>At least 1 capital and lowercase letter</small></li>
                    <li><small>At least 1 non-alphanumeric</small></li>
                </ul>
             ">
            <label class="fg-label">Password</label>
        </div>
        <small class="help-block"></small>
    </div>
</div>

<div class="input-group m-b-20">
    <span class="input-group-addon"><i class="zmdi zmdi-male"></i></span>
    <div class="form-group fg-float">
        <div class="fg-line">
            <input type="password" class="form-control fg-input create-account-form" id="login-two-password">
            <label class="fg-label">Confirm Password</label>
        </div>
        <small class="help-block"></small>
    </div>
</div>

<div class="clearfix"></div>

<div class="checkbox">    
    <p><i>By sumbitting, your are accepting the terms of the license agreement</i></p>
</div>

<a href="" class="btn btn-login btn-danger btn-float" id="create-account-now" 
    user-id="<?=$userId; ?>" 
    user-nonce="<?=$nonce; ?>" 
>
    <i class="zmdi zmdi-arrow-forward"></i>
</a>

<ul class="login-navigation">
    <li data-block="#l-login" class="bgm-green">Login</li>
    <li data-block="#l-forget-password" class="bgm-orange">Forgot Password?</li>
</ul>
	
