<?php
session_start();
include 'includes/db.php';
include 'includes/auth.php';

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

    header("Location: bookings.php?type=".$event_type);
    exit;
}

/* DELETE */
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM bookings WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    $type = isset($_GET['type']) ? $_GET['type'] : '';
    header("Location: bookings.php".($type ? "?type=".$type : ""));
    exit;
}

$type = isset($_GET['type']) ? $_GET['type'] : '';
?>

<!DOCTYPE html>
<html>
<head>
<title>Bookings</title>

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Open Sans', sans-serif;
    margin: 0;
    background: linear-gradient(to bottom, #f5f1e6, #e8dcc7);
    color: #4b2e2e;
}

.navbar {
    background: #6b3e26;
    padding: 15px 25px;
    color: white;
    display: flex;
    justify-content: space-between;
}

.navbar h2 {
    font-family: 'Playfair Display', serif;
    margin: 0;
}

.navbar a {
    color: white;
    margin-left: 15px;
    text-decoration: none;
}

.container {
    width: 90%;
    margin: auto;
    padding: 20px;
}

.grid {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 20px;
}

.card {
    background: #fffaf0;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

input, select {
    width: 100%;
    padding: 10px;
    border: 1px solid #8b5e3c;
    border-radius: 6px;
    margin-bottom: 12px;
}

button {
    width: 100%;
    padding: 10px;
    background: linear-gradient(to right, #8b5e3c, #6b3e26);
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    background: #8b5e3c;
    color: white;
    padding: 12px;
}

td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.delete-btn {
    background: #a0522d;
    color: white;
    padding: 6px 10px;
    border-radius: 5px;
    text-decoration: none;
}

.back-btn {
    display: inline-block;
    margin-bottom: 15px;
    padding: 10px 15px;
    background: #6b3e26;
    color: white;
    border-radius: 6px;
    text-decoration: none;
}
</style>
</head>

<body>

<div class="navbar">
    <h2>Church Booking System</h2>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">

<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

<h1><?php echo $type ? $type : 'All'; ?> Bookings</h1>

<div class="grid">

<!-- FORM -->
<div class="card">
<h3>Add Booking</h3>

<form method="POST">
<?php if(!$type): ?>
    <select name="event_type" required>
        <option value="Christening">Christening</option>
        <option value="Wedding">Wedding</option>
        <option value="Funeral Mass">Funeral Mass</option>
    </select>
<?php else: ?>
    <input type="hidden" name="event_type" value="<?php echo $type; ?>">
    <strong><?php echo $type; ?></strong><br><br>
<?php endif; ?>

<input type="text" name="person_name" placeholder="Name" required>
<input type="date" name="event_date" required>
<input type="time" name="event_time" required>
<input type="text" name="priest" placeholder="Priest">

<button type="submit" name="add_booking">Add Booking</button>
</form>
</div>

<!-- TABLE -->
<div class="card">
<h3>Booking List</h3>

<?php
if($type){
    $stmt = $conn->prepare("SELECT * FROM bookings WHERE event_type=? ORDER BY event_date ASC");
    $stmt->bind_param("s", $type);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM bookings ORDER BY event_date ASC");
}
?>

<table>
<tr>
<th>Event</th>
<th>Name</th>
<th>Date</th>
<th>Time</th>
<th>Priest</th>
<th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>
<tr>
<td><?= $row['event_type'] ?></td>
<td><?= $row['person_name'] ?></td>
<td><?= $row['event_date'] ?></td>
<td><?= $row['event_time'] ?></td>
<td><?= $row['priest'] ?></td>
<td>
<a class="delete-btn"
href="?delete=<?= $row['id'] ?>&type=<?= $row['event_type'] ?>"
onclick="return confirm('Delete this booking?')">
Delete
</a>
</td>
</tr>
<?php endwhile; ?>

</table>

</div>

</div>
</div>

</body>
</html>