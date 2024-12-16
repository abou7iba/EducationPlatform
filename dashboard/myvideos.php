<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

if(isset($_GET['course_id'])){
    $get_id = $_GET['course_id']; 
 }else{
    $get_id = ""; 
}

if(isset($_GET['video_id'])){
    $get_video_id = $_GET['video_id']; 
 }else{
    $get_video_id = ""; 

}
   include 'header.php';

if(isset($_POST['update_video'])){

    $title = $_POST['title'];
    $title = filter_var($title, FILTER_SANITIZE_STRING);
 

 
    $add_courses = $conn->prepare("UPDATE `content` SET title = ? WHERE id = ?");
    $add_courses->execute([ $title, $get_video_id]);
   header('location:  mycourses.php');

    
}   
?>
    <style>
        .cards{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: center;
            margin: 20px;
        }
        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            width: 300px;
            padding-bottom: 16px;
            text-align: center;
            margin: 20px;
            box-shadow:0px 0px 9px #40a5788a;
        }
        .card img {
            width: 100%;
            border-radius: 8px 8px 0 0;
        }
        .card h3 {
            margin: 16px 0;
        }
        .card p {
            color: #555;
        }
        .card .price {
            font-weight: bold;
            color: #007bff;
        }
        .deletebtn
        {
            background-color: #f44336;
            color: white;
            padding: 5px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .editbtn
        {
            background-color: #4CAF50;
            color: white;
            padding: 5px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }
        .Videobtn
        {
            background-color: #2994B2;
            color: white;
            padding: 5px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }
        .action
        {
            display: flex;
            justify-content: space-around;
        }
        
    </style>

<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="css/index.css">
<link rel="stylesheet" href="css/register.css">
<link rel="stylesheet" href="css/popup.css">

<?php
if(isset($_GET['delete_id'])){
   $delete_id = $_GET['delete_id'];

   $delete_playlist = $conn->prepare("DELETE FROM `content` WHERE id = ?");
   $delete_playlist->execute([$delete_id]);
   header('location:  mycourses.php');

}

?>
</head>
<body>
<div class="cards">
    <?php
    $select_courses = $conn->prepare("SELECT * FROM `content` WHERE tutor_id = ? AND course_id = ? ");
    $select_courses->execute([$tutor_id , $get_id]);
    if($select_courses->rowCount() > 0){
        while($fetch_course = $select_courses->fetch(PDO::FETCH_ASSOC)){
    ?>
    <div class="card">
        <video width="300" height="200" controls >
            <source src="../uploaded_files/<?= $fetch_course['video']; ?>" type="video/mp4">
        </video>
        <h3><?= $fetch_course['title']; ?></h3>
        <div  class="action" >
        <a href="myvideos.php?delete_id=<?= $fetch_course['id']; ?>"  onclick="return confirm('هل انت متأكد من حذف الفيديو ؟');" id="editCourseBtn" class="deletebtn">حذف</a>
        <a href="edit_video.php?video_id=<?= $fetch_course['id']; ?>" id="editCourseBtn" class="editbtn">تعديل</a>
        </div>        
    </div>
    <?php
        }}
    ?>
</div>

<script>
    // addEditCourseModal
    const editCourseModal = document.getElementById("editCourseModal");
    const editCourseBtn = document.getElementById("editCourseBtn");
    const closeModalBtn = document.getElementById("closeModalBtn");

    editCourseBtn.onclick = function() {
        editCourseModal.style.display = "block";
    }

    closeModalBtn.onclick = function() {
        editCourseModal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target === editCourseModal) {
            editCourseModal.style.display = "none";
        }
    }

</script>