<?php
include "db_connection.php";
session_start();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $username = trim($_POST['username']);
    $password = $_POST['password'];


    $stmt = $conn->prepare("SELECT * from users where username =:username limit 1");
    $stmt->execute(['username'=>$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);//user(user-id , username , user pass , user role)

    if(!$user){
    echo"<script>alert('you not user')</script>";
}elseif(!password_verify($password,$user['pass'])){
    echo"<script>alert('your password is incorect ');</script>";
}else{
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    header("location:dashboard.php");
    exit;
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cloth Shop Management</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        body {
            height: 100vh;
            background: linear-gradient(135deg, #5dade2, #85c1e9);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: #ffffff;
            width: 400px;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h2 {
            color: #2c3e50;
            font-size: 26px;
            margin-bottom: 8px;
        }

        .login-header p {
            color: #7f8c8d;
            font-size: 14px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #34495e;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #dcdde1;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .input-group input:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 8px rgba(52, 152, 219, 0.2);
        }

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 13px;
        }

        .options a {
            color: #3498db;
            text-decoration: none;
        }

        .options a:hover {
            text-decoration: underline;
        }

        .btn {
            width: 100%;
            padding: 13px;
            background: #3498db;
            border: none;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn:hover {
            background: #2e86c1;
        }

        .footer-note {
            margin-top: 25px;
            font-size: 13px;
            color: #95a5a6;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-header">
        <h2>Shop Login</h2>
        <p>Enter your credentials to manage inventory</p>
    </div>

    <form method="post" action="">
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="Enter your username" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>
        </div>

        <div class="options">
            <label style="color: #7f8c8d; cursor: pointer;">
                <input type="checkbox" name="remember"> Remember me
            </label>
            <a href="#">Forgot Password?</a>
        </div>

        <button type="submit" name="login" class="btn">Login to System</button>
    </form>

    <div class="footer-note">
        <a href="create_user.php">create user</a> <br>
        © 2024 Cloth Shop Management System
    </div>
</div>

</body>
</html>