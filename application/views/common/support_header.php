<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Digong</title>

    <!-- This shit is for the CSS on Login page -->
    <?php
        foreach ($css as $key => $value) {     
            echo '<link href="'.$value.'" rel="stylesheet">';
        }
    ?>

    <!-- Page Loader -->
    <!-- <div class="page-loader">
        <div class="preloader pls-blue">
            <svg class="pl-circular" viewBox="25 25 50 50">
                <circle class="plc-path" cx="50" cy="50" r="20" />
            </svg>

            <p>Please wait...</p>
        </div>
    </div> -->

</head>