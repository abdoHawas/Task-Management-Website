<?php
session_start();
if(isset($_SESSION['role']) && isset($_SESSION['id'])){
if(isset($_POST['user_name']) && isset($_POST['password']) && isset($_POST['full_name']) && $_SESSION['role']=='admin'){
    include "../DB_connection.php";
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $user_name = validate($_POST['user_name']);
    $password = validate($_POST['password']);
    $full_name = validate($_POST['full_name']);
    $id = validate($_POST['id']);
   
    if (empty($user_name)) {
        $temp = "User name is required";
        header("Location: ../edit-user.php?error=$temp&id=$id");
        exit();
    }else if(empty($password)){
        $temp = "Password is required";
        header("Location: ../edit-user.php?error=$temp&id=$id");
        exit();      
    }else if(empty($full_name)){
        $temp = "Full name is required";
        header("Location: ../edit-user.php?error=$temp&id=$id");
        exit();   
    }else {
        include "model/user.php";
        $password = password_hash($password, PASSWORD_DEFAULT);
        $data = array($full_name, $user_name, $password, "employee" , $id , "employee");
        update_user($conn, $data);
        
        $temp = "User updated successfully";
        header("Location: ../edit-user.php?success=$temp&id=$id");
        exit();

    }

} else {
    $temp = "Unknown error occurred";
    header("Location: ../edit-user.php?error=$temp");
    exit();
}
}else {
    $temp = "Log In is required";
    header("Location: ../login.php?error=$temp");
    exit();
}


