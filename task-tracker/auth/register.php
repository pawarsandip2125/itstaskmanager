<?php
include("../config/db.php");

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(name,email,password) VALUES (?,?,?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss",$name,$email,$password);

    if($stmt->execute()){
        echo "Registration Successful";
    }else{
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>User Registration</h2>

<form method="POST">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>

    <button name="register">Register</button>
</form>

</body>
</html>
