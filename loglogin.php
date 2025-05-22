<?php
session_start();

$output = "";

function escape($input) {
    return trim(htmlspecialchars($input));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["loginButton"])) {
        $username = escape($_POST["username"]);
        $password = escape($_POST["password"]);

        /*Error Handling and Redirection When User And Pass Are Passed Correctly*/

        if (empty($username) || empty($password)) {
            $output = "<p class='error'>ERROR: Make Sure To Please Fill Out All Fields :) </p>";
        } else {
            require("includes/connect.php");

            $stmt = $conn->prepare("SELECT username, pass FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if ($user && $user['pass'] === $password) {
                $_SESSION['username'] = $username;
                header("Location: http://localhost/guapp/home.html");
                exit();
            } else {
                $output = "<p class='error'>ERROR: Username Or Password Is Incorrect. Try Again :( </p>";
            }

            $conn = null;
        }
    }
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Croccy Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        .box {
            width: 100%;
            height: 100vh;
            background-image: linear-gradient(rgba(255, 71, 71, 0.8),rgba(255, 71, 71, 0.8)), url(croccreate.jpg);
            background-position: center;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Form Creation and Button Creation */
        .form {
            width: 90%;
            max-width: 400px;
            background: #ffffff;
            padding: 30px;
            text-align: center;
            border-radius: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .form h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #a00000;
            position: relative;
        }

        .form h1::after {
            content: '';
            width: 30px;
            height: 4px;
            border-radius: 3px;
            background: #a00000;
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
        }

        /*Field To Fill In*/
        .field {
            background: #ffe2e2;
            margin: 12px 0;
            border-radius: 10px;
            display: flex;
            align-items: center;
            padding: 10px;
        }

        input {
            width: 100%;
            background: transparent;
            border: none;
            outline: none;
            padding: 10px;
            font-size: 16px;
        }

        .field i {
            margin-left: 10px;
            color: #999;
        }

        form p {
            font-size: 12px;
            font-weight: bold;
        }

        form p a {
            text-decoration: none;
            color: #a00000;
        }

        .btn, .btntwo {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .btn button, .btntwo button {
            background: #a00000;
            color: #ffffff;
            height: 45px;
            border-radius: 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: 0.3s;
            width: 100%;
            margin-bottom: 20px;
        }

        .btn button:hover, .btntwo button:hover {
            background: darkred;
        }

        .btn button.disable {
            background-color: #fec4c4;
        }

        /* Again Making It Mobile Worthy */
        @media (max-width: 480px) {
            .form {
                padding: 20px;
                width: 95%;
            }

            input {
                font-size: 14px;
            }

            .btn button, .btntwo button {
                font-size: 14px;
                height: 40px;
            }
        }

        /* Splash Screen */
        .splashScreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #d32f2f;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 1;
            z-index: 9999;
            transition: opacity 2s ease-out;
        }

        .splashScreen h1 {
            font-size: 40px;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

    </style>
</head>
<body>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Croccy Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .box {
            width: 100%;
            height: 100vh;
            background-image: linear-gradient(rgba(255, 71, 71, 0.8),rgba(255, 71, 71, 0.8)), url(croccreate.jpg);
            background-position: center;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form {
            width: 90%;
            max-width: 400px;
            background: #ffffff;
            padding: 30px;
            text-align: center;
            border-radius: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .form h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #a00000;
            position: relative;
        }

        .form h1::after {
            content: '';
            width: 30px;
            height: 4px;
            border-radius: 3px;
            background: #a00000;
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
        }

        .field {
            background: #ffe2e2;
            margin: 12px 0;
            border-radius: 10px;
            display: flex;
            align-items: center;
            padding: 10px;
        }

        input {
            width: 100%;
            background: transparent;
            border: none;
            outline: none;
            padding: 10px;
            font-size: 16px;
        }

        .field i {
            margin-left: 10px;
            color: #999;
        }

        .btn, .btntwo {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .btn button, .btntwo button {
            background: #a00000;
            color: #ffffff;
            height: 45px;
            border-radius: 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: 0.3s;
            width: 100%;
            margin-bottom: 20px;
        }

        .btn button:hover, .btntwo button:hover {
            background: darkred;
        }

        .error {
            color: red;
            font-weight: bold;
        }

        @media (max-width: 480px) {
            .form {
                padding: 20px;
                width: 95%;
            }

            input {
                font-size: 14px;
            }

            .btn button, .btntwo button {
                font-size: 14px;
                height: 40px;
            }
        }

        .splashScreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #d32f2f;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 1;
            z-index: 9999;
            transition: opacity 2s ease-out;
        }

        .splashScreen h1 {
            font-size: 40px;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

    </style>
</head>
<body>

    <div class="splashScreen" id="splashScreen">
        <h1>Croccy's Login</h1>
    </div>

    <div class="box">
        <div class="form">
            <h1 id="title">Login</h1>

            <form action="" method="POST">
                <div class="group">
                    <div class="field">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" name="username" placeholder="Username" required>                
                    </div>

                    <div class="field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required>                
                    </div>
                </div>
                <div class="btntwo">
                <button type="submit" name="loginButton">Login</button>
                </div>

                <?php if ($output) echo $output; ?>
            </form>
        </div>
    </div>

    <script>
        window.onload = function () {
            setTimeout(function () {
                const splashScreen = document.getElementById('splashScreen');
                splashScreen.style.opacity = 0;
                setTimeout(function () {
                    splashScreen.style.display = 'none';
                }, 500);
            }, 500);
        }
    </script>

</body>
</html>
