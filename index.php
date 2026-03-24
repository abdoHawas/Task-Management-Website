<?php
session_start();
if(isset($_SESSION['role']) && isset($_SESSION['id'])){
	include "DB_connection.php";
    include "app/model/User.php";
	include "app/model/Task.php";

	if($_SESSION['role'] == "admin"){
		$due_today_tasks = get_tasks_due_today($conn);
		$num_of_due_today_tasks = count_tasks($due_today_tasks);

		$due_month_tasks = get_tasks_due_this_month($conn);
		$num_of_due_this_month_tasks = count_tasks($due_month_tasks);
		
		$unassigned_tasks = get_unassigned_tasks($conn);
		$num_of_unassigned_tasks = count_tasks($unassigned_tasks);

		$overdue_tasks = get_overdue_tasks($conn);
		$num_of_overdue_tasks = count_tasks($overdue_tasks);

		$nodeadline_tasks = get_tasks_with_no_deadline($conn);
		$num_of_nodeadline_tasks = count_tasks($nodeadline_tasks);

		$tasks = get_all_tasks($conn);
		$num_of_tasks = count_tasks($tasks); 

		$Users = get_all_users($conn);
		$num_of_users = count($Users);

		$pending = count_pending_tasks($conn);
		$in_progress = count_in_progress_tasks($conn);
		$completed = count_completed_tasks($conn);
		
	}
	else {
		$mytasks = get_all_tasks_by_id($conn, $_SESSION['id']);
		$num_of_mytasks = count_tasks($mytasks);

		$due_today_mytasks = get_mytasks_due_today($conn);
		$num_of_due_today_mytasks = count_tasks($due_today_mytasks);

		$due_this_month_mytasks = get_mytasks_due_this_month($conn);
		$num_of_due_this_month_mytasks = count_tasks($due_this_month_mytasks);

		$overdue_mytasks = get_overdue_mytasks($conn);
		$num_of_overdue_mytasks = count_tasks($overdue_mytasks);

		$nodeadline_mytasks = get_mytasks_with_no_deadline($conn);
		$num_of_nodeadline_mytasks = count_tasks($nodeadline_mytasks);
		
		$pinding_mytasks = count_pending_mytasks($conn);
		$in_progress_mytasks = count_in_progress_mytasks($conn);
		$completed_mytasks = count_completed_mytasks($conn);


	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/Style.css">
</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include "inc/header.php"; ?>
	<div class="body">
		<?php include "inc/nav.php"; ?>
		<section class="section-1">
		<?php
		if($_SESSION['role'] == "admin"){ ?>
			<div class= "dashboard-admin">
				<div class="dashboard-item">
					<i class="fa fa-users"></i>
					<span><?php echo $num_of_users; ?> Employee</span>
				</div>
				<div class="dashboard-item">
					<i class="fa fa-tasks"></i>
					<span><?php echo $num_of_tasks; ?> Total Tasks</span>
				</div>
				<div class="dashboard-item">
					<i class="fa fa-exclamation-triangle"></i>
					<span><?php echo $num_of_due_today_tasks; ?> Due Today</span>
				</div>
				<div class="dashboard-item">
					<i class="fa fa-exclamation-triangle"></i>
					<span><?php echo $num_of_due_this_month_tasks; ?> Due This Month</span>
				</div>
				<div class="dashboard-item">
					<i class="fa fa-window-close"></i>
					<span><?php echo $num_of_unassigned_tasks; ?> Unassigned</span>
				</div>
				<div class="dashboard-item">
					<i class="fa fa-calendar-minus-o"></i>
					<span><?php echo $num_of_overdue_tasks; ?> Overdue</span>
				</div>
				<div class="dashboard-item">
					<i class="fa fa-clock-o"></i>
					<span><?php echo $num_of_nodeadline_tasks; ?> No Deadline</span>
				</div>
				<div class="dashboard-item">
					<i class="fa fa-square-o"></i>
					<span><?php echo $pending; ?> Pending</span>
				</div>
				<div class="dashboard-item">
					<i class="fa fa-spinner"></i>
					<span><?php echo $in_progress; ?> In Progress</span>
				</div>
				<div class="dashboard-item">
					<i class="fa fa-check-square-o"></i>
					<span><?php echo $completed; ?> Completed</span>
				</div>
			</div>
		
			
		<?php } else {?>
			<div class= "dashboard-emp">
				<div class="dashboard-item">
					<i class="fa fa-tasks"></i>
					<span><?php echo $num_of_mytasks; ?> My Tasks</span>
				</div>
				<div class="dashboard-item">
					<i class="fa fa-tasks"></i>
					<span><?php echo $num_of_due_today_mytasks; ?> Due Today</span>
				</div>
				<div class="dashboard-item">
					<i class="fa fa-tasks"></i>
					<span><?php echo $num_of_due_this_month_mytasks; ?> Due This Month</span>
				</div>
				<div class="dashboard-item">
					<i class="fa fa-window-close-o"></i>
					<span><?php echo $num_of_overdue_mytasks; ?> Overdue</span>
				</div>
				<div class="dashboard-item">
					<i class="fa fa-clock-o"></i>
					<span><?php echo $num_of_nodeadline_mytasks; ?> No Deadline</span>
				</div>
				<div class="dashboard-item">
					<i class="fa fa-square-o"></i>
					<span><?php echo $pinding_mytasks; ?> Pending</span>
				</div>
				<div class="dashboard-item">
					<i class="fa fa-spinner"></i>
					<span><?php echo $in_progress_mytasks; ?> In Progress</span>
				</div>
				<div class="dashboard-item">
					<i class="fa fa-check-square-o"></i>
					<span><?php echo $completed_mytasks; ?> Completed</span>
				</div>
			</div>

		<?php } ?>
		
		</section>
	</div>
	<script type="text/javascript">
    var active = document.querySelector("#navlist li:nth-child(1)");
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