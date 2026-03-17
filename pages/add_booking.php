<?php
include '../config/database.php';

if(isset($_POST['submit'])){

$name = $_POST['name'];
$type = $_POST['event_type'];
$date = $_POST['event_date'];
$time = $_POST['event_time'];
$priest = $_POST['priest'];
$notes = $_POST['notes'];

$query = "INSERT INTO bookings (name,event_type,event_date,event_time,priest,notes)
VALUES ('$name','$type','$date','$time','$priest','$notes')";

mysqli_query($conn,$query);

header("Location: ../bookings.php");

}
?>

<h2>Add Church Booking</h2>

<form method="POST">

Name<br>
<input type="text" name="name" required><br><br>

Event Type<br>
<select name="event_type">

<option>Baptism (Binyag)</option>
<option>Wedding</option>
<option>Funeral Mass (Misa sa Patay)</option>

</select><br><br>

Date<br>
<input type="date" name="event_date"><br><br>

Time<br>
<input type="time" name="event_time"><br><br>

Priest<br>
<input type="text" name="priest"><br><br>

Notes<br>
<textarea name="notes"></textarea><br><br>

<button type="submit" name="submit">Save Booking</button>

</form>