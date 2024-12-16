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

if(isset($_POST['update_exam'])){

    $exam_title = $_POST['exam_title'];
    $exam_title = filter_var($exam_title, FILTER_SANITIZE_STRING);

    $exam_description = $_POST['exam_description'];
    $exam_description = filter_var($exam_description, FILTER_SANITIZE_STRING);

    $update_exam = $conn->prepare("UPDATE `exam` SET exam_title = ?, exam_description = ? WHERE id = ?");
    $update_exam->execute([ $exam_title,  $exam_description , $get_id]);
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

</head>
<body>
<div id="editCourseModal" class="modal">
<center>

<div class="modal-content">
        <?php
    $select_exam = $conn->prepare("SELECT * FROM `exam` WHERE tutor_id = ? AND id = ? ");
    $select_exam->execute([$tutor_id , $get_id]);
    if($select_exam->rowCount() > 0){
        while($fetch_exam = $select_exam->fetch(PDO::FETCH_ASSOC)){
            ?>
            <br><br>
            <h2> تحديث بيانات الامتحان </h2>
      
<form action="" method="post" enctype="multipart/form-data" dir="rtl">

   <div class="col">
      <p> عنوان الامتحان  <span>*</span></p>
      <input type="text" name="exam_title" maxlength="100" value="<?= $fetch_exam['exam_title']; ?>"  placeholder="مثال : محتوي شهر سبتمبر في اللغه العربيه ..." class="box">
      <p> وصف الامتحان  <span>*</span></p>
      <input type="text" name="exam_description" maxlength="100" value="<?= $fetch_exam['exam_description']; ?>"  placeholder="مثال : محتوي شهر سبتمبر في اللغه العربيه ..." class="box">
   
    </div>

      <input type="submit" value="تحديث" name="update_exam" class="btn">
</form>
      </div>
    </div>
    
    <?php
}}
?>
</center>