<?php 

function get_all_my_notifications($conn, $id) {
    $sql = "SELECT * FROM notifications WHERE recipient = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    if($stmt->rowCount() > 0){
        $notifications = $stmt->fetchAll();
    }else{
        $notifications = 0;
    }
    return $notifications;

}
