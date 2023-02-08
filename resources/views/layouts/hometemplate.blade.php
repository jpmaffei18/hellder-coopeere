<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

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
  <script type="application/ld+json" class="yoast-schema-graph">
    {
      "@context": "https://schema.org",
      "@graph": [{
        "@type": "WebSite",
        "@id": "https://www.coopeere.eco.br/#website",
        "url": "https://www.coopeere.eco.br/",
        "name": "Coopeere",
        "description": "",
        "potentialAction": [{
          "@type": "SearchAction",
          "target": "https://www.coopeere.eco.br/?s={search_term_string}",
          "query-input": "required name=search_term_string"
        }],
        "inLanguage": "pt-BR"
      }, {
        "@type": "WebPage",
        "@id": "https://www.coopeere.eco.br/cadastro-de-cooperado/#webpage",
        "url": "https://www.coopeere.eco.br/cadastro-de-cooperado/",
        "name": "Cadastro de Cooperado - Coopeere",
        "isPartOf": {
          "@id": "https://www.coopeere.eco.br/#website"
        },
        "datePublished": "2020-10-05T12:23:48+00:00",
        "dateModified": "2020-12-11T17:46:28+00:00",
        "breadcrumb": {
          "@id": "https://www.coopeere.eco.br/cadastro-de-cooperado/#breadcrumb"
        },
        "inLanguage": "pt-BR",
        "potentialAction": [{
          "@type": "ReadAction",
          "target": ["https://www.coopeere.eco.br/cadastro-de-cooperado/"]
        }]
      }, {
        "@type": "BreadcrumbList",
        "@id": "https://www.coopeere.eco.br/cadastro-de-cooperado/#breadcrumb",
        "itemListElement": [{
          "@type": "ListItem",
          "position": 1,
          "item": {
            "@type": "WebPage",
            "@id": "https://www.coopeere.eco.br/",
            "url": "https://www.coopeere.eco.br/",
            "name": "In\u00edcio"
          }
        }, {
          "@type": "ListItem",
          "position": 2,
          "item": {
            "@type": "WebPage",
            "@id": "https://www.coopeere.eco.br/cadastro-de-cooperado/",
            "url": "https://www.coopeere.eco.br/cadastro-de-cooperado/",
            "name": "Cadastro de Cooperado"
          }
        }]
      }]
    }
  </script>
  <!-- / Yoast SEO plugin. -->


  <link rel='dns-prefetch' href='//s.w.org' />
  <link rel="alternate" type="application/rss+xml" title="Feed para Coopeere &raquo;"
    href="https://www.coopeere.eco.br/feed/" />
  <link rel="alternate" type="application/rss+xml" title="Feed de comentários para Coopeere &raquo;"
    href="https://www.coopeere.eco.br/comments/feed/" />
  <script type="text/javascript">
    window._wpemojiSettings = {
      "baseUrl": "https:\/\/s.w.org\/images\/core\/emoji\/13.0.1\/72x72\/",
      "ext": ".png",
      "svgUrl": "https:\/\/s.w.org\/images\/core\/emoji\/13.0.1\/svg\/",
      "svgExt": ".svg",
      "source": {
        "concatemoji": "https:\/\/www.coopeere.eco.br\/wp-includes\/js\/wp-emoji-release.min.js?ver=746e4c11d22ed8d851dc394b530c5ac2"
      }
    };
    ! function(e, a, t) {
      var n, r, o, i = a.createElement("canvas"),
        p = i.getContext && i.getContext("2d");

      function s(e, t) {
        var a = String.fromCharCode;
        p.clearRect(0, 0, i.width, i.height), p.fillText(a.apply(this, e), 0, 0);
        e = i.toDataURL();
        return p.clearRect(0, 0, i.width, i.height), p.fillText(a.apply(this, t), 0, 0), e === i.toDataURL()
      }

      function c(e) {
        var t = a.createElement("script");
        t.src = e, t.defer = t.type = "text/javascript", a.getElementsByTagName("head")[0].appendChild(t)
      }
      for (o = Array("flag", "emoji"), t.supports = {
          everything: !0,
          everythingExceptFlag: !0
        }, r = 0; r < o.length; r++) t.supports[o[r]] = function(e) {
        if (!p || !p.fillText) return !1;
        switch (p.textBaseline = "top", p.font = "600 32px Arial", e) {
          case "flag":
            return s([127987, 65039, 8205, 9895, 65039], [127987, 65039, 8203, 9895, 65039]) ? !1 : !s([55356, 56826,
              55356, 56819
            ], [55356, 56826, 8203, 55356, 56819]) && !s([55356, 57332, 56128, 56423, 56128, 56418, 56128, 56421,
              56128, 56430, 56128, 56423, 56128, 56447
            ], [55356, 57332, 8203, 56128, 56423, 8203, 56128, 56418, 8203, 56128, 56421, 8203, 56128, 56430, 8203,
              56128, 56423, 8203, 56128, 56447
            ]);
          case "emoji":
            return !s([55357, 56424, 8205, 55356, 57212], [55357, 56424, 8203, 55356, 57212])
        }
        return !1
      }(o[r]), t.supports.everything = t.supports.everything && t.supports[o[r]], "flag" !== o[r] && (t.supports
        .everythingExceptFlag = t.supports.everythingExceptFlag && t.supports[o[r]]);
      t.supports.everythingExceptFlag = t.supports.everythingExceptFlag && !t.supports.flag, t.DOMReady = !1, t
        .readyCallback = function() {
          t.DOMReady = !0
        }, t.supports.everything || (n = function() {
          t.readyCallback()
        }, a.addEventListener ? (a.addEventListener("DOMContentLoaded", n, !1), e.addEventListener("load", n, !1)) : (e
          .attachEvent("onload", n), a.attachEvent("onreadystatechange", function() {
            "complete" === a.readyState && t.readyCallback()
          })), (n = t.source || {}).concatemoji ? c(n.concatemoji) : n.wpemoji && n.twemoji && (c(n.twemoji), c(n
          .wpemoji)))
    }(window, document, window._wpemojiSettings);
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
  <link rel='stylesheet' id='wp-block-library-css'
    href='https://www.coopeere.eco.br/wp-includes/css/dist/block-library/style.min.css?ver=746e4c11d22ed8d851dc394b530c5ac2'
    type='text/css' media='all' />
  <link rel='stylesheet' id='wpforms-full-css'
    href='https://www.coopeere.eco.br/wp-content/plugins/wpforms/assets/css/wpforms-full.min.css?ver=1.6.5.1'
    type='text/css' media='all' />
  <link rel='stylesheet' id='hello-elementor-css'
    href='https://www.coopeere.eco.br/wp-content/themes/hello-elementor/style.min.css?ver=2.3.1' type='text/css'
    media='all' />
  <link rel='stylesheet' id='hello-elementor-theme-style-css'
    href='https://www.coopeere.eco.br/wp-content/themes/hello-elementor/theme.min.css?ver=2.3.1' type='text/css'
    media='all' />
  <link rel='stylesheet' id='elementor-icons-css'
    href='https://www.coopeere.eco.br/wp-content/plugins/elementor/assets/lib/eicons/css/elementor-icons.min.css?ver=5.11.0'
    type='text/css' media='all' />
  <link rel='stylesheet' id='elementor-animations-css'
    href='https://www.coopeere.eco.br/wp-content/plugins/elementor/assets/lib/animations/animations.min.css?ver=3.1.3'
    type='text/css' media='all' />
  <link rel='stylesheet' id='elementor-frontend-legacy-css'
    href='https://www.coopeere.eco.br/wp-content/plugins/elementor/assets/css/frontend-legacy.min.css?ver=3.1.3'
    type='text/css' media='all' />
  <link rel='stylesheet' id='elementor-frontend-css'
    href='https://www.coopeere.eco.br/wp-content/plugins/elementor/assets/css/frontend.min.css?ver=3.1.3'
    type='text/css' media='all' />
  <link rel='stylesheet' id='elementor-post-34-css'
    href='https://www.coopeere.eco.br/wp-content/uploads/elementor/css/post-34.css?ver=1615313181' type='text/css'
    media='all' />
  <link rel='stylesheet' id='elementor-pro-css'
    href='https://www.coopeere.eco.br/wp-content/plugins/elementor-pro/assets/css/frontend.min.css?ver=3.1.1'
    type='text/css' media='all' />
  <link rel='stylesheet' id='elementor-post-466-css'
    href='https://www.coopeere.eco.br/wp-content/uploads/elementor/css/post-466.css?ver=1615313182' type='text/css'
    media='all' />
  <link rel='stylesheet' id='elementor-post-538-css'
    href='https://www.coopeere.eco.br/wp-content/uploads/elementor/css/post-538.css?ver=1615315568' type='text/css'
    media='all' />
  <link rel='stylesheet' id='jltma-bootstrap-css'
    href='https://www.coopeere.eco.br/wp-content/plugins/master-addons/assets/css/bootstrap.min.css?ver=746e4c11d22ed8d851dc394b530c5ac2'
    type='text/css' media='all' />
  <link rel='stylesheet' id='master-addons-main-style-css'
    href='https://www.coopeere.eco.br/wp-content/plugins/master-addons/assets/css/master-addons-styles.css?ver=746e4c11d22ed8d851dc394b530c5ac2'
    type='text/css' media='all' />
  <link rel='stylesheet' id='google-fonts-1-css'
    href='https://fonts.googleapis.com/css?family=Roboto%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CRoboto+Slab%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7COpen+Sans%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&#038;ver=746e4c11d22ed8d851dc394b530c5ac2'
    type='text/css' media='all' />
  <link rel='stylesheet' id='elementor-icons-shared-0-css'
    href='https://www.coopeere.eco.br/wp-content/plugins/elementor/assets/lib/font-awesome/css/fontawesome.min.css?ver=5.15.1'
    type='text/css' media='all' />
  <link rel='stylesheet' id='elementor-icons-fa-solid-css'
    href='https://www.coopeere.eco.br/wp-content/plugins/elementor/assets/lib/font-awesome/css/solid.min.css?ver=5.15.1'
    type='text/css' media='all' />
  <script type='text/javascript' id='jquery-core-js-before'>
    /* < ![CDATA[ */
    function jltmaNS(n) {
      for (var e = n.split("."), a = window, i = "", r = e.length, t = 0; r > t; t++) "window" != e[t] && (i = e[t], a[
        i] = a[i] || {}, a = a[i]);
      return a;
    }
    /* ]]> */
  </script>
  <script type='text/javascript' src='https://www.coopeere.eco.br/wp-includes/js/jquery/jquery.min.js?ver=3.5.1'
    id='jquery-core-js'></script>
  <script type='text/javascript' src='https://www.coopeere.eco.br/wp-includes/js/jquery/jquery-migrate.min.js?ver=3.3.2'
    id='jquery-migrate-js'></script>
  <link rel="https://api.w.org/" href="https://www.coopeere.eco.br/wp-json/" />
  <link rel="alternate" type="application/json" href="https://www.coopeere.eco.br/wp-json/wp/v2/pages/400" />
  <link rel="EditURI" type="application/rsd+xml" title="RSD" href="https://www.coopeere.eco.br/xmlrpc.php?rsd" />
  <link rel="wlwmanifest" type="application/wlwmanifest+xml"
    href="https://www.coopeere.eco.br/wp-includes/wlwmanifest.xml" />

  <link rel='shortlink' href='https://www.coopeere.eco.br/?p=400' />
  <link rel="alternate" type="application/json+oembed"
    href="https://www.coopeere.eco.br/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fwww.coopeere.eco.br%2Fcadastro-de-cooperado%2F" />
  <link rel="alternate" type="text/xml+oembed"
    href="https://www.coopeere.eco.br/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fwww.coopeere.eco.br%2Fcadastro-de-cooperado%2F&#038;format=xml" />
  <script type="text/javascript">
    (function() {
      window.ma_el_fs = {
        can_use_premium_code: false
      };
    })();
  </script>
  <link rel="icon" href="https://www.coopeere.eco.br/wp-content/uploads/2020/09/logo-coopere-final-150x150.png"
    sizes="32x32" />
  <link rel="icon" href="https://www.coopeere.eco.br/wp-content/uploads/2020/09/logo-coopere-final.png"
    sizes="192x192" />
  <link rel="apple-touch-icon" href="https://www.coopeere.eco.br/wp-content/uploads/2020/09/logo-coopere-final.png" />
  <meta name="msapplication-TileImage"
    content="https://www.coopeere.eco.br/wp-content/uploads/2020/09/logo-coopere-final.png" />
  <style type="text/css" id="wp-custom-css">
    a:link {
      color: #000;
    }

    a:hover,
    a:visited {
      color: #095ba4;
    }

    .page-header {
      padding-top: 90px;
    }

    h1.entry-title {
      display: none;
    }

    h4.elementor-heading-title,
    .elementor-heading-title {
      font-size: 37px;
      font-family: "Open Sans", Sans-serif;
    }

    .page-content p {
      font-family: "Open Sans", Sans-serif;
      font-size: 15px;
    }

    /* On screens that are 992px or less, set the background color to blue */
    @media screen and (max-width: 992px) {
      .page-header {
        padding: 36px 0 24px;
      }

      h1.entry-title {
        display: none;
      }
    }

    /* On screens that are 600px or less, set the background color to olive */
    @media screen and (max-width: 600px) {
      .page-header {
        padding: 36px 0 60px;
      }

      h1.entry-title {
        display: none;
      }
    }

  </style>

