<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kolej Teknologi Maju - Verify Email</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Reuse Forgot Password Page CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: url('{{ asset('uploads/klj_maju.jpg') }}') no-repeat center center fixed;
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

        .verify-container {
            position: relative;
            background: rgba(255, 255, 255, 0.95);
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 480px;
            z-index: 1;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .verify-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        }

        .brand-logo img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 1rem;
            box-shadow: 0 4px 10px rgba(11, 94, 215, 0.3);
        }

        .verify-container h2 {
            color: #0b5ed7;
            font-size: 1.6rem;
            margin-bottom: 1rem;
        }

        .verify-container p {
            color: #555;
            font-size: 1rem;
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }

        .alert-success {
            background: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
            padding: 0.8rem;
            border-radius: 10px;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }

        .btn-submit {
            width: 100%;
            padding: 1rem;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #0b5ed7, #2b8cff);
            color: white;
            font-size: 1.05rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(11, 94, 215, 0.3);
            margin-top: 0.5rem;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #094bb0, #1a7de8);
            box-shadow: 0 6px 20px rgba(11, 94, 215, 0.4);
            transform: translateY(-2px);
        }

        .extra-links {
            margin-top: 1.2rem;
            font-size: 0.9rem;
        }

        .extra-links button {
            background: none;
            border: none;
            color: #0b5ed7;
            font-weight: 500;
            cursor: pointer;
        }

        .extra-links button:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="verify-container">
        <div class="brand-logo">
            <img src="{{ asset('uploads/logo_KTM.jpg') }}" alt="Kolej Teknologi Maju Logo">
        </div>

        <h2>Email Verification</h2>
        <p>Thanks for signing up! Before getting started, please verify your email address by clicking on the link we
            just sent you. If you didn’t receive the email, click below to request another.</p>

        @if (session('status') == 'verification-link-sent')
            <div class="alert-success">
                A new verification link has been sent to the email address you provided.
            </div>
        @endif

        <!-- Resend Verification Email -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn-submit">
                Resend Verification Email
            </button>
        </form>

        <!-- Logout -->
        <div class="extra-links">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Log Out</button>
            </form>
        </div>
    </div>
</body>

</html>
