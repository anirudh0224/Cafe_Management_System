<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $con->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username_restaurant'] = $username;
        header('Location: ./index.php');
        exit();
    } else {
        echo "Invalid username or password";
    }
}
?>
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
<div class="container">
    <form method="POST" action="login.php">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button><a href="./register.php">don't have account</a>
        <a href="./forgot_password.php">forgot_password</a>
    </form>
</div>