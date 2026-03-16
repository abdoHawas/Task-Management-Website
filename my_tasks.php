<?php
session_start();
if(isset($_SESSION['role']) && isset($_SESSION['id'])){
	include "DB_connection.php";	
    include "app/model/User.php";
	include "app/model/Task.php";

	$tasks = get_all_tasks_by_id($conn, $_SESSION['id']);
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>My Tasks</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/Style.css">
	
</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include "inc/header.php"; ?>
	<div class="body">
		<?php include "inc/nav.php"; ?>
		<section class="section-1">
                <h2 class = "tittle"> My Tasks </h2>
				 <!-- Success message -->
                <?php if (isset($_GET['success'])) {?>
                <div class="success" role="alert">
                    <?php echo stripcslashes($_GET['success']); ?>
                </div>
                <?php }?>
				<?php if($tasks != 0){ ?>
				<table class="main-table">
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Description</th>
                        <th>Status</th>
						<th>Due Date</th>
						<th>Action</th>
					</tr>
					<?php $i= 0; foreach($tasks as $task){ $i++; ?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $task['title']; ?></td>
						<td><?php echo $task['description']; ?></td>
                        <td><?php echo $task['status']; ?></td>
						<td><?php echo $task['due_date']; ?></td>
						<td>
							<a href="edit-task-employee.php?id=<?php echo $task['id']; ?>" class="edit-btn">Edit</a> 
						</td>
					</tr>
					<?php } ?>
				</table>
				<?php } else { ?>
					<h3>No tasks assigned to you yet !!!!</h3>
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