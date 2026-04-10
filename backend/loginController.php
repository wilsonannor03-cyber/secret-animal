<?php

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch();

if ($stmt->rowCount() < 1) {
    exit;
}

if (!password_verify($password, $user['password'])) {
    exit;
}

session_start();
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['username'];

header("../index.php");

