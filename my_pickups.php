<?php
session_start();
require 'config.php';


if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}


$stmt = $pdo->prepare("SELECT * FROM pickups WHERE email = ?");
$stmt->execute([$_SESSION['email']]); 

$data = $stmt->fetchAll(PDO::FETCH_ASSOC); 

?>

<h2>Pickup History</h2>

<table border="1" cellpadding="10">
<tr>
    <th>Name</th>
    <th>Email</th>
    <th>Waste Type</th>
    <th>Date</th>
</tr>

<?php foreach ($data as $row): ?>
<tr>
    <td><?= $row['full_name'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['waste_type'] ?></td>
    <td><?= $row['pickup_date'] ?></td>
</tr>
<?php endforeach; ?>
</table>