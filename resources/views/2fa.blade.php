<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Authenticator Verification</title>
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
        div,
        label {
            font-family: "PlusJakartaSans";
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            width: 100%;
            max-width: 400px;
        }
    </style>
    <link href="/backend/style.min.css" rel="stylesheet" />
    <link href="/backend/css/styles.css" rel="stylesheet" />
    <script src="/backend/js/all.js" crossorigin="anonymous"></script>

</head>

<body>

    <div class="container">
        <h2><b>Google Authenticator Verification</b></h2>
        <p style="text-align: center">Silakan buka aplikasi Google Authenticator dan scan qr code di bawah ini:</p>

        {!! $google2faUrl !!} <!-- Menampilkan QR Code SVG -->

        <form method="POST" action="{{ route('2fa.authenticate') }}">
            @csrf
            <div class="form-group">
                <label for="otp">One-Time Password (OTP)</label>
                <input id="otp" type="text" name="otp"
                    class="form-control @error('otp') is-invalid @enderror" placeholder="Masukan 6 digit kode otp"
                    autofocus required maxlength="6">
                @error('otp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-2 text-center">
                <button type="submit" class="btn btn-primary btn-block">Verifikasi</button>
            </div>
        </form>
    </div>


    <script src="/backend/js/bootstrap.bundle.min.js"></script>
    <script src="/backend/js/scripts.js"></script>
    <script src="/backend/js/Chart.min.js"></script>
    <script src="/backend/assets/demo/chart-area-demo.js"></script>
    <script src="/backend/assets/demo/chart-bar-demo.js"></script>
    <script src="/backend/js/simple-datatables.min.js"></script>
    <script src="/backend/js/datatables-simple-demo.js"></script>
</body>

</html>
