<?php

$output = "";

function escape($input) {
    return trim(htmlspecialchars($input));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["sign-up-btn"])) {
        if (empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["email"])) {
            $output = "<p class='error'>ERROR: One Or More Inputs Are Empty</p>";   
        } else {
            if (strlen($_POST["username"]) < 4 || strlen($_POST["username"]) > 64) {
                $output .= "<p class='error'>ERROR: Username Should Be Between 4 And 64 Characters In Length</p>";
            }
            
            if (strlen($_POST["password"]) < 8 || strlen($_POST["password"]) > 75) {
                $output .= "<p class='error'>ERROR: Password Should Be Between 8 And 75 Characters In Length</p>";
            }
    
            if (strlen($_POST["email"]) < 12 || strlen($_POST["username"]) > 200) {
                $output .= "<p class='error'>ERROR: Email Should Be Between 12 And 200 Characters In Length</p>";
            }
    
            if (!$output) {
                require("includes/connect.php");
            
                $stmt = $conn->prepare("INSERT INTO users (username, pass, email) VALUES (?, ?, ?)");
                $stmt->execute([$_POST["username"], $_POST["password"], $_POST["email"]]);
            
                session_start();
                $_SESSION['username'] = $_POST['username'];
            
                $conn = null;
                header("Location: http://localhost/guapp/cookie.html");
                exit();
            }
        }
    }
}
            

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Croccy Create An Account</title>
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

    <div class="splashScreen" id="splashScreen">
        <h1>Croccy's Create</h1>
    </div>

    <div class="box">
        <div class="form">
            <h1 id="title">Create An Account</h1>

            <script>
                function validateForm(event) {
                    const fields = document.querySelectorAll("input[type='text'], input[type='email'], input[type='password']");
                    let allFilled = true;
                    fields.forEach(field => {
                        if (field.value.trim() === "") {
                            allFilled = false;
                            field.style.borderColor = "red";
                        } else {
                            field.style.borderColor = "";
                        }
                    });
                    
                    if (!allFilled) {
                        event.preventDefault();
                        alert("Please Fill Out All Of The Fields");
                    }
                }
            </script>

            <form onsubmit="validateForm(event)" action="login.php" method="POST"> 
                <div class="group">
                    <div class="field">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" name="username" placeholder="Username" required>                
                    </div>

                    <div class="field">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" required>                
                    </div>

                    <div class="field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required>                
                    </div>
                </div>
                <div class="btntwo">
                    <button type="submit" name="sign-up-btn">Create Account</button>
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
