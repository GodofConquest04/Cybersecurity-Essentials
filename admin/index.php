<?php
require_once __DIR__ . '/../check_login.php';

ob_start();
include_once __DIR__ . '/../header.php';
$headerHtml = ob_get_clean();

if (!isset($_COOKIE['isAdmin'])) {
    header("Location: /users/"); 
    exit();
} elseif ($_COOKIE['isAdmin'] !== 'true') {
    echo "<h2 style='color:red; text-align:center; margin-top:50px;'>❌ You are not an admin!</h2>";
    exit();
}

$pingResult = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['ip'])) {
    $ip = trim($_POST['ip']);
    $cmd = "ping -c 3 $ip 2>&1";
    ob_start();
    system($cmd);
    $pingResult = ob_get_clean();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Panel</title>
    <link rel="stylesheet" href="/style.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
            margin: 0;
        }
        .content-wrapper {
            max-width: 600px;
            margin: 80px auto 40px auto;
            padding: 0 20px;
        }
        .admin-container {
            background: white;
            padding: 25px 30px;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0,0,0,0.15);
            text-align: center;
        }
        input[type="text"] {
            width: 90%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            box-sizing: border-box;
        }
        button {
            margin-top: 20px;
            padding: 12px 30px;
            border: none;
            background: #3498db;
            color: white;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.25s ease;
        }
        button:hover {
            background: #2980b9;
        }
        .result {
            margin-top: 20px;
            font-family: monospace;
            white-space: pre-wrap;
            background: #eee;
            padding: 15px;
            border-radius: 5px;
            max-height: 300px;
            overflow-y: auto;
            text-align: left;
        }
    </style>
</head>
<body style="margin: 0; background-color: #1f2937; color: black; font-family: Arial, sans-serif;">
<?php echo $headerHtml; ?>

<div class="content-wrapper">
    <div class="admin-container">
        <h2>Admin Panel</h2>
        <p>Enter an IP address or hostname to ping:</p>
        <form method="POST" action="">
            <input type="text" name="ip" placeholder="e.g. 8.8.8.8 or example.com" required />
            <br/>
            <button type="submit">Ping</button>
        </form>

        <?php if ($pingResult !== ''): ?>
            <div class="result"><?php echo htmlspecialchars($pingResult); ?></div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
