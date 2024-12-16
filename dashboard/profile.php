<?php

   include '../components/connect.php';

   if(isset($_COOKIE['tutor_id'])){
      $tutor_id = $_COOKIE['tutor_id'];
   }else{
      $tutor_id = '';
      header('location:login.php');
   }
   include 'header.php';

   
?>
<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="../css/profile.css">


   <div class="details">
   <?php
            $select_profile = $conn->prepare("SELECT * FROM `tutor` WHERE id = ?");
            $select_profile->execute([$tutor_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
   ?>
   </div>
<div class="profile">
    <div class="profile-header">
    <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" width="120" height="120" alt="">
        <h1><?= $fetch_profile['name']; ?></h1>
        <h2><?= $fetch_profile['phone']; ?></h2>
    </div>    

<div class="profile-content">
<ul class="tabs">
    <li  class="active" data-cont=".four">بياناتي</li>
  <li data-cont=".one">كورساتي</li>
  <li data-cont=".two">امتحاناتي</li>
  <li data-cont=".three">الاشعارات</li>
</ul>
<div class="content">

    <div class="four">
            <h1 style="border-bottom: 2px solid #40a5785e; padding: 10px;">البيانات</h1>
        <h3>الاسم :  <?= $fetch_profile['name']; ?></h3>
        <h3>التخصص :  <?= $fetch_profile['profession']; ?></h3>
        <h3>الموبايل :  <?= $fetch_profile['phone']; ?></h3>
    </div>

    <div class="one">
            <h1 style="border-bottom: 2px solid #40a5785e; padding: 10px;">الإشتراكات</h1>
    </div>

  <div class="two"> 
            <h1 style="border-bottom: 2px solid #40a5785e; padding: 10px;">الامتحانات</h1>
    </div>

  <div class="three">
            <h1 style="border-bottom: 2px solid #40a5785e; padding: 10px;">الاشعارات</h1>
  </div>

</div>
</div>

</div>
<?php }  ?>

<script>
    let tabs = document.querySelectorAll(".tabs li");
let tabsArray = Array.from(tabs);
let divs = document.querySelectorAll(".content > div");
let divsArray = Array.from(divs);

// console.log(tabsArray);

tabsArray.forEach((ele) => {
  ele.addEventListener("click", function (e) {
    // console.log(ele);
    tabsArray.forEach((ele) => {
      ele.classList.remove("active");
    });
    e.currentTarget.classList.add("active");
    divsArray.forEach((div) => {
      div.style.display = "none";
    });
    // console.log(e.currentTarget.dataset.cont);
    document.querySelector(e.currentTarget.dataset.cont).style.display = "block";
  });
});
</script>