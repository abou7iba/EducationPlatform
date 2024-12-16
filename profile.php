<?php 
    include 'components/connect.php';
    if(!isset($_COOKIE['user_id'])){
        header('location: components/login.php');
    }else{
        $user_id = $_COOKIE['user_id'];
    }

    include 'header.php';

    $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
    $select_profile->execute([$user_id]);
    if($select_profile->rowCount() > 0){
      $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

?>
<link rel="stylesheet" href="css/profile.css">

<div class="profile">
    <div class="profile-header">
        <img src="img/Xlogo.png" width="100" height="100" alt="">
        <h1><?= $fetch_profile['name']; ?></h1>
        <h2><?= $fetch_profile['phone']; ?></h2>
    </div>    
    

<br>
<div class="profile-content">
<ul class="tabs">
    <li  class="active" data-cont=".four">بياناتي</li>
  <li data-cont=".one">الإشتراكات</li>
  <li data-cont=".two">الامتحانات</li>
  <li data-cont=".three">الاشعارات</li>
</ul>
<div class="content">

    <div class="four">
            <h1 style="border-bottom: 2px solid #40a5785e; padding: 10px;">البيانات</h1>
        <h3>الصف : <?= $fetch_profile['classroom']; ?></h3>
        <h3>القسم : <?= $fetch_profile['section']; ?></h3>
        <h3>العام : <?= $fetch_profile['academic_year']; ?></h3>
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
<?php } ?>

</div>

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