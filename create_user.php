<?php
include "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role     = $_POST['role'];

    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, pass, role) VALUES (:username, :pass, :role)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':pass', $hash_password);
    $stmt->bindParam(':role', $role);
    $stmt->execute();

    echo "<script>alert('User created successfully');</script>";
}

$sql = "SELECT * FROM users";
$stmt = $conn->prepare($sql);
$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$admin = 0;
$employee = 0;

foreach($users as $user){
    if($user['role']=== 'admin'){
    $admin ++;
}else{
    $employee++;

}
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management Dashboard</title>
    <style>
        :root {
            --primary: #3498db;
            --secondary: #2c3e50;
            --success: #27ae60;
            --danger: #e74c3c;
            --bg: #f4f7f6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--bg);
            padding: 40px;
            color: #333;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        /* --- Dashboard Cards --- */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            text-align: center;
            border-bottom: 4px solid var(--primary);
        }

        .card h3 {
            font-size: 14px;
            text-transform: uppercase;
            color: #777;
            margin-bottom: 10px;
        }

        .card .count {
            font-size: 28px;
            font-weight: bold;
            color: var(--secondary);
        }

        /* --- Main Layout: Form and Table --- */
        .main-grid {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 30px;
            align-items: start;
        }

        @media (max-width: 850px) {
            .main-grid { grid-template-columns: 1fr; }
        }

        .form-section, .table-section {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        h2 {
            margin-bottom: 20px;
            font-size: 20px;
            color: var(--secondary);
        }

        .input-group { margin-bottom: 15px; }
        .input-group label { display: block; margin-bottom: 5px; font-size: 13px; font-weight: 600; }
        
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn-create { background: var(--primary); color: white; }
        .btn-create:hover { background: #2980b9; }

        /* --- Table Styles --- */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            text-align: left;
            background: #f8f9fa;
            padding: 12px;
            font-size: 14px;
            border-bottom: 2px solid #eee;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .badge-admin { background: #ebf5ff; color: #3498db; }
        .badge-emp { background: #f0fdf4; color: #27ae60; }

        .btn-edit { color: var(--primary); background: none; margin-right: 10px; cursor: pointer; border: none; font-weight: 600; }
        .btn-delete { color: var(--danger); background: none; cursor: pointer; border: none; font-weight: 600; }
        
        .btn-edit:hover, .btn-delete:hover { text-decoration: underline; }

    </style>
</head>
<body>

<div class="container">
    
    <div class="stats-row">
        <div class="card">
            <h3>Total Admins</h3>
            <div class="count">
            <?php echo $admin; ?>
            </div>
        </div>
        <div class="card" style="border-color: var(--success);">
            <h3>Total Employees</h3>
            <div class="count"><?php echo $employee;?></div>
        </div>
    </div>

    <div class="main-grid">
        <div class="form-section">
            <h2>Create User</h2>
            <form action="#" method="POST">
                <div class="input-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="johndoe" required>
                </div>
                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
                <div class="input-group">
                    <label>Role</label>
                    <select name="role" required>
                        <option value="admin">Admin</option>
                        <option value="employee" selected>Employee</option>
                    </select>
                </div>
                <button type="submit" name="create" class="btn btn-create">Create User</button>
            </form>
        </div>

        <div class="table-section">
            <h2>User List</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <?php if($users): ?>
                            <?php foreach($users as $user): ?>
                        <td>
                            <?php echo $user['user_id']; ?>

                        </td>
                        <td>
                            <?php echo $user['username']; ?>

                        </td>
                        <td>
                            <?php echo $user['role']; ?>

                        </td>
                        <td>
                            <button class="btn-edit">Edit</button>
                            <button class="btn-delete">Delete</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <td colspan="4">
                            user not found

                        </td>
                    <?php endif; ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>