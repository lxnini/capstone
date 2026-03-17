<?php
include 'config/database.php';

if(isset($_POST['signup'])){

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (name,email,password)
VALUES ('$name','$email','$password')";

mysqli_query($conn,$sql);

header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Sign Up</title>
</head>

<body>

<h2>Church Staff Sign Up</h2>

<form method="POST">

Name<br>
<input type="text" name="name" required><br><br>

Email<br>
<input type="email" name="email" required><br><br>

Password<br>
<input type="password" name="password" required><br><br>

<button type="submit" name="signup">Sign Up</button>

</form>

<a href="login.php">Already have an account? Login</a>

</body>
</html>