<?php
session_start();
include "db_conn.php";

if(isset($_POST['email']) && isset($_POST['password'])) {
    
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return data;
    }
}

$email = validate($_POST['email']);
$pass = validate($_POST['password']);

if(empty($email)){
    header("Location: index.php?error=Email is required");
    exit();
}
else if(empty($pass)) {
    header("Location: index.php?error=Password is required");
    exit();
}

$sql = "SELECT * FROM users WHERE user_id='$email' AND password='$pass'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if($row['user_name'] === $email && $row['password'] === $pass) {
        echo "You are logged in.";
        // Add sessions for all variables https://www.youtube.com/watch?v=scd8YKiuS7I
            
    }
}