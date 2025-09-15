<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/upload/image/'.website('icon')) }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet" />

    <!-- Icon & CSS -->
    <link rel="stylesheet" href="{{ asset('assets/auth/fonts/icomoon/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/auth/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/auth/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/auth/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/sweetalert/css/sweetalert.css') }}">
    <script src="{{ asset('assets/sweetalert/js/sweetalert.min.js') }}"></script>

    <style>
        body {
            background: #34c4ff;
            font-family: 'Roboto', sans-serif;
        }

        .card {
            border-radius: 12px;
            background: #ffffff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background: #34c4ff;
            border-color: #34c4ff;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .btn-primary:hover {
            background: #34c4ff;
            transform: translateY(-2px);
        }

        .forgot-pass {
            color: #1613e2;
            font-weight: 500;
            text-decoration: none;
        }

        .forgot-pass:hover {
            color: #34c4ff;
            text-decoration: underline;
        }

        /* Hilangkan tombol OK swal */
        .sweet-alert button.confirm {
            display: none !important;
        }
    </style>
</head>

<body>
    <div class="content d-flex align-items-center min-vh-100">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <!-- Left Image -->
                <div class="col-md-6 d-none d-md-block text-center">
                    <a href="{{ '/' }}">
                        <img src="{{ asset('assets/upload/image/undraw_experience_design_re_dmqq.svg') }}" alt="Image" class="img-fluid animated-img" />
                    </a>
                </div>

                <!-- Forgot Password Form -->
                <div class="col-md-6">
                    <div class="card shadow p-4">
                        <div class="text-center mb-4">
                            <a href="{{ '/' }}">
                                <img src="{{ asset('assets/upload/image/logo.png')}}" alt="Logo" class="img-fluid" width="170" />
                            </a>
                        </div>

                        <form id="forgotForm" action="{{ asset('login/forgot-process') }}" method="post" accept-charset="utf-8">
                            {{ csrf_field() }}

                            <div class="form-group mb-3">
                                <label for="email">Masukkan Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Alamat email" autocomplete="off" required />
                            </div>

                            <button type="submit" class="btn btn-primary btn-block mb-3">
                                <i class="fas fa-paper-plane"></i> Reset Password
                            </button>

                            <div class="text-center">
                                <a href="{{ '/login' }}" class="forgot-pass">← Back to Login</a>
                            </div>

                            <p class="text-center text-muted mb-0 mt-3">&copy; <?= date('Y'); ?> Mudahin</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/auth/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/auth/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/auth/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/dist/js/adminlte.min.js') }}"></script>

    <script>
        // Swal loading ketika submit
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("forgotForm");

            form.addEventListener("submit", function () {
                swal({
                    title: "Mohon tunggu...",
                    text: "Sedang memproses reset password",
                    icon: "info",
                    closeOnClickOutside: false,
                    closeOnEsc: false
                });
            });
        });

        @if ($message = Session::get('warning'))
            swal("Mohon maaf", "{{ $message }}", "warning");
        @endif

        @if ($message = Session::get('sukses'))
            swal("Berhasil", "{{ $message }}", "success");
        @endif
    </script>
</body>
</html>
