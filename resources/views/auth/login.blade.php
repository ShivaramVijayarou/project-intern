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

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 0;
        }

        .login-container {
            position: relative;
            background: rgba(255, 255, 255, 0.95);
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 420px;
            z-index: 1;
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
            justify-content: flex-end;
            margin-bottom: 1.8rem;
            font-size: 0.9rem;
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
            0%,100%{transform: translateX(0);}
            20%,60%{transform: translateX(-10px);}
            40%,80%{transform: translateX(10px);}
        }

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
            to {transform: translate(-50%, -50%) rotate(360deg);}
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

    <div class="login-container">
        <div class="brand">
            <div class="brand-logo">
                <img src="{{ asset('uploads/logo_KTM.jpg') }}" alt="Kolej Teknologi Maju Logo" width="80" height="80">
            </div>
            <h2>Kolej Teknologi Maju</h2>
            <p>Sign in to your account</p>
        </div>

        <form action="{{ route('login') }}" method="POST" id="loginForm">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-with-icon">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email" class="form-control"
                        placeholder="Enter your email" required>
                </div>
                <div class="error-message" id="email-error">Please enter a valid email address</div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-with-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" class="form-control"
                        placeholder="Enter your password" required>
                    <button type="button" class="password-toggle" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="error-message" id="password-error">Password must be at least 6 characters</div>
            </div>

            <div class="remember-forgot">
                <a href="{{ route('password.request') }}" class="forgot-password">Forgot password?</a>
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
            const passwordError = document.getElementById('password-error');
            const emailError = document.getElementById('email-error');

            function validateEmail(email) {
                const re =
                    /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(String(email).toLowerCase());
            }

            function validatePassword(password) {
                return password.length >= 6;
            }

            // on submit allow real login if valid
            loginForm.addEventListener('submit', function(e) {
                let valid = true;

                if (!validateEmail(emailInput.value)) {
                    emailError.style.display = 'block';
                    emailInput.classList.add('shake');
                    setTimeout(() => emailInput.classList.remove('shake'), 500);
                    valid = false;
                } else {
                    emailError.style.display = 'none';
                }

                if (!validatePassword(passwordInput.value)) {
                    passwordError.style.display = 'block';
                    passwordInput.classList.add('shake');
                    setTimeout(() => passwordInput.classList.remove('shake'), 500);
                    valid = false;
                } else {
                    passwordError.style.display = 'none';
                }

                if (!valid) {
                    e.preventDefault(); // stop submission if invalid
                }
                // if valid, form will submit to Laravel normally
            });
        });
    </script>
</body>

</html>
