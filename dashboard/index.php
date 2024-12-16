<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}
   include 'header.php';

if(isset($_POST['cr_course'])){

      $title = $_POST['title'];
      $title = filter_var($title, FILTER_SANITIZE_STRING);
   
      $section = $_POST['section'];
      $section = filter_var($section, FILTER_SANITIZE_STRING);
   
      $classroom = $_POST['classroom'];
      $classroom = filter_var($classroom, FILTER_SANITIZE_STRING);
   
      $month_content = $_POST['month_content'];
      $month_content = filter_var($month_content, FILTER_SANITIZE_STRING);
   
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_STRING);

      $academic_year = $_POST['academic_year'];
      $academic_year = filter_var($academic_year, FILTER_SANITIZE_STRING);

      $image = $_FILES['image']['name'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);
      $ext = pathinfo($image, PATHINFO_EXTENSION);
      $rename = unique_id().'.'.$ext;
      $image_size = $_FILES['image']['size'];
      $image_tmp_name = $_FILES['image']['tmp_name'];
      $image_folder = '../uploaded_files/'.$rename;
   
      $add_courses = $conn->prepare("INSERT INTO `courses`( tutor_id, title, thumb, section, academic_year ,  classroom, month_content , price) VALUES(?,?,?,?,?,?,?,?)");
      $add_courses->execute([$tutor_id, $title, $rename, $section, $academic_year , $classroom , $month_content, $price]);
   
      move_uploaded_file($image_tmp_name, $image_folder);
      header('location: index.php');

      
}


if(isset($_POST['up_content'])){

   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);

   $course = $_POST['course'];
   $course = filter_var($course, FILTER_SANITIZE_STRING);

   $thumb = $_FILES['thumb']['name'];
   $thumb = filter_var($thumb, FILTER_SANITIZE_STRING);
   $thumb_ext = pathinfo($thumb, PATHINFO_EXTENSION);
   $rename_thumb = unique_id().'.'.$thumb_ext;
   $thumb_size = $_FILES['thumb']['size'];
   $thumb_tmp_name = $_FILES['thumb']['tmp_name'];
   $thumb_folder = '../uploaded_files/'.$rename_thumb;

   $video = $_FILES['video']['name'];
   $video = filter_var($video, FILTER_SANITIZE_STRING);
   $video_ext = pathinfo($video, PATHINFO_EXTENSION);
   $rename_video = unique_id().'.'.$video_ext;
   $video_tmp_name = $_FILES['video']['tmp_name'];
   $video_folder = '../uploaded_files/'.$rename_video;

   if($thumb_size > 2000000){
      $message[] = 'image size is too large!';
   }else{
      $add_playlist = $conn->prepare("INSERT INTO `content`( tutor_id, course_id, title, video, thumb ) VALUES(?,?,?,?,?)");
      $add_playlist->execute([ $tutor_id, $course, $title, $rename_video, $rename_thumb ]);

      move_uploaded_file($thumb_tmp_name, $thumb_folder);
      move_uploaded_file($video_tmp_name, $video_folder);
      $message[] = 'تم الرفع بنجاح';
      header('location: index.php');
   }
   
}

if(isset($_POST['up_exam'])){

   $exam_title = $_POST['exam_title'];
   $exam_title = filter_var($exam_title, FILTER_SANITIZE_STRING);

   $course = $_POST['course'];
   $course = filter_var($course, FILTER_SANITIZE_STRING);

   $exam_description = $_POST['exam_description'];
   $exam_description = filter_var($exam_description, FILTER_SANITIZE_STRING);

   $add_playlist = $conn->prepare("INSERT INTO `exam`( tutor_id, course_id, exam_title , exam_description ) VALUES(?,?,?,?)");
   $add_playlist->execute([ $tutor_id, $course, $exam_title , $exam_description ]);
   header('location: index.php');

}

