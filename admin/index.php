<?php 
    session_start();
    $pageTitle = 'Admin Login';

    if (isset($_SESSION['username_restaurant_qRewacvAqzA']) && isset($_SESSION['password_restaurant_qRewacvAqzA'])) {
        header('Location: dashboard.php');
    }
?>

<?php include 'connect.php'; ?>
<?php include 'Includes/functions/functions.php'; ?>
<?php include 'Includes/templates/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Vincent Pizza</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
  <style>
    /* Style similar to previous example */
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

    .login-container {
      background-color: #444;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.5);
      width: 400px;
      text-align: center;
    }

    .login-container h1 {
      font-size: 36px;
      font-weight: 700;
      color: #f7c544;
      margin-bottom: 20px;
    }

    .login-container p {
      font-size: 14px;
      color: #bbb;
      margin-bottom: 30px;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: none;
      border-radius: 5px;
      background-color: #555;
      color: #fff;
      font-size: 16px;
    }

    .login-container button {
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

    .login-container button:hover {
      background-color: #e6b73c;
    }

    .login-container a {
      display: block;
      margin-top: 15px;
      color: #f7c544;
      text-decoration: none;
    }

    .login-container a:hover {
      text-decoration: underline;
    }

    .alert-danger {
      background-color: #ff4444;
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 5px;
      color: white;
      text-align: left;
    }

    .alert-danger .close {
      float: right;
      color: white;
      font-size: 20px;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <h1>Admin Login</h1>
    <p>Welcome back to Love Latee Cafe..</p>

    <form action="index.php" method="POST" onsubmit="return validateLoginForm()">
      <?php
        if (isset($_POST['admin_login'])) {
            $username = test_input($_POST['username']);
            $password = test_input($_POST['password']);
            $hashedPass = sha1($password);

            // Check if user exists in database
            $stmt = $con->prepare("SELECT user_id, username, password FROM users WHERE username = ? AND password = ?");
            $stmt->execute(array($username, $hashedPass));
            $row = $stmt->fetch();
            $count = $stmt->rowCount();

            if ($count > 0) {
                $_SESSION['username_restaurant_qRewacvAqzA'] = $username;
                $_SESSION['password_restaurant_qRewacvAqzA'] = $password;
                $_SESSION['userid_restaurant_qRewacvAqzA'] = $row['user_id'];
                header('Location: dashboard.php');
                die();
            } else {
                echo '
                <div class="alert alert-danger">
                    <button class="close" onclick="this.parentElement.style.display=\'none\';">&times;</button>
                    <div>Username and/or password are incorrect!</div>
                </div>';
            }
        }
      ?>

      <!-- USERNAME INPUT -->
      <input type="text" name="username" placeholder="Username" id="user" autocomplete="off">
      <div class="invalid-feedback" id="username_required" style="display: none;">Username is required!</div>

      <!-- PASSWORD INPUT -->
      <input type="password" name="password" placeholder="Password" id="password" autocomplete="new-password">
      <div class="invalid-feedback" id="password_required" style="display: none;">Password is required!</div>

      <!-- SIGNIN BUTTON -->
      <button type="submit" name="admin_login">Sign In</button>

      <!-- FORGOT PASSWORD LINK -->
      <a href="#">Forgot your password? Reset it here.</a>
    </form>
  </div>

  <script>
    function validateLoginForm() {
      let username = document.getElementById('user').value;
      let password = document.getElementById('password').value;
      let valid = true;

      if (username === "") {
        document.getElementById('username_required').style.display = 'block';
        valid = false;
      }
      if (password === "") {
        document.getElementById('password_required').style.display = 'block';
        valid = false;
      }

      return valid;
    }
  </script>

</body>
</html>

<?php include 'Includes/templates/footer.php'; ?>

