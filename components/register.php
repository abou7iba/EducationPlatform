<?php

include 'connect.php';

if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
    header('location: ../index.php');
 }else{
    $user_id = '';
}

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   $phone = $_POST['phone'];
   $phone = filter_var($phone, FILTER_SANITIZE_STRING);

   $password = sha1($_POST['password']);
   $password = filter_var($password, FILTER_SANITIZE_STRING);

   $classroom = $_POST['classroom'];
   $classroom = filter_var($classroom, FILTER_SANITIZE_STRING);

   $academic_year = $_POST['academic_year'];
   $academic_year = filter_var($academic_year, FILTER_SANITIZE_STRING);

   $section = $_POST['section'];
   $section = filter_var($section, FILTER_SANITIZE_STRING);





   $select_user = $conn->prepare("SELECT * FROM `users` WHERE phone = ?");
   $select_user->execute([$phone]);
   
   if($select_user->rowCount() > 0){
      $message[] = ' الرقم مسجل بالفعل !';
   }else{
         $insert_user = $conn->prepare("INSERT INTO `users`( name, phone, password, classroom, section, academic_year) VALUES(?,?,?,?,?,?)");
         $insert_user->execute([ $name, $phone,$password, $classroom, $section, $academic_year ]);
         
         $verify_user = $conn->prepare("SELECT * FROM `users` WHERE phone = ? AND password = ? LIMIT 1");
         $verify_user->execute([$phone, $password]);
         $row = $verify_user->fetch(PDO::FETCH_ASSOC);
         
         if($verify_user->rowCount() > 0){
            setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
            header('location: ../index.php');
         }
    }
}

?>
<link rel="stylesheet" href="../css/register.css">
<title>تسجل حساب جديد </title>
<form class="register" action="" method="post" enctype="multipart/form-data">
    <img src="../img/Xlogo.png" width="120" height="120" alt="">
    <h2> انشاء حساب جديد </h2>
    <div class="flex">
        <div class="col">
            <p> الاسم <span>*</span></p>
            <input type="text" name="name" placeholder=" .. ادخل اسمك هنا  " maxlength="50" required class="box">
            <p> رقم الموبايل <span>*</span></p>
            <input type="text" name="phone" placeholder=" .. ادخل رقمك هنا  " maxlength="20" required class="box">
            <p> كلمة السر <span>*</span></p>
            <input type="password" name="password" placeholder=" .. ادخل كلمة السر هنا " maxlength="20" required class="box">
       
 </div> 

        <div class="col">
        <p> الصف الدراسي <span>*</span></p>
            <select class="select-register" name="classroom" id="">
                <option selected disabled> أختر الصف الدراسي </option>
                <option value="الأول_الثانوي">الأول الثانوي</option>
                <option value="الثاني_الثانوي">الثاني الثانوي</option>
                <option value="الثالث_الثانوي">الثالث الثانوي</option>
            </select>

            <p> العام الدراسي <span>*</span></p>
            <select class="select-register" name="academic_year" id="">
                <option selected disabled> أختر العام الدراسي </option>
                <option value="2024_2025">2024 - 2025</option>
            </select>

            <p>  القسم الدراسي <span>*</span></p>
            <select class="select-register" name="section" id="">
                <option selected disabled> أختر القسم الدراسي </option>
                <option value="علمي_رياضة">علمي رياضة</option>
                <option value="علمي_علوم">علمي علوم</option>
                <option value="الأدبي">الأدبي</option>
            </select>
        </div>

    </div>
    <input type="submit" name="submit" value="تسجيل حساب جديد " class="btn">
    <p class="link"> عندك حساب بالفعل  ؟ <a href="login.php" class="login-btn">  تسجيل الدخول </a></p>
</form>