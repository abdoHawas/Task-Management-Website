<?php
session_start();
if(isset($_SESSION['role']) && isset($_SESSION['id'])){
	include "DB_connection.php";	
    include "app/model/Notification.php";

	$notifications = get_all_my_notifications($conn, $_SESSION['id']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>My Notifications</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/Style.css">
	
</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include "inc/header.php"; ?>
	<div class="body">
		<?php include "inc/nav.php"; ?>
		<section class="section-1">
                <h2 class = "tittle"> All Notifications </h2>
				 <!-- Success message -->
                <?php if (isset($_GET['success'])) {?>
                <div class="success" role="alert">
                    <?php echo stripcslashes($_GET['success']); ?>
                </div>
                <?php }?>
				<?php if($notifications != 0){ ?>
				<table class="main-table">
					<tr>
						<th>#</th>
						<th>Message</th>
						<th>Type</th>
						<th>Date</th>
					</tr>
					<?php $i= 0; foreach($notifications as $notification){ $i++; ?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $notification['message']; ?></td>
						<td><?php echo $notification['type']; ?></td>
						<td><?php echo $notification['date']; ?></td>
					</tr>
					<?php } ?>
				</table>
				<?php } else { ?>
					<h3>No Notifications Yet !!!!</h3>
				<?php } ?>
		</section>
	</div>
<script type="text/javascript">
    var active = document.querySelector("#navlist li:nth-child(4)");
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