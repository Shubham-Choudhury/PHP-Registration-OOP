<?php

    session_start();

    class Loggedin{
        public function __construct(){
            if(!isset($_SESSION['loggedin'])){
                header('location: login.php');
            }
        }

        public function logout(){
            session_destroy();
            header('location: login.php');
        }
    }
?>