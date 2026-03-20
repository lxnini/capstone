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

    header("Location: bookings.php?type=".$event_type);
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

    $type = isset($_GET['type']) ? $_GET['type'] : '';
    header("Location: bookings.php".($type ? "?type=".$type : ""));
    exit;
}

$type = isset($_GET['type']) ? $_GET['type'] : '';
?>

<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background: #f4f6f9;
}

.container {
    width: 90%;
    max-width: 1000px;
    margin: auto;
}

.card {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    margin-bottom: 20px;
}

h1, h2 {
    margin-bottom: 15px;
}

input, select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

button {
    background: #4CAF50;
    color: white;
    border: none;
    padding: 10px;
    width: 100%;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background: #45a049;
}

.back-btn {
    display: inline-block;
    margin-bottom: 15px;
    padding: 8px 15px;
    background: #2196f3;
    color: white;
    text-decoration: none;
    border-radius: 5px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table th {
    background: #333;
    color: white;
    padding: 10px;
}

table td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

table tr:hover {
    background: #f1f1f1;
}

.delete-btn {
    color: red;
    text-decoration: none;
}
</style>

<div class="container">

    <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

    <div class="card">
        <h1><?php echo $type ? $type : 'All'; ?> Bookings</h1>
    </div>

    <!-- FORM CARD -->
    <div class="card">
        <h2>Add Booking</h2>
        <form method="POST">

            <?php if(!$type): ?>
                <label>Event Type</label>
                <select name="event_type" required>
                    <option value="Binyag">Binyag</option>
                    <option value="Wedding">Wedding</option>
                    <option value="Misa sa Patay">Misa sa Patay</option>
                </select>
            <?php else: ?>
                <input type="hidden" name="event_type" value="<?php echo $type; ?>">
                <p><strong>Event:</strong> <?php echo $type; ?></p>
            <?php endif; ?>

            <label>Name</label>
            <input type="text" name="person_name" required>

            <label>Date</label>
            <input type="date" name="event_date" required>

            <label>Time</label>
            <input type="time" name="event_time" required>

            <label>Priest</label>
            <input type="text" name="priest">

            <button type="submit" name="add_booking">Add Booking</button>
        </form>
    </div>

    <!-- TABLE CARD -->
    <div class="card">
        <h2>Booking List</h2>

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