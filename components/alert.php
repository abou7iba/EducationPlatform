
<style>
    @import url('https://fonts.googleapis.com/css2?family=Changa:wght@200..800&display=swap');

    *
    {
        margin: 0;
        padding: 0;
        font-family: "Changa", sans-serif;
        text-decoration: none;
    }

    *::-webkit-scrollbar{
    height: 5rem;
    width: 1rem;
    }

    *::-webkit-scrollbar-track{
    background-color: transparent;
    }

    *::-webkit-scrollbar-thumb{
    background-color: #40A578;
    }
    body
    {
        scroll-behavior: smooth;
    }
    h1
    {
        font-size: 30px;
        margin-bottom: 10px;
        color: #40A578;
        text-shadow: -5px 5px 25px #40A578;
        text-align: center;
    }
    .alerts
    {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }
    .alert-item
    {
        width: 300px;
        margin: 50px 20px;
        text-align: center;
        height: 222px;
        background: #40A578;
        border-radius: 20px 20px 70px 20px;
        padding: 8px;
        position: relative;
        color: #Fff;
        box-shadow: 5px 15px 39px #40a5789e;
    }
    .alert-item i 
    {
        position: absolute;
        font-size: 30px;
        color: #Fff;
        background: #40A578;
        top: -25px;
        left: 122px;
        border: 6px solid;
        border-radius: 50%;
        padding: 10px;
    }

    .alert-item p
    {
        position: absolute;
        top: 40px;
        padding: 10px;
    }

    .alert-item .time
    {
        position: absolute;
        right: 14px;
        font-size: 16px;
    }
    .alert-item .date
    {
        position: absolute;
        left: 14px;
        font-size: 16px;
    }
</style>

<h1>الإشعارات</h1>
<?php
    // Include the database connection
    require_once 'components/connect.php';
    if(!isset($_COOKIE['user_id'])){
        header('location: components/login.php');
    }else{
        $user_id = $_COOKIE['user_id'];
    }

    $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
    $select_user->execute([$user_id]);
    if($select_user->rowCount() > 0){
        $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);
        $user_id = $fetch_user['id'];
        $user_classroom = $fetch_user['classroom'];
        $user_section = $fetch_user['section'];
    }


?>
<div class="alerts">
<?php
    $select_notification = $conn->prepare("SELECT * FROM `notifications` WHERE classroom = ? AND section = ? LIMIT 3");
    $select_notification->execute([$user_classroom , $user_section ]);
    if($select_notification->rowCount() > 0){
    while($fetch_select_notification = $select_notification->fetch(PDO::FETCH_ASSOC)){
        $notification_id    = $fetch_select_notification['id'];
        $select_notification_title = $fetch_select_notification['notification'];
        $select_notification_date = $fetch_select_notification['date'];
        $select_notification_time = $fetch_select_notification['time'];
?>
    <div class="alert-item">
        <i class="fa-solid fa-bell"></i>
        <p><?= $select_notification_title ?></p>
        <span class="time"><?= $select_notification_time ?></span>  
        <span class="date"><?= $select_notification_date ?></span>
    </div>
<?php }



}else {echo '<h3 style="color: red;">لا يوجد إشعارات حاليا</h3>'; }?>

</div>
