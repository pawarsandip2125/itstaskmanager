<?php
session_start();
include("../config/db.php");

if(isset($_GET['id'])){

    $task_id = $_GET['id'];

    $sql = "DELETE FROM tasks WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$task_id);
    $stmt->execute();
}

header("Location: task_list.php");
?>
