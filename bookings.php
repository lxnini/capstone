<?php
session_start();
include 'includes/db.php';

/* =======================
   ADD BOOKING
======================= */
if(isset($_POST['add_booking'])){
    $event_type = $_POST['event_type'];
    $person_name = $_POST['person_name'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $priest = $_POST['priest'];

    $stmt = $conn->prepare("INSERT INTO bookings (event_type, person_name, event_date, event_time, priest) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $event_type, $person_name, $event_date, $event_time, $priest);
    $stmt->execute();
    $stmt->close();

    header("Location: bookings.php"); // refresh
}

/* =======================
   DELETE BOOKING
======================= */
if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $stmt = $conn->prepare("DELETE FROM bookings WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: bookings.php"); // refresh
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bookings</title>
</head>
<body>

<h2>Add Booking</h2>

<form method="POST">
    Event Type:
    <select name="event_type" required>
        <option value="Binyag">Binyag</option>
        <option value="Wedding">Wedding</option>
        <option value="Misa sa Patay">Misa sa Patay</option>
    </select><br><br>

    Name:
    <input type="text" name="person_name" required><br><br>

    Date:
    <input type="date" name="event_date" required><br><br>

    Time:
    <input type="time" name="event_time" required><br><br>

    Priest:
    <input type="text" name="priest"><br><br>

    <button type="submit" name="add_booking">Add Booking</button>
</form>

<hr>

<h2>All Bookings</h2>

<?php
$result = $conn->query("SELECT * FROM bookings ORDER BY event_date ASC");

echo "<table border='1'>
<tr>
    <th>Event</th>
    <th>Name</th>
    <th>Date</th>
    <th>Time</th>
    <th>Priest</th>
    <th>Action</th>
</tr>";

while($row = $result->fetch_assoc()){
    echo "<tr>
        <td>{$row['event_type']}</td>
        <td>{$row['person_name']}</td>
        <td>{$row['event_date']}</td>
        <td>{$row['event_time']}</td>
        <td>{$row['priest']}</td>
        <td>
            <a href='?delete={$row['id']}' onclick=\"return confirm('Are you sure?')\">Delete</a>
        </td>
    </tr>";
}

echo "</table>";
?>

</body>
</html>