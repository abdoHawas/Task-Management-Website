<?php
session_start();
if(isset($_SESSION['role']) && isset($_SESSION['id'])&& $_SESSION['role'] == "employee"){
    include "DB_connection.php";	
    include "app/model/User.php";
    include "app/model/Task.php";

    if (!isset($_GET['id'])) {
    	 header("Location: tasks.php");
    	 exit();
    }
    $id = $_GET['id'];
    $task = get_task_by_id($conn, $id);

    if ($task == 0) {
    	 header("Location: tasks.php");
    	 exit();
    }
    $users = get_all_users($conn);     
    
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Task</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/Style.css">
	
</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include "inc/header.php"; ?>
	<div class="body">
		<?php include "inc/nav.php"; ?>
		<section class="section-1">
            <h4 class = "tittle"> Edit Task <a href="my_tasks.php"> My Tasks</a></h4>
			<form class="form-1"
                method = "post"
                action = "app/update_task_employee.php">
                
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
                    <br><p><b>Title : </b><?=$task['title'];?></p>  
                </div><br>
                 <div class="input-holder">
                    <p><b>Description : </b><?=$task['description'];?></p>
                    
                </div><br><br>
                <div class="input-holder">
                    <label>Status</label>
                    <select name="status" class="input-1">
                        <option value="pending" <?php echo $task['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                        <option value="in_progress" <?php echo $task['status'] == 'in_progress' ? 'selected' : ''; ?>>In Progress</option>
                        <option value="completed" <?php echo $task['status'] == 'completed' ? 'selected' : ''; ?>>Completed</option>
                    </select><br><br>
                </div>
                    
                
                <input type="text" name = "id" value="<?=$task['id'];?>"hidden>

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