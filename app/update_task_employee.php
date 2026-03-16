<?php
session_start();
if(isset($_SESSION['role']) && isset($_SESSION['id'])){

if(isset($_POST['id']) && isset($_POST['status']) && $_SESSION['role'] == 'employee'){
    include "../DB_connection.php";
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $status = validate($_POST['status']);
    $id = validate($_POST['id']);

    if (empty($status)) {
        $temp = "Status is required";
        header("Location: ../edit-task-employee.php?error=$temp&id=$id");
        exit();
    }else {
        include "model/task.php";
        $data = array($status, $id);
        update_task_status($conn, $data);
        $temp = "Task updated successfully";
        header("Location: ../edit-task-employee.php?success=$temp&id=$id");
        exit();
    }

} else {
    $temp = "Unknown error occurred";
    header("Location: ../edit-task-employee.php?error=$temp&id=$id");
    exit();
}
}else {
    $temp = "Log In is required";
    header("Location: ../login.php?error=$temp");
    exit();
}


