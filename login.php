<?php

session_start();
include_once 'database.php';

$conn = new Database();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // check if email and password are empty
    if (empty($email) || empty($password)) {
        echo "<script>alert('Please fill all the fields!')</script>";
    } else {
        // check if email is valid
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            echo "<script>alert('Invalid email format!')</script>";
        } else {
            // login
            if ($conn->login($email, $password)) {
                $_SESSION['loggedin'] = true;
                $_SESSION['user_email'] = $email;
                header('location: index.php');
            } else {
                echo "<script>alert('Invalid email or password!')</script>";
            }
        }
    }
}
?>

<html>

<head>
    <title>Log In</title>
    <link rel="stylesheet" href="public/style.css" />
</head>

<body>
    <div class="form">
        <h1>Log In</h1>
        <form action="" method="post">
            <input type="text" name="email" placeholder="Please Enter Email" required />
            <br />
            <input type="password" name="password" placeholder="Please Enter Password" required />
            <br />
            <input type="submit" name="submit" value="Login" />
        </form>
        <p>Not registered yet?<a href="register.php"> Register Here</a></p>
    </div>
</body>

</html>