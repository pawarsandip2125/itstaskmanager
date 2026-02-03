<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM tasks WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$user_id);
$stmt->execute();

$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Tasks</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Your Tasks</h2>
        <a class="btn btn-primary" href="add_task.php">+ Add New Task</a>
    </div>

    <div class="card shadow">
        <div class="card-body">

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th width="200">Action</th>
                    </tr>
                </thead>

                <tbody>

                <?php while($row = $result->fetch_assoc()) { ?>

                <tr>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>

                    <td>
                        <?php 
                        if($row['status'] == 'Done'){
                            echo "<span class='badge bg-success'>Done</span>";
                        }else{
                            echo "<span class='badge bg-warning text-dark'>Pending</span>";
                        }
                        ?>
                    </td>

                    <td>
                        <a class="btn btn-success btn-sm"
                           href="update_status.php?id=<?php echo $row['id']; ?>">
                           Mark Done
                        </a>

                        <a class="btn btn-danger btn-sm"
                           href="delete_task.php?id=<?php echo $row['id']; ?>"
                           onclick="return confirm('Are you sure to delete this task?')">
                           Delete
                        </a>
                    </td>
                </tr>

                <?php } ?>

                </tbody>
            </table>

        </div>
    </div>

</div>

</body>
</html>