<link href="{{ mix('/css/app.css') }}" rel="stylesheet">
<script src="{{ mix('/js/app.js') }}"></script>
</head>

<body class="page-template-default page page-id-400 elementor-default elementor-kit-34 elementor-page-538">


  <div data-elementor-type="header" data-elementor-id="466" class="elementor elementor-466 elementor-location-header"
    data-elementor-settings="[]">
    <div class="elementor-section-wrap">
      <section
        class="has_ma_el_bg_slider elementor-section elementor-top-section elementor-element elementor-element-cce1944 elementor-section-height-min-height elementor-section-content-middle elementor-section-boxed elementor-section-height-default elementor-section-items-middle"
        data-id="cce1944" data-element_type="section"
        data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
        <div class="elementor-container elementor-column-gap-no">
          <div class="elementor-row">
            <div
              class="has_ma_el_bg_slider elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-a583d3d"
              data-id="a583d3d" data-element_type="column">
              <div class="elementor-column-wrap elementor-element-populated">
                <div class="elementor-widget-wrap">
                  <div
                    class="elementor-element elementor-element-b10e0af elementor-icon-list--layout-inline elementor-align-right elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list"
                    data-id="b10e0af" data-element_type="widget" data-widget_type="icon-list.default">
                    <div class="elementor-widget-container">
                      <ul class="elementor-icon-list-items elementor-inline-items">
                        <li class="elementor-icon-list-item elementor-inline-item">
                          <a href="http://<?php echo request()->getHttpHost(); ?>"> <span class="elementor-icon-list-icon">
                              <i aria-hidden="true" class="fas fa-user"></i> </span>
                            <span class="elementor-icon-list-text">Login</span>
                          </a>
                        </li>
                        <li class="elementor-icon-list-item elementor-inline-item">
                          <a href="http://<?php echo request()->getHttpHost() . '/precadastro/inserir'; ?>"> <span class="elementor-icon-list-icon">
                              <i aria-hidden="true" class="fas fa-pencil-alt"></i> </span>
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
      <header
        class="has_ma_el_bg_slider elementor-section elementor-top-section elementor-element elementor-element-419a63b6 elementor-section-content-middle elementor-section-height-min-height elementor-section-boxed elementor-section-height-default elementor-section-items-middle"
        data-id="419a63b6" data-element_type="section"
        data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
        <div class="elementor-container elementor-column-gap-no">
          <div class="elementor-row">
            <div
              class="has_ma_el_bg_slider elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-49c56e98"
              data-id="49c56e98" data-element_type="column">
              <div class="elementor-column-wrap elementor-element-populated">
                <div class="elementor-widget-wrap">
                  <div class="elementor-element elementor-element-bb1f0a4 elementor-widget elementor-widget-image"
                    data-id="bb1f0a4" data-element_type="widget" data-widget_type="image.default">
                    <div class="elementor-widget-container">
                      <div class="elementor-image">
                        <a href="https://www.coopeere.eco.br">
                          <img
                            src="https://www.coopeere.eco.br/wp-content/uploads/elementor/thumbs/logo-coopere-final-p3z3q5yfwgadw4jj0fu4u9ghauf0po3phz3cd1hps0.png"
                            title="logo-coopere-final" alt="logo-coopere-final"> </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div
              class="has_ma_el_bg_slider elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-63fb0818"
              data-id="63fb0818" data-element_type="column">
              <div class="elementor-column-wrap elementor-element-populated">
                <div class="elementor-widget-wrap">
                  <div
                    class="elementor-element elementor-element-39d4ed57 elementor-nav-menu__align-right elementor-nav-menu--stretch elementor-nav-menu--indicator-angle elementor-nav-menu--dropdown-tablet elementor-nav-menu__text-align-aside elementor-nav-menu--toggle elementor-nav-menu--burger elementor-widget elementor-widget-nav-menu"
                    data-id="39d4ed57" data-element_type="widget"
                    data-settings="{&quot;full_width&quot;:&quot;stretch&quot;,&quot;layout&quot;:&quot;horizontal&quot;,&quot;toggle&quot;:&quot;burger&quot;}"
                    data-widget_type="nav-menu.default">
                    <div class="elementor-widget-container">
                      <nav role="navigation"
                        class="elementor-nav-menu--main elementor-nav-menu__container elementor-nav-menu--layout-horizontal e--pointer-underline e--animation-slide">
                        <ul id="menu-1-39d4ed57" class="elementor-nav-menu" data-smartmenus-id="16216001485418845">
                          <li
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-243">
                            <a href="https://www.coopeere.eco.br/" class="elementor-item">Home</a></li>
                          <li
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-1768">
                            <a href="#" class="elementor-item elementor-item-anchor has-submenu"
                              id="sm-16216001485418845-1" aria-haspopup="true" aria-controls="sm-16216001485418845-2"
                              aria-expanded="false">A Coopeere<span class="sub-arrow"><i
                                  class="fa"></i></span></a>
                            <ul class="sub-menu elementor-nav-menu--dropdown sm-nowrap" id="sm-16216001485418845-2"
                              role="group" aria-hidden="true" aria-labelledby="sm-16216001485418845-1"
                              aria-expanded="false"
                              style="width: auto; display: none; top: auto; left: 0px; margin-left: 0px; margin-top: 0px; min-width: 10em; max-width: 1000px;">
                              <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-272"><a
                                  href="https://www.coopeere.eco.br/a-coopeere/quem-somos/"
                                  class="elementor-sub-item">Quem somos</a></li>
                              <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-277"><a
                                  href="https://www.coopeere.eco.br/objetivo/" class="elementor-sub-item">Objetivo</a>
                              </li>
                              <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-276"><a
                                  href="https://www.coopeere.eco.br/a-equipe/" class="elementor-sub-item">A equipe</a>
                              </li>
                            </ul>
                          </li>
                          <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-275"><a
                              href="https://www.coopeere.eco.br/estatuto/" class="elementor-item">Estatuto</a></li>
                          <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-274"><a
                              href="https://www.coopeere.eco.br/legislacao/" class="elementor-item">Legislação</a></li>
                          <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-273"><a
                              href="https://www.coopeere.eco.br/vantagens/" class="elementor-item">Vantagens</a></li>
                          <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1815"><a
                              href="https://www.coopeere.eco.br/parceiros/" class="elementor-item">Parceiros</a></li>
                          <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-278"><a
                              href="https://www.coopeere.eco.br/fale-conosco/" class="elementor-item">Fale conosco</a>
                          </li>
                        </ul>
                      </nav>
                      <div class="elementor-menu-toggle" role="button" tabindex="0" aria-label="Alternar menu"
                        aria-expanded="false" style="">
                        <i class="eicon-menu-bar" aria-hidden="true"></i>
                        <span class="elementor-screen-only">Menu</span>
                      </div>
                      <nav class="elementor-nav-menu--dropdown elementor-nav-menu__container" role="navigation"
                        aria-hidden="true" style="top: 49.6901px; width: 2102px; left: 0px;">
                        <ul id="menu-2-39d4ed57" class="elementor-nav-menu" data-smartmenus-id="16216001485443025">
                          <li
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-243">
                            <a href="https://www.coopeere.eco.br/" class="elementor-item">Home</a></li>
                          <li
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-1768">
                            <a href="#" class="elementor-item elementor-item-anchor has-submenu"
                              id="sm-16216001485443025-1" aria-haspopup="true" aria-controls="sm-16216001485443025-2"
                              aria-expanded="false">A Coopeere<span class="sub-arrow"><i
                                  class="fa"></i></span></a>
                            <ul class="sub-menu elementor-nav-menu--dropdown" id="sm-16216001485443025-2" role="group"
                              aria-hidden="true" aria-labelledby="sm-16216001485443025-1" aria-expanded="false">
                              <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-272"><a
                                  href="https://www.coopeere.eco.br/a-coopeere/quem-somos/"
                                  class="elementor-sub-item">Quem somos</a></li>
                              <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-277"><a
                                  href="https://www.coopeere.eco.br/objetivo/" class="elementor-sub-item">Objetivo</a>
                              </li>
                              <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-276"><a
                                  href="https://www.coopeere.eco.br/a-equipe/" class="elementor-sub-item">A equipe</a>
                              </li>
                            </ul>
                          </li>
                          <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-275"><a
                              href="https://www.coopeere.eco.br/estatuto/" class="elementor-item">Estatuto</a></li>
                          <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-274"><a
                              href="https://www.coopeere.eco.br/legislacao/" class="elementor-item">Legislação</a></li>
                          <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-273"><a
                              href="https://www.coopeere.eco.br/vantagens/" class="elementor-item">Vantagens</a></li>
                          <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1815"><a
                              href="https://www.coopeere.eco.br/parceiros/" class="elementor-item">Parceiros</a></li>
                          <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-278"><a
                              href="https://www.coopeere.eco.br/fale-conosco/" class="elementor-item">Fale conosco</a>
                          </li>
                        </ul>
                      </nav>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div
              class="has_ma_el_bg_slider elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-6c3ad609"
              data-id="6c3ad609" data-element_type="column">
              <div class="elementor-column-wrap elementor-element-populated">
                <div class="elementor-widget-wrap">
                  <div
                    class="elementor-element elementor-element-46dde139 elementor-search-form--skin-full_screen elementor-widget elementor-widget-search-form"
                    data-id="46dde139" data-element_type="widget"
                    data-settings="{&quot;skin&quot;:&quot;full_screen&quot;}" data-widget_type="search-form.default">
                    <div class="elementor-widget-container">
                      <form class="elementor-search-form" role="search" action="https://www.coopeere.eco.br"
                        method="get">
                        <div class="elementor-search-form__toggle">
                          <i aria-hidden="true" class="fas fa-search"></i> <span
                            class="elementor-screen-only">Pesquisar</span>
                        </div>
                        <div class="elementor-search-form__container">
                          <input placeholder="Procurar..." class="elementor-search-form__input" type="search" name="s"
                            title="Pesquisar" value="">
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

  @yield('content')
</body>

</html>


<!-- Scripts DataTables -->
<script src="{{ URL::asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/datatables/datatables-demo.js') }}"></script>