if(isset($_POST['up_question'])){

   $exam_id = $_POST['exam_id'];
   $exam_id = filter_var($exam_id, FILTER_SANITIZE_STRING);

   $question = $_POST['question'];
   $question = filter_var($question, FILTER_SANITIZE_STRING);

   $ans1 = $_POST['ans1'];
   $ans1 = filter_var($ans1, FILTER_SANITIZE_STRING);

   $ans2 = $_POST['ans2'];
   $ans2 = filter_var($ans2, FILTER_SANITIZE_STRING);

   $ans3 = $_POST['ans3'];
   $ans3 = filter_var($ans3, FILTER_SANITIZE_STRING);

   $ans4 = $_POST['ans4'];
   $ans4 = filter_var($ans4, FILTER_SANITIZE_STRING);

   $cor_ans = $_POST['cor_ans'];
   $cor_ans = filter_var($cor_ans, FILTER_SANITIZE_STRING);

   $add_playlist = $conn->prepare("INSERT INTO `questions`( tutor_id, exam_id, question , ans1,ans2,ans3,ans4,cor_ans ) VALUES(?,?,?,?,?,?,?,?)");
   $add_playlist->execute([ $tutor_id, $exam_id, $question , $ans1, $ans2 , $ans3, $ans4, $cor_ans]); 
   header('location: index.php');

}
if(isset($_POST['up_notification'])){

   $notification = $_POST['notification'];
   $notification = filter_var($notification, FILTER_SANITIZE_STRING);

   $course_id = $_POST['course_id'];
   $course_id = filter_var($course_id, FILTER_SANITIZE_STRING);

   $classroom = $_POST['classroom'];
   $classroom = filter_var($classroom, FILTER_SANITIZE_STRING);

   $section = $_POST['section'];
   $section = filter_var($section, FILTER_SANITIZE_STRING);

   $add_playlist = $conn->prepare("INSERT INTO `notifications`( tutor_id, course_id, notification , classroom,section ) VALUES (?,?,?,?,?)");
   $add_playlist->execute([$tutor_id, $course_id, $notification, $classroom , $section ]);
   header('location: index.php');

}

?>
<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="css/index.css">
<link rel="stylesheet" href="css/register.css">
<link rel="stylesheet" href="css/popup.css">

   
<section class="dashboard" >

   <h1 class="heading">لوحة التحكم</h1>
   
   <div class="box-container">
      <table dir="rtl">
         <tr>
            <th colspan="3">الخيارات</th>
         </tr>
         <tbody>
            <tr>
               <td>الكورسات</td>
               <td><a id="addCourseModalBtn">اضافة</a></td>
               <td><a href="mycourses.php">عرض</a></td>
            </tr>
            <tr>
               <td>المحاضرات</td>
               <td><a id="addContentModalBtn">اضافة</a></td>
               <td><a href="myvideos.php">عرض</a></td>
            </tr>
            <tr>
               <td>الإمتحانات</td>
               <td><a id="addExamModalBtn">اضافة</a></td>
               <td><a href="myexams.php">عرض</a></td>
            </tr>
            <tr>
               <td>الأسئلة</td>
               <td><a id="addQuestionModalBtn">اضافة</a></td>
               <td><a href="questionexam.php">عرض</a></td>
            </tr>
            <tr>
               <td>الإشعارات</td>
               <td><a id="addNotificationModalBtn">اضافة</a></td>
               <td><a href="notifications.php">عرض</a></td>
            </tr>
            
            <tr>
               <td>الإشتراكات</td>
               <td colspan="2" ><a href="subscriptions.php" id="addNotificationModalBtn">عرض</a></td>
            </tr>
         </tbody>
      </table>
   </div>

</section>

<!-- addCourseModal -->
<div id="addCourseModal" class="modal">
        <div class="modal-content">
            <span id="closeModalBtn" class="close">&times;</span>
            <h2>اضافة كورس جديد</h2>
      
