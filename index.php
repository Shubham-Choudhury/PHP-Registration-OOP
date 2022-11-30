<?php

include_once 'valid_login.php';
include_once 'database.php';

$loggedin = new Loggedin();

$conn = new Connection();
$db = $conn->connect();

$email = $_SESSION['user_email'];

$sql = "SELECT * FROM users WHERE email = :email";
$stmt = $db->prepare($sql);
$stmt->execute(['email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$name = $user['name'];

?>

<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="public/style.css" />
</head>

<body>
    <div class="form">
        <h1>Welcome <?php echo $name; ?></h1>
        <p align="right"><a href="logout.php">LOGOUT</a></p>
    </div>
</body>

</html>