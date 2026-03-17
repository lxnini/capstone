<?php
session_start();

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}
?>

<?php include 'config/database.php'; ?>

<h2>Church Event Bookings</h2>

<a href="pages/add_booking.php">Add Booking</a>

<table border="1">

<tr>
<th>Name</th>
<th>Event</th>
<th>Date</th>
<th>Time</th>
<th>Priest</th>
<th>Action</th>
</tr>

<?php

$result = mysqli_query($conn,"SELECT * FROM bookings");

while($row = mysqli_fetch_assoc($result)){

echo "<tr>

<td>".$row['name']."</td>
<td>".$row['event_type']."</td>
<td>".$row['event_date']."</td>
<td>".$row['event_time']."</td>
<td>".$row['priest']."</td>

<td>

<a href='pages/edit_booking.php?id=".$row['id']."'>Edit</a>

<a href='pages/delete_booking.php?id=".$row['id']."'>Delete</a>

</td>

</tr>";

}

?>

</table>