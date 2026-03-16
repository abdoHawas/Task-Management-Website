<?php
session_start();
if(isset($_SESSION['role']) && isset($_SESSION['id'])){

if(isset($_POST['title']) && isset($_POST['description'])&& isset($_POST['assigned_to']) && isset($_POST['due_date']) && $_SESSION['role'] == 'admin'){
    include "../DB_connection.php";
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $title = validate($_POST['title']);
    $description = validate($_POST['description']);
    $assigned_to = validate($_POST['assigned_to']);
    $due_date = validate($_POST['due_date']);

    if (empty($title)) {
        $temp = "Title is required";
        header("Location: ../create_task.php?error=$temp");
        exit();
    }else if(empty($description)){
        $temp = "Description is required";
        header("Location: ../create_task.php?error=$temp");
        exit();  
    }else if($assigned_to == 0){
        $temp = "Select an employee to assign the task to";
        header("Location: ../create_task.php?error=$temp");
        exit();
    }else {
        include "model/task.php";
        $data = array($title, $description, $assigned_to, $due_date);
        insert_task($conn, $data);
        $temp = "Task created successfully";
        header("Location: ../create_task.php?success=$temp");
        exit();
    }

} else {
    $temp = "Unknown error occurred";
    header("Location: ../create_task.php?error=$temp");
    exit();
}
}else {
    $temp = "Log In is required";
    header("Location: ../login.php?error=$temp");
    exit();
}


