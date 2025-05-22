<?php
session_start();

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "users";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection Has Failed, Please Try Again: " . $conn->connect_error);
}

$user = null;

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql = "SELECT username, pass, email, date_added FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Croccy Profile</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-image: url('crocprof.jpg');
            background-size: cover; 
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh; 
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            color: white;
            font-family: Arial, sans-serif;
        }

        .buttonContainer {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            width: 90%;
            max-width: 300px;
        }

        button {
            background-color: red;
            color: white;
            border: none;
            padding: 15px 20px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
            width: 100%;
            text-align: center;
            margin-top: 10px;
        }

        button:hover {
            background-color: darkred;
        }

        .usernameDisplay {
            background: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 24px;
        }
    </style>
</head>
<body>
<div class="usernameDisplay">
    <?php if ($user): ?>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Date Added:</strong> <?php echo htmlspecialchars($user['date_added']); ?></p>
    <?php else: ?>
        <p>User Not Found</p>
    <?php endif; ?>
</div>

    <div>
    <button onclick="redirectTo('changeuser.html')">Change User</button>
        <button onclick="redirectTo('settings.html')">Back</button>
    </div>

    <script>
        function redirectTo(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>

