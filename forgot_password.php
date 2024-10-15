<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    $stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $reset_token = bin2hex(random_bytes(50));
        $token_expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $stmt = $conn->prepare("UPDATE users SET reset_token = ?, token_expiry = ? WHERE email = ?");
        $stmt->execute([$reset_token, $token_expiry, $email]);

        $reset_link = "http://yourdomain.com/reset_password.php?token=" . $reset_token;
        // Mail the reset link to the user (use PHP's mail() function)
        mail($email, 'Password Reset', "Click the link to reset your password: $reset_link");

        echo "Password reset link sent to your email.";
    } else {
        echo "Email not found";
    }
}
?>
<html>

<head>
    <style>
        /* Add some basic styling to center the form and make it look clean */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #333;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #444;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.5);
            width: 400px;
            text-align: center;
        }

        h3 {
            /* font-size: 36px; */
            font-weight: 700;
            color: #f7c544;
            /* margin-bottom: 20px; */
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: #555;
            color: #fff;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #f7c544;
            color: #333;
            font-size: 18px;
            font-weight: 700;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #e6b73c;
        }

        .alert {
            background-color: #ff4444;
            color: white;
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
        }

        .alert a {
            color: #f7c544;
            text-decoration: underline;
        }

        .alert a:hover {
            text-decoration: none;
        }

        a {
            display: block;
            margin-top: 15px;
            color: #f7c544;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .box {
            box-shadow: 1px 2px 5px rgba(0, 0, 0, .7);
            width: 300px;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body></body>

</html>

<form method="POST" action="forgot_password.php">
    <div class="box">
        <div>
            <h3>Admin forgot_password</h3>
            <input type="email" name="email" placeholder="Enter your email" required><br>
            <button type="submit">Reset Password</button>
        </div>
    </div>
</form>