<form action="" method="post" enctype="multipart/form-data" dir="rtl">

   <div class="col">
      <p> عنوان الكورس  <span>*</span></p>
      <input type="text" name="title" maxlength="100" required placeholder="مثال : محتوي شهر سبتمبر في اللغه العربيه ..." class="box">
      <p>  سعر الكورس  <span>*</span></p>
      <input type="text" name="price" maxlength="100" required placeholder=" سعر الكورس " class="box">
      <p> صوره للقائمه <span>*</span></p>
      <input type="file" name="image" accept="image/*" required class="box">
   </div>

   <div class="col">
      <select class="select-register" name="classroom" id="" required>
                <option selected disabled>-- اختيار  الصف الدراسي -- </option>
                <option value="الأول_الثانوي">الأول الثانوي</option>
                <option value="الثاني_الثانوي">الثاني الثانوي</option>
                <option value="الثالث_الثانوي">الثالث الثانوي</option>
      </select>

      <select class="select-register" name="academic_year" id="">
                <option selected disabled> أختر العام الدراسي </option>
                <option value="2024_2025">2024 - 2025</option>
      </select>

      <select class="select-register" name="section" id="" required>
                <option selected disabled> أختر القسم الدراسي </option>
                <option value="علمي_رياضة">علمي رياضة</option>
                <option value="علمي_علوم">علمي علوم</option>
                <option value="الأدبي">الأدبي</option>
      </select>
   
      <select name="month_content" class="select-register" required>
         <option selected disabled>-- منهج شهر -- </option>
         <option value="سبتمبر">سبتمبر</option>
         <option value="اكتوبر">اكتوبر</option>
         <option value="نوفمبر">نوفمبر</option>
         <option value="مراجعة ترم اول">مراجعة علي الترم الاول</option>
         <option value="فبراير">فبراير</option>
         <option value="مارس">مارس</option>
         <option value="ابريل">ابريل</option>
         <option value="مراجعة ترم ثاني">مراجعة علي الترم الثاني</option>
      </select>
   </div>
      <input type="submit" value="نشر الكورس" name="cr_course" class="btn">
</form>
      </div>
</div>
<!-- // addCourseModal -->

<!-- ====================== -->
<!-- addContentModal -->
<div id="addContentModal" class="modal">
      <div class="modal-content">
            <span id="closeContentModalBtn" class="close">&times;</span>
            <h2>اضافة محتوي جديد</h2>

<form action="" method="POST" enctype="multipart/form-data"  dir="rtl">
      <select name="course" class="select-register" required>
         <option disabled selected>-- أختر الكورس --</option>
         <?php
         $select_courses = $conn->prepare("SELECT * FROM `courses` WHERE tutor_id = ?");
         $select_courses->execute([$tutor_id]);
         if($select_courses->rowCount() > 0){
            while($fetch_course = $select_courses->fetch(PDO::FETCH_ASSOC)){
         ?>
         <option value="<?= $fetch_course['id']; ?>"><?= $fetch_course['title']; ?></option>
         <?php
            }
         ?>
         <?php
         }else{
            echo '<option value="" disabled> لا توجد قوائم تشغيل بعد </option>';
         }
         ?>
      </select>
      <div class="col">
         <p> عنوان الفيديو <span>*</span></p>
         <input type="text" name="title" maxlength="100" required placeholder="عنوان الفيديو" class="box">

         <p>صوره مصغره <span>*</span></p>
         <input type="file" name="thumb" accept="image/*" required class="box">
         <p> تحديد الفيديو <span>*</span></p>
         <input type="file" name="video" accept="video/*" required class="box">
      </div>


      <input type="submit" value="نشر الفيديو" name="up_content" class="btn">
   </form>
   </div>   
</div>
<!-- // addContentModal -->

<!-- ====================== -->
<!-- addExamModal -->
<div id="addExamModal" class="modal">
      <div class="modal-content">
            <span id="closeExamModalBtn" class="close">&times;</span>
            <h2>اضافة امتحان جديد</h2>
            <form action="" method="POST" enctype="multipart/form-data"  dir="rtl">
      <select name="course" class="select-register" required>
         <option disabled selected>-- أختر الكورس --</option>
         <?php
         $select_courses = $conn->prepare("SELECT * FROM `courses` WHERE tutor_id = ?");
         $select_courses->execute([$tutor_id]);
         if($select_courses->rowCount() > 0){
            while($fetch_course = $select_courses->fetch(PDO::FETCH_ASSOC)){
         ?>
         <option value="<?= $fetch_course['id']; ?>"><?= $fetch_course['title']; ?></option>
         <?php
            }
         ?>
         <?php
         }else{
            echo '<option value="" disabled> لا توجد قوائم تشغيل بعد </option>';
         }
         ?>
      </select>
      <div class="col">
         <p> عنوان الإمتحان <span>*</span></p>
         <input type="text" name="exam_title" maxlength="100" required placeholder="عنوان الإمتحان" class="box">
         <p> وصف الإمتحان <span>*</span></p>
         <input type="text" name="exam_description" maxlength="100" required placeholder="وصف قصير للامتحان" class="box">
      </div>
      <input type="submit" value="رفع الإمتحان" name="up_exam" class="btn">
   </form>
      </div>   
</div>

<!-- // addExamModal -->
<!-- ====================== -->
<!-- addQuestionModal -->
<div id="addQuestionModal" class="modal">
      <div class="modal-content">
            <span id="closeQuestionModalBtn" class="close">&times;</span>
            <h2>اضافة سؤال جديد</h2>
            <form action="" method="POST" enctype="multipart/form-data"  dir="rtl">
      <select name="exam_id" class="select-register" required>
         <option disabled selected>-- أختر الإمتحان --</option>
         <?php
         $select_courses = $conn->prepare("SELECT * FROM `exam` WHERE tutor_id = ?");
         $select_courses->execute([$tutor_id]);
         if($select_courses->rowCount() > 0){
            while($fetch_course = $select_courses->fetch(PDO::FETCH_ASSOC)){
         ?>
         <option value="<?= $fetch_course['id']; ?>"><?= $fetch_course['exam_title']; ?></option>
         <?php
            }
         ?>
         <?php
         }else{
            echo '<option value="" disabled> لا توجد قوائم تشغيل بعد </option>';
         }
         ?>
      </select>
      <div class="col">
         <p>  السؤال <span>*</span></p>
         <input type="text" name="question" maxlength="100" required placeholder="السؤال" class="box">
         <p> الاجابة الأولي <span>*</span></p>
         <input type="text" name="ans1" maxlength="100" required  placeholder="ادخل الاجابة الاولي هناا ..."  class="box">
         <p> الاجابة الثانية <span>*</span></p>
         <input type="text" name="ans2" maxlength="100" required placeholder="ادخل الاجابة الثانية هناا ..."  class="box">
         <p> الاجابة الثالثة <span>*</span></p>
         <input type="text" name="ans3" maxlength="100"  placeholder="ادخل الاجابة الثالثة هناا ..." class="box">
         <p> الاجابة الرابعة <span>*</span></p>
         <input type="text" name="ans4" maxlength="100"  placeholder="ادخل الاجابة الرابعة هناا ..." class="box">
         <p> الاجابة الصحيحة <span>*</span></p>
         <input type="text" name="cor_ans" maxlength="100"  placeholder="ادخل الاجابة الصحيحة هناا ..." class="box">
      </div>
      <input type="submit" value="رفع السؤال" name="up_question" class="btn">

   </form>
      </div>   
</div>
<!-- // addQuestionModal -->
<!-- ====================== -->
<!-- addNotificationModal -->
<div id="addNotificationModal" class="modal">
      <div class="modal-content">
      <span id="closeNotificationModalBtn" class="close">&times;</span>
      <h2>اضافة شعار  جديد</h2>
         <form action="" method="POST" enctype="multipart/form-data"  dir="rtl">
         <select name="course_id" class="select-register" required>
         <option disabled selected>-- أختر الكورس --</option>
         <?php
            $select_courses = $conn->prepare("SELECT * FROM `courses` WHERE tutor_id = ?");
            $select_courses->execute([$tutor_id]);
            if($select_courses->rowCount() > 0){
               while($fetch_course = $select_courses->fetch(PDO::FETCH_ASSOC)){
            ?>
            <option value="<?= $fetch_course['id']; ?>"><?= $fetch_course['title']; ?></option>
            <?php
               }
            ?>
            <?php
            }else{
               echo '<option value="" disabled> لا توجد  كورسات بعد .. </option>';
            }
            ?>
         </select>

            <select class="select-register" name="section" id="">
                <option selected disabled>-- أختر القسم الدراسي --</option>
                <option value="علمي_رياضة">علمي رياضة</option>
                <option value="علمي_علوم">علمي علوم</option>
                <option value="الأدبي">الأدبي</option>
            </select>

            <select class="select-register" name="classroom" id="">
                <option selected disabled>-- أختر الصف الدراسي --</option>
                <option value="الأول_الثانوي">الأول الثانوي</option>
                <option value="الثاني_الثانوي">الثاني الثانوي</option>
                <option value="الثالث_الثانوي">الثالث الثانوي</option>
            </select>

            <div class="col">
               <p> الإشعار <span>*</span></p>
               <input type="text" name="notification" maxlength="100"  placeholder="ادخل الإشعار هناا ..." class="box">
            </div>
      <input type="submit" value="رفع الإشعار" name="up_notification" class="btn">
         </form>
      </div>   
</div>
<!-- // addNotificationModal -->
<!-- ====================== -->
 
<script src="js/popup.js"></script>