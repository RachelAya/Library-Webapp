<?php
session_start();
include "db_conn.php";

if(isset($_POST['username']) && isset($_POST['password'])) {
    
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return data;
    }
}

$username = validate($_POST['username']);
$pass = validate($_POST['password']);

if(empty($username)){
    header("Location: index.php?error=Username is required");
    exit();
}
else if(empty($pass)) {
    header("Location: index.php?error=Password is required");
    exit();
}

$sql = "SELECT * FROM users WHERE user_name='$username' AND password='$pass'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if($row['user_name'] === $username && $row['password'] === $pass) {
        echo "You are logged in.";
        // Add sessions for all variables 
        $_SESSION['user_name'] = $row['user_name'];
        // This line might cause errors
        $_SESSION['name'] = $row['name'];
        $_SESSION['id'] = $row['id'];
        header("Location: home.php");
        exit();
    }
    else{
        header("Location: index.php?error=Incorrect Username or password");
        exit();
    }
}
else{
    header("Location: index.php");
    exit();
}