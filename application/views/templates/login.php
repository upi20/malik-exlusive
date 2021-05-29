<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->



    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?=$this->setting->index()['app_title']?></title>
        <link rel="icon" type="image/ico" href="<?=base_url()?>assets/admin/non-angular/assets/images/favicon.ico" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">




        <!-- ============================================
        ================= Stylesheets ===================
        ============================================= -->
        <!-- vendor css files -->
        <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/css/vendor/animate.css">
        <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/css/vendor/font-awesome.min.css">
        <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/animsition/css/animsition.min.css">

        <!-- project main css files -->
        <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/css/main.css">
        <!--/ stylesheets -->



        <!-- ==========================================
        ================= Modernizr ===================
        =========================================== -->
        <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <!--/ modernizr -->




    </head>





    <body id="minovate" class="appWrapper">






        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="<?=base_url()?>assets/admin/non-angular/http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->



        <!-- ====================================================
        ================= Application Content ===================
        ===================================================== -->
        <div id="wrap" class="animsition" style="background-color: #2B333E;">

            <div class="page page-core page-login" style="background-color: #2B333E;">

                <div class="text-center"><h3 class="text-light text-white"><span class="text-lightred">Inventory</span> <?=$this->setting->index()['app_name']?></h3></div>
                <div class="container w-420 p-15 bg-white mt-40 text-center">


                    <h2 class="text-light text-greensea">Log In</h2>

                    <form name="form" class="form-validation mt-20" action="<?=base_url()?>login/doLogin" method="POST">

                        <div class="form-group">
                            <input type="email" name="email" class="form-control underline-input" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password" class="form-control underline-input">
                        </div>

                        <div class="form-group text-left mt-20">
                            <button class="btn btn-greensea b-0 br-2 mr-5">Login</button>
                        </div>

                    </form>



                </div>

            </div>



        </div>
        <!--/ Application Content -->














        <!-- ============================================
        ============== Vendor JavaScripts ===============
        ============================================= -->
        <script src="<?=base_url()?>assets/admin/non-angular/https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/bootstrap/bootstrap.min.js"></script>

        <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/jRespond/jRespond.min.js"></script>

        <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

        <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

        <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>

        <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/screenfull/screenfull.min.js"></script>
        <!--/ vendor javascripts -->




        <!-- ============================================
        ============== Custom JavaScripts ===============
        ============================================= -->
        <script src="<?=base_url()?>assets/admin/non-angular/assets/js/main.js"></script>
        <!--/ custom javascripts -->






        <!-- ===============================================
        ============== Page Specific Scripts ===============
        ================================================ -->
        <script>
            $(window).load(function(){


            });
        </script>
        <!--/ Page Specific Scripts -->





        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>

    </body>
</html>
