<?php
// Enable error reporting for development
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db_host = 'sql200.infinityfree.com';
$db_user = 'if0_41897854';
$db_pass = 'b6Rqm5iXMp8ap3';
$db_name = 'if0_41897854_wastecollect';

try {
    $pdo = new PDO(
        "mysql:host=$db_host;port=3306;dbname=$db_name;charset=utf8mb4",
        $db_user,
        $db_pass
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

function sanitizeInput($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}
?>