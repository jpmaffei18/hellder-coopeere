<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    
        <link href="{{ URL::asset('assets/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        
        <!-- This site is optimized with the Yoast SEO plugin v15.9.1 - https://yoast.com/wordpress/plugins/seo/ -->
        <title>Cadastro de Cooperado - Coopeere</title>
        <meta name="robots" content="noindex, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
        <meta property="og:locale" content="pt_BR" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="Cadastro de Cooperado - Coopeere" />
        <meta property="og:url" content="https://www.coopeere.eco.br/cadastro-de-cooperado/" />
        <meta property="og:site_name" content="Coopeere" />
        <meta property="article:modified_time" content="2020-12-11T17:46:28+00:00" />
        <meta name="twitter:card" content="summary_large_image" />
        <script type="application/ld+json" class="yoast-schema-graph">{"@context":"https://schema.org","@graph":[{"@type":"WebSite","@id":"https://www.coopeere.eco.br/#website","url":"https://www.coopeere.eco.br/","name":"Coopeere","description":"","potentialAction":[{"@type":"SearchAction","target":"https://www.coopeere.eco.br/?s={search_term_string}","query-input":"required name=search_term_string"}],"inLanguage":"pt-BR"},{"@type":"WebPage","@id":"https://www.coopeere.eco.br/cadastro-de-cooperado/#webpage","url":"https://www.coopeere.eco.br/cadastro-de-cooperado/","name":"Cadastro de Cooperado - Coopeere","isPartOf":{"@id":"https://www.coopeere.eco.br/#website"},"datePublished":"2020-10-05T12:23:48+00:00","dateModified":"2020-12-11T17:46:28+00:00","breadcrumb":{"@id":"https://www.coopeere.eco.br/cadastro-de-cooperado/#breadcrumb"},"inLanguage":"pt-BR","potentialAction":[{"@type":"ReadAction","target":["https://www.coopeere.eco.br/cadastro-de-cooperado/"]}]},{"@type":"BreadcrumbList","@id":"https://www.coopeere.eco.br/cadastro-de-cooperado/#breadcrumb","itemListElement":[{"@type":"ListItem","position":1,"item":{"@type":"WebPage","@id":"https://www.coopeere.eco.br/","url":"https://www.coopeere.eco.br/","name":"In\u00edcio"}},{"@type":"ListItem","position":2,"item":{"@type":"WebPage","@id":"https://www.coopeere.eco.br/cadastro-de-cooperado/","url":"https://www.coopeere.eco.br/cadastro-de-cooperado/","name":"Cadastro de Cooperado"}}]}]}</script>
        <!-- / Yoast SEO plugin. -->
    
    
    <link rel='dns-prefetch' href='//s.w.org' />
    <link rel="alternate" type="application/rss+xml" title="Feed para Coopeere &raquo;" href="https://www.coopeere.eco.br/feed/" />
    <link rel="alternate" type="application/rss+xml" title="Feed de comentários para Coopeere &raquo;" href="https://www.coopeere.eco.br/comments/feed/" />
            <script type="text/javascript">
                window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/13.0.1\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/13.0.1\/svg\/","svgExt":".svg","source":{"concatemoji":"https:\/\/www.coopeere.eco.br\/wp-includes\/js\/wp-emoji-release.min.js?ver=746e4c11d22ed8d851dc394b530c5ac2"}};
                !function(e,a,t){var n,r,o,i=a.createElement("canvas"),p=i.getContext&&i.getContext("2d");function s(e,t){var a=String.fromCharCode;p.clearRect(0,0,i.width,i.height),p.fillText(a.apply(this,e),0,0);e=i.toDataURL();return p.clearRect(0,0,i.width,i.height),p.fillText(a.apply(this,t),0,0),e===i.toDataURL()}function c(e){var t=a.createElement("script");t.src=e,t.defer=t.type="text/javascript",a.getElementsByTagName("head")[0].appendChild(t)}for(o=Array("flag","emoji"),t.supports={everything:!0,everythingExceptFlag:!0},r=0;r<o.length;r++)t.supports[o[r]]=function(e){if(!p||!p.fillText)return!1;switch(p.textBaseline="top",p.font="600 32px Arial",e){case"flag":return s([127987,65039,8205,9895,65039],[127987,65039,8203,9895,65039])?!1:!s([55356,56826,55356,56819],[55356,56826,8203,55356,56819])&&!s([55356,57332,56128,56423,56128,56418,56128,56421,56128,56430,56128,56423,56128,56447],[55356,57332,8203,56128,56423,8203,56128,56418,8203,56128,56421,8203,56128,56430,8203,56128,56423,8203,56128,56447]);case"emoji":return!s([55357,56424,8205,55356,57212],[55357,56424,8203,55356,57212])}return!1}(o[r]),t.supports.everything=t.supports.everything&&t.supports[o[r]],"flag"!==o[r]&&(t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&t.supports[o[r]]);t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&!t.supports.flag,t.DOMReady=!1,t.readyCallback=function(){t.DOMReady=!0},t.supports.everything||(n=function(){t.readyCallback()},a.addEventListener?(a.addEventListener("DOMContentLoaded",n,!1),e.addEventListener("load",n,!1)):(e.attachEvent("onload",n),a.attachEvent("onreadystatechange",function(){"complete"===a.readyState&&t.readyCallback()})),(n=t.source||{}).concatemoji?c(n.concatemoji):n.wpemoji&&n.twemoji&&(c(n.twemoji),c(n.wpemoji)))}(window,document,window._wpemojiSettings);
            </script>
            <style type="text/css">
    img.wp-smiley,
    img.emoji {
        display: inline !important;
        border: none !important;
        box-shadow: none !important;
        height: 1em !important;
        width: 1em !important;
        margin: 0 .07em !important;
        vertical-align: -0.1em !important;
        background: none !important;
        padding: 0 !important;
    }
    </style>
        <link rel='stylesheet' id='wp-block-library-css'  href='https://www.coopeere.eco.br/wp-includes/css/dist/block-library/style.min.css?ver=746e4c11d22ed8d851dc394b530c5ac2' type='text/css' media='all' />
    <link rel='stylesheet' id='wpforms-full-css'  href='https://www.coopeere.eco.br/wp-content/plugins/wpforms/assets/css/wpforms-full.min.css?ver=1.6.5.1' type='text/css' media='all' />
    <link rel='stylesheet' id='hello-elementor-css'  href='https://www.coopeere.eco.br/wp-content/themes/hello-elementor/style.min.css?ver=2.3.1' type='text/css' media='all' />
    <link rel='stylesheet' id='hello-elementor-theme-style-css'  href='https://www.coopeere.eco.br/wp-content/themes/hello-elementor/theme.min.css?ver=2.3.1' type='text/css' media='all' />
    <link rel='stylesheet' id='elementor-icons-css'  href='https://www.coopeere.eco.br/wp-content/plugins/elementor/assets/lib/eicons/css/elementor-icons.min.css?ver=5.11.0' type='text/css' media='all' />
    <link rel='stylesheet' id='elementor-animations-css'  href='https://www.coopeere.eco.br/wp-content/plugins/elementor/assets/lib/animations/animations.min.css?ver=3.1.3' type='text/css' media='all' />
    <link rel='stylesheet' id='elementor-frontend-legacy-css'  href='https://www.coopeere.eco.br/wp-content/plugins/elementor/assets/css/frontend-legacy.min.css?ver=3.1.3' type='text/css' media='all' />
    <link rel='stylesheet' id='elementor-frontend-css'  href='https://www.coopeere.eco.br/wp-content/plugins/elementor/assets/css/frontend.min.css?ver=3.1.3' type='text/css' media='all' />
    <link rel='stylesheet' id='elementor-post-34-css'  href='https://www.coopeere.eco.br/wp-content/uploads/elementor/css/post-34.css?ver=1615313181' type='text/css' media='all' />
    <link rel='stylesheet' id='elementor-pro-css'  href='https://www.coopeere.eco.br/wp-content/plugins/elementor-pro/assets/css/frontend.min.css?ver=3.1.1' type='text/css' media='all' />
    <link rel='stylesheet' id='elementor-post-466-css'  href='https://www.coopeere.eco.br/wp-content/uploads/elementor/css/post-466.css?ver=1615313182' type='text/css' media='all' />
    <link rel='stylesheet' id='elementor-post-538-css'  href='https://www.coopeere.eco.br/wp-content/uploads/elementor/css/post-538.css?ver=1615315568' type='text/css' media='all' />
    <link rel='stylesheet' id='jltma-bootstrap-css'  href='https://www.coopeere.eco.br/wp-content/plugins/master-addons/assets/css/bootstrap.min.css?ver=746e4c11d22ed8d851dc394b530c5ac2' type='text/css' media='all' />
    <link rel='stylesheet' id='master-addons-main-style-css'  href='https://www.coopeere.eco.br/wp-content/plugins/master-addons/assets/css/master-addons-styles.css?ver=746e4c11d22ed8d851dc394b530c5ac2' type='text/css' media='all' />
    <link rel='stylesheet' id='google-fonts-1-css'  href='https://fonts.googleapis.com/css?family=Roboto%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CRoboto+Slab%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7COpen+Sans%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&#038;ver=746e4c11d22ed8d851dc394b530c5ac2' type='text/css' media='all' />
    <link rel='stylesheet' id='elementor-icons-shared-0-css'  href='https://www.coopeere.eco.br/wp-content/plugins/elementor/assets/lib/font-awesome/css/fontawesome.min.css?ver=5.15.1' type='text/css' media='all' />
    <link rel='stylesheet' id='elementor-icons-fa-solid-css'  href='https://www.coopeere.eco.br/wp-content/plugins/elementor/assets/lib/font-awesome/css/solid.min.css?ver=5.15.1' type='text/css' media='all' />
    <script type='text/javascript' id='jquery-core-js-before'>
    /* < ![CDATA[ */
    function jltmaNS(n){for(var e=n.split("."),a=window,i="",r=e.length,t=0;r>t;t++)"window"!=e[t]&&(i=e[t],a[i]=a[i]||{},a=a[i]);return a;}
    /* ]]> */
    </script>
    <script type='text/javascript' src='https://www.coopeere.eco.br/wp-includes/js/jquery/jquery.min.js?ver=3.5.1' id='jquery-core-js'></script>
    <script type='text/javascript' src='https://www.coopeere.eco.br/wp-includes/js/jquery/jquery-migrate.min.js?ver=3.3.2' id='jquery-migrate-js'></script>
    <link rel="https://api.w.org/" href="https://www.coopeere.eco.br/wp-json/" /><link rel="alternate" type="application/json" href="https://www.coopeere.eco.br/wp-json/wp/v2/pages/400" /><link rel="EditURI" type="application/rsd+xml" title="RSD" href="https://www.coopeere.eco.br/xmlrpc.php?rsd" />
    <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="https://www.coopeere.eco.br/wp-includes/wlwmanifest.xml" /> 
    
    <link rel='shortlink' href='https://www.coopeere.eco.br/?p=400' />
    <link rel="alternate" type="application/json+oembed" href="https://www.coopeere.eco.br/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fwww.coopeere.eco.br%2Fcadastro-de-cooperado%2F" />
    <link rel="alternate" type="text/xml+oembed" href="https://www.coopeere.eco.br/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fwww.coopeere.eco.br%2Fcadastro-de-cooperado%2F&#038;format=xml" />
            <script type="text/javascript">
                (function () {
                    window.ma_el_fs = { can_use_premium_code: false};
                })();
            </script>
            <link rel="icon" href="https://www.coopeere.eco.br/wp-content/uploads/2020/09/logo-coopere-final-150x150.png" sizes="32x32" />
    <link rel="icon" href="https://www.coopeere.eco.br/wp-content/uploads/2020/09/logo-coopere-final.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="https://www.coopeere.eco.br/wp-content/uploads/2020/09/logo-coopere-final.png" />
    <meta name="msapplication-TileImage" content="https://www.coopeere.eco.br/wp-content/uploads/2020/09/logo-coopere-final.png" />
            <style type="text/css" id="wp-custom-css">
                a:link{
        color: #000;
    }
    a:hover, a:visited{
        color: #095ba4;
    }
    
    .page-header{
        padding-top: 90px;
    }
    h1.entry-title{
        display: none;
    }
    h4.elementor-heading-title, .elementor-heading-title {
        font-size: 37px;
        font-family: "Open Sans", Sans-serif;
    }
    .page-content p{
        font-family: "Open Sans", Sans-serif;
        font-size: 15px;
    }
    
    /* On screens that are 992px or less, set the background color to blue */
    @media screen and (max-width: 992px) {
        .page-header{
            padding: 36px 0 24px;
        }
        h1.entry-title{
            display: none;
        }
    }
    
    /* On screens that are 600px or less, set the background color to olive */
    @media screen and (max-width: 600px) {
        .page-header{
            padding: 36px 0 60px;
        }
        h1.entry-title{
            display: none;
        }
    }		</style>
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <!--<body class="antialiased">-->
        <body class="page-template-default page page-id-400 elementor-default elementor-kit-34 elementor-page-538">


            <div data-elementor-type="header" data-elementor-id="466" class="elementor elementor-466 elementor-location-header" data-elementor-settings="[]">
                    <div class="elementor-section-wrap">
                                <section class="has_ma_el_bg_slider elementor-section elementor-top-section elementor-element elementor-element-cce1944 elementor-section-height-min-height elementor-section-content-middle elementor-section-boxed elementor-section-height-default elementor-section-items-middle" data-id="cce1944" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                    <div class="elementor-container elementor-column-gap-no">
                                        <div class="elementor-row">
                                <div class="has_ma_el_bg_slider elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-a583d3d" data-id="a583d3d" data-element_type="column">
                        <div class="elementor-column-wrap elementor-element-populated">
                                        <div class="elementor-widget-wrap">
                                    <div class="elementor-element elementor-element-b10e0af elementor-icon-list--layout-inline elementor-align-right elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="b10e0af" data-element_type="widget" data-widget_type="icon-list.default">
                            <div class="elementor-widget-container">
                                <ul class="elementor-icon-list-items elementor-inline-items">
                                        <li class="elementor-icon-list-item elementor-inline-item">
                                <a href="http://<?php echo request()->getHttpHost();?>">						<span class="elementor-icon-list-icon">
                                        <i aria-hidden="true" class="fas fa-user"></i>						</span>
                                                    <span class="elementor-icon-list-text">Login</span>
                                                        </a>
                                                </li>
                                            <li class="elementor-icon-list-item elementor-inline-item">
                                <a href="http://<?php echo request()->getHttpHost()."/precadastro/inserir";?>">						<span class="elementor-icon-list-icon">
                                        <i aria-hidden="true" class="fas fa-pencil-alt"></i>						</span>
                                                    <span class="elementor-icon-list-text">Cadastre-se</span>
                                                        </a>
                                                </li>
                                    </ul>
                            </div>
                            </div>
                                    </div>
                                </div>
                    </div>
                                            </div>
                                </div>
                    </section>
                            <header class="has_ma_el_bg_slider elementor-section elementor-top-section elementor-element elementor-element-419a63b6 elementor-section-content-middle elementor-section-height-min-height elementor-section-boxed elementor-section-height-default elementor-section-items-middle" data-id="419a63b6" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                    <div class="elementor-container elementor-column-gap-no">
                                        <div class="elementor-row">
                                <div class="has_ma_el_bg_slider elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-49c56e98" data-id="49c56e98" data-element_type="column">
                        <div class="elementor-column-wrap elementor-element-populated">
                                        <div class="elementor-widget-wrap">
                                    <div class="elementor-element elementor-element-bb1f0a4 elementor-widget elementor-widget-image" data-id="bb1f0a4" data-element_type="widget" data-widget_type="image.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-image">
                                                        <a href="https://www.coopeere.eco.br">
                                        <img src="https://www.coopeere.eco.br/wp-content/uploads/elementor/thumbs/logo-coopere-final-p3z3q5yfwgadw4jj0fu4u9ghauf0po3phz3cd1hps0.png" title="logo-coopere-final" alt="logo-coopere-final">								</a>
                                                        </div>
                            </div>
                            </div>
                                    </div>
                                </div>
                    </div>
                            <div class="has_ma_el_bg_slider elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-63fb0818" data-id="63fb0818" data-element_type="column">
                        <div class="elementor-column-wrap elementor-element-populated">
                                        <div class="elementor-widget-wrap">
                                    <div class="elementor-element elementor-element-39d4ed57 elementor-nav-menu__align-right elementor-nav-menu--stretch elementor-nav-menu--indicator-angle elementor-nav-menu--dropdown-tablet elementor-nav-menu__text-align-aside elementor-nav-menu--toggle elementor-nav-menu--burger elementor-widget elementor-widget-nav-menu" data-id="39d4ed57" data-element_type="widget" data-settings="{&quot;full_width&quot;:&quot;stretch&quot;,&quot;layout&quot;:&quot;horizontal&quot;,&quot;toggle&quot;:&quot;burger&quot;}" data-widget_type="nav-menu.default">
                            <div class="elementor-widget-container">
                                    <nav role="navigation" class="elementor-nav-menu--main elementor-nav-menu__container elementor-nav-menu--layout-horizontal e--pointer-underline e--animation-slide"><ul id="menu-1-39d4ed57" class="elementor-nav-menu" data-smartmenus-id="16216001485418845"><li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-243"><a href="https://www.coopeere.eco.br/" class="elementor-item">Home</a></li>
            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-1768"><a href="#" class="elementor-item elementor-item-anchor has-submenu" id="sm-16216001485418845-1" aria-haspopup="true" aria-controls="sm-16216001485418845-2" aria-expanded="false">A Coopeere<span class="sub-arrow"><i class="fa"></i></span></a>
            <ul class="sub-menu elementor-nav-menu--dropdown sm-nowrap" id="sm-16216001485418845-2" role="group" aria-hidden="true" aria-labelledby="sm-16216001485418845-1" aria-expanded="false" style="width: auto; display: none; top: auto; left: 0px; margin-left: 0px; margin-top: 0px; min-width: 10em; max-width: 1000px;">
                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-272"><a href="https://www.coopeere.eco.br/a-coopeere/quem-somos/" class="elementor-sub-item">Quem somos</a></li>
                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-277"><a href="https://www.coopeere.eco.br/objetivo/" class="elementor-sub-item">Objetivo</a></li>
                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-276"><a href="https://www.coopeere.eco.br/a-equipe/" class="elementor-sub-item">A equipe</a></li>
            </ul>
            </li>
            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-275"><a href="https://www.coopeere.eco.br/estatuto/" class="elementor-item">Estatuto</a></li>
            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-274"><a href="https://www.coopeere.eco.br/legislacao/" class="elementor-item">Legislação</a></li>
            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-273"><a href="https://www.coopeere.eco.br/vantagens/" class="elementor-item">Vantagens</a></li>
            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1815"><a href="https://www.coopeere.eco.br/parceiros/" class="elementor-item">Parceiros</a></li>
            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-278"><a href="https://www.coopeere.eco.br/fale-conosco/" class="elementor-item">Fale conosco</a></li>
            </ul></nav>
                                <div class="elementor-menu-toggle" role="button" tabindex="0" aria-label="Alternar menu" aria-expanded="false" style="">
                        <i class="eicon-menu-bar" aria-hidden="true"></i>
                        <span class="elementor-screen-only">Menu</span>
                    </div>
                        <nav class="elementor-nav-menu--dropdown elementor-nav-menu__container" role="navigation" aria-hidden="true" style="top: 49.6901px; width: 2102px; left: 0px;"><ul id="menu-2-39d4ed57" class="elementor-nav-menu" data-smartmenus-id="16216001485443025"><li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-243"><a href="https://www.coopeere.eco.br/" class="elementor-item">Home</a></li>
            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-1768"><a href="#" class="elementor-item elementor-item-anchor has-submenu" id="sm-16216001485443025-1" aria-haspopup="true" aria-controls="sm-16216001485443025-2" aria-expanded="false">A Coopeere<span class="sub-arrow"><i class="fa"></i></span></a>
            <ul class="sub-menu elementor-nav-menu--dropdown" id="sm-16216001485443025-2" role="group" aria-hidden="true" aria-labelledby="sm-16216001485443025-1" aria-expanded="false">
                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-272"><a href="https://www.coopeere.eco.br/a-coopeere/quem-somos/" class="elementor-sub-item">Quem somos</a></li>
                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-277"><a href="https://www.coopeere.eco.br/objetivo/" class="elementor-sub-item">Objetivo</a></li>
                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-276"><a href="https://www.coopeere.eco.br/a-equipe/" class="elementor-sub-item">A equipe</a></li>
            </ul>
            </li>
            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-275"><a href="https://www.coopeere.eco.br/estatuto/" class="elementor-item">Estatuto</a></li>
            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-274"><a href="https://www.coopeere.eco.br/legislacao/" class="elementor-item">Legislação</a></li>
            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-273"><a href="https://www.coopeere.eco.br/vantagens/" class="elementor-item">Vantagens</a></li>
            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1815"><a href="https://www.coopeere.eco.br/parceiros/" class="elementor-item">Parceiros</a></li>
            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-278"><a href="https://www.coopeere.eco.br/fale-conosco/" class="elementor-item">Fale conosco</a></li>
            </ul></nav>
                            </div>
                            </div>
                                    </div>
                                </div>
                    </div>
                            <div class="has_ma_el_bg_slider elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-6c3ad609" data-id="6c3ad609" data-element_type="column">
                        <div class="elementor-column-wrap elementor-element-populated">
                                        <div class="elementor-widget-wrap">
                                    <div class="elementor-element elementor-element-46dde139 elementor-search-form--skin-full_screen elementor-widget elementor-widget-search-form" data-id="46dde139" data-element_type="widget" data-settings="{&quot;skin&quot;:&quot;full_screen&quot;}" data-widget_type="search-form.default">
                            <div class="elementor-widget-container">
                                <form class="elementor-search-form" role="search" action="https://www.coopeere.eco.br" method="get">
                                                <div class="elementor-search-form__toggle">
                            <i aria-hidden="true" class="fas fa-search"></i>				<span class="elementor-screen-only">Pesquisar</span>
                        </div>
                                    <div class="elementor-search-form__container">
                                            <input placeholder="Procurar..." class="elementor-search-form__input" type="search" name="s" title="Pesquisar" value="">
                                                                            <div class="dialog-lightbox-close-button dialog-close-button">
                                <i class="eicon-close" aria-hidden="true"></i>
                                <span class="elementor-screen-only">Fechar</span>
                            </div>
                                        </div>
                    </form>
                            </div>
                            </div>
                                    </div>
                                </div>
                    </div>
                                            </div>
                                </div>
                    </header>
                            </div>
                    </div>
        
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    <svg viewBox="0 0 651 192" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-16 w-auto text-gray-700 sm:h-20">
                        <g clip-path="url(#clip0)" fill="#EF3B2D">
                            <path d="M248.032 44.676h-16.466v100.23h47.394v-14.748h-30.928V44.676zM337.091 87.202c-2.101-3.341-5.083-5.965-8.949-7.875-3.865-1.909-7.756-2.864-11.669-2.864-5.062 0-9.69.931-13.89 2.792-4.201 1.861-7.804 4.417-10.811 7.661-3.007 3.246-5.347 6.993-7.016 11.239-1.672 4.249-2.506 8.713-2.506 13.389 0 4.774.834 9.26 2.506 13.459 1.669 4.202 4.009 7.925 7.016 11.169 3.007 3.246 6.609 5.799 10.811 7.66 4.199 1.861 8.828 2.792 13.89 2.792 3.913 0 7.804-.955 11.669-2.863 3.866-1.908 6.849-4.533 8.949-7.875v9.021h15.607V78.182h-15.607v9.02zm-1.431 32.503c-.955 2.578-2.291 4.821-4.009 6.73-1.719 1.91-3.795 3.437-6.229 4.582-2.435 1.146-5.133 1.718-8.091 1.718-2.96 0-5.633-.572-8.019-1.718-2.387-1.146-4.438-2.672-6.156-4.582-1.719-1.909-3.032-4.152-3.938-6.73-.909-2.577-1.36-5.298-1.36-8.161 0-2.864.451-5.585 1.36-8.162.905-2.577 2.219-4.819 3.938-6.729 1.718-1.908 3.77-3.437 6.156-4.582 2.386-1.146 5.059-1.718 8.019-1.718 2.958 0 5.656.572 8.091 1.718 2.434 1.146 4.51 2.674 6.229 4.582 1.718 1.91 3.054 4.152 4.009 6.729.953 2.577 1.432 5.298 1.432 8.162-.001 2.863-.479 5.584-1.432 8.161zM463.954 87.202c-2.101-3.341-5.083-5.965-8.949-7.875-3.865-1.909-7.756-2.864-11.669-2.864-5.062 0-9.69.931-13.89 2.792-4.201 1.861-7.804 4.417-10.811 7.661-3.007 3.246-5.347 6.993-7.016 11.239-1.672 4.249-2.506 8.713-2.506 13.389 0 4.774.834 9.26 2.506 13.459 1.669 4.202 4.009 7.925 7.016 11.169 3.007 3.246 6.609 5.799 10.811 7.66 4.199 1.861 8.828 2.792 13.89 2.792 3.913 0 7.804-.955 11.669-2.863 3.866-1.908 6.849-4.533 8.949-7.875v9.021h15.607V78.182h-15.607v9.02zm-1.432 32.503c-.955 2.578-2.291 4.821-4.009 6.73-1.719 1.91-3.795 3.437-6.229 4.582-2.435 1.146-5.133 1.718-8.091 1.718-2.96 0-5.633-.572-8.019-1.718-2.387-1.146-4.438-2.672-6.156-4.582-1.719-1.909-3.032-4.152-3.938-6.73-.909-2.577-1.36-5.298-1.36-8.161 0-2.864.451-5.585 1.36-8.162.905-2.577 2.219-4.819 3.938-6.729 1.718-1.908 3.77-3.437 6.156-4.582 2.386-1.146 5.059-1.718 8.019-1.718 2.958 0 5.656.572 8.091 1.718 2.434 1.146 4.51 2.674 6.229 4.582 1.718 1.91 3.054 4.152 4.009 6.729.953 2.577 1.432 5.298 1.432 8.162 0 2.863-.479 5.584-1.432 8.161zM650.772 44.676h-15.606v100.23h15.606V44.676zM365.013 144.906h15.607V93.538h26.776V78.182h-42.383v66.724zM542.133 78.182l-19.616 51.096-19.616-51.096h-15.808l25.617 66.724h19.614l25.617-66.724h-15.808zM591.98 76.466c-19.112 0-34.239 15.706-34.239 35.079 0 21.416 14.641 35.079 36.239 35.079 12.088 0 19.806-4.622 29.234-14.688l-10.544-8.158c-.006.008-7.958 10.449-19.832 10.449-13.802 0-19.612-11.127-19.612-16.884h51.777c2.72-22.043-11.772-40.877-33.023-40.877zm-18.713 29.28c.12-1.284 1.917-16.884 18.589-16.884 16.671 0 18.697 15.598 18.813 16.884h-37.402zM184.068 43.892c-.024-.088-.073-.165-.104-.25-.058-.157-.108-.316-.191-.46-.056-.097-.137-.176-.203-.265-.087-.117-.161-.242-.265-.345-.085-.086-.194-.148-.29-.223-.109-.085-.206-.182-.327-.252l-.002-.001-.002-.002-35.648-20.524a2.971 2.971 0 00-2.964 0l-35.647 20.522-.002.002-.002.001c-.121.07-.219.167-.327.252-.096.075-.205.138-.29.223-.103.103-.178.228-.265.345-.066.089-.147.169-.203.265-.083.144-.133.304-.191.46-.031.085-.08.162-.104.25-.067.249-.103.51-.103.776v38.979l-29.706 17.103V24.493a3 3 0 00-.103-.776c-.024-.088-.073-.165-.104-.25-.058-.157-.108-.316-.191-.46-.056-.097-.137-.176-.203-.265-.087-.117-.161-.242-.265-.345-.085-.086-.194-.148-.29-.223-.109-.085-.206-.182-.327-.252l-.002-.001-.002-.002L40.098 1.396a2.971 2.971 0 00-2.964 0L1.487 21.919l-.002.002-.002.001c-.121.07-.219.167-.327.252-.096.075-.205.138-.29.223-.103.103-.178.228-.265.345-.066.089-.147.169-.203.265-.083.144-.133.304-.191.46-.031.085-.08.162-.104.25-.067.249-.103.51-.103.776v122.09c0 1.063.568 2.044 1.489 2.575l71.293 41.045c.156.089.324.143.49.202.078.028.15.074.23.095a2.98 2.98 0 001.524 0c.069-.018.132-.059.2-.083.176-.061.354-.119.519-.214l71.293-41.045a2.971 2.971 0 001.489-2.575v-38.979l34.158-19.666a2.971 2.971 0 001.489-2.575V44.666a3.075 3.075 0 00-.106-.774zM74.255 143.167l-29.648-16.779 31.136-17.926.001-.001 34.164-19.669 29.674 17.084-21.772 12.428-43.555 24.863zm68.329-76.259v33.841l-12.475-7.182-17.231-9.92V49.806l12.475 7.182 17.231 9.92zm2.97-39.335l29.693 17.095-29.693 17.095-29.693-17.095 29.693-17.095zM54.06 114.089l-12.475 7.182V46.733l17.231-9.92 12.475-7.182v74.537l-17.231 9.921zM38.614 7.398l29.693 17.095-29.693 17.095L8.921 24.493 38.614 7.398zM5.938 29.632l12.475 7.182 17.231 9.92v79.676l.001.005-.001.006c0 .114.032.221.045.333.017.146.021.294.059.434l.002.007c.032.117.094.222.14.334.051.124.088.255.156.371a.036.036 0 00.004.009c.061.105.149.191.222.288.081.105.149.22.244.314l.008.01c.084.083.19.142.284.215.106.083.202.178.32.247l.013.005.011.008 34.139 19.321v34.175L5.939 144.867V29.632h-.001zm136.646 115.235l-65.352 37.625V148.31l48.399-27.628 16.953-9.677v33.862zm35.646-61.22l-29.706 17.102V66.908l17.231-9.92 12.475-7.182v33.841z"/>
                        </g>
                    </svg>
                </div>

                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laravel.com/docs" class="underline text-gray-900 dark:text-white">Documentation</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    Laravel has wonderful, thorough documentation covering every aspect of the framework. Whether you are new to the framework or have previous experience with Laravel, we recommend reading all of the documentation from beginning to end.
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laracasts.com" class="underline text-gray-900 dark:text-white">Laracasts</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    Laracasts offers thousands of video tutorials on Laravel, PHP, and JavaScript development. Check them out, see for yourself, and massively level up your development skills in the process.
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laravel-news.com/" class="underline text-gray-900 dark:text-white">Laravel News</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    Laravel News is a community driven portal and newsletter aggregating all of the latest and most important news in the Laravel ecosystem, including new package releases and tutorials.
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">Vibrant Ecosystem</div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    Laravel's robust library of first-party tools and libraries, such as <a href="https://forge.laravel.com" class="underline">Forge</a>, <a href="https://vapor.laravel.com" class="underline">Vapor</a>, <a href="https://nova.laravel.com" class="underline">Nova</a>, and <a href="https://envoyer.io" class="underline">Envoyer</a> help you take your projects to the next level. Pair them with powerful open source libraries like <a href="https://laravel.com/docs/billing" class="underline">Cashier</a>, <a href="https://laravel.com/docs/dusk" class="underline">Dusk</a>, <a href="https://laravel.com/docs/broadcasting" class="underline">Echo</a>, <a href="https://laravel.com/docs/horizon" class="underline">Horizon</a>, <a href="https://laravel.com/docs/sanctum" class="underline">Sanctum</a>, <a href="https://laravel.com/docs/telescope" class="underline">Telescope</a>, and more.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 sm:text-left">
                        <div class="flex items-center">
                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="-mt-px w-5 h-5 text-gray-400">
                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>

                            <a href="https://laravel.bigcartel.com" class="ml-1 underline">
                                Shop
                            </a>

                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="ml-4 -mt-px w-5 h-5 text-gray-400">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>

                            <a href="https://github.com/sponsors/taylorotwell" class="ml-1 underline">
                                Sponsor
                            </a>
                        </div>
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
