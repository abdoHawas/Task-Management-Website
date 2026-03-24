<?php
session_start();
if(isset($_SESSION['role']) && isset($_SESSION['id'])){
	include "../DB_connection.php";	
    include "model/Notification.php";

	$notificationCount = count_notifications($conn, $_SESSION['id']);
    if($notificationCount){
        echo "&nbsp;$notificationCount&nbsp;";
    }

    
} else {
	echo"";
}
?>