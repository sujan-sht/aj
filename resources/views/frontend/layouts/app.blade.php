<!DOCTYPE html>
@if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
<html dir="rtl" lang="en">
@else
<html lang="en">
@endif
<head>

@php
    $seosetting = \App\SeoSetting::first();
@endphp

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="index, follow">
<title>@yield('meta_title', config('app.name', 'Laravel'))</title>
<meta name="description" content="@yield('meta_description', $seosetting->description)" />
<meta name="keywords" content="@yield('meta_keywords', $seosetting->keyword)">
<meta name="author" content="{{ $seosetting->author }}">
<meta name="sitemap_link" content="{{ $seosetting->sitemap_link }}">

@yield('meta')

@if(!isset($detailedProduct))
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ config('app.name', 'Laravel') }}">
    <meta itemprop="description" content="{{ $seosetting->description }}">
    <meta itemprop="image" content="{{ asset(\App\GeneralSetting::first()->logo) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ config('app.name', 'Laravel') }}">
    <meta name="twitter:description" content="{{ $seosetting->description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ asset(\App\GeneralSetting::first()->logo) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ config('app.name', 'Laravel') }}" />
    <meta property="og:type" content="Ecommerce Site" />
    <meta property="og:url" content="{{ route('home') }}" />
    <meta property="og:image" content="{{ asset(\App\GeneralSetting::first()->logo) }}" />
    <meta property="og:description" content="{{ $seosetting->description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
@endif

<!-- Favicon -->
<link type="image/x-icon" href="{{ asset(\App\GeneralSetting::first()->favicon) }}" rel="shortcut icon" />


<!-- css Icon Font -->
<link rel="stylesheet" href="{{asset('frontend/assets/css/vendor/ecicons.min.css')}}" />

<!-- css All Plugins Files -->
<link rel="stylesheet" href="{{asset('frontend/assets/css/plugins/animate.css')}}" />
<link rel="stylesheet" href="{{asset('frontend/assets/css/plugins/swiper-bundle.min.css')}}" />
<link rel="stylesheet" href="{{asset('frontend/assets/css/plugins/jquery-ui.min.css')}}" />
<link rel="stylesheet" href="{{asset('frontend/assets/css/plugins/countdownTimer.css')}}" />
<link rel="stylesheet" href="{{asset('frontend/assets/css/plugins/slick.min.css')}}" />
<link rel="stylesheet" href="{{asset('frontend/assets/css/plugins/bootstrap.css')}}" />

<!-- Main Style -->
<link rel="stylesheet" href="{{asset('frontend/assets/css/demo1.css')}}" />
<link rel="stylesheet" href="{{asset('frontend/assets/css/responsive.css')}}" />

<!-- Background css -->
<link rel="stylesheet" id="bg-switcher-css" href="{{asset('frontend/assets/css/backgrounds/bg-4.css')}}">
@if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
     <!-- RTL -->
    <link type="text/css" href="{{ asset('frontend/css/active.rtl.css') }}" rel="stylesheet" media="all">
@endif

<!-- color theme -->
<link href="{{ asset('frontend/css/colors/'.\App\GeneralSetting::first()->frontend_color.'.css')}}" rel="stylesheet" media="all">

{{-- <!-- Custom style -->
<link type="text/css" href="{{ asset('frontend/css/custom-style.css') }}" rel="stylesheet" media="all">

<!-- jQuery -->
<script src="{{ asset('frontend/js/vendor/jquery.min.js') }}"></script> --}}


@if (\App\BusinessSetting::where('type', 'google_analytics')->first()->value == 1)
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('TRACKING_ID') }}"></script>

    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '{{ env('TRACKING_ID') }}');
    </script>
@endif

@if (\App\BusinessSetting::where('type', 'facebook_pixel')->first()->value == 1)
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', {{ env('FACEBOOK_PIXEL_ID') }});
  fbq('track', 'PageView');
</script>
<noscript>
  <img height="1" width="1" style="display:none"
       src="https://www.facebook.com/tr?id={{ env('FACEBOOK_PIXEL_ID') }}/&ev=PageView&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->
@endif

</head>
<body>
  <div id="ec-overlay"><span class="loader_img"></span></div>

  <!-- Header -->
  @include('frontend.inc.nav')

  @yield('content')

  @include('frontend.inc.footer')

  @include('frontend.partials.modal')

  @if (\App\BusinessSetting::where('type', 'facebook_chat')->first()->value == 1)
      <div id="fb-root"></div>
      <!-- Your customer chat code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="{{ env('FACEBOOK_PAGE_ID') }}">
      </div>
  @endif

    <!-- ekka Cart Start -->
    <div class="ec-side-cart-overlay"></div>
    <div id="ec-side-cart" class="ec-side-cart">
        <div class="ec-cart-inner">
            <div class="ec-cart-top">
                <div class="ec-cart-title">
                    <span class="cart_title">My Cart</span>
                    <button class="ec-close">×</button>
                </div>
                <ul class="eccart-pro-items">
                    <li>
                        <a href="product-left-sidebar.html" class="sidekka_pro_img"><img
                                src="{{asset('frontend/assets/images/product-image/6_1.jpg')}}" alt="product"></a>
                        <div class="ec-pro-content">
                            <a href="product-left-sidebar.html" class="cart_pro_title">T-shirt For Women</a>
                            <span class="cart-price"><span>$76.00</span> x 1</span>
                            <div class="qty-plus-minus">
                                <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                            </div>
                            <a href="javascript:void(0)" class="remove">×</a>
                        </div>
                    </li>
                    <li>
                        <a href="product-left-sidebar.html" class="sidekka_pro_img"><img
                                src="{{asset('frontend/assets/images/product-image/12_1.jpg')}}" alt="product"></a>
                        <div class="ec-pro-content">
                            <a href="product-left-sidebar.html" class="cart_pro_title">Women Leather Shoes</a>
                            <span class="cart-price"><span>$64.00</span> x 1</span>
                            <div class="qty-plus-minus">
                                <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                            </div>
                            <a href="javascript:void(0)" class="remove">×</a>
                        </div>
                    </li>
                    <li>
                        <a href="product-left-sidebar.html" class="sidekka_pro_img"><img
                                src="{{asset('frontend/assets/images/product-image/3_1.jpg')}}" alt="product"></a>
                        <div class="ec-pro-content">
                            <a href="product-left-sidebar.html" class="cart_pro_title">Girls Nylon Purse</a>
                            <span class="cart-price"><span>$59.00</span> x 1</span>
                            <div class="qty-plus-minus">
                                <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                            </div>
                            <a href="javascript:void(0)" class="remove">×</a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="ec-cart-bottom">
                <div class="cart-sub-total">
                    <table class="table cart-table">
                        <tbody>
                            <tr>
                                <td class="text-left">Sub-Total :</td>
                                <td class="text-right">$300.00</td>
                            </tr>
                            <tr>
                                <td class="text-left">VAT (20%) :</td>
                                <td class="text-right">$60.00</td>
                            </tr>
                            <tr>
                                <td class="text-left">Total :</td>
                                <td class="text-right primary-color">$360.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="cart_btn">
                    <a href="cart.html" class="btn btn-primary">View Cart</a>
                    <a href="checkout.html" class="btn btn-secondary">Checkout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ekka Cart End -->
  <!-- Vendor JS -->
  <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js">
  </script>
  <script src="{{asset('frontend/assets/js/vendor/jquery-3.5.1.min.js')}}"></script>
  <script src="{{asset('frontend/assets/js/vendor/popper.min.js')}}"></script>
  <script src="{{asset('frontend/assets/js/vendor/bootstrap.min.js')}}"></script>
  <script src="{{asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
  <script src="{{asset('frontend/assets/js/vendor/modernizr-3.11.2.min.js')}}"></script>

  <!--Plugins JS-->
  <script src="{{asset('frontend/assets/js/plugins/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('frontend/assets/js/plugins/countdownTimer.min.js')}}"></script>
  <script src="{{asset('frontend/assets/js/plugins/scrollup.js')}}"></script>
  <script src="{{asset('frontend/assets/js/plugins/jquery.zoom.min.js')}}"></script>
  <script src="{{asset('frontend/assets/js/plugins/slick.min.js')}}"></script>
  <script src="{{asset('frontend/assets/js/plugins/infiniteslidev2.js')}}"></script>
  <script src="{{asset('frontend/assets/js/vendor/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{asset('frontend/assets/js/plugins/jquery.sticky-sidebar.js')}}"></script>

  <!-- Main Js -->
  <script src="{{asset('frontend/assets/js/vendor/index.js')}}"></script>
  <script src="{{asset('frontend/assets/js/main.js')}}"></script>
  @yield('script')

</body>
</html>