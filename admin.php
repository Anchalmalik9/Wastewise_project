```php
<?php
session_start();
require 'config.php';

// ✅ Restrict access (only admin allowed)
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access Denied ❌";
    exit();
}

// ✅ Fetch all pickup records
$stmt = $pdo->query("SELECT * FROM pickups ORDER BY created_at DESC");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - WasteWise</title>
    <style>
        body {
            font-family: Arial;
            text-align: center;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: auto;
        }
        th, td {
            padding: 10px;
            border: 1px solid black;
        }
        th {
            background-color: #2a9d8f;
            color: white;
        }
        a {
            text-decoration: none;
            color: red;
        }
    </style>
</head>
<body>

<h2>Admin Panel - All Pickups</h2>

<a href="index.html">⬅ Back to Home</a>
<br><br>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Waste Type</th>
    <th>Date</th>
    <th>Action</th>
</tr>

<?php foreach ($data as $row): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['full_name'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['waste_type'] ?></td>
    <td><?= $row['pickup_date'] ?></td>
    <td>
        <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this record?')">Delete</a>
    </td>
</tr>
<?php endforeach; ?>

</table>

</body>
</html>
```
