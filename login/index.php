<?php
session_start(); 
ob_start();
include_once __DIR__ . '/../header.php';
$headerHtml = ob_get_clean();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
    }
    a {
      color: white;
      text-decoration: none;
    }
    main.login-form {
      margin: 100px auto 0 auto; 
      width: 320px;
      max-width: 95%;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      box-sizing: border-box;
      text-align: center;
    }

    main.login-form h2 {
      margin-top: 0;
      color: #333;
      font-weight: 700;
      margin-bottom: 15px;
    }

    label {
      font-weight: 600;
      color: #555;
      display: block;
      margin-bottom: 5px;
      text-align: left;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border-radius: 6px;
      border: 1px solid #ccc;
      margin-bottom: 15px;
      box-sizing: border-box;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
      border-color: #3498db;
      outline: none;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #4CAF50;
      border: none;
      border-radius: 6px;
      font-weight: 600;
      font-size: 16px;
      color: white;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #45a049;
    }

    .note {
      font-size: 14px;
      color: #777;
      margin-bottom: 20px;
    }
  </style>
</head>
<body style="margin: 0; background-color: #1f2937; color: black; font-family: Arial, sans-serif;">
<?php 
echo $headerHtml;
?>

<main class="login-form">
  <h2>Login</h2>
  <div class="note">Login using <strong>guest:guest</strong></div>

  <form method="POST" action="validate.php" novalidate>
    <label for="username">Username</label>
    <input type="text" id="username" name="username" placeholder="Enter Username" required autocomplete="username" />

    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Enter Password" required autocomplete="current-password" />

    <button type="submit">Login</button>
  </form>
</main>

<?php if (isset($_SESSION['error'])): ?>
<script>
  alert("<?php echo addslashes($_SESSION['error']); ?>");
</script>
<?php unset($_SESSION['error']); endif; ?>

</body>
</html>
