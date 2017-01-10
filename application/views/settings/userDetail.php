<?php include(APPPATH.'/views/common/header.php'); ?>
<?php include(APPPATH.'/views/common/top_menu.php'); ?>

<section id="main" data-layout="layout-1">
    <?php include(APPPATH.'/views/common/sidebar.php'); ?>
    <?php $table = 'invoice-table-list'; ?>

    <section id="content">
        <div class="container">
            <div class="block-header pull-left">
                <h2>User Detail</h2>
                 <ol class="breadcrumb breadcrums2">
                    <li><a href="/app">Home</a></li>
                    <li><a href="/settings">User List</a></li>
                    <li class="active" id="main-list-breadcrums">
                        User Detail
                    </li>
                </ol>
            </div>
            <div class="pull-right">
                <?php if($info['active'] != 1) :?>
                    <button class="btn btn-primary waves-effect btn-icon-text" id="user-resend">
                        <i class="fa fa-envelope"></i> Resend Invitation
                    </button>
                <?php endif; ?>
            </div>
            <div class="clearfix"></div>
            <div class="card">
                
                <div id="profile-main">
                    <div class="pm-overview c-overflow">
                        <div class="pmo-pic">
                            <div class="p-relative" id="change-primary-image">
                                <a href="">
                                    <img class="img-responsive mCS_img_loaded" src="<?=show($info['image']);?>" alt=""> 
                                </a>
                                <a href="" class="pmop-edit">
                                    <i class="zmdi zmdi-camera"></i> <span class="hidden-xs">Update Profile Picture</span>
                                </a>
                            </div>
                            <div class="pmo-stat bgc-default bgm-blue">
                                <h2 id="main-user-name" class="m-0 c-white"><?=$info['name'];?></h2>
                                <span id="main-user-role">
                                    <?=$info['role_name'];?>
                                </span>
                            </div>
                        </div>

                        <div class="pmo-block pmo-contact hidden-xs">
                            <h2>Contact Information</h2>
                            <ul>
                                <li><i class="zmdi zmdi-smartphone"></i> 
                                    <span id="main-user-mobile">
                                        <?=show($info['mobile'], '---'); ?>
                                    </span>
                                </li>
                                <li><i class="zmdi zmdi-phone"></i> 
                                    <span id="main-user-phone">
                                        <?=show($info['phone'], '---'); ?>
                                    </span>
                                </li>
                                <li><i class="zmdi zmdi-email"></i> 
                                    <span id="main-user-username">
                                        <?=show($info['username'], '---'); ?>
                                    </span>
                                </li>
                                <li><i class="zmdi zmdi-facebook-box"></i> 
                                    <span id="main-user-facebook">
                                        <?=show($info['facebook'], '---'); ?>
                                    </span>
                                </li>
                                <li>
                                    <i class="zmdi zmdi-twitter"></i> 
                                    <span id="main-user-twitter">
                                        <?=show($info['twitter'], '---'); ?>
                                    </span>
                                </li>
                                <li>
                                    <i class="fa fa-skype"></i> 
                                    <span id="main-user-skype">
                                        <?=show($info['skype'], '---'); ?>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="pm-body clearfix">
                        <ul class="tab-nav tn-justified">
                            <li class="active waves-effect">
                                <a href="#detail-about" data-toggle="tab">About</a>
                            </li>

                            <li class="waves-effect">
                                <a href="#detail-activity" data-toggle="tab">Login Activity</a>
                            </li>
                        </ul>
                        
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="detail-about">
                                <?php include('user/about.php'); ?>
                            </div>
                            <div role="tabpanel" class="tab-pane " id="detail-activity">
                                <?php include('user/activity.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>



<?php include('user/change-photo.php'); ?>
<?php include(APPPATH.'/views/common/footer.php'); ?>