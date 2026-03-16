<?php

function insert_task($conn, $data) {
    $sql = "INSERT INTO tasks (title, description, assigned_to, due_date) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);
}
function get_all_tasks($conn) {
    $sql = "SELECT * FROM tasks ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([]);
    if($stmt->rowCount() > 0){
        $tasks = $stmt->fetchAll();
        
    } else $tasks= 0;
    return $tasks;
}
function get_task_by_id($conn, $id) {
    $sql = "SELECT * FROM tasks WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    if($stmt->rowCount() > 0){
        $task = $stmt->fetch();
        
    } else $task= 0;
    return $task;
}
function update_task($conn, $data) {
    $sql = "UPDATE tasks SET title = ?, description = ?, assigned_to = ?, due_date = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);
}               
function delete_task($conn, $data) {
    $sql = "DELETE FROM tasks WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);
}
function get_all_tasks_by_id($conn, $id) {
    $sql = "SELECT * FROM tasks WHERE assigned_to = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    if($stmt->rowCount() > 0){
        $tasks = $stmt->fetchAll();
        
    } else $tasks= 0;
    return $tasks;
}
function update_task_status($conn, $data) {
    $sql = "UPDATE tasks SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);
}
function get_tasks_due_today($conn) {
    $sql = "SELECT * FROM tasks WHERE due_date = CURDATE() ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([]);
    if($stmt->rowCount() > 0){
        $tasks = $stmt->fetchAll();
        
    } else $tasks= 0;
    return $tasks;
}
function get_tasks_due_this_week($conn) {
    $sql = "SELECT * FROM tasks WHERE YEARWEEK(due_date, 1) = YEARWEEK(CURDATE(), 1) ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([]);
    if($stmt->rowCount() > 0){
        $tasks = $stmt->fetchAll();
        
    } else $tasks= 0;
    return $tasks;
}
function get_tasks_due_this_month($conn) {
    $sql = "SELECT * FROM tasks WHERE MONTH(due_date) = MONTH(CURDATE()) AND YEAR(due_date) = YEAR(CURDATE()) ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([]);
    if($stmt->rowCount() > 0){
        $tasks = $stmt->fetchAll();
        
    } else $tasks= 0;
    return $tasks;
}
function get_overdue_tasks($conn) {
    $sql = "SELECT * FROM tasks WHERE due_date < CURDATE() AND status != 'completed' ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([]);
    if($stmt->rowCount() > 0){
        $tasks = $stmt->fetchAll();
        
    } else $tasks= 0;
    return $tasks;
}
function get_tasks_with_no_deadline($conn) {
    $sql = "SELECT * FROM tasks WHERE due_date IS NULL OR due_date = '0000-00-00' ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([]);
    if($stmt->rowCount() > 0){
        $tasks = $stmt->fetchAll();
        
    } else $tasks= 0;
    return $tasks;
}
function count_pending_tasks($conn) {
    $sql = "SELECT COUNT(*) FROM tasks WHERE status = 'pending'";
    $stmt = $conn->prepare($sql);
    $stmt->execute([]);
    return $stmt->fetchColumn();
}
function count_in_progress_tasks($conn) {
    $sql = "SELECT COUNT(*) FROM tasks WHERE status = 'in_progress'";
    $stmt = $conn->prepare($sql);
    $stmt->execute([]);
    return $stmt->fetchColumn();
}
function count_completed_tasks($conn) {
    $sql = "SELECT COUNT(*) FROM tasks WHERE status = 'completed'";
    $stmt = $conn->prepare($sql);
    $stmt->execute([]);
    return $stmt->fetchColumn();
}
function get_unassigned_tasks($conn) {
    $sql = "SELECT * FROM tasks WHERE assigned_to IS NULL ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([]);
    if($stmt->rowCount() > 0){
        $tasks = $stmt->fetchAll();
        
    } else $tasks= 0;
    return $tasks;
}
function count_tasks ($tasks) {
    if($tasks != 0) return count($tasks);
    else return 0;
}
function get_mytasks_due_today($conn) {
    $sql = "SELECT * FROM tasks WHERE due_date = CURDATE() AND assigned_to = ? ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_SESSION['id']]);
    if($stmt->rowCount() > 0){
        $tasks = $stmt->fetchAll();
        
    } else $tasks= 0;
    return $tasks;
}
function get_mytasks_due_this_week($conn) {
    $sql = "SELECT * FROM tasks WHERE YEARWEEK(due_date, 1) = YEARWEEK(CURDATE(), 1) AND assigned_to = ? ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_SESSION['id']]);
    if($stmt->rowCount() > 0){
        $tasks = $stmt->fetchAll();
        
    } else $tasks= 0;
    return $tasks;
}
function get_mytasks_due_this_month($conn) {
    $sql = "SELECT * FROM tasks WHERE MONTH(due_date) = MONTH(CURDATE()) AND YEAR(due_date) = YEAR(CURDATE()) AND assigned_to = ? ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_SESSION['id']]);
    if($stmt->rowCount() > 0){
        $tasks = $stmt->fetchAll();
        
    } else $tasks= 0;
    return $tasks;
}
function get_overdue_mytasks($conn) {
    $sql = "SELECT * FROM tasks WHERE due_date < CURDATE() AND status != 'completed' AND assigned_to = ? ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_SESSION['id']]);
    if($stmt->rowCount() > 0){
        $tasks = $stmt->fetchAll();
        
    } else $tasks= 0;
    return $tasks;
}
function get_mytasks_with_no_deadline($conn) {
    $sql = "SELECT * FROM tasks WHERE (due_date IS NULL OR due_date = '0000-00-00') AND assigned_to = ? ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_SESSION['id']]);
    if($stmt->rowCount() > 0){
        $tasks = $stmt->fetchAll();
        
    } else $tasks= 0;
    return $tasks;
}
function count_pending_mytasks($conn) {
    $sql = "SELECT COUNT(*) FROM tasks WHERE status = 'pending' AND assigned_to = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_SESSION['id']]);
    return $stmt->fetchColumn();
}
function count_in_progress_mytasks($conn) {
    $sql = "SELECT COUNT(*) FROM tasks WHERE status = 'in_progress' AND assigned_to = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_SESSION['id']]);
    return $stmt->fetchColumn();
}
function count_completed_mytasks($conn) {
    $sql = "SELECT COUNT(*) FROM tasks WHERE status = 'completed' AND assigned_to = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_SESSION['id']]);
    return $stmt->fetchColumn();
}







?>