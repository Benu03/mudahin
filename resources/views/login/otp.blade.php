<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'TS3 Indonesia') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap5/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/sweetalert/css/sweetalert.css') }}">
    <script src="{{ asset('assets/sweetalert/js/sweetalert.min.js') }}"></script>

    <style>
    

        body, html {
             background: #195fb3;
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
            background: linear-gradient(45deg, #172fdf, #2f68bd);
            color: #fff;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
             background: linear-gradient(45deg, #172fdf, #2f68bd);
            transform: scale(1.03);
            box-shadow: 0 6px 15px rgba(50, 175, 129, 0.4);
        }

        .form-label {
            font-weight: 600;
            font-size: 14px;
            color: #191B71;
        }

        .text-theme {
            color: #191B71;
        }

        .back-link {
            text-decoration: none;
            color: #2E308A;
            font-size: 15px;
            font-weight: 600;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: #191B71;
        }

        .invalid-feedback {
            font-weight: 600;
            font-size: 13px;
        }
            .sweet-alert button.confirm {
            display: none !important;
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

                <h4 class="fw-bold text-theme mb-2">🔐 Enter OTP Code</h4>
                <p class="mb-4 text-muted">
                    Please enter the OTP code we sent to your <b>{{ $data['via'] }}</b> to reset your password.
                </p>

                <form method="POST" action="{{ route('send-otp') }}" id="otpForm">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="otp" class="form-label">OTP Code</label>
                       <input 
                            type="text" 
                            class="form-control" 
                            id="otp" 
                            name="otp" 
                            value="{{ old('otp') }}" 
                            maxlength="6" 
                            oninput="this.value=this.value.replace(/[^0-9]/g,'')" 
                            placeholder="Enter OTP Code"
                        >
                        <input type="text" name="username" value="{{ $data['username'] }}">
                        <input type="text" id="otp_old" name="otp_old" value="{{ $data['otp'] }}">

                        <div id="validasiOtp" class="invalid-feedback"></div>
                        @if ($errors->has('otp'))
                            <div class="text-danger small mt-1">{{ $errors->first('otp') }}</div>
                        @endif
                    </div>

                    <div class="d-grid mt-4">
                        <button id="submitBtn" type="submit" class="btn btn-login fw-bold">
                            SUBMIT
                            <span class="loading-icon d-none ms-2">
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
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('otpForm');
        const otpInput = document.getElementById('otp');
        const oldOtpInput = document.getElementById('otp_old');
        const validasiOtp = document.getElementById('validasiOtp');

        form.addEventListener('submit', function (e) {
            if (otpInput.value === '') {
                validasiOtp.style.display = 'block';
                validasiOtp.textContent = '* Please fill your OTP Code';
                otpInput.focus();
                e.preventDefault();
            } else if (otpInput.value !== oldOtpInput.value) {
                validasiOtp.style.display = 'block';
                validasiOtp.textContent = 'Invalid OTP Code.';
                otpInput.focus();
                e.preventDefault();
            } else {
                // SweetAlert loading
                swal({
                    title: "Verifying...",
                    text: "Please wait while we check your OTP code",
                    imageUrl: "https://i.gifer.com/ZZ5H.gif", // loader gif
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false
                });
            }
        });
    });
</script>

</body>
</html>
