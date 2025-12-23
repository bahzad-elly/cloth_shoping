<?php
include"db_connection.php";
session_start();
if(!isset($_SESSION['user_id'])){
    header("location:index.php");
    exit;
}

$usr = $conn->query("SELECT * FROM users");
$user_number = $usr->rowCount();
?>

<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بەڕێوەبردنی فرۆشگای جلوبەرگ</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;700&display=swap" rel="stylesheet">
    <style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Noto Sans Arabic', Tahoma, sans-serif;
}

body {
    background-color: #f4f7f6;
}

.container {
    display: flex;
    min-height: 100vh;
}

/* ستایلی لایەنی */
.sidebar {
    width: 250px;
    background-color: #2c3e50;
    color: white;
    padding: 20px;
}

.sidebar h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #3498db;
}

.sidebar ul {
    list-style: none;
}

.sidebar ul li {
    padding: 15px;
    cursor: pointer;
    transition: 0.3s;
    border-radius: 5px;
    margin-bottom: 5px;
}

.sidebar ul li:hover, .sidebar ul li.active {
    background-color: #34495e;
    color: #3498db;
}

/* ناوەڕۆکی سەرەکی */
.main-content {
    flex: 1;
    padding: 30px;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    background: white;
    padding: 15px 25px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

/* کارتەکان */
.stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.card {
    background: white;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.card h3 {
    font-size: 16px;
    color: #7f8c8d;
    margin-bottom: 10px;
}

.card p {
    font-size: 22px;
    font-weight: bold;
    color: #2c3e50;
}

/* خشتەکە */
.recent-orders {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.recent-orders h2 {
    margin-bottom: 20px;
    font-size: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table th, table td {
    padding: 12px;
    text-align: right;
    border-bottom: 1px solid #eee;
}

.status {
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
}

.status.completed { background: #d4edda; color: #155724; }
.status.pending { background: #fff3cd; color: #856404; }
</style>
</head>
<body>

    <div class="container">
        <aside class="sidebar">
            <h2>فرۆشگای من</h2>
            <ul>
                <li class="active">سەرەکی</li>
                <li>کاڵاکان</li>
                <li>داواکارییەکان</li>
                <li>کڕیارەکان</li>
                <li>ڕاپۆرتەکان</li>
                <li>ڕێکخستن</li>
                <li><a href="create_user.php">create user</a></li>
                <li><a href="suppliers.php">create supplier</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <header>
                <h1>تەختەی کۆنتڕۆڵ</h1>
                <div class="user-info">بەخێربێیت، <span><?php echo $_SESSION['username']; ?></span></div>
            </header>

            <section class="stats">
                <div class="card">
                    <h3>کۆی فرۆش</h3>
                    <p>١,٢٥٠,٠٠٠ دینار</p>
                </div>
                <div class="card">
                    <h3>داواکاری نوێ</h3>
                    <p>١٥</p>
                </div>
                <div class="card">
                    <h3>کاڵای بەردەست</h3>
                    <p>٤٥٠ پارچە</p>
                </div>
                <div class="card">
                    <h3>zhmaray user</h3>
                    <p><?php echo $user_number; ?></p>
                </div>
            </section>

            <section class="recent-orders">
                <h2>دوایین داواکارییەکان</h2>
                <table>
                    <thead>
                        <tr>
                            <th>کۆدی داواکاری</th>
                            <th>کڕیار</th>
                            <th>جۆری جل</th>
                            <th>نرخ</th>
                            <th>دۆخ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#1001</td>
                            <td>ئاراس ئەحمەد</td>
                            <td>قاتی پیاوانە</td>
                            <td>١٢٠,٠٠٠ د.ع</td>
                            <td><span class="status completed">تەواوبووە</span></td>
                        </tr>
                        <tr>
                            <td>#1002</td>
                            <td>سارا محەمەد</td>
                            <td>فستانی ئافرەتانە</td>
                            <td>٨٥,٠٠٠ د.ع</td>
                            <td><span class="status pending">چاوەڕێیە</span></td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </main>
    </div>

</body>
</html>