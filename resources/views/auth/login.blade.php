<!doctype html>
<html lang="en" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none"
    data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Connexion | Xtrak</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="XTRAK- HARMEN & BOTTS" name="description" />
    <meta content="Xtrak" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.jpg') }}">

    <!-- Layout config Js -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .login_bg {
            background-image: url('{{  asset('assets/images/login_bg.jpg')  }}');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>

</head>

<body class="login_bg ">

    <div class="auth-page-wrapper">
        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">
                            <div class="card-body p-4">
                                <div class="text-center ">
                                    <div>
                                        <a href="index.html" class="d-inline-block auth-logo">
                                            <img src="{{ asset('assets/images/logo.jpg') }}" alt="" class="img-fluid"
                                                height="300" width="300">
                                        </a>
                                    </div>
                                    <H2 class="mt-3 fw-bold text-secondary">XTRAK</H2>
                                    <div class="container">
                                        <div class="row">
                                          <div class="col">
                                            <h5 class="fw-bold">Administrateur :</h5>
                                            <p>Login : admin@local.com</p>
                                            <p>Password : admin@2024</p>
                                          </div>
                                          <div class="col">
                                            <h5 class="fw-bold">Consultant :</h5>
                                            <p>Login : consultant@local.com</p>
                                            <p>Password : consultant@2024</p>
                                          </div>
                                        </div>
                                      </div>
                                      
                                </div>
                                <div class="p-2">
                                    @if (session()->has('error'))
                                        <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow show"
                                            role="alert">
                                            <i class="ri-error-warning-line label-icon"></i><strong>Erreur</strong> -
                                            {{ session('error') }}
                                            <button type="button" class="btn-close" data-bs-dismiss=" alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <x-validation-errors class="mb-4" />

                                    @if (session('status'))
                                        <div class="mb-4 font-medium text-sm text-green-600">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                        <div class="row">
                                    
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror" id="email"
                                                 placeholder="Entrez votre adresse email"
                                                value="{{ old('email') }}">
                                            @error('email')
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">

                                            <label class="form-label" for="password-input">Mot de passe</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" name="password" 
                                                    class="form-control pe-5 password-input @error('password') border-danger @enderror"
                                                    placeholder="Entrez votre mot de passe" id="password-input">
                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                    type="button" id="password-addon"><i
                                                        class="ri-eye-fill align-middle"></i></button>
                                                @error('password')
                                                    <small class="text-danger">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" name="remember_me" type="checkbox"
                                                value="true" id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Se souvenir de moi
                                            </label>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-secondary w-100" type="submit">Connexion</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">

                            <p class="mb-0  text-white">&copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Tous droits réservé. XTRAK, Réalisé
                                par <a class="link-light" href="https://www.harmen-botts.com/">HARMEN & BOTTS</a>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

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
</body>

</html>
