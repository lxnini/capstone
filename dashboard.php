<?php
session_start();
include 'includes/db.php';
include 'includes/auth.php';
include 'includes/header.php';

/* =======================
   COUNT BOOKINGS
======================= */

$binyag = $conn->query("SELECT COUNT(*) as total FROM bookings WHERE event_type='Binyag'")->fetch_assoc()['total'];
$wedding = $conn->query("SELECT COUNT(*) as total FROM bookings WHERE event_type='Wedding'")->fetch_assoc()['total'];
$funeral = $conn->query("SELECT COUNT(*) as total FROM bookings WHERE event_type='Misa sa Patay'")->fetch_assoc()['total'];
$mass = $conn->query("SELECT COUNT(*) as total FROM mass_schedule")->fetch_assoc()['total'];
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
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    margin-bottom: 20px;
}

h1 {
    margin-bottom: 10px;
}

.top-buttons {
    margin-bottom: 20px;
}

.btn {
    padding: 10px 20px;
    border-radius: 5px;
    color: white;
    text-decoration: none;
    margin-right: 10px;
}

.btn-blue {
    background: #2196f3;
}

.btn-green {
    background: #4CAF50;
}

/* SAME STYLE AS BOOKINGS TABLE FEEL */
.cards {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
}

.box {
    background: #fff;
    padding: 20px;
    width: 200px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    text-align: center;
    text-decoration: none;
    color: #333;
}

.box:hover {
    background: #f1f1f1;
}

.box h3 {
    margin-bottom: 10px;
    font-size: 16px;
    color: #555;
}

.box p {
    font-size: 22px;
    font-weight: bold;
}
</style>

<div class="container">

    <!-- HEADER -->
    <div class="card">
        <h1>Welcome, <?php echo $_SESSION['staff_name']; ?></h1>
        <h3>Dashboard Overview</h3>
    </div>

    <!-- BUTTONS -->
    <div class="top-buttons">
        <a href="dashboard.php" class="btn btn-blue">Home</a>
        <a href="bookings.php" class="btn btn-green">Add Booking</a>
    </div>

    <!-- SIMPLE BOXES (same feel sa bookings) -->
    <div class="cards">

        <a href="bookings.php?type=Binyag" class="box">
            <h3>Christening</h3>
            <p><?php echo $binyag; ?></p>
        </a>

        <a href="bookings.php?type=Wedding" class="box">
            <h3>Wedding</h3>
            <p><?php echo $wedding; ?></p>
        </a>

        <a href="bookings.php?type=Misa sa Patay" class="box">
            <h3>Funeral Mass</h3>
            <p><?php echo $funeral; ?></p>
        </a>

        <a href="schedule.php" class="box">
            <h3>Regular Mass</h3>
            <p><?php echo $mass; ?></p>
        </a>

    </div>

</div>