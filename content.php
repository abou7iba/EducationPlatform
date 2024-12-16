<?php 
    include 'components/connect.php';
    if(!isset($_COOKIE['user_id'])){
        header('location: components/login.php');
    }else{
        $user_id = $_COOKIE['user_id'];
        $course_id = $_GET['course_id'];
        if(isset($_GET['content_id'])){
            $content_id = $_GET['content_id'];
        }else
            $content_id = '';
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

<link rel="stylesheet" href="css/content.css">


    <?php
        $select_course = $conn->prepare("SELECT * FROM `courses` WHERE id = ?");
        $select_course->execute([$course_id]);
        if($select_course->rowCount() > 0){
            $fetch_course = $select_course->fetch(PDO::FETCH_ASSOC);
            $course_id    = $fetch_course['id'];
            $course_title = $fetch_course['title'];
     }?>
<div class="content">
    <div class="side-content">
        <h3><?= $course_title ?></h3>
        <?php
        $select_content = $conn->prepare("SELECT * FROM `content` WHERE course_id = ?");
        $select_content->execute([$course_id]);
        if($select_content->rowCount() > 0){
            while($fetch_content = $select_content->fetch(PDO::FETCH_ASSOC)){
            $id    = $fetch_content['id'];
            $content_title = $fetch_content['title'];
            ?>
            <a href="content.php?course_id=<?= $course_id ?>&content_id=<?= $id ?>"> <?= $content_title ?> </a>
            <?php }} ?> 
        </div> 

        <div class="area-content">
        <?php
        if($content_id == ''){
            echo "<h1>أختر من القائمة للتشغيل</h1>";
        }else{
        $select_video = $conn->prepare("SELECT * FROM `content` WHERE id = ?");
        $select_video->execute([$content_id]);
        if($select_video->rowCount() > 0){
            $fetch_video = $select_video->fetch(PDO::FETCH_ASSOC);
            $video_title = $fetch_video['title'];
            $content_video = $fetch_video['video'];
            echo "<video class='video' controls>";
            echo "<source src='uploaded_files/".$content_video ."' type='video/mp4'>";
            echo "متصفحك لا يدعم عنصر الفيديو.";
            echo "</video>"; 
    ?>
    <div class="content-info">
        <h2><?= $video_title ?></h2>
    </div>
    <?php }} ?> 
</div>
</div>