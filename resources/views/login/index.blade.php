<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title }}</title>


    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" />

    <!-- Icon & CSS -->
    <link rel="stylesheet" href="{{ asset('assets/auth/fonts/icomoon/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/auth/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/auth/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/auth/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/sweetalert/css/sweetalert.css') }}">
    <style>
        body {
            background: #195fb3;
            font-family: 'Roboto', sans-serif;
        }

        .card {
        border-radius: 12px;
        background: #ffffff;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        transform: translateY(-20px); /* naik ke atas */
    }

    @media (max-width: 767px) {
        .card {
            transform: translateY(0); /* mobile normal */
        }
    }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background: #195fb3;
            border-color: #195fb3;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .btn-primary:hover {
            background: #005fcc;
            transform: translateY(-2px);
        }

 

    .forgot-pass {
            color: #1613e2; /* putih agar kontras dengan biru */
            font-weight: 500;
            text-decoration: none;
        
        }

        .forgot-pass:hover {
            color: #3112fc; /* kuning terang saat hover */
            text-decoration: underline;
        }

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
                    <img src="{{ asset('assets/upload/image/undraw_accept_tasks_re_09mv.svg') }}" alt="Image" class="img-fluid animated-img" />
                </a>
            </div>

                <!-- Login Form -->
                <div class="col-md-6">
                    <div class="card shadow p-4">
                        <div class="text-center mb-4">
                            <a href="{{ '/' }}">
                                <img src="{{ asset('assets/upload/image/logo.png') }}" alt="Logo" class="img-fluid" width="170" />
                            </a>
                    
                        </div>

                        <form action="{{ asset('login/check') }}" method="post" accept-charset="utf-8">
                            {{ csrf_field() }}

                            <div class="form-group mb-3">
                                <label for="username">Username or Email</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username or email" required />
                            </div>

                            <div class="form-group mb-3 position-relative">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required />
                                <span class="toggle-password" onclick="togglePassword()"
                                      style="position:absolute; right: 15px; top: 38px; cursor:pointer;">
                                    <i class="material-symbols-rounded" style="font-size: 22px;">visibility_off</i>
                                </span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                            
                                <a href="{{ 'login/lupa' }}" class="forgot-pass">Forgot Password?</a>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block mb-3">
                                <i class="fas fa-sign-in-alt"></i> Log In
                            </button>

                            <p class="text-center text-muted mb-0">&copy; <?= date('Y'); ?> Mudahin</p>
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
    <script src="{{ asset('assets/sweetalert/js/sweetalert.min.js') }}"></script>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const icon = document.querySelector('.toggle-password i');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.textContent = 'visibility';
            } else {
                passwordInput.type = 'password';
                icon.textContent = 'visibility_off';
            }
        }

        @if ($message = Session::get('warning'))
            swal("Mohon maaf", "{{ $message }}", "warning");
        @endif

        @if ($message = Session::get('sukses'))
            swal("Berhasil", "{{ $message }}", "success");
        @endif
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector("form");

        form.addEventListener("submit", function () {
            swal({
                title: "Mohon tunggu...",
                text: "Sedang memproses login",
                icon: "info",
                closeOnClickOutside: false,
                closeOnEsc: false
            });
        });
    });
</script>


</body>

</html>
