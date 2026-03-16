<?php
session_start();
if(isset($_SESSION['role']) && isset($_SESSION['id'])&& $_SESSION['role'] == "admin"){
    include "DB_connection.php";	
    include "app/model/User.php";

    if (!isset($_GET['id'])) {
    	 header("Location: users.php");
    	 exit();
    }
    $id = $_GET['id'];
    $user = get_user_by_id($conn, $id);

    if ($user == 0) {
    	 header("Location: users.php");
    	 exit();
    }
    delete_user($conn, $id);  
    $temp = "User deleted successfully";
    header("Location: users.php?success=$temp");    
    exit();

} else {
	$temp = "Log In is required";
    header("Location: login.php?error=$temp");
    exit();
}
?>