<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
}

if(isset($_POST['add_task'])){

    $title = $_POST['title'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO tasks(user_id,title,description) VALUES (?,?,?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss",$user_id,$title,$description);

    if($stmt->execute()){
        echo "Task Added Successfully";
    }else{
        echo "Error";
    }
}
?>

<h2>Add Task</h2>

<form method="POST">
    Title: <input type="text" name="title" required><br><br>
    Description: <textarea name="description"></textarea><br><br>

    <button name="add_task">Add Task</button>
</form>

<a href="../dashboard.php">Back to Dashboard</a>
