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

if(isset($_POST['update_question'])){

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

    $update_exam = $conn->prepare("UPDATE `questions` SET question = ?, ans1 = ? , ans2 = ? , ans3 = ? , ans4 = ? , cor_ans = ? WHERE id = ?");
    $update_exam->execute([ $question ,  $ans1,  $ans2,  $ans3,  $ans4,  $cor_ans , $get_id]);
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
    $select_exam = $conn->prepare("SELECT * FROM `questions` WHERE tutor_id = ? AND id = ? ");
    $select_exam->execute([$tutor_id , $get_id]);
    if($select_exam->rowCount() > 0){
        while($fetch_exam = $select_exam->fetch(PDO::FETCH_ASSOC)){
            ?>
            <br><br>
            <h2> تحديث بيانات الاسئلة </h2>
      
<form action="" method="post" enctype="multipart/form-data" dir="rtl">

   <div class="col">
      <p> عنوان السؤال  <span>*</span></p>
      <input type="text" name="question" maxlength="100" value="<?= $fetch_exam['question']; ?>"  placeholder="عنوان السؤال" class="box">
     
      <p>  الاجابة الأولي  <span>*</span></p>
      <input type="text" name="ans1" maxlength="100" value="<?= $fetch_exam['ans1']; ?>"  placeholder="مثال : محتوي شهر سبتمبر في اللغه العربيه ..." class="box">
     
      <p>  الاجابة الثانية  <span>*</span></p>
      <input type="text" name="ans2" maxlength="100" value="<?= $fetch_exam['ans2']; ?>"  placeholder="مثال : محتوي شهر سبتمبر في اللغه العربيه ..." class="box">
     
      <p>  الاجابة الثالثة  <span>*</span></p>
      <input type="text" name="ans3" maxlength="100" value="<?= $fetch_exam['ans3']; ?>"  placeholder="مثال : محتوي شهر سبتمبر في اللغه العربيه ..." class="box">
     
      <p>  الاجابة الرابعة  <span>*</span></p>
      <input type="text" name="ans4" maxlength="100" value="<?= $fetch_exam['ans4']; ?>"  placeholder="مثال : محتوي شهر سبتمبر في اللغه العربيه ..." class="box">
     
      <p>  الاجابة الصحيحه  <span>*</span></p>
      <input type="text" name="cor_ans" maxlength="100" value="<?= $fetch_exam['cor_ans']; ?>"  placeholder="مثال : محتوي شهر سبتمبر في اللغه العربيه ..." class="box">
   
    </div>

      <input type="submit" value="تحديث" name="update_question" class="btn">
</form>
      </div>
    </div>
    
    <?php
}}
?>
</center>