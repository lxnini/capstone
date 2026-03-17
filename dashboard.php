<?php
session_start();
include 'includes/db.php';
include 'includes/auth.php';
include 'includes/header.php';

/* =======================
   COUNT BOOKINGS
======================= */

// Binyag
$binyag = $conn->query("SELECT COUNT(*) as total FROM bookings WHERE event_type='Binyag'")->fetch_assoc()['total'];

// Wedding
$wedding = $conn->query("SELECT COUNT(*) as total FROM bookings WHERE event_type='Wedding'")->fetch_assoc()['total'];

// Funeral Mass
$funeral = $conn->query("SELECT COUNT(*) as total FROM bookings WHERE event_type='Misa sa Patay'")->fetch_assoc()['total'];

// Regular Mass (from mass_schedule table)
$mass = $conn->query("SELECT COUNT(*) as total FROM mass_schedule")->fetch_assoc()['total'];
?>

<h1>Welcome, <?php echo $_SESSION['staff_name']; ?></h1>

<h2>Dashboard Overview</h2>

<div style="display:flex; gap:20px; flex-wrap:wrap;">

    <a href="bookings.php?type=Binyag" style="text-decoration:none;">
        <div style="border:1px solid black; padding:20px; width:200px; text-align:center; background:#e3f2fd;">
            <h3>Christening</h3>
            <p><?php echo $binyag; ?></p>
        </div>
    </a>

    <a href="bookings.php?type=Wedding" style="text-decoration:none;">
        <div style="border:1px solid black; padding:20px; width:200px; text-align:center; background:#fff3e0;">
            <h3>Wedding</h3>
            <p><?php echo $wedding; ?></p>
        </div>
    </a>

    <a href="bookings.php?type=Misa sa Patay" style="text-decoration:none;">
        <div style="border:1px solid black; padding:20px; width:200px; text-align:center; background:#ffebee;">
            <h3>Funeral Mass</h3>
            <p><?php echo $funeral; ?></p>
        </div>
    </a>

    <a href="schedule.php" style="text-decoration:none;">
        <div style="border:1px solid black; padding:20px; width:200px; text-align:center; background:#e8f5e9;">
            <h3>Regular Mass</h3>
            <p><?php echo $mass; ?></p>
        </div>
    </a>

</div>