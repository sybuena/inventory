<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title path="<?=serverPath(); ?>">Apgars</title>

    <!-- This shit is for the CSS on Login page -->
    <?php loadAssets($css, 'css'); ?>

    <!-- Page Loader -->
    <div class="page-loader">
        <!-- <div class="preloader pl-xxl">
            <svg class="pl-circular" viewBox="25 25 50 50">
               <circle class="plc-path" cx="50" cy="50" r="20"></circle>
            </svg>
        </div> -->
        <div class="loader-walk">
            <div></div><div></div><div></div><div></div><div></div>
            <br/><br/>
            <p>Please wait ...</p>
        </div>
    </div>

</head>