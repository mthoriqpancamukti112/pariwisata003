<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="/frontend/assets/images/logo-wisata.png" type="image/x-icon" />
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>
    <link href="/backend/style.min.css" rel="stylesheet" />
    {{--
        <link
            href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css"
            rel="stylesheet"
        />
        --}}
    <link href="/backend/css/styles.css" rel="stylesheet" />
    <script src="/backend/js/all.js" crossorigin="anonymous"></script>
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
</head>

<body class="sb-nav-fixed">
    @include('layout.be.top-nav')

    <div id="layoutSidenav">
        @include('layout.be.sidebar')

        <div id="layoutSidenav_content">
            @yield('content') @include('layout.be.footer')
        </div>
    </div>
    <script src="/backend/js/bootstrap.bundle.min.js"></script>
    <script src="/backend/js/scripts.js"></script>
    {{--
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
            crossorigin="anonymous"
        ></script>
        --}}
    <script src="/backend/js/Chart.min.js"></script>
    <script src="/backend/assets/demo/chart-area-demo.js"></script>
    <script src="/backend/assets/demo/chart-bar-demo.js"></script>
    {{--
        <script
            src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
            --}}
    {{--
            <script
            src="/backend/js/datatables.min.js"
        ></script>
        --}}
    <script src="/backend/js/simple-datatables.min.js"></script>
    <script src="/backend/js/datatables-simple-demo.js"></script>
</body>

</html>
