<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AcadX</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">

    <!-- FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            background: linear-gradient(120deg, #d4f1f9, #6dd5ed);
            color: #333;
            font-family: 'Figtree', sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Prevent sliding left and right */
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 2rem;
            width: 100%;
            box-sizing: border-box;
        }

        .welcome-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 800px;
            width: 90%;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .welcome-card img {
            width: 80px;
            height: 80px;
            margin-bottom: 1rem;
        }

        .welcome-card h1 {
            font-size: 1.8rem;
            margin: 0;
            color: #2a9d8f;
        }

        .auth-buttons {
            display: flex;
            flex-direction: row;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            width: 100%;
        }

        .auth-buttons a {
            display: inline-block;
            padding: 0.75rem 2rem;
            background-color: #2a9d8f;
            color: white;
            font-size: 1rem;
            border-radius: 4px;
            text-decoration: none;
            text-align: center;
            max-width: 200px;
            transition: background-color 0.3s ease;
        }

        .auth-buttons a:hover {
            background-color: lightseagreen;
        }

        .cards {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            flex-wrap: wrap;
            max-width: 1200px;
            width: 100%;
            margin-top: 2rem;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 2rem;
            flex: 1 1 calc(33.333% - 2rem);
            max-width: calc(33.333% - 2rem);
            box-sizing: border-box;
            position: relative;
            overflow: hidden;
        }

        .card h2 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: #2a9d8f;
        }

        .card p {
            font-size: 1rem;
            margin: 0;
            color: #555;
        }

        .card[data-icon]::before {
            content: attr(data-icon);
            font-family: 'FontAwesome';
            position: absolute;
            top: 33%;
            left: 75%;
            transform: translate(-50%, -50%);
            font-size: 5rem;
            color: rgba(0, 0, 0, 0.1);
            opacity: 10;

        }

        footer {
            text-align: center;
            padding: 1rem;
            background-color: #f3f4f6;
            width: 100%;
            margin-top: 2rem;
        }

        footer span {
            font-size: 0.9rem;
            color: #666;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .card {
                flex: 1 1 calc(50% - 1rem);
                max-width: calc(50% - 1rem);
            }
        }

        @media (max-width: 480px) {
            .card {
                flex: 1 1 100%;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Welcome Card -->
        <div class="welcome-card">
            <img src="https://www.learnsoftbeliotechsolutions.co.ke/img/logo.png" alt="Logo">
            <h1>Welcome to our University ERP System. Experience the power of efficient management.</h1>
        </div>

        <!-- Authentication Buttons -->
        <div class="auth-buttons">
            @if (Route::has('login'))
                @guest
                    <a href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endguest
            @endif
        </div>

        <!-- Feature Cards -->
        <div class="cards">
            <div class="card" data-icon="&#128101;">
                <h2>Staff Management</h2>
                <p>Organize and manage faculty and staff records seamlessly.</p>
            </div>
            <div class="card" data-icon="&#128202;">
                <h2>Student Management</h2>
                <p>Track student progress, performance, and academic details.</p>
            </div>
            <div class="card" data-icon="&#128200;">
                <h2>Analytics & Reports</h2>
                <p>Generate real-time insights and customized reports for better decision-making.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <span>&copy; {{ date('Y') }} <a href="https://www.learnsoftbeliotechsolutions.co.ke/">Learnsoft Beliotech Solutions</a> All Rights Reserved.</span>
        <span>Version 1.1.0</span>
    </footer>
</body>
</html>
