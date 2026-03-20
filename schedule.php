<?php
session_start();
include 'includes/db.php';
include 'includes/auth.php';
include 'includes/header.php';

// Handle Add Schedule
if(isset($_POST['add_schedule'])){
    $day = $_POST['day'];
    $time = $_POST['time'];
    $priest = $_POST['priest'];

    $stmt = $conn->prepare("INSERT INTO mass_schedule (day, time, priest) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $day, $time, $priest);
    $stmt->execute();
    $stmt->close();

    header("Location: schedule.php");
    exit;
}
?>

<h1>Regular Mass Schedule</h1>

<!-- Back to Dashboard -->
<div style="margin-bottom:20px;">
    <a href="dashboard.php" style="padding:10px 20px; background:#2196f3; color:white; text-decoration:none; border-radius:5px;">Back to Dashboard</a>
</div>

<!-- Add Regular Mass Form -->
<h2>Add Regular Mass</h2>
<link rel="stylesheet" href="css/style.css">
<form method="POST">
    Day:
    <select name="day" required>
        <option value="Sunday">Sunday</option>
        <option value="Monday">Monday</option>
        <option value="Tuesday">Tuesday</option>
        <option value="Wednesday">Wednesday</option>
        <option value="Thursday">Thursday</option>
        <option value="Friday">Friday</option>
        <option value="Saturday">Saturday</option>
    </select><br><br>

    Time:
    <input type="time" name="time" required><br><br>

    Priest:
    <input type="text" name="priest"><br><br>

    <button type="submit" name="add_schedule">Add Schedule</button>
</form>

<hr>

<h2>Existing Schedule</h2>
<table border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>Day</th>
    <th>Time</th>
    <th>Priest</th>
</tr>
<?php
$result = $conn->query("SELECT * FROM mass_schedule ORDER BY FIELD(day,'Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'), time ASC");
while($row = $result->fetch_assoc()){
    echo "<tr>
        <td>{$row['day']}</td>
        <td>{$row['time']}</td>
        <td>{$row['priest']}</td>
    </tr>";
}
?>
</table>