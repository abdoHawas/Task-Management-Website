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
        
    
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit User</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/Style.css">
	
</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include "inc/header.php"; ?>
	<div class="body">
		<?php include "inc/nav.php"; ?>
		<section class="section-1">
            <h4 class = "tittle"> Edit Users <a href="users.php"> All Users</a></h4>
			<form class="form-1"
                method = "post"
                action = "app/update_user.php">
                
                <!-- Error message -->
                <?php if (isset($_GET['error'])) {?>
                <div class="danger" role="alert">
                    <?php echo stripcslashes($_GET['error']); ?>
                </div>
                <?php }?>
                <!-- Success message -->
                <?php if (isset($_GET['success'])) {?>
                <div class="success" role="alert">
                    <?php echo stripcslashes($_GET['success']); ?>
                </div>
                <?php }?>

                <div class="input-holder">
                    <label>Full Name</label>
                    <input type="text" name = "full_name" value="<?=$user['fullname'];?>" class= "input-1" placeholder="Full Name"><br><br>  
                </div>
                 <div class="input-holder">
                    <label>Username</label>
                    <input type="text" name = "user_name" value="<?=$user['username'];?>" class= "input-1" placeholder="Username"><br><br>  
                </div>
                 <div class="input-holder">
                    <label>Password</label>
                    <input type="text" name = "password" value="**************" class= "input-1" placeholder="Password"><br><br>
                </div>
                <input type="text" name = "id" value="<?=$user['id'];?>"hidden>

                <button class="edit-btn"> Update </button>
            </form>	
		</section>
	</div>
<script type="text/javascript">
    var active = document.querySelector("#navlist li:nth-child(2)");
    active.classList.add("active");

</script>
</body>
</html>
<?php
} else {
	$temp = "Log In is required";
    header("Location: login.php?error=$temp");
    exit();
}
?>