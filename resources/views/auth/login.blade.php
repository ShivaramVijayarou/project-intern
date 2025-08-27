{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

{{-- welcome to the new day --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kolej Teknologi Maju - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            font-family: Arial, sans-serif;
            background: url('{{ asset('uploads/klj_maju.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative;
        }

        /* Dark overlay */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            /* Adjust 0.4 for more or less darkness */
            z-index: 0;
        }

        /* Animated background elements */
        .bg-bubbles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            overflow: hidden;
        }

        .bg-bubbles li {
            position: absolute;
            list-style: none;
            display: block;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.15);
            bottom: -160px;
            animation: square 25s infinite;
            transition-timing-function: linear;
            border-radius: 2px;
        }

        .bg-bubbles li:nth-child(1) {
            left: 10%;
            animation-delay: 0s;
        }

        .bg-bubbles li:nth-child(2) {
            left: 20%;
            width: 80px;
            height: 80px;
            animation-delay: 2s;
            animation-duration: 17s;
        }

        .bg-bubbles li:nth-child(3) {
            left: 25%;
            animation-delay: 4s;
        }

        .bg-bubbles li:nth-child(4) {
            left: 40%;
            width: 60px;
            height: 60px;
            animation-duration: 22s;
            background-color: rgba(255, 255, 255, 0.25);
        }

        .bg-bubbles li:nth-child(5) {
            left: 70%;
        }

        .bg-bubbles li:nth-child(6) {
            left: 80%;
            width: 120px;
            height: 120px;
            animation-delay: 3s;
            background-color: rgba(255, 255, 255, 0.2);
        }

        .bg-bubbles li:nth-child(7) {
            left: 32%;
            width: 160px;
            height: 160px;
            animation-delay: 7s;
        }

        .bg-bubbles li:nth-child(8) {
            left: 55%;
            width: 20px;
            height: 20px;
            animation-delay: 15s;
            animation-duration: 40s;
        }

        @keyframes square {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
                border-radius: 0;
            }

            100% {
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0;
                border-radius: 50%;
            }
        }

        /* Login container */
        .login-container {
            position: relative;
            background: rgba(255, 255, 255, 0.95);
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 420px;
            z-index: 1;
            position: relative;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }



        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        }

        .brand {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 15px;
            background: linear-gradient(135deg, #0b5ed7 0%, #2b8cff 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            box-shadow: 0 4px 10px rgba(11, 94, 215, 0.3);
        }

        .brand h2 {
            color: #0b5ed7;
            font-size: 1.8rem;
            margin-bottom: 0.3rem;
        }

        .brand p {
            color: #666;
            font-size: 0.95rem;
        }

        /* Form styling */
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #444;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #0b5ed7;
            font-size: 1.1rem;
        }

        .form-control {
            width: 100%;
            padding: 0.9rem 0.9rem 0.9rem 45px;
            border: 2px solid #e1e5eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-control:focus {
            border-color: #0b5ed7;
            box-shadow: 0 0 0 3px rgba(11, 94, 215, 0.15);
        }

        .password-toggle {
            position: absolute;
            right: 50px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #777;
            cursor: pointer;
            font-size: 1.1rem;
        }

        .password-toggle:hover {
            color: #0b5ed7;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.8rem;
            font-size: 0.9rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 8px;
            accent-color: #0b5ed7;
        }

        .forgot-password {
            color: #0b5ed7;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            padding: 1rem;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #0b5ed7 0%, #2b8cff 100%);
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(11, 94, 215, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #094bb0 0%, #1a7de8 100%);
            box-shadow: 0 6px 20px rgba(11, 94, 215, 0.4);
            transform: translateY(-2px);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -60%;
            width: 20px;
            height: 200%;
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(25deg);
            transition: all 0.5s;
        }

        .btn-login:hover::after {
            left: 120%;
        }

        /* Social login */
        .social-login {
            margin-top: 1.8rem;
        }

        .social-login p {
            text-align: center;
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 1rem;
            position: relative;
        }

        .social-login p::before,
        .social-login p::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 30%;
            height: 1px;
            background: #e1e5eb;
        }

        .social-login p::before {
            left: 0;
        }

        .social-login p::after {
            right: 0;
        }

        .social-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .social-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .google {
            background: linear-gradient(135deg, #DB4437 0%, #EA4335 100%);
        }

        .facebook {
            background: linear-gradient(135deg, #3b5998 0%, #4267B2 100%);
        }

        .twitter {
            background: linear-gradient(135deg, #1DA1F2 0%, #1DA1F2 100%);
        }

        /* Responsive design */
        @media (max-width: 480px) {
            .login-container {
                padding: 1.8rem;
            }

            .brand-logo {
                width: 70px;
                height: 70px;
                font-size: 1.8rem;
            }

            .brand h2 {
                font-size: 1.5rem;
            }

            .remember-forgot {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .forgot-password {
                margin-left: 28px;
            }
        }

        /* Error message */
        .error-message {
            color: #e74c3c;
            font-size: 0.85rem;
            margin-top: 0.3rem;
            display: none;
        }

        .shake {
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20%,
            60% {
                transform: translateX(-10px);
            }

            40%,
            80% {
                transform: translateX(10px);
            }
        }

        /* Loading spinner */
        .spinner {
            display: none;
            width: 24px;
            height: 24px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s linear infinite;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        @keyframes spin {
            to {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        .login-text {
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        .btn-login.loading .login-text {
            opacity: 0;
        }

        .btn-login.loading .spinner {
            display: block;
        }
    </style>
</head>

<body>


    <!-- Login container -->
    <div class="login-container">
        <div class="brand">
            <div class="brand-logo">
               <img src="{{ asset('uploads/logo_KTM.jpg') }}" alt="Kolej Teknologi Maju Logo" class="w-16 h-16 mx-auto" width="80px" height="80px">
            </div>
            <h2>Kolej Teknologi Maju</h2>
            <p>Sign in to your account</p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-6" id="loginForm">
            @csrf

            <!-- Email Field -->
            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-with-icon">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                </div>
                <div class="error-message" id="email-error">Please enter a valid email address</div>
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-with-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password"
                        required>
                    <button type="button" class="password-toggle" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="error-message" id="password-error">Password must be at least 6 characters</div>
            </div>


            <!-- remember -->
            <div class="remember-forgot">
                {{-- <div class="remember-me">
                    <input type="checkbox" name="remember">
                    <label for="remember">Remember me</label>
                </div> --}}
                <a href="#" justify="align-center" class="forgot-password">Forgot password?</a>
            </div>

            <button type="submit" class="btn-login" id="loginButton">
                <span class="login-text">Login</span>
                <div class="spinner"></div>
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password visibility toggle
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeIcon = togglePassword.querySelector('i');

            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                eyeIcon.classList.toggle('fa-eye');
                eyeIcon.classList.toggle('fa-eye-slash');
            });

            // Form validation
            const loginForm = document.getElementById('loginForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const emailError = document.getElementById('email-error');
            const passwordError = document.getElementById('password-error');
            const loginButton = document.getElementById('loginButton');

            function validateEmail(email) {
                const re =
                    /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(String(email).toLowerCase());
            }

            function validatePassword(password) {
                return password.length >= 6;
            }

            emailInput.addEventListener('input', function() {
                if (!validateEmail(emailInput.value)) {
                    emailError.style.display = 'block';
                    emailInput.classList.add('shake');
                    setTimeout(() => emailInput.classList.remove('shake'), 500);
                } else {
                    emailError.style.display = 'none';
                }
            });

            passwordInput.addEventListener('input', function() {
                if (!validatePassword(passwordInput.value)) {
                    passwordError.style.display = 'block';
                    passwordInput.classList.add('shake');
                    setTimeout(() => passwordInput.classList.remove('shake'), 500);
                } else {
                    passwordError.style.display = 'none';
                }
            });

            // Form submission
            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const emailValid = validateEmail(emailInput.value);
                const passwordValid = validatePassword(passwordInput.value);

                if (!emailValid) {
                    emailError.style.display = 'block';
                    emailInput.classList.add('shake');
                    setTimeout(() => emailInput.classList.remove('shake'), 500);
                }

                if (!passwordValid) {
                    passwordError.style.display = 'block';
                    passwordInput.classList.add('shake');
                    setTimeout(() => passwordInput.classList.remove('shake'), 500);
                }

                if (emailValid && passwordValid) {
                    // Simulate login process
                    loginButton.classList.add('loading');

                    setTimeout(() => {
                        loginButton.classList.remove('loading');

                        // Show success message (in a real app, redirect to dashboard)
                        alert('Login successful! Welcome back.');

                        // Reset form
                        loginForm.reset();
                    }, 2000);
                }
            });

            // Social login buttons
            const socialButtons = document.querySelectorAll('.social-btn');
            socialButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const platform = this.classList[1];
                    alert(
                        `Logging in with ${platform.charAt(0).toUpperCase() + platform.slice(1)}...`
                    );
                });
            });
        });
    </script>
</body>

</html>
