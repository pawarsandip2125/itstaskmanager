<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: auth/login.php");
}
?>

<h2>Welcome <?php echo $_SESSION['user_name']; ?></h2>
<br><br>

<a href="task/add_task.php">Add Task</a><br>
<a href="task/task_list.php">View Tasks</a><br>
<a href="auth/logout.php">Logout</a>
