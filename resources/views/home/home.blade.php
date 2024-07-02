<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
    <meta charset="utf-8" />
    <title>Accueil | Xtrak</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="XTRAK- HARMEN & BOTTS" name="description" />
    <meta content="Xtrak" name="author" />
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.jpg') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
    /* Styles for large screens */
    .login_bg {
        background-image: url('{{ asset('assets/images/landing.jpg') }}');
        background-size: cover;
        background-repeat: no-repeat;
    }
    .header-container {
        position: absolute;
        top: 2%;
        left: 8%;
        display: flex;
        align-items: center;
    }
    .header-container img {
        height:100%;
        width: 13%;
    }
    .header-container .separator {
        margin-left: -72%;
        font-size: 50px;
        color: white;
        margin-right:4%;
    }
    .circle {
        width:35%;
        height:35%;
        border-radius: 50%;
        text-align: center;
        line-height:100%;
        color: black;
        border: none;
        cursor: pointer;
        font-size: 18px;
        position: absolute;
        transition: background-color 0.1s ease, border 0.1s ease;
    }
    .circle:hover {
        background-color: white !important;
        border: 2px solid;
    }
    #EVT1:hover { border-color: #FFC0CB; color: #FFC0CB; }
    #EVT2:hover { border-color: #FFA500; color: #FFA500; }
    #CPN:hover { border-color: #FF0000; color: #FF0000; }
    #OPP:hover { border-color: #800080; color: #800080; }
    #TRG:hover { border-color: #808080; color: #808080; }
    #CDT:hover { border-color: #FFFF00; color: #FFFF00; }
    #ANN:hover { border-color: #00FFFF; color: #00FFFF; }
    #CTC:hover { border-color: #00FF00; color: #00FF00; }
    #container {
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;
        width: 10%;
        height:18%;
        bottom: 45%;
        right: 10%;
    }
    #xtrak {
        width:50%;
        height:60%;
        margin-top:2%;
    }
    /* @media (max-width: 767px) {
        .header-container {
            top: 10px;
            left: 10px;
            flex-direction: column;
            align-items: flex-start;
        }
        .header-container img {
            height: 40px;
            width: 140px;
            margin-right: 20px;
        }
        .header-container .separator {
            margin-right: 20px;
            font-size: 30px;
        }
        .header-container h1 {
            margin-top: 10px;
        }
        #container {
            bottom: 150px;
            right: 10px;
        }
    }
    @media (max-width: 576px) {
        .circle {
            width: 50px;
            height: 50px;
            font-size: 16px;
            line-height: 50px;
        }
        .header-container {
            flex-direction: row;
            align-items: center;
        }
        .header-container a img,
        #xtrak {
            width: 50%;
            max-width: 100px;
        }
        .header-container .separator {
            display: none;
        }
    }
    @media (max-width: 400px) {
        .circle {
            width: 40px;
            height: 40px;
            font-size: 12px;
            line-height: 40px;
        }
        #container {
            width: 150px;
            height: 150px;
        }
    } */
    </style>
</head>
<body class="login_bg">
    <div class="container-fluid d-flex justify-content-center align-items-center">
        <div class="header-container">
            <a href="https://www.harmen-botts.com/">
                <img src="{{ asset('assets/images/logo.jpg') }}" alt="Harmen & Botts Logo">
            </a>
            <span class="separator">|</span>
            <h1><img src="{{ asset('assets/images/xtrak.png') }}" alt="XTrak Logo" id="xtrak"></h1>
        </div>
        <div id="container">
            <button class="circle" style="background-color: #FFC0CB;" id="EVT1">EVT</button>
            <button class="circle" style="background-color: #FFA500;" id="EVT2">XTK</button>
            <button class="circle" style="background-color: #FF0000;" id="CPN">CPN</button>
            <button class="circle" style="background-color: #800080;" id="OPP">OPP</button>
            <button class="circle" style="background-color: #808080;" id="TRG">TRG</button>
            <button class="circle" style="background-color: #FFFF00;" id="CDT">CDT</button>
            <button class="circle" style="background-color: #00FFFF;" id="ANN">ANN</button>
            <button class="circle" style="background-color: #00FF00;" id="CTC">CTC</button>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>

    <!-- particles js -->
    <script src="{{ asset('assets/libs/particles.js/particles.js') }}"></script>
    <!-- particles app js -->
    <script src="{{ asset('assets/js/pages/particles.app.js') }}"></script>
    <!-- password-addon init -->
    <script src="{{ asset('assets/js/pages/password-addon.init.js') }}"></script>
    <script>
        const radius = 70;
        const container = document.getElementById('container');
        const circles = document.getElementsByClassName('circle');
        const angleStep = 360 / circles.length;

        function positionCircles() {
            for (let i = 0; i < circles.length; i++) {
                const angle = angleStep * i;
                const x = radius * Math.cos(angle * Math.PI / 180);
                const y = radius * Math.sin(angle * Math.PI / 180);

                circles[i].style.left = `${container.offsetWidth / 2 + x - circles[i].offsetWidth / 2}%`;
                circles[i].style.top = `${container.offsetHeight / 2 + y - circles[i].offsetHeight / 2}%`;
            }
        }

        window.addEventListener('resize', positionCircles);
        positionCircles();

        document.getElementById('CDT').addEventListener('click', function() {
            window.location.href = '{{ route('dashboard') }}';
        });
    </script>
</body>
</html>
