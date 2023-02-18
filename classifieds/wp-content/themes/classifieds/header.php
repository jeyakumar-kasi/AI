<?php

/* 
 * Author       : Jai K
 * Purpose      : Main Header file
 * Created On   : 2020-02-10 19:31
 */

# Page Title
if (IS_HOME):
    $page_title = get_bloginfo('description');
elseif (is_404()):
    $page_title = 'Page Not Found';
else:
    $page_title = $post->post_title;
endif;

// Add Site Name
$page_title .= ' - ' . SITE_NAME;

if (IS_HOME):
    $categories = get_all_categories(TRUE);
    //echo '<pre>'; print_r($categories); die;    
endif;
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta property="og:site_name" content="Hyproid" />
        <meta property="og:type" content="website" />

        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta http-equiv="Content-Language" content="en" />
        <meta http-equiv="cleartype" content="on" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="format-detection" content="telephone=no" />
        <meta name="apple-mobile-wep-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <meta name="MobileOptimized" content="width" />
        <meta name="HandheldFriendly" content="True" />
        <meta name="google-site-verification" content="L8kTFul-GpA9lIdms_nabd1yBSg9PDCIouhmZmEkT8I" />
        <meta name="msvalidate.01" content="7594C55D7B2B33B5FBFA187D6AE55EB6" />

        <title><?php echo $page_title; ?></title>

        <meta name="description" content="Post your free online classified ads on today. Search the posts for services, dating, buy or sell items/products etc in India" />
        <meta name="keywords" content="free online classifieds, post ads for free, free advertising sites, classifieds sites in india, top free online classifieds, free online classifieds website, posting ads as free, free advertisement, buy, sell, free services, free call services, free dating websites, free blogging websites, full enjoy, week end events, online local ads" />
        <meta name="article-author" content="jai" />
        <!--<meta name="googlebot" content="index, follow" />
        <meta name="Robots" content="index, follow" />-->
        <!-- <meta name="robots" content="noindex" /> -->
        <!-- <meta name="theme-color" content="#f4f4f4" /> -->
        <!-- <link rel="manifest" href="./manifest.json" crossorigin="use-credentials" /> -->
        <link rel="shortcut icon" href="<?php echo TMPL_URI; ?>/static/images/favicon.ico" type="image/x-icon" />

        <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic|Roboto+Mono:400,500|Material+Icons" rel="stylesheet"> -->
        <!--<link href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,600,700,400" rel="stylesheet" type="text/css" />-->
        <link href="<?php echo TMPL_URI; ?>/static/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo TMPL_URI; ?>/static/css/fontawesome-all.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo TMPL_URI; ?>/style.css" rel="stylesheet" type="text/css" />
        <!--<script src="<?php echo TMPL_URI; ?>/static/js/modernizr.js"></script>-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lte IE 9]>
            <link href="<?php echo TMPL_URI; ?>/static/css/ie9.css" rel="stylesheet">
        <![endif]-->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <link href="<?php echo TMPL_URI; ?>/static/css/ie8.css" rel="stylesheet">
        <![endif]-->
        
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-32JSY5XYXG"></script>
        <script type="text/javascript">
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'G-32JSY5XYXG');
          
            
            var siteURL  = '<?php echo TMPL_URI; ?>'
            ,   menuList = <?php echo json_encode($categories); ?> 
        </script>
    </head>

    <body>
        <div class="page">
            <header>
                <div id="header-top" class="hr">
                    <div class="container">
                        <div class="row">
                            <div class="col-4">
                                <span class="small-text pip">India</span>
                                <span class="small-text">EN</span>
                            </div>
                            <div class="col-5 offset-3 text-right">
                                <div class="social-icons">
                                    <a href="#" target="_blank" title="Like us on: Facebook"><i class="fab fa-facebook"></i></a>
                                    <a href="#" target="_blank" title="Follow us on: Twitter"><i class="fab fa-twitter"></i></a>
                                    <a href="#" target="_blank" title="Join us on: Google Plus"><i class="fab fa-google-plus"></i></a>
                                    <a href="#" target="_blank" title="Stay connected on: LinkedIn"><i class="fab fa-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="<?php echo SITE_URL; ?>/post-your-free-ad" id="post-new-btn" class="btn warning"><i class="fa fa-plus-circle"></i> Post New Ad</a>
                <nav class="navbar navbar-light navbar-expand-lg">
                    <div class="container">
                        <a href="<?php echo SITE_URL; ?>" class="navbar-brand" id="main-logo"><img src="<?php echo TMPL_URI; ?>/static/images/logo.png" /></a>
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false" aria-label="Navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse " id="navbar-collapse" style="flex-grow: unset;">
                              <ul class="navbar-nav">
                                  <li class="nav-item"><a href="<?php echo SITE_URL; ?>/frequently-asked-questions" class="nav-link"><i class="fa fa-question-circle"></i> FAQ/Help</a></li>
                                  <?php if (IS_LOGGED_IN): ?>
                                  <li class="nav-item">
                                    <a href="./profile" class="nav-link">
                                        <i class="fa fa-user"></i> My Account
                                    </a>
                                  </li>
                                  <?php else: ?>
                                  <li class="nav-item">
                                      <a href="<?php echo SITE_URL; ?>/login" class="nav-link">
                                          <i class="fa fa-user-lock"></i> Login
                                      </a>
                                  </li>
                                  <?php endif; ?>
                              </ul>
                        </div>
                    </div>
                </nav>
            </header>

            <section id="featured-image" class=""></section> <!-- #featured-image -->            
                
                   
