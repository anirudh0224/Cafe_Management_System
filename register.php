<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $con->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $password]);

    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Vincent Pizza</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
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

        h1 {
            font-size: 36px;
            font-weight: 700;
            color: #f7c544;
            margin-bottom: 20px;
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
    </style>
</head>

<body>

    <div class="container">
        <h1> Register</h1>
        <p>Create your account at Vincent Pizza</p>

        <?php
        // Display error message if exists
        if (isset($_SESSION['error'])) {
            echo '<div class="alert">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']); // Clear error after displaying
        }
        ?>

        <form method="POST" action="register.php">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Register</button>
        </form>

        <a href="login.php">Already have an account? Login here</a>
    </div>

    <script>
        function validateRegisterForm() {
            let username = document.getElementById('username').value;
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;
            let confirmPassword = document.getElementById('confirm_password').value;

            if (username === "" || email === "" || password === "" || confirmPassword === "") {
                alert("All fields are required!");
                return false;
            }

            let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address!");
                return false;
            }

            if (password !== confirmPassword) {
                alert("Passwords do not match!");
                return false;
            }

            if (password.length < 6) {
                alert("Password must be at least 6 characters long!");
                return false;
            }

            return true;
        }
    </script>

</body>

</html>