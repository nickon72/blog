<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" class="no-js" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>SintezMLM</title>
    <meta name="description" content="">

    <!-- CSS FILES -->
    <link rel="stylesheet" href="/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/css/style.css">

    <link rel="stylesheet" href="/css/fractionslider.css"/>
    <link rel="stylesheet" href="/css/style-fraction.css"/>
    <link rel="stylesheet" href="/css/animate.css"/>

    <link rel="stylesheet" type="text/css" href="/css/style.css" media="screen" data-name="skins">
    <link rel="stylesheet" href="/css/layout/wide.css" data-name="layout">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <?php $this->insert('partials/navigation') ?>

    <?=$this->section('content')?>

    <?php $this->insert('partials/footer') ?>
</div>
</body>

<script type="text/javascript" src="/js/jquery-1.10.2.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.easing.1.3.js"></script>
<script src="/js/retina-1.1.0.min.js"></script>
<script type="text/javascript" src="/js/jquery.cookie.js"></script> <!-- jQuery cookie -->
<script type="text/javascript" src="/js/styleswitch.js"></script> <!-- Style Colors Switcher -->
<script src="/js/jquery.fractionslider.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="/js/jquery.smartmenus.min.js"></script>
<script type="text/javascript" src="/js/jquery.smartmenus.bootstrap.min.js"></script>
<script type="text/javascript" src="/js/jquery.jcarousel.js"></script>
<script type="text/javascript" src="/js/jflickrfeed.js"></script>
<script type="text/javascript" src="/js/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="/js/jquery.isotope.min.js"></script>
<script type="text/javascript" src="/js/swipe.js"></script>
<script type="text/javascript" src="/js/jquery-scrolltofixed-min.js"></script>
<script src="/js/main.js"></script>


<script>
    $(window).load(function(){
        $('.slider').fractionSlider({
            'fullWidth': 			true,
            'controls': 			true,
            'responsive': 			true,
            'dimensions': 			"1920,450",
            'timeout' :             5000,
            'increase': 			true,
            'pauseOnHover': 		true,
            'slideEndAnimation': 	false,
            'autoChange':           true
        });
    });
</script>

<!-- WARNING: Wow.js doesn't work in IE 9 or less -->
<!--[if gte IE 9 | !IE ]><!-->
<script type="text/javascript" src="/js/wow.min.js"></script>
<script>
    // WOW Animation
    new WOW().init();
</script>
<![endif]-->

</body>
</html>