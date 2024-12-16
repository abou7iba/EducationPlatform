<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <title>منصة المطور إكس</title>
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>
    <header>
            <div class="right">
                <a href="./index.phpx"><img src="img/Xlogo.png" width="50" height="50" alt=""></a>
            </div>
            <div class="center" dir="rtl" >
                <a href="./index.php"><i class="fa-solid fa-house"></i> <span>الرئيسية</span>  </a>
                <a href="./courses.php"> <i class="fa-solid fa-chalkboard-user"></i><span>تعلم</span></a>
                <a href="#"><i class="fa-solid fa-magnifying-glass"></i><span>بحث</span> </a>
            </div>
            <div class="left" dir="rtl" >
            <a href="profile.php"><i class="fa-solid fa-circle-user"></i></a>
            <?php 
               if(isset($_COOKIE['user_id'])){ 
                  echo ' 
                  <a href="components/user_logout.php"><i class="fa-solid fa-power-off"></i></a>
                  ';
               }else
                  echo '
                  <a href="components/login.php"><i class="fa-solid fa-right-to-bracket"></i></a>
                  '
               ?>
            </div>
        </header>