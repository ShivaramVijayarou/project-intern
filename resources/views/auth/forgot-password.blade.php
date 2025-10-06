<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kolej Teknologi Maju - Forgot Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Reuse your login CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: url("{{ asset('uploads/klj_maju.jpg') }}") no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 0;
        }

        .forgot-container {
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

        .forgot-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        }

        .brand {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-logo img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(11, 94, 215, 0.3);
        }

        .brand h2 {
            color: #0b5ed7;
            font-size: 1.8rem;
            margin: 0.5rem 0;
        }

        .brand p {
            color: #666;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #444;
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
        }

        .form-control {
            width: 100%;
            padding: 0.9rem 0.9rem 0.9rem 45px;
            border: 2px solid #e1e5eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #0b5ed7;
            box-shadow: 0 0 0 3px rgba(11, 94, 215, 0.15);
        }

        .btn-submit {
            width: 100%;
            padding: 1rem;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #0b5ed7, #2b8cff);
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(11, 94, 215, 0.3);
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #094bb0, #1a7de8);
            box-shadow: 0 6px 20px rgba(11, 94, 215, 0.4);
            transform: translateY(-2px);
        }

        .extra-links {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 0.9rem;
        }

        .extra-links a {
            color: #0b5ed7;
            text-decoration: none;
            font-weight: 500;
        }

        .extra-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
{{-- toii acdi mlik dppk
tapugtuffgosefjn
qunu xzmb zzny noky --}}
<body>
    <div class="forgot-container">
        <div class="brand">
            <div class="brand-logo">
                <img src="{{ asset('uploads/logo_KTM.jpg') }}" alt="Kolej Teknologi Maju Logo">
            </div>
            <h2>Forgot Password</h2>
            <p>Enter your email and we’ll send you a reset link</p>
        </div>

        <!-- Forgot password form -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-with-icon">
                    <i class="fas fa-envelope"></i>
                    <input id="email" type="email" name="email" class="form-control"
                        placeholder="Enter your email" required autofocus>
                </div>
                @error('email')
                    <div style="color:#e74c3c; font-size:0.85rem; margin-top:0.3rem;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">Send Reset Link</button>
        </form>

        <div class="extra-links">
            <p><a href="{{ route('login') }}">Back to Login</a></p>
        </div>
    </div>
</body>
</html>
