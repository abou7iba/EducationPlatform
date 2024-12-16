<?php 
    include 'components/connect.php';
    if(!isset($_COOKIE['user_id'])){
        header('location: components/login.php');
    }else{
        $user_id = $_COOKIE['user_id'];
        $course_id = $_GET['course_id'];

    }

    include 'header.php';
    
    $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
    $select_user->execute([$user_id]);
    if($select_user->rowCount() > 0){
        $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);
        $user_id = $fetch_user['id'];
        $name = $fetch_user['name'];
        $phone = $fetch_user['phone'];
        $user_classroom = $fetch_user['classroom'];
        $user_section = $fetch_user['section'];
        $user_academic_year = $fetch_user['academic_year'];
    }

    if(isset($_POST['subscribe_btn'])){

        $course_name = $_POST['course_name'];
        $course_name = filter_var($course_name, FILTER_SANITIZE_STRING);
     
        $student_name = $_POST['student_name'];
        $student_name = filter_var($student_name, FILTER_SANITIZE_STRING);
     
        $copun = $_POST['copun'];
        $copun = filter_var($copun, FILTER_SANITIZE_STRING);
     
        $phone = $_POST['phone'];
        $phone = filter_var($phone, FILTER_SANITIZE_STRING);
     
        $add_playlist = $conn->prepare("INSERT INTO `subscriptions`( course_id, user_id, student_name , copun, phone ,status) VALUES (?,?,?,?,?,?)");
        $add_playlist->execute([$course_id, $user_id, $student_name, $copun , $phone , 0]);

        header('location: index.php');
     
     }
?>

<link rel="stylesheet" href="css/courses.css">
<link rel="stylesheet" href="dashboard/css/index.css">
<link rel="stylesheet" href="dashboard/css/register.css">
<link rel="stylesheet" href="dashboard/css/popup.css">

<div class="swiper">
  <div class="swiper-wrapper">
    <?php
        $select_course = $conn->prepare("SELECT * FROM `courses` WHERE id = ?");
        $select_course->execute([$course_id]);
        if($select_course->rowCount() > 0){
            $fetch_course = $select_course->fetch(PDO::FETCH_ASSOC);
            $course_id    = $fetch_course['id'];
            $course_title = $fetch_course['title'];
            $course_thumb = $fetch_course['thumb'];
            $course_price = $fetch_course['price'];
            $course_month_content = $fetch_course['month_content'];
        ?>
        <div class="swiper-slide" style="text-align: center ; ">
              <a href="content.php?course_id=<?= $course_id ?>"><img src="uploaded_files/<?= $course_thumb ?>" width="70%"  height="250" alt="">
                <div class="info">
                  <h3 class="title"><?= $course_title;?></h3>
                  <p class="price">السعر: $<?= $course_price;?></p>
                </div>
              </a>
        </div>
        <?php }?>
      </div>
  <div class="swiper-pagination"></div>
</div>



<table dir="rtl">
         <tr>
            <th>الكورس</th>
            <th>منهج شهر </th>
            <th>السعر</th>
            <th>الخيارات</th>
         </tr>
         <tbody>
            <tr>
               <td><?= $course_title;?></td>
               <td><?= $course_month_content;?></td>
               <td><?= $course_price;?>  ج.م  </td>
               <td style="text-align: center ;" ><a  id="showCourseModalBtn">اشترك</a></td>
            </tr>
         </tbody>
</table>


<!-- showCourseModal -->
<div id="showCourseModal" class="modal">
      <div class="modal-content">
        <span id="closeCourseModalBtn" class="close">&times;</span>
        <h2> الاشتراك </h2>
        <form action="" method="POST" enctype="multipart/form-data"  dir="rtl">
            <div class="col">
                <p>  اسم الكورس  <span>*</span></p>
                <input type="text" value="<?= $course_title;?>" class="box" placeholder="" disabled name="course_name">
                <input type="hidden" value="<?= $name; ?>" class="box" placeholder="" name="student_name">
                <p>  كوبون خصم  <span>*</span></p>
                <input type="text"  class="box" placeholder="ادخل الكوبون هناا ..."  name="copun">
                <p>  رقم للتواصل  <span>*</span></p>
                <input type="text"  value="<?= $phone ; ?>" class="box" placeholder="ادخل التواصل هناا ..."  name="phone">
            </div>
            <input type="submit" value="الاشتراك" name="subscribe_btn" class="btn">
        </form>
      </div>   
</div>
<br><br>
<?php include 'components/alert.php';?>

<script>
    const showCourseModal = document.getElementById("showCourseModal");
    const showCourseModalBtn = document.getElementById("showCourseModalBtn");
    const closeCourseModalBtn = document.getElementById("closeCourseModalBtn");

    showCourseModalBtn.onclick = function() {
        showCourseModal.style.display = "block";
    }

    closeCourseModalBtn.onclick = function() {
        showCourseModal.style.display = "none";
    }   

    window.onclick = function(event) {
        if (event.target === showCourseModal) {
            showCourseModal.style.display = "none";
        }
    }
</script>
