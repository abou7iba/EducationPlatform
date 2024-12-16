<?php 
    include 'components/connect.php';
    if(!isset($_COOKIE['user_id'])){
        header('location: components/login.php');
    }else{
        $user_id = $_COOKIE['user_id'];
    }

    include 'header.php';
    
    $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
    $select_user->execute([$user_id]);
    if($select_user->rowCount() > 0){
        $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);
        $user_id = $fetch_user['id'];
        $user_classroom = $fetch_user['classroom'];
        $user_section = $fetch_user['section'];
        $user_academic_year = $fetch_user['academic_year'];
    }
?>

<link rel="stylesheet" href="css/courses.css">


<div class="swiper">
  <div class="swiper-wrapper">
    <?php
        $select_course = $conn->prepare("SELECT * FROM `courses` WHERE classroom = ? AND section = ? AND academic_year = ?");
        $select_course->execute([$user_classroom , $user_section ,$user_academic_year]);
        if($select_course->rowCount() > 0){
          while($fetch_course = $select_course->fetch(PDO::FETCH_ASSOC)){

            // $fetch_course = $select_course->fetch(PDO::FETCH_ASSOC);
            $course_id    = $fetch_course['id'];
            $course_title = $fetch_course['title'];
            $course_thumb = $fetch_course['thumb'];
            $course_price = $fetch_course['price'];
        ?>
        <div class="swiper-slide" style="text-align: center ; ">
              <a href="course.php?course_id=<?= $course_id ?>"><img src="uploaded_files/<?= $course_thumb ?>" width="70%"  height="250" alt="">
              <div class="info">
                <h3 class="title"><?= $course_title;?></h3>
                <p class="price">السعر: $<?= $course_price;?></p>
              </div>
              </a>
        </div>
        <?php } }?>
      </div>
  <div class="swiper-pagination"></div>
</div>


<script>
    const swiper = new Swiper('.swiper', {
  // Optional parameters
  direction: 'horizontal',
  loop: true,
  autoplay: {
   delay: 2000,
    },

  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
  },

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  // And if we need scrollbar
  scrollbar: {
    el: '.swiper-scrollbar',
  },
});
</script>