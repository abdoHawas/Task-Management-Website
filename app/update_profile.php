<?php
session_start();
if(isset($_SESSION['role']) && isset($_SESSION['id'])){
if(isset($_POST['full_name']) && isset($_POST['password']) && isset($_POST['new_password'])&& isset($_POST['confirm_password']) && $_SESSION['role']=='employee'){
    include "../DB_connection.php";
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $full_name = validate($_POST['full_name']);
    $password = validate($_POST['password']);
    $new_password = validate($_POST['new_password']);
    $confirm_password = validate($_POST['confirm_password']);
    $id = $_SESSION['id'];
    
   
    if (empty($full_name)) {
        $temp = "Full name is required";
        header("Location: ../edit_profile.php?error=$temp");
        exit();
    }else if(empty($password) || empty($new_password) || empty($confirm_password)){
        $temp = "All password fields are required";
        header("Location: ../edit_profile.php?error=$temp");
        exit();      
    }else if($new_password !== $confirm_password){
        $temp = "New password and confirm password do not match";
        header("Location: ../edit_profile.php?error=$temp");
        exit();     
    }else {
        include "model/user.php";
        $user = get_user_by_id($conn, $id);
        if($user){
            if(password_verify($password, $user['password'])){
                $new_password = password_hash($new_password, PASSWORD_DEFAULT);
                $data = array($full_name, $new_password, $id);
                update_profile($conn, $data);
        
                $temp = "Profile updated successfully";
                header("Location: ../edit_profile.php?success=$temp");
                exit(); 
            }else {
                $temp = "Old password is incorrect";
                header("Location: ../edit_profile.php?error=$temp");
                exit(); 
            }
        } else {
            $temp = "Unknown error occurred";
            header("Location: ../edit_profile.php?error=$temp");
            exit(); 
        }
       

    }

} else {
    $temp = "Unknown error occurred";
    header("Location: ../edit_profile.php?error=$temp");
    exit();
}
}else {
    $temp = "Log In is required";
    header("Location: ../login.php?error=$temp");
    exit();
}


