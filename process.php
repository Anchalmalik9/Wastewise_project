<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $waste_type = $_POST['waste_type'];
    $pickup_date = $_POST['pickup_date'];
    $pickup_time = $_POST['pickup_time'];

    $stmt = $pdo->prepare("INSERT INTO pickups 
        (name, email, phone, address, waste_type, pickup_date, pickup_time) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");

    $stmt->execute([
        $name,
        $email,
        $phone,
        $address,
        $waste_type,
        $pickup_date,
        $pickup_time
    ]);

    echo "<script>alert('Pickup scheduled successfully'); window.location.href='index.html';</script>";
}
?>