<?php
session_start();
if(isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin"){
	include "DB_connection.php";	
	include "app/model/User.php";
	$users = get_all_users($conn);
	

?>
<!DOCTYPE html>
<html>
<head>
	<title>Manage Users</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/Style.css">
	
</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include "inc/header.php"; ?>
	<div class="body">
		<?php include "inc/nav.php"; ?>
		<section class="section-1">
			<a href="add-user.php" class="add-btn">Add User</a><br><br>
                <h3 class = "tittle"> Manage Users </h3>
				 <!-- Success message -->
                <?php if (isset($_GET['success'])) {?>
                <div class="success" role="alert">
                    <?php echo stripcslashes($_GET['success']); ?>
                </div>
                <?php }?>
				<?php if($users != 0){ ?>
				<table class="main-table">
					<tr>
						<th>#</th>
						<th>Full Name</th>
						<th>Username</th>
						<th>Role</th>
						<th>Action</th>
					</tr>
					<?php $i= 0; foreach($users as $user){ $i++; ?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $user['fullname']; ?></td>
						<td><?php echo $user['username']; ?></td>
						<td><?php echo $user['role']; ?></td>
						<td>
							<a href="edit-user.php?id=<?php echo $user['id']; ?>" class="edit-btn">Edit</a> 
						 	<a href="delete-user.php?id=<?php echo $user['id']; ?>" class="delete-btn">Delete</a>
						</td>
					</tr>
					<?php } ?>
				</table>
				<?php } else { ?>
					<h3>Empty</h3>
				<?php } ?>
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