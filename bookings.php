<?php
session_start();
include 'includes/db.php';
include 'includes/auth.php';
include 'includes/header.php';

/* =======================
   HANDLE NEW BOOKING
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

    header("Location: bookings.php?type=".$event_type); // refresh and keep filter
    exit;
}

/* =======================
   HANDLE DELETE BOOKING
======================= */
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM bookings WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    // Keep filter if exists
    $type = isset($_GET['type']) ? $_GET['type'] : '';
    header("Location: bookings.php".($type ? "?type=".$type : ""));
    exit;
}

/* =======================
   GET FILTER TYPE
======================= */
$type = isset($_GET['type']) ? $_GET['type'] : '';
?>

<!-- BACK TO DASHBOARD BUTTON -->
<div style="margin-bottom:20px;">
    <a href="dashboard.php" style="padding:10px 20px; background:#2196f3; color:white; text-decoration:none; border-radius:5px;">Back to Dashboard</a>
</div>

<h1><?php echo $type ? $type : 'All'; ?> Bookings</h1>

<!-- ADD BOOKING FORM -->
<h2>Add Booking</h2>
<form method="POST">
    <?php if(!$type): ?>
        Event Type:
        <select name="event_type" required>
            <option value="Binyag">Binyag</option>
            <option value="Wedding">Wedding</option>
            <option value="Misa sa Patay">Misa sa Patay</option>
        </select><br><br>
    <?php else: ?>
        <input type="hidden" name="event_type" value="<?php echo $type; ?>">
        Event: <strong><?php echo $type; ?></strong><br><br>
    <?php endif; ?>

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

<!-- BOOKINGS TABLE -->
<?php
if($type){
    $stmt = $conn->prepare("SELECT * FROM bookings WHERE event_type=? ORDER BY event_date ASC");
    $stmt->bind_param("s", $type);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM bookings ORDER BY event_date ASC");
}

echo "<table border='1' cellpadding='5' cellspacing='0'>
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
            <a href='?delete={$row['id']}&type={$row['event_type']}' onclick=\"return confirm('Are you sure you want to delete this booking?')\">Delete</a>
        </td>
    </tr>";
}

echo "</table>";
?>