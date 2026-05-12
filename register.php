<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitizeInput($_POST['username']);
    $email = sanitizeInput($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $pdo->prepare("SELECT email FROM users WHERE email = ?");
    $check->execute([$email]);
    if ($check->fetch()) {
        echo "<script>alert('Email already registered');</script>";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);
        echo "<script>alert('Registration successful'); window.location='login.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Register - WasteWise</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Base styles from login page */
        :root {
            --primary-color: #2a9d8f;
            --secondary-color: #e9c46a;
            --accent-color: #e76f51;
            --dark-color: #1a2f38;
            --light-color: #f8f9fa;
            --gradient-primary: linear-gradient(135deg, #2a9d8f 0%, #1d7874 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: var(--dark-color);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .particle {
            position: absolute;
            background: rgba(233, 196, 106, 0.1);
            border-radius: 50%;
            animation: float 8s infinite;
        }

        /* Unique Registration Layout */
        .registration-container {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            background: rgba(26, 47, 56, 0.95);
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
            width: 90%;
            max-width: 800px;
            position: relative;
            z-index: 2;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            overflow: hidden;
        }

        .art-side {
            background: rgba(42, 157, 143, 0.1);
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .art-side::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, var(--primary-color) 0%, transparent 70%);
            opacity: 0.1;
            animation: pulse 6s infinite;
        }

        .art-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .art-content i {
            font-size: 4rem;
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
            animation: float 3s ease-in-out infinite;
        }

        .benefits-list {
            list-style: none;
            margin-top: 2rem;
        }

        .benefits-list li {
            color: var(--light-color);
            margin: 1rem 0;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .benefits-list i {
            font-size: 1.2rem;
            color: var(--accent-color);
            animation: none;
        }

        .form-side {
            padding: 3rem;
            position: relative;
        }

        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-header h2 {
            color: var(--light-color);
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: #8b9da7;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
        }

        .form-control {
            width: 100%;
            padding: 14px 14px 14px 45px;
            background: #233943;
            border: 2px solid #2a4a5a;
            border-radius: 8px;
            color: var(--light-color);
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 15px rgba(42, 157, 143, 0.3);
            outline: none;
        }

        .password-strength {
            height: 4px;
            background: #2a4a5a;
            border-radius: 2px;
            margin-top: 0.5rem;
            overflow: hidden;
            position: relative;
        }

        .strength-bar {
            height: 100%;
            width: 0;
            background: var(--accent-color);
            transition: width 0.3s ease;
        }

        button {
            background: var(--gradient-primary);
            color: white;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(42, 157, 143, 0.4);
        }

        button::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.1;
            }

            50% {
                transform: scale(1.05);
                opacity: 0.15;
            }
        }

        @media (max-width: 768px) {
            .registration-container {
                grid-template-columns: 1fr;
                max-width: 500px;
            }

            .art-side {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="particles">
        <?php for ($i = 0; $i < 15; $i++): ?>
            <div class="particle" style="
                width: <?= rand(20, 50) ?>px;
                height: <?= rand(20, 50) ?>px;
                top: <?= rand(0, 100) ?>%;
                left: <?= rand(0, 100) ?>%;
                animation-delay: <?= rand(0, 10) ?>s;"></div>
        <?php endfor; ?>
    </div>

    <div class="registration-container">
        <div class="art-side">
            <div class="art-content">
                <i class="fas fa-user-plus"></i>
                <h3>Join WasteWise Community</h3>
                <ul class="benefits-list">
                    <li><i class="fas fa-chart-line"></i>Track your waste reduction progress</li>
                    <li><i class="fas fa-award"></i>Earn sustainability badges</li>
                    <li><i class="fas fa-calendar-alt"></i>Schedule pickups</li>
                    <li><i class="fas fa-leaf"></i>Contribute to greener planet</li>
                </ul>
            </div>
        </div>

        <div class="form-side">
            <div class="form-header">
                <h2>Create Account</h2>
                <p>Start your sustainable journey with us</p>
            </div>

            <form method="POST" class="form-box">
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>

                <div class="form-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>

                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <div class="password-strength">
                        <div class="strength-bar"></div>
                    </div>
                </div>

                <button type="submit">Register Now</button>
            </form>

            <p style="margin-top: 1.5rem; color: #8b9da7; text-align: center;">
                Already have an account? <a href="login.php" style="color: var(--secondary-color);">Login here</a>
            </p>
        </div>
    </div>

    <script>
        // Password strength indicator
        const passwordInput = document.querySelector('input[name="password"]');
        const strengthBar = document.querySelector('.strength-bar');

        passwordInput.addEventListener('input', () => {
            const strength = Math.min(passwordInput.value.length / 12 * 100, 100);
            strengthBar.style.width = `${strength}%`;
            strengthBar.style.backgroundColor = strength > 75 ? '#2a9d8f' :
                strength > 50 ? '#e9c46a' : '#e76f51';
        });

        // Particle animation
        document.addEventListener('DOMContentLoaded', () => {
            const particles = document.querySelectorAll('.particle');
            particles.forEach(particle => {
                particle.style.setProperty('--x', Math.random() * 100);
                particle.style.setProperty('--y', Math.random() * 100);
            });
        });
    </script>
</body>

</html>