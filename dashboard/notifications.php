<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
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

   $delete_notification = $conn->prepare("DELETE FROM `notifications` WHERE id = ?");
   $delete_notification->execute([$delete_id]);

   header('location:  notifications.php');
}

?>
</head>
<body>
    <br>
<center>
        <h1>اشعاراتي</h1>
    </center>
<div class="cards">
    <?php
    $select_notification = $conn->prepare("SELECT * FROM `notifications` WHERE tutor_id = ?");
    $select_notification->execute([$tutor_id]);
    if($select_notification->rowCount() > 0){
        while($fetch_notification = $select_notification->fetch(PDO::FETCH_ASSOC)){
    ?>
    <div class="card">
        <h3><?= $fetch_notification['notification']; ?></h3>
        <span class="exam_description"> <?= $fetch_notification['classroom']; ?></span> #
        <span class="exam_description"> <?= $fetch_notification['section']; ?></span>
        <p class="exam_description"> <?= $fetch_notification['date']; ?></p>
        <br>
        <div class="action" >
        <a href="notifications.php?delete_id=<?= $fetch_notification['id']; ?>"  class="deletebtn">حذف</a>
        <a href="edit_notification.php?edit_id=<?= $fetch_notification['id']; ?>" id="editCourseBtn" class="editbtn">تعديل</a>
        </div>        
    </div>

    <?php
        }}
    ?>
</div>