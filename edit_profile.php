<?php
session_start();
if(isset($_SESSION['role']) && isset($_SESSION['id'])&& $_SESSION['role'] == "employee"){
    include "DB_connection.php";	
    include "app/model/User.php";
    $user = get_user_by_id($conn, $_SESSION['id']);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/Style.css">
	
</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include "inc/header.php"; ?>
	<div class="body">
		<?php include "inc/nav.php"; ?>
		<section class="section-1">
            <h2 class = "tittle"> Edit Profile <a href="profile.php"> Profile</a></h2>
			<form class="form-1"
                method = "post"
                action = "app/update_profile.php">
                
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
                    <label>Old Password</label>
                    <input type="text" name = "password" value="**************" class= "input-1" placeholder="Old Password"><br><br>
                </div>
                 <div class="input-holder">
                    <label>New Password</label>
                    <input type="text" name = "new_password" class= "input-1" placeholder="New Password"><br><br>
                </div>
                 <div class="input-holder">
                    <label>Confirm Password</label>
                    <input type="text" name = "confirm_password" class= "input-1" placeholder="Confirm Password"><br><br>
                </div>

                <button class="edit-btn"> Update </button>
            </form>	
		</section>
	</div>
<script type="text/javascript">
    var active = document.querySelector("#navlist li:nth-child(3)");
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