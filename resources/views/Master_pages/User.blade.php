<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="UTF-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('backend/img/settings/logo_top/logo_top.webp') }}" rel="shortcut icon">
    <title>Za3touri - Home</title>
    
        <!--====== Google Font ======-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">
    <!--====== Vendor Css ======-->
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor.css')}}" >

    <!--====== Utility-Spacing ======-->
    <link rel="stylesheet" href="{{ asset('frontend/css/utility.css') }}">
        <!--====== Font Awssome ======-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!--====== App ======-->
    <link rel="stylesheet" href="{{ asset('frontend/css/app.css') }}">
        <!--====== spinner ======-->
    <link rel="stylesheet" href="{{ asset('frontend/css/spinner.css') }}">

</head>
<body class="config" >
    
    @include('sweetalert::alert')
    <div id="loaderstore">
        <img src='{{ asset('frontend/images/loding/general.gif') }}' class="loaderstore">
    </div>
    <!--====== Main App ======-->
    <div id="vue">
    <div id="app">
    <!--====== Main Header ======-->
   <header-vue></header-vue>
    <!--====== End - Main Header ======-->
      

        <!--====== App Content -- vue ======-->
    <router-view :key="$route.fullPath"></router-view>
          
        <!--====== End - App Content  -- vue======-->


        <!--====== Main Footer ======-->
            @include('user.layout.Footer')
        <!--====== Modal Section ======-->
    </div>  
    </div>  




    <!--====== End - Main App ======-->
    <!--====== Google Analytics: change UA-XXXXX-Y to be your site's ID ======-->

    <script  src="{{ asset('js/frontend/app.js') }}"   ></script>
    <script>
        window.ga = function() {
            ga.q.push(arguments)
        };
        ga.q = [];
        ga.l = +new Date;
        ga('create', 'UA-XXXXX-Y', 'auto');
        ga('send', 'pageview')
    </script>
    <script src="https://www.google-analytics.com/analytics.js"  ></script>

        <!--====== Vendor Js ======-->
        <script src="{{ asset('frontend/js/vendor.js') }}"></script>

        <!--====== jQuery Shopnav plugin ======-->
        <script src="{{ asset('frontend/js/jquery.shopnav.js') }}" defer></script>
    
        <!--====== App ======-->
        <script src="{{ asset('frontend/js/app.js') }}" defer ></script>
    <!--====== Noscript ======-->

    <noscript>
        <div class="app-setting">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="app-setting__wrap">
                            <h1 class="app-setting__h1">JavaScript is disabled in your browser.</h1>

                            <span class="app-setting__text">Please enable JavaScript in your browser or upgrade to a JavaScript-capable browser.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </noscript>
    <script>
        window.addEventListener('load', (event) => {
            $('#loaderstore').hide(); 
            $('.loaderstore').hide(); 
});
    </script>
        <script type="text/javascript">
        if (window.location.hash === "#_=_"){
    history.replaceState 
        ? history.replaceState(null, null, window.location.href.split("#")[0])
        : window.location.hash = "";
}
    console.log(window.location.hash)
        </script>


</body>
</html>