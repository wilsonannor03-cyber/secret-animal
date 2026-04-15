<?php

require_once __DIR__ . '/conn.php';
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute([':username' => $username]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    exit("User bestaat niet");
}

if (!password_verify($password, $user['password'])) {
    exit("Wachtwoord klopt niet");
}

$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['username'];

header("Location: " . $base_url);
exit;