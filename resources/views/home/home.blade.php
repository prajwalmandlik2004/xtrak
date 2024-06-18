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
        .login_bg {
            background-image: url('{{ asset('assets/images/landing.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
        }
        .header-container {
            position: absolute;
            top: 20px;
            left: 200px;
            display: flex;
            align-items: center;
        }
        .header-container img {
            height: 50px;
            width: 180px;
            margin-right: 84px;
        }
        .header-container .separator {
            margin-right: 83px;
            font-size: 50px;
            color: white;
        }
        .header-container h1 {
            margin-top: 20px;
        }
        .circle {
            position: absolute;
            width: 65px;
            height: 65px;
            border-radius: 50%;
            text-align: center;
            line-height: 60px;
            color: black;
            border: none;
            cursor: pointer;
            font-size: 24px;
            
        }
        #EVT1:hover {
            border: 2px solid #FFC0CB;
            background-color: white !important;
            transition: background-color 0.1s ease, border 0.1s ease;
            color: #FFC0CB;
        }
        #EVT2:hover {
            border: 2px solid #FFA500;
            background-color: white !important;
            transition: background-color 0.1s ease, border 0.1s ease;
            color: #FFA500;
        }
        #CPN:hover {
            border: 2px solid #FF0000;
            background-color: white !important;
            transition: background-color 0.1s ease, border 0.1s ease;
            color: #FF0000;
        }
        #OPP:hover {
            border: 2px solid #800080;
            background-color: white !important;
            transition: background-color 0.1s ease, border 0.1s ease;
            color: #800080;
        }
        #ANN:hover {
            border: 2px solid #00FFFF;
            background-color: white !important;
            transition: background-color 0.1s ease, border 0.1s ease;
            color: #00FFFF;
        }
        #TRG:hover {
            border: 2px solid #808080;
            background-color: white !important;
            transition: background-color 0.1s ease, border 0.1s ease;
            color: #808080;
        }
        #CDT:hover {
            border: 2px solid #FFFF00;
            background-color: white !important;
            transition: background-color 0.1s ease, border 0.1s ease;
            color: #FFFF00;
        }
        #CTC:hover {
            border: 2px solid #00FF00;
            background-color: white !important;
            transition: background-color 0.1s ease, border 0.1s ease;
            color: #00FF00;
        }
        #container {
            position: absolute;
            width: 300px;
            height: 300px;
            bottom: 330px;
            right: 100px;
            /* top:500px; */
        }
        #xtrak {
            width:185px;
            height:45px;
            margin-top:-18px;
        }
        @media (max-width: 767px) {
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
            .header-container a img, #xtrak {
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
            
        }
    </style>
</head>
<body class="login_bg">
    <div class="container-fluid">
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
        const radius = 120;
        const container = document.getElementById('container');
        const circles = document.getElementsByClassName('circle');
        const angleStep = 360 / circles.length;

        function positionCircles() {
            for (let i = 0; i < circles.length; i++) {
                const angle = angleStep * i;
                const x = radius * Math.cos(angle * Math.PI / 180);
                const y = radius * Math.sin(angle * Math.PI / 180);

                circles[i].style.left = `${container.offsetWidth / 2 + x - circles[i].offsetWidth / 2}px`;
                circles[i].style.top = `${container.offsetHeight / 2 + y - circles[i].offsetHeight / 2}px`;
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
