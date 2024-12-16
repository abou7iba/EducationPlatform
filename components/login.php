<?php
include 'connect.php';
    
if(isset($_COOKIE['user_id'])){
        $user_id = $_COOKIE['user_id'];
        header('location: ../index.php');
     }else{
        $user_id = '';
}

echo $user_id ;
if(isset($_POST['btnlog'])){
        $phone = $_POST['phone'];
        $phone = filter_var($phone, FILTER_SANITIZE_STRING);

        $password = sha1($_POST['password']);
        $password = filter_var($password, FILTER_SANITIZE_STRING);
     
        $select_user = $conn->prepare("SELECT * FROM `users` WHERE phone = ? AND password = ? LIMIT 1");
        $select_user->execute([$phone, $password]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);
        
    if($select_user->rowCount() > 0){
        setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
        header('location: ../index.php');
    }else{
        $message[] = 'الايميل او كلمة السر خطأ ';
    }
     
}
?>

<link rel="stylesheet" href="../css/login.css">
<title>تسجل الدخول</title>
<div class="login">
    <form action="" method="post" enctype="multipart/form-data">
        <img src="../img/Xlogo.png" width="120" height="120" alt="">
        <h1>تسجيل الدخول</h1>
        <input type="text" placeholder="رقم الموبايل" class="txtinp" required name="phone">
        <input type="password" placeholder="كلمة المرور" class="txtinp" required name="password">
        <input type="submit" value="تسجيل الدخول" class="btnlog" name="btnlog" >
        <span>ليس لديك حساب ؟ </span><a href="./register.php">انشاء حساب جديد</a>
    </form>
</div>