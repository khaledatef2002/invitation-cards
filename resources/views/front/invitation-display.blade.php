<!DOCTYPE html>
<html lang="ar">
<head dir="rtl">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $inv->title }}</title>
    <link rel="stylesheet" href="{{ asset('front/libs/bootstrap/css/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/libs/fontawesome/css/all.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('storage/' . $inv->logo) }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('front/libs/sweetalert2/sweet.css') }}">
    <style>
        :root {
            --button-color: {{ $inv->button_color }};
            --buttton-background-color: {{ $inv->button_background }};
            --border-color: {{ $inv->border_color }};
            --border-width: {{ $inv->border_width }};
            --border-radius: {{ $inv->border_radius }};
        }
        body
        {
            background: url("{{ asset('storage/' . $inv->background) }}") no-repeat center center fixed;
            background-size: cover;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('front/css/main.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="content-container mx-auto">
        <div class="container">
            <div class="content mx-auto text-center">
                <div class="logo">
                    <div class="logoMoe d-flex justify-content-center">
                        <img src="{{ asset('storage/' . $inv->logo) }}">
                    </div>
                </div>
            </div>
            <div class="content-text fs-5">
                <div class="text-center" style="white-space: pre-line;">
                    {{ $inv->description }}
                </div>
            </div>
            <div class="page-style-selection mx-auto d-flex justify-content-center gap-3">
                <div class="page-style-item-container d-flex flex-column align-items-center justify-contnet-center" role="button">
                    <div class="page-style-item rounded-3 p-1 d-flex align-items-center h-100 position-relative" data-type="long">
                        <img src="{{ asset('storage/' . $inv->long) }}" class="rounded-3" width="300" height="200">
                    </div>
                    <p class="mt-0">
                        طولي
                    </p>
                </div>
                <div class="page-style-item-container d-flex flex-column align-items-center justify-contnet-center" role="button">
                    <div class="page-style-item rounded-3 p-1 d-flex align-items-center h-100 position-relative" data-type="wide">
                        <img src="{{ asset('storage/' . $inv->wide) }}" class="rounded-3" width="300" height="200">
                    </div>
                    <p class="mt-0">
                        عرضي
                    </p>
                </div>
            </div>
            <div class="input-holder d-flex justify-content-center mt-3">
                <input placeholder="الاسم" class="">
            </div>
            <div class="recaptacha-holder d-flex justify-content-center mt-5 gap-2">
                <input placeholder="رمز التحقق" class="">
                <div class="d-flex">
                    <div class="d-flex flex-column justify-content-between">
                        <img src="{{ asset('front/image/recap.gif') }}" onclick="generate_captcha()" role="button">
                        <img src="{{ asset('front/image/BotDetectCaptcha.gif') }}" id="hear-captcha" role="button">
                    </div>
                    <img src="" id="captcha">
                </div>
            </div>
            <div class="submit-holder text-center mt-5 mb-5">
                <button>
                    <span class="text">أنشئ بطاقتك</span>
                </button>
            </div>
        </div>
    </div>
    <div class="BGBottom"></div>
<script src="{{ asset('front/libs/jquery/jquery-3.6.4.min.js') }}"></script>
<script src="{{ asset('front/libs/sweetalert2/sweet.js') }}"></script>
<script src="{{ asset('front/js/main.js') }}"></script>
</body>
</html>