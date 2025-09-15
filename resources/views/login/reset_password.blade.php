<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'TS3 Indonesia') }}</title>

    <!-- Google Font & Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap5/css/bootstrap.min.css') }}">

    <style>
        body, html {
              background: #34c4ff;
            height: 100%;
            margin: 0;
            font-family: 'Nunito', sans-serif;
       
        }

        .card {
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            animation: fadeInUp 0.8s ease;
            border: 1px solid #eee;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-login {
            padding: 0.75rem 1rem;
            font-size: 14px;
            border-radius: 20px;
            background: linear-gradient(45deg, #2e8b57, #32af81);
            color: #fff;
            letter-spacing: 0.05rem;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: scale(1.03);
            box-shadow: 0 6px 15px rgba(50, 175, 129, 0.4);
        }

        .form-label {
            font-weight: 600;
            font-size: 14px;
            color: #34c4ff;
        }

        .back-link {
            text-decoration: none;
            color: #34c4ff;
            font-size: 15px;
            font-weight: 600;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: #34c4ff;
        }

        .toggle-password, .toggle-confpassword {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #34c4ff;
        }

        .loading-icon {
            margin-left: 8px;
        }
    </style>
</head>
<body>
<div class="container h-100 d-flex justify-content-center align-items-center">
    <div class="col-sm-9 col-md-7 col-lg-5">
        <div class="card shadow border-0">
            <div class="card-body p-4">
                <a href="{{ route('login') }}" class="back-link d-block mb-4">
                    <i class="fa-solid fa-arrow-left"></i> Back to Login Page
                </a>

                <h4 class="fw-bold text-theme mb-3">🔒 Reset Password</h4>
                <p class="mb-4 text-muted">Enter your new password below.</p>

                <form method="POST" action="{{ route('reset_password') }}" id="resetForm">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="floatingPassword" class="form-label">New Password</label>
                        <div class="position-relative">
                            <input type="password" class="form-control" id="floatingPassword" name="password" value="{{ old('password') }}">
                            <span toggle="#floatingPassword" class="toggle-password">
                                <i class="fas fa-eye-slash"></i>
                            </span>
                        </div>
                        @if ($errors->has('password'))
                            <small class="text-danger fw-semibold">{{ $errors->first('password') }}</small>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="confirmPassword" class="form-label">Confirm New Password</label>
                        <div class="position-relative">
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" value="{{ old('confirmPassword') }}">
                            <input type="hidden" name="email" id="email" value="{{ $data['username'] }}">
                            <span toggle="#confirmPassword" class="toggle-confpassword">
                                <i class="fas fa-eye-slash"></i>
                            </span>
                        </div>
                        <small id="confirmPasswordError" class="text-danger fw-semibold"></small>
                    </div>

                    <div class="d-grid mt-4">
                        <button id="submitBtn" type="submit" class="btn btn-login fw-bold">
                            SUBMIT
                            <span class="loading-icon d-none">
                                <i class="fas fa-spinner fa-spin"></i>
                            </span>
                        </button>
                    </div>

                   
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script>
    // Toggle password
    document.addEventListener('DOMContentLoaded', function () {
        function togglePassword(fieldId, toggleClass) {
            const input = document.getElementById(fieldId);
            const toggleBtn = document.querySelector(toggleClass);

            toggleBtn.addEventListener('click', function () {
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                toggleBtn.innerHTML = type === 'password'
                    ? '<i class="fas fa-eye-slash"></i>'
                    : '<i class="fas fa-eye"></i>';
            });
        }

        togglePassword('floatingPassword', '.toggle-password');
        togglePassword('confirmPassword', '.toggle-confpassword');
    });

    // Loading button
    document.getElementById('resetForm').addEventListener('submit', function () {
        const submitBtn = document.getElementById('submitBtn');
        const spinner = submitBtn.querySelector('.loading-icon');
        spinner.classList.remove('d-none');
    });

    // Confirm password validation
    $(document).ready(function () {
        $('#confirmPassword').on('input', function () {
            let passwordValue = $('#floatingPassword').val();
            let confirmPasswordValue = $(this).val();
            let confirmErrorDiv = $('#confirmPasswordError');

            if (passwordValue !== confirmPasswordValue) {
                confirmErrorDiv.text('The new password does not match.');
            } else {
                confirmErrorDiv.text('');
            }
        });
    });
</script>
</body>
</html>
