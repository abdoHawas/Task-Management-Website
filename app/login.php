<?php
session_start();
if(isset($_POST['user_name']) && isset($_POST['password'])){
    include "../DB_connection.php";
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $user_name = validate($_POST['user_name']);
    $password = validate($_POST['password']);
    if (empty($user_name)) {
        $temp = "User name is required";
        header("Location: ../login.php?error=$temp");
        exit();
    }else if(empty($password)){
        $temp = "Password is required";
        header("Location: ../login.php?error=$temp");
        exit();         
    }else {
        $sql = "SELECT * FROM users WHERE username = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user_name]);
        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch();
            $usernamedb = $user['username'];
            $passworddb = $user['password'];
            $rolebd = $user['role'];
            $idbd = $user['id'];
            if ($user_name === $usernamedb) {
                if (password_verify($password, $passworddb)) {
                   if ($rolebd === "admin") {
                        // code for admin
                        $_SESSION['role'] = $rolebd;
                        $_SESSION['id'] = $idbd;
                        $_SESSION['username'] = $usernamedb;
                        header("Location: ../index.php");
                     }else if ($rolebd === "employee") {
                        //  code for employee
                        $_SESSION['role'] = $rolebd;
                        $_SESSION['id'] = $idbd;
                        $_SESSION['username'] = $usernamedb;
                        header("Location: ../index.php");
                     }else {
                        $temp = "Unknown error occurred";    
                        header("Location: ../login.php?error=$temp");
                        exit();
                        }
                }else {
                    $temp = "Incorrect User name or password";      
                    header("Location: ../login.php?error=$temp");
                    exit();
                }
            }else {
                $temp = "Incorrect User name or password";
                header("Location: ../login.php?error=$temp");
                exit();
            }
        }else {
            $temp = "Incorrect User name or password";
            header("Location: ../login.php?error=$temp");
            exit();
        }

    }

} else {
    $temp = "Unknown error occurred";
    header("Location: ../login.php?error=$temp");
    exit();
}


