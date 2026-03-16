<?php

function get_all_users($conn){
    $sql = "SELECT * FROM users WHERE role = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(["employee"]);

    if($stmt->rowCount() > 0){
        $users = $stmt->fetchAll();
    } else {
        $users = 0;
    }
    return $users;
}
function insert_user($conn , $data){
    $sql = "INSERT INTO users (fullname, username, password , role) VALUES(?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);
}
function update_user($conn , $data){
    $sql = "UPDATE users SET fullname = ?, username = ?, password = ?, role = ? WHERE id = ? and role = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);
}
function delete_user($conn , $id){

        // First, set assigned_to to NULL for all tasks assigned to this user
        $stmt = $conn->prepare("UPDATE tasks SET assigned_to = NULL WHERE assigned_to = ?");
        $stmt->execute([$id]);
        
        // Then delete the user
        $stmt = $conn->prepare("DELETE FROM users WHERE id=? AND role=?");
        $stmt->execute([$id, "employee"]);
}

function get_user_by_id($conn , $id){
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    if($stmt->rowCount() > 0){
        $user = $stmt->fetch();
    } else {
        $user = 0;
    }
    return $user;
}
function update_profile($conn , $data){
    $sql = "UPDATE users SET fullname = ?, password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);
}