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

if(isset($_POST['accept'])){
    $accept_id = $_GET['accept']; 
    $status = 1;
    
    $update_exam = $conn->prepare("UPDATE `subscriptions` SET status = ?  WHERE id = ?");
    $update_exam->execute([ $status,  $accept_id]);
    header('location:  subscriptions.php'); 
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
 
    $delete_playlist = $conn->prepare("DELETE FROM `subscriptions` WHERE id = ?");
    $delete_playlist->execute([$delete_id]);
    header('location:  subscriptions.php');
 
 }

?>
<style>
    table {
        width: 90%;
        border-collapse: collapse;
        text-align: right;
        color: #40A578;
        padding: 10px 20px;
        margin: 40px auto;
    }
    table th {
        text-align: center;
        font-weight: 600;
        font-size: 20px;
        background-color: #40a57830;
        border: 1px solid #40a57875;
    }
    table tr td {
        border: 1px solid #40a57875;
        padding: 5px 10px;
        font-weight: 600;
    }
    .action 
    {
        text-align: center;
        width: 150px;
    }
    .action a
    {
        padding : 0 20px ; 
    }
    .deletebtn
    {
        color: red ; 
    }
    .acceptbtn
    {
        color: green ;
        background: none;
        border: none;
    }
</style>

<div class="swiper">
  <div class="swiper-wrapper">


<table dir="rtl">
        <tr>
            <th colspan="6" >الاشتراكات</th>
         </tr>
         <tr>
            <th>الطالب</th>
            <th>الخصم</th>
            <th>رقم الموبايل</th>
            <th>الحاله</th>
            <th>الوقت</th>
            <th>الخيارات</th>
         </tr>
         <tbody>
         <?php
    $select_subscriptions = $conn->prepare("SELECT * FROM `subscriptions` ORDER BY status");
    $select_subscriptions->execute([]);
    if($select_subscriptions->rowCount() > 0){
        while($fetch_subscriptions = $select_subscriptions->fetch(PDO::FETCH_ASSOC)){
?>
<tr>
    <td><?= $fetch_subscriptions['student_name']; ?></td>
    <td><?= $fetch_subscriptions['copun']; ?></td>
    <td><?= $fetch_subscriptions['phone']; ?></td>
    <td><?= $fetch_subscriptions['status']; ?></td>
    <td><?= $fetch_subscriptions['cr_at']; ?></td>
    <td class="action">
    <form action="subscriptions.php?accept=<?= $fetch_subscriptions['id']; ?>" method="post">
        <input type="hidden" name="accept" value="<?= $fetch_subscriptions['id'];?>">
        <button name="accept_btn" class="acceptbtn" type="submit"><i class="fa-solid fa-check"></i></button>
        <a href="subscriptions.php?delete=<?= $fetch_subscriptions['id']; ?>"  class="deletebtn"><i class="fa-solid fa-xmark"></i></a>
    </form>
    </td>
</tr>
<?php }}?> 
</tbody>
</table>
