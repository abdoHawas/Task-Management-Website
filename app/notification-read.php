<?php
session_start();
if(isset($_SESSION['role']) && isset($_SESSION['id'])){
	include "../DB_connection.php";	
    include "model/Notification.php";

    if(isset($_GET['notification_id'])){
        $notification_id = $_GET['notification_id'];
	    make_notifications_read($conn, $_SESSION['id'], $notification_id);
        header("Location: ../notifications.php");
        exit();
    }
    else {
        header("Location: ../index.php");
        exit();
    }

} else {
	$temp = "Log In is required";
    header("Location: login.php?error=$temp");
    exit();
}
?>