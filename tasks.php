<?php
session_start();
if(isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin"){
	include "DB_connection.php";
    include "app/model/User.php";
	include "app/model/Task.php";

	$users = get_all_users($conn);

	$text = "All Tasks";
	if(isset($_GET['due_date']) && $_GET['due_date'] == "due today") {
		$text = "Tasks Due Today";
		$tasks = get_tasks_due_today($conn);
		$num_of_tasks = count_tasks($tasks);

	}else if(isset($_GET['due_date']) && $_GET['due_date'] == "due this week") {
		$text = "Tasks Due This Week";
		$tasks = get_tasks_due_this_week($conn);
		$num_of_tasks = count_tasks($tasks);
	} else if(isset($_GET['due_date']) && $_GET['due_date'] == "due this month") {
		$text = "Tasks Due This Month";
		$tasks = get_tasks_due_this_month($conn);
		$num_of_tasks = count_tasks($tasks);

	} else if(isset($_GET['due_date']) && $_GET['due_date'] == "overdue") {
		$text = "Overdue Tasks";
		$tasks = get_overdue_tasks($conn);
		$num_of_tasks = count_tasks($tasks);

	} else if(isset($_GET['due_date']) && $_GET['due_date'] == "no deadline") {
		$text = "Tasks With No Deadline";
		$tasks = get_tasks_with_no_deadline($conn);
		$num_of_tasks = count_tasks($tasks);

	} else if(isset($_GET['due_date']) && $_GET['due_date'] == "not assigned") {
		$text = "Unassigned Tasks";
		$tasks = get_unassigned_tasks($conn);
		$num_of_tasks = count_tasks($tasks);
		
	} else{
		$tasks = get_all_tasks($conn);
		$num_of_tasks = count_tasks($tasks);
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>All Tasks</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/Style.css">

</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include "inc/header.php"; ?>
	<div class="body">
		<?php include "inc/nav.php"; ?>
		<section class="section-1">
			<a href="create_task.php" class="add-btn">Create Task</a><br><br>
                <h3 class = "tittle-2"> <?php echo $text; ?> (<?php echo $num_of_tasks; ?>)
				<a href="tasks.php">All Tasks</a>
				<a href="tasks.php?due_date=due today">Due Today</a>
				<a href="tasks.php?due_date=due this week">Due This Week</a>
				<a href="tasks.php?due_date=due this month">Due This Month</a>
				<a href="tasks.php?due_date=overdue">Overdue</a>
				<a href="tasks.php?due_date=no deadline">No Deadline</a>
				<a href="tasks.php?due_date=not assigned">Not Assigned</a> 


				</h3>
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
						<th>Assigned To</th>
						<th style="width: 100px;">Due Date</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
					<?php $i= 0; foreach($tasks as $task){ $i++; ?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $task['title']; ?></td>
						<td><?php echo $task['description']; ?></td>
						<td><?php
                         foreach($users as $user){
                             if($user['id'] == $task['assigned_to']){
                                echo $user['fullname'];
                             }
							 else if($task['assigned_to'] == NULL){
								echo "Unassigned";
								break;
							 }
                         }
                        ?>
                        </td>
						<td><?php if($task['due_date'] == "") echo "No Deadline"; 
								  else echo $task['due_date'];
						?></td>
						<td><?php echo $task['status']; ?></td>
						<td>
							<a href="edit-task.php?id=<?php echo $task['id']; ?>" class="edit-btn">Edit</a>
						 	<a href="delete-task.php?id=<?php echo $task['id']; ?>" class="delete-btn">Delete</a>
						</td>
					</tr>
					<?php } ?>
				</table>
				<?php } else { ?>
					<h1>Empty !!!!</h1>
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