<?php
session_start();
if(isset($_SESSION['role']) && isset($_SESSION['id'])){
	include "../DB_connection.php";	
    include "model/Notification.php";

	$notifications = get_all_my_notifications($conn, $_SESSION['id']);
    if($notifications == 0){ ?>
    <li>
        <a href="#">
            <mark><b> No New Notification Available</b></mark>
        </a>
    </li>

    <?php } else{
    foreach($notifications as $notification){

?>

    <li>
        <a href="app/notification-read.php?notification_id=<?= $notification['id'] ?>">
            
            <?php if($notification['is_read'] == 0 ){ 
                echo "<mark><b> You Have a ".$notification['type']." </b></mark> :";

            } else echo " You Have a ".$notification['type']." :"; ?>
             <?= $notification['message'] ?>
            &nbsp;&nbsp;<small> <?= $notification['date'] ?></small>
        </a>
    </li>

<?php    
}
}
} else {
	$temp = "Log In is required";
    header("Location: login.php?error=$temp");
    exit();
}
?>