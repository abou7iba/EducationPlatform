<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

if(isset($_GET['edit_id'])){
    $get_id = $_GET['edit_id']; 
 }else{
    $get_id = ""; 

}
   include 'header.php';

if(isset($_POST['update_course'])){

    $title = $_POST['title'];
    $title = filter_var($title, FILTER_SANITIZE_STRING);

    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);
 
    $add_courses = $conn->prepare("UPDATE `courses` SET title = ?, price = ? WHERE id = ?");
    $add_courses->execute([ $title, $price , $get_id]);
}   
?>
    <style>
        body
        {
            color: #40A578;
        }
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
<!-- <link rel="stylesheet" href="css/popup.css"> -->

<?php
if(isset($_POST['delete'])){
   $delete_id = $_GET['delete_id'];

   $delete_playlist = $conn->prepare("DELETE FROM `courses` WHERE id = ?");
   $delete_playlist->execute([$delete_id]);
}

?>
</head>
<body>
<div id="editCourseModal" class="modal">
<center>

<div class="modal-content">
        <?php
    $select_courses = $conn->prepare("SELECT * FROM `courses` WHERE tutor_id = ? AND id = ? ");
    $select_courses->execute([$tutor_id , $get_id]);
    if($select_courses->rowCount() > 0){
        while($fetch_course = $select_courses->fetch(PDO::FETCH_ASSOC)){
            ?>
            <br><br>
            <h2> تحديث بيانات الكورس </h2>
      
<form action="" method="post" enctype="multipart/form-data" dir="rtl">
<div class="col">
      <p> عنوان الكورس  <span>*</span></p>
      <input type="text" name="title" maxlength="100" value="<?= $fetch_course['title']; ?>"  placeholder="مثال : محتوي شهر سبتمبر في اللغه العربيه ..." class="box">
      <p>  سعر الكورس  <span>*</span></p>
      <input type="text" name="price" maxlength="100" value="<?= $fetch_course['price']; ?>"   placeholder=" سعر الكورس " class="box">
   </div>

      <input type="submit" value="تحديث" name="update_course" class="btn">
</form>
      </div>
    </div>
    
    <?php
}}
?>
</center>