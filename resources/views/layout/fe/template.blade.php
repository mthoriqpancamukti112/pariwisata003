<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="/frontend/assets/images/logo-wisata.png" type="image/x-icon" />

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
    <title>@yield('title')</title>
    <style>
        @font-face {
            font-family: "PlusJakartaSans";
            src: url("/frontend/assets/font/PlusJakartaSans-Medium.ttf") format("truetype");
        }

        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        a,
        span,
        li,
        div {
            font-family: "PlusJakartaSans";
        }

        @media (max-width: 768px) {
            .swal2-container {
                font-size: 8px;
            }

            .swal2-title {
                font-size: 18px;
            }

            .swal2-content {
                font-size: 8px;
            }

            .swal2-actions {
                font-size: 12px;
            }

            .swal2-popup {
                max-width: 280px;
                width: 70%;
            }
        }
    </style>
    <!-- Vendor CSS Files -->
    <link href="/frontend/assets/vendors/aos/aos.css" rel="stylesheet" />
    <link href="/frontend/assets/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/frontend/assets/vendors/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="/frontend/assets/vendors/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="/frontend/assets/vendors/glightbox/css/glightbox.min.css" rel="stylesheet" />
    <link href="/frontend/assets/vendors/swiper/swiper-bundle.min.css" rel="stylesheet" />
    <link href="/frontend/assets/vendors/fontawesome/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" id="thickbox-css" href="/frontend/assets/js/thickbox/thickbox.css" type="text/css"
        media="all" />
    <link rel="stylesheet" id="usquare-css-css"
        href="/frontend/assets/vendors/sliders/usquare/css/frontend/usquare_style.css" type="text/css" media="all" />
    <link rel="stylesheet" id="responsive-css" href="/frontend/assets/css/responsive.css" type="text/css"
        media="all" />
    <link rel="stylesheet" id="polaroid-slider-css" href="/frontend/assets/vendors/sliders/polaroid/css/polaroid.css"
        type="text/css" media="all" />
    <link rel="stylesheet" id="ahortcodes-css" href="/frontend/assets/css/shortcodes.css" type="text/css"
        media="all" />
    <link rel="stylesheet" id="contact-form-css" href="/frontend/assets/css/contact_form.css" type="text/css"
        media="all" />
    <link rel="stylesheet" id="custom-css" href="/frontend/assets/css/custom.css" type="text/css" media="all" />

    <!-- Template Main CSS File -->
    <link href="/frontend/assets/css/adminlte.css" rel="stylesheet" />
    <link href="/frontend/assets/css/styleb.css" rel="stylesheet" />

    <script type="text/javascript" src="/frontend/assets/js/jquery/jquery.js"></script>
</head>

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<body>
    @include('layout.fe.top-nav') @yield('content')
    @include('layout.fe.footer')

    <script src="/frontend/assets/vendors/purecounter/purecounter_vanilla.js"></script>
    <script src="/frontend/assets/vendors/aos/aos.js"></script>
    <script src="/frontend/assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/frontend/assets/vendors/glightbox/js/glightbox.min.js"></script>
    <script src="/frontend/assets/vendors/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="/frontend/assets/vendors/swiper/swiper-bundle.min.js"></script>
    <script src="/frontend/assets/vendors/waypoints/noframework.waypoints.js"></script>
    <script src="/frontend/assets/vendors/php-email-form/validate.js"></script>
    <script type="text/javascript" src="/frontend/assets/js/comment-reply.min.js"></script>
    <script type="text/javascript" src="/frontend/assets/js/underscore.min.js"></script>
    <script type="text/javascript" src="/frontend/assets/js/jquery/jquery.masonry.min.js"></script>
    <script type="text/javascript" src="/frontend/assets/vendors/sliders/polaroid/js/jquery.polaroid.js"></script>
    <script type="text/javascript" src="/frontend/assets/js/jquery.colorbox-min.js"></script>
    <script type="text/javascript" src="/frontend/assets/js/jquery.easing.js"></script>
    <script type="text/javascript" src="/frontend/assets/js/jquery.carouFredSel-6.1.0-packed.js"></script>
    <script type="text/javascript" src="/frontend/assets/js/jQuery.BlackAndWhite.js"></script>
    <script type="text/javascript" src="/frontend/assets/js/jquery.touchSwipe.min.js"></script>
    <script type="text/javascript" src="/frontend/assets/vendors/sliders/polaroid/js/jquery.transform-0.8.0.min.js">
    </script>
    <script type="text/javascript" src="/frontend/assets/vendors/sliders/polaroid/js/jquery.preloader.js"></script>
    <script type="text/javascript" src="/frontend/assets/js/responsive.js"></script>
    <script type="text/javascript" src="/frontend/assets/js/mobilemenu.js"></script>
    <script type="text/javascript" src="/frontend/assets/js/jquery.superfish.js"></script>
    <script type="text/javascript" src="/frontend/assets/js/jquery.placeholder.js"></script>
    <script type="text/javascript" src="/frontend/assets/js/contact.js"></script>
    <script type="text/javascript" src="/frontend/assets/js/jquery.tipsy.js"></script>
    <script type="text/javascript" src="/frontend/assets/js/jquery.cycle.min.js"></script>
    <script type="text/javascript" src="/frontend/assets/js/shortcodes.js"></script>
    <script type="text/javascript" src="/frontend/assets/js/jquery.custom.js"></script>

    <!-- Template Main JS File -->
    <script src="/frontend/assets/js/main.js"></script>
</body>

</html>
