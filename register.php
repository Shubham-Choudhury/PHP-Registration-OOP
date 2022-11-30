<?php

    include_once 'database.php';

    $conn = new Database();

    if(isset($_POST['submit'])){

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // validation
        if(empty($name) || empty($email) || empty($password)){
            echo "<script>alert('All fields are required')</script>";
        }else{
            // validation for email
            if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
                echo "<script>alert('Invalid email format')</script>";
            }else{
                // validation for password
                if(strlen($password) < 6){
                    echo "<script>alert('Password must be at least 6 characters')</script>";
                }else{
                    if($conn->checkEmail($email)){
                        echo "<script>alert('Email already exists')</script>";
                    }
                    else{
                        // hashing password
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        if($conn->register($name, $email, $password)){
                            echo "<script>alert('Registration successful')</script>";
                        }else{
                            echo "<script>alert('Registration failed')</script>";
                        }
                    }
                }
            }
        }

    }
?>

<html>

<head>
    <title>Registration</title>
    <link rel="stylesheet" href="public/style.css" />
</head>

<body>
    <div class="form">
        <h1>Registration</h1>
        <form action="" method="post">
            <input type="text" name="name" placeholder="Please Enter Name" required />
            <br />
            <input type="text" name="email" placeholder="Please Enter Email" required />
            <br />
            <input type="password" name="password" placeholder="Please Enter Password" required />
            <br />
            <input type="submit" name="submit" value="Register" />
        </form>
        <p>Alredy Registered?<a href="login.php"> Login Here</a></p>
    </div>
</body>

</html>