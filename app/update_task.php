<?php
session_start();
if(isset($_SESSION['role']) && isset($_SESSION['id'])){

if(isset($_POST['id']) && isset($_POST['title']) && isset($_POST['description'])&& isset($_POST['assigned_to']) && isset($_POST['due_date']) && $_SESSION['role'] == 'admin'){
    include "../DB_connection.php";
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $title = validate($_POST['title']);
    $description = validate($_POST['description']);
    $due_date = validate($_POST['due_date']);
    $assigned_to = validate($_POST['assigned_to']);
    $id = validate($_POST['id']);

    if (empty($title)) {
        $temp = "Title is required";
        header("Location: ../edit-task.php?error=$temp&id=$id");
        exit();
    }else if(empty($description)){
        $temp = "Description is required";
        header("Location: ../edit-task.php?error=$temp&id=$id");
        exit();  
    }else if($assigned_to == 0){
        $temp = "Select an employee to assign the task to";
        header("Location: ../edit-task.php?error=$temp&id=$id");
        exit();
    }else {
        include "model/Task.php";
        include "model/Notification.php";
        $data = array($title, $description, $assigned_to, $due_date, $id);
        update_task($conn, $data);
        $notification_data = array("'$title' has been assigned to you. please check your tasks.", $assigned_to, "Task Update", date("Y-m-d"));
        insert_notification($conn, $notification_data);
        $temp = "Task updated successfully";
        header("Location: ../edit-task.php?success=$temp&id=$id");
        exit();
    }

} else {
    $temp = "Unknown error occurred";
    header("Location: ../edit-task.php?error=$temp&id=$id");
    exit();
}
}else {
    $temp = "Log In is required";
    header("Location: ../login.php?error=$temp");
    exit();
}


