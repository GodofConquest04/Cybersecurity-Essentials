<?php
require_once __DIR__ . '/../check_login.php';
include_once __DIR__ . '/../header.php';

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    setcookie("isAdmin", "", time() - 3600, "/");
    header("Location: /login/");
    exit;
}

$users = [
    1 => ["name" => "Anurag D. Maurya", "role" => "Technical Head", "bio" => "I love hacking"],
    2 => ["name" => "Shweta Panigrahy", "role" => "Chairperson", "bio" => "Everything happens for a reason"],
    3 => ["name" => "Ayush Sahu", "role" => "Vice Chairperson", "bio" => "Whatever happens, happens for the good"],
    4 => ["name" => "Fuzail Khan", "role" => "Secretary", "bio" => "Busy"],
    5 => ["name" => "Ahtesham Ali Khan", "role" => "Event Manager", "bio" => "Reverse Engineer"],
    6 => ["name" => "Kartik Chudasama", "role" => "Creative Head", "bio" => "."],
    7 => ["name" => "Guest", "role" => "Guest", "bio" => "Hello user"]
];

$id = isset($_GET['id']) ? (int)$_GET['id'] : 7;
$user = $users[$id] ?? $users[7];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo htmlspecialchars($user['name']); ?> - Profile</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
  }
  main.profile {
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    width: 320px;
    max-width: 95%;
    margin: 100px auto 0 auto;
    text-align: center;
  }
  a {
    color: white;
    text-decoration: none;
  }
  a.button {
    display: inline-block;
    margin: 10px 10px 0 10px;
    padding: 10px 20px;
    background: #4CAF50; /* green */
    color: white;
    border-radius: 6px;
    font-weight: 600;
    transition: background 0.3s ease;
  }
  a.button.logout {
    background: #e74c3c; /* red */
  }
  a.button:hover {
    background: #45a049;
  }
  a.button.logout:hover {
    background: #c0392b;
  }
</style>
</head>
<body style="margin: 0; background-color: #1f2937; color: black; font-family: Arial, sans-serif;">
  <main class="profile">
    <h2><?php echo htmlspecialchars($user['name']); ?></h2>
    <p><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
    <p><?php echo htmlspecialchars($user['bio']); ?></p>
    <a href="/chat" class="button">All Chats</a>
    <a href="/users?action=logout" class="button logout">Logout</a>
  </main>
</body>
</html>
