<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

if(isset($_GET['exam_id'])){
    $get_id = $_GET['exam_id']; 
 }else{
    $get_id = ""; 
    header('location:myexams.php');
}
   include 'header.php';
 
?>
    <style>
        body {
            color: #40A578 ;
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
<link rel="stylesheet" href="css/popup.css">

<?php
if(isset($_GET['delete_id'])){
   $delete_id = $_GET['delete_id'];

   $delete_exam = $conn->prepare("DELETE FROM `questions` WHERE id = ?");
   $delete_exam->execute([$delete_id]);

   header('location:  myexams.php');
}

?>
</head>
<body>
<?php
    $select_exam = $conn->prepare("SELECT * FROM `exam` WHERE id = ?");
    $select_exam->execute([$get_id ]);
    if($select_exam->rowCount() > 0){
        while($fetch_exam = $select_exam->fetch(PDO::FETCH_ASSOC)){
    ?>
    <br>
<center>
        <h1>اسئلة امتحان  :   <?= $fetch_exam['exam_title']; ?> </h1>
    </center>
<?php
    }}
?>
<div class="cards">
    <?php
    $select_question = $conn->prepare("SELECT * FROM `questions` WHERE exam_id = ?");
    $select_question->execute([ $get_id ]);
    if($select_question->rowCount() > 0){
        while($fetch_question = $select_question->fetch(PDO::FETCH_ASSOC)){
    ?>
    <div class="card" dir="rtl">
        <h3> السؤال :  <?= $fetch_question['question']; ?></h3>
        <p class="exam_description"> الاجابة الأولي : <br> <?= $fetch_question['ans1']; ?></p>
        <p class="exam_description"> الاجابة الثانية : <br> <?= $fetch_question['ans2']; ?></p>
        <p class="exam_description"> الاجابة الثالثة : <br> <?= $fetch_question['ans3']; ?></p>
        <p class="exam_description"> الاجابة الرابعه : <br> <?= $fetch_question['ans4']; ?></p>
        <p class="exam_description"> الاجابة الصحيحه : <br> ئ<?= $fetch_question['cor_ans']; ?></p>

        <div class="action" >
        <a href="questionexam.php?delete_id=<?= $fetch_question['id']; ?>"  class="deletebtn">حذف</a>
        <a href="edit_question.php?edit_id=<?= $fetch_question['id']; ?>" id="editCourseBtn" class="editbtn">تعديل</a>
        </div>        
    </div>

    <?php
        }}
    ?>
</div>