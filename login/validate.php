<?php
session_start();

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username === 'guest' && $password === 'guest') {
    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['id'] = 7;

    setcookie('isAdmin', 'false', time() + 3600, '/');

    header('Location: /users?id=7');
    exit();
} else {
    $_SESSION['error'] = "Invalid username or password.";
    header('Location: /login/index.php');
    exit();
}
