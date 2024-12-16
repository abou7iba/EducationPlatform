<?php

include '../components/connect.php';

if(isset($_POST['submit'])){

   $phone = $_POST['phone'];
   $phone = filter_var($phone, FILTER_SANITIZE_STRING);

   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_tutor = $conn->prepare("SELECT * FROM `tutor` WHERE phone = ? AND password = ? LIMIT 1");
   $select_tutor->execute([$phone, $pass]);

   $row = $select_tutor->fetch(PDO::FETCH_ASSOC);
   
   if($select_tutor->rowCount() > 0){
     setcookie('tutor_id', $row['id'], time() + 60*60*24*30, '/');
     header('location: index.php');
   }else{
      $message[] = 'الموبايل او كلمة المرور خطأ';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>دخول كمحاضر</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/login.css">

</head>
<body style="padding-left: 0;">

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message form">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<!-- register section starts  -->

<section class="login" dir="rtl" >

   <form action="" method="post" enctype="multipart/form-data" class="login">
     <center>
         <img src="../img/Xlogo.png" width="100" height="100" alt="">
         <h1>  مرحبا بعودتك </h1>
     </center> 
      <p> الموبايل <span>*</span></p>
      <input type="phone" name="phone" placeholder="ادخل رقم موبايلك هنا ...  " maxlength="20" required class="txtinp">
      <p> كلمة السر <span>*</span></p>
      <input type="password" name="pass" placeholder=" ادخل كلمة السر هنا ... " maxlength="20" required class="txtinp">
      <input type="submit" name="submit" value=" دخول " class="btnlog">
      <center>
         <p class="link"> ليس لديك حساب ؟ <a href="register.php"> انشاء حساب </a></p>
      </center>
   </form>

</section>

<!-- registe section ends -->














<script>

let darkMode = localStorage.getItem('dark-mode');
let body = document.body;

const enabelDarkMode = () =>{
   body.classList.add('dark');
   localStorage.setItem('dark-mode', 'enabled');
}

const disableDarkMode = () =>{
   body.classList.remove('dark');
   localStorage.setItem('dark-mode', 'disabled');
}

if(darkMode === 'enabled'){
   enabelDarkMode();
}else{
   disableDarkMode();
}

</script>
   
</body>
</html>