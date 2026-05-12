<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
require 'config.php';

$inputs = [];
$errors = [];
$success = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $inputs['full_name'] = sanitizeInput($_POST['full_name'] ?? '');
  $inputs['email'] = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
  $inputs['phone'] = preg_replace('/[^0-9]/', '', $_POST['phone'] ?? '');
  $inputs['address'] = sanitizeInput($_POST['address'] ?? ''); // Added address
  $inputs['waste_type'] = sanitizeInput($_POST['waste_type'] ?? '');
  $inputs['pickup_date'] = sanitizeInput($_POST['pickup_date'] ?? '');

  // Validation
  if (empty($inputs['full_name'])) $errors['full_name'] = 'Full name is required';
  if (!filter_var($inputs['email'], FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Invalid email format';
  if (strlen($inputs['phone']) !== 10) $errors['phone'] = 'Phone must be 10 digits';
  if (empty($inputs['address'])) $errors['address'] = 'Address is required'; // Added validation
  if (!in_array($inputs['waste_type'], ['Recyclables', 'Organic', 'Hazardous'])) $errors['waste_type'] = 'Invalid waste type';
  if (empty($inputs['pickup_date']) || strtotime($inputs['pickup_date']) < strtotime('today')) $errors['pickup_date'] = 'Invalid date';

  if (empty($errors)) {
    try {
      $stmt = $pdo->prepare("INSERT INTO pickups (full_name, email, phone, address, waste_type, pickup_date) VALUES (:full_name, :email, :phone, :address, :waste_type, :pickup_date)");
      $stmt->execute([
        ':full_name' => $inputs['full_name'],
        ':email' => $inputs['email'],
        ':phone' => $inputs['phone'],
        ':address' => $inputs['address'],
        ':waste_type' => $inputs['waste_type'],
        ':pickup_date' => $inputs['pickup_date']
      ]);
      $_SESSION['success'] = true;
      header("Location: " . $_SERVER['PHP_SELF']);
      exit();
    } catch (PDOException $e) {
      $errors[] = "Database error: " . $e->getMessage();
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WasteWise - Smart Waste Management</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary: #2a9d8f;
      --secondary: #e9c46a;
      --accent: #e76f51;
      --dark: #264653;
      --light: #f8f9fa;
      --gradient: linear-gradient(135deg, #2a9d8f 0%, #1d7874 100%);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(45deg, #f0fff0 0%, #e1f5ec 100%);
      color: var(--dark);
      min-height: 100vh;
      overflow-x: hidden;
    }

    header {
      background: var(--gradient);
      padding: 6rem 0;
      position: relative;
      overflow: hidden;
      transform-style: preserve-3d;
    }

    .header-content {
      position: relative;
      z-index: 2;
      text-align: center;
      color: white;
      padding: 0 2rem;
    }

    .floating-icons {
      position: absolute;
      width: 100%;
      height: 100%;
      pointer-events: none;
    }

    .floating-icon {
      position: absolute;
      opacity: 0.1;
      animation: float 6s infinite linear;
      font-size: 2rem;
    }

    @keyframes float {

      0%,
      100% {
        transform: translateY(0) rotate(0deg);
      }

      50% {
        transform: translateY(-20px) rotate(10deg);
      }
    }

    main {
      max-width: 800px;
      margin: -80px auto 40px;
      perspective: 1000px;
      padding: 0 2rem;
    }

    .form-container {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 25px;
      padding: 2.5rem;
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
      transform: rotateX(5deg) rotateY(-5deg);
      transition: transform 0.5s ease;
    }

    .form-container:hover {
      transform: rotateX(2deg) rotateY(-2deg);
    }

    .form-group {
      margin-bottom: 2rem;
      position: relative;
    }

    .form-group::after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 2px;
      background: var(--primary);
      transition: width 0.5s ease;
    }

    .form-group:focus-within::after {
      width: 100%;
    }

    input,
    select,
    textarea {
      width: 100%;
      padding: 1.2rem;
      border: 2px solid transparent;
      border-radius: 12px;
      background: rgba(255, 255, 255, 0.9);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      font-family: inherit;
    }

    input:focus,
    select:focus,
    textarea:focus {
      border-color: var(--primary);
      box-shadow: 0 8px 20px rgba(42, 157, 143, 0.15);
      transform: translateY(-2px);
    }

    .info-card {
      position: absolute;
      right: -300px;
      top: 50%;
      transform: translateY(-50%);
      width: 280px;
      background: white;
      padding: 1.5rem;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      opacity: 0;
      transition: all 0.4s ease;
      pointer-events: none;
      z-index: 10;
    }

    .form-group:hover .info-card {
      right: -320px;
      opacity: 1;
    }

    .submit-btn {
      position: relative;
      overflow: hidden;
      background: var(--gradient);
      color: white;
      padding: 1.5rem 3rem;
      border: none;
      border-radius: 15px;
      font-size: 1.1rem;
      cursor: pointer;
      transition: all 0.4s ease;
      margin-top: 1rem;
    }

    .submit-btn span {
      position: relative;
      z-index: 2;
    }

    .submit-btn::before {
      content: "";
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg,
          transparent,
          rgba(255, 255, 255, 0.3),
          transparent);
      transition: 0.5s;
    }

    .submit-btn:hover::before {
      left: 100%;
    }

    .progress-steps {
      display: flex;
      justify-content: space-between;
      margin-bottom: 3rem;
      position: relative;
    }

    .progress-step {
      width: 40px;
      height: 40px;
      border: 3px solid #eee;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      background: white;
      position: relative;
      transition: all 0.3s ease;
    }

    .progress-step.active {
      border-color: var(--primary);
      background: var(--primary);
      color: white;
      transform: scale(1.2);
    }

    .progress-bar {
      position: absolute;
      top: 50%;
      left: 0;
      height: 3px;
      background: #eee;
      width: 100%;
      z-index: -1;
    }

    .progress-fill {
      height: 100%;
      background: var(--primary);
      transition: width 0.5s ease;
    }

    .success-animation {
      display: none;
      text-align: center;
      padding: 2rem;
    }

    .checkmark {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background: var(--primary);
      margin: 0 auto 2rem;
      position: relative;
      animation: scaleUp 0.5s ease;
    }

    .checkmark::after {
      content: "";
      position: absolute;
      left: 20px;
      top: 38px;
      width: 25px;
      height: 12px;
      border-left: 4px solid white;
      border-bottom: 4px solid white;
      transform: rotate(-45deg);
    }

    @keyframes scaleUp {
      0% {
        transform: scale(0);
      }

      80% {
        transform: scale(1.1);
      }

      100% {
        transform: scale(1);
      }
    }

    .map-preview {
      height: 200px;
      border-radius: 15px;
      margin: 2rem 0;
      background: #ddd;
      position: relative;
      overflow: hidden;
    }

    .map-overlay {
      position: absolute;
      width: 100%;
      height: 100%;
      background: linear-gradient(45deg, rgba(42, 157, 143, 0.1), rgba(233, 196, 106, 0.1));
      pointer-events: none;
    }

    .error-message {
      color: #e76f51;
      padding: 1rem;
      margin: 1rem 0;
      border: 2px solid #ffe3e3;
      border-radius: 8px;
      background: #fff5f5;
      animation: shake 0.5s;
    }

    @keyframes shake {

      0%,
      100% {
        transform: translateX(0);
      }

      25% {
        transform: translateX(-10px);
      }

      50% {
        transform: translateX(10px);
      }

      75% {
        transform: translateX(-5px);
      }
    }

    @media (max-width: 768px) {
      main {
        margin: 2rem auto;
        padding: 0 1rem;
      }

      .form-container {
        transform: none;
        padding: 1.5rem;
      }

      .info-card {
        display: none;
      }

      .floating-icon {
        font-size: 1.5rem;
      }
    }
  </style>
</head>

<body>
  <header>
    <div class="floating-icons">
      <div class="floating-icon" style="left: 10%; top: 20%">♻️</div>
      <div class="floating-icon" style="left: 30%; top: 60%">🌱</div>
      <div class="floating-icon" style="left: 70%; top: 40%">🌍</div>
    </div>
    <div class="header-content" data-aos="zoom-in">
      <h1>Schedule Smart Pickup</h1>
      <p>Help us create cleaner communities through responsible waste management</p>
    </div>
  </header>

  <main>
    <div class="form-container" data-aos="fade-up" data-aos-delay="200">
      <?php if (!empty($errors)): ?>
        <div class="error-message">
          <?php foreach ($errors as $error): ?>
            <p><?= $error ?></p>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <?php if (isset($_SESSION['success'])): ?>
        <div class="success-animation" style="display: block;">
          <div class="checkmark"></div>
          <h3>Pickup Scheduled Successfully!</h3>
          <p>Our team will contact you shortly</p>
        </div>
        <?php unset($_SESSION['success']); ?>
      <?php else: ?>
        <div class="progress-steps">
          <div class="progress-step active">1</div>
          <div class="progress-step">2</div>
          <div class="progress-step">3</div>
          <div class="progress-bar">
            <div class="progress-fill" style="width: 33%"></div>
          </div>
        </div>

        <form id="pickupForm" method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
          <form id="pickupForm" method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <!-- Step 1 -->
            <div class="form-step active">
              <div class="form-group">
                <input type="text" name="full_name" placeholder="Full Name" required value="<?= htmlspecialchars($inputs['full_name'] ?? '') ?>">
                <div class="info-card">
                  <h4>Why We Need This</h4>
                  <p>We use your name to personalize your service experience</p>
                </div>
              </div>
              <div class="form-group">
                <input type="email" name="email" placeholder="Email Address" required value="<?= htmlspecialchars($inputs['email'] ?? '') ?>">
              </div>
            </div>

            <!-- Step 2 -->
            <div class="form-step">
              <div class="form-group">
                <input type="tel" name="phone" placeholder="Phone Number" pattern="[0-9]{10}" required value="<?= htmlspecialchars($inputs['phone'] ?? '') ?>">
              </div>
              <div class="form-group">
                <textarea name="address" placeholder="Pickup Address" required><?= htmlspecialchars($inputs['address'] ?? '') ?></textarea> <!-- Added address field -->
              </div>
              <div class="map-preview">
                <div class="map-overlay"></div>
              </div>
            </div>

            <!-- Step 3 -->
            <div class="form-step">
              <div class="form-group">
                <select name="waste_type" required>
                  <option value="">Select Waste Type</option>
                  <option value="Recyclables" <?= ($inputs['waste_type'] ?? '') === 'Recyclables' ? 'selected' : '' ?>>Recyclables</option>
                  <option value="Organic" <?= ($inputs['waste_type'] ?? '') === 'Organic' ? 'selected' : '' ?>>Organic</option>
                  <option value="Hazardous" <?= ($inputs['waste_type'] ?? '') === 'Hazardous' ? 'selected' : '' ?>>Hazardous</option>
                </select>
              </div>
              <div class="form-group">
                <input type="date" name="pickup_date" required value="<?= htmlspecialchars($inputs['pickup_date'] ?? '') ?>" min="<?= date('Y-m-d') ?>">
              </div>
            </div>

            <button type="submit" class="submit-btn">
              <span>Schedule Pickup</span>
            </button>
          </form>
        <?php endif; ?>
    </div>
  </main>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 1000,
      once: true,
      mirror: false
    });

    // Form Steps Navigation
    const steps = document.querySelectorAll('.form-step');
    const progressSteps = document.querySelectorAll('.progress-step');
    const progressFill = document.querySelector('.progress-fill');
    let currentStep = 0;

    function updateProgress() {
      progressSteps.forEach((step, index) => {
        step.classList.toggle('active', index <= currentStep);
      });
      progressFill.style.width = `${(currentStep + 1) * 33}%`;
    }

    // Form Validation
    document.querySelectorAll('input').forEach(input => {
      input.addEventListener('input', () => {
        if (input.checkValidity()) {
          input.style.borderColor = '#2a9d8f';
        } else {
          input.style.borderColor = '#e76f51';
        }
      });
    });
  </script>
</body>

</html>