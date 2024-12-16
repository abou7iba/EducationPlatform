<?php 
    include 'components/connect.php';
    if(!isset($_COOKIE['user_id'])){
        header('location: components/login.php');
    }else{
        $user_id = $_COOKIE['user_id'];
    }

    include 'header.php';
    include 'components/hero.php';
    include 'components/alert.php';
    include 'footer.php';

   

?>