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
	<title>Profile</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/Style.css">
	
</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include "inc/header.php"; ?>
	<div class="body">
		<?php include "inc/nav.php"; ?>
		<section class="section-1">
            <a href="edit_profile.php" class="add-btn">Edit Profile</a><br><br>
            <h2 class = "tittle"> Profile </h2>
			<table class = main-table style= "max-width: 300px;">
                <tr>
                    <th>Name</th>
                    <td><?=$user['fullname'];?></td>
                </tr>
                <tr>
                    <th>User Name</th>
                    <td><?=$user['username'];?></td>
                </tr>
                <tr>
                    <th>Joined at</th>
                    <td><?=$user['created_at'];?></td>
                </tr>
            </table>	
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