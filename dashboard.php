<?php
session_start();
include 'includes/db.php';
include 'includes/auth.php';
include 'includes/header.php';

/* =======================
   COUNT BOOKINGS
======================= */
<<<<<<< HEAD
=======

>>>>>>> 9c194cfaf6bbc38594f7fb565efab438e1853ca8
$binyag = $conn->query("SELECT COUNT(*) as total FROM bookings WHERE event_type='Binyag'")->fetch_assoc()['total'];
$wedding = $conn->query("SELECT COUNT(*) as total FROM bookings WHERE event_type='Wedding'")->fetch_assoc()['total'];
$funeral = $conn->query("SELECT COUNT(*) as total FROM bookings WHERE event_type='Misa sa Patay'")->fetch_assoc()['total'];
$mass = $conn->query("SELECT COUNT(*) as total FROM mass_schedule")->fetch_assoc()['total'];
?>

<<<<<<< HEAD
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            background: linear-gradient(to bottom, #f5f1e6, #e8dcc7);
            color: #4b2e2e;
        }

        h1, h2 {
            font-family: 'Playfair Display', serif;
        }

        .container {
            width: 90%;
            margin: 30px auto;
        }

        /* BUTTONS */
        .btn-group {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
        }

        .btn-group a {
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-home { background: #2196f3; }
        .btn-home:hover { background: #1976d2; }

        .btn-add { background: #4caf50; }
        .btn-add:hover { background: #388e3c; }

        /* DASHBOARD CARDS */
        .cards {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .card {
            flex: 1 1 200px;
            padding: 20px;
            text-align: center;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: 0.3s;
            color: #4b2e2e;
            text-decoration: none;
        }

        .card h3 {
            margin-bottom: 10px;
        }

        .card p {
            font-size: 28px;
            font-weight: bold;
            margin: 0;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 18px rgba(0,0,0,0.2);
        }

        .card.christening { background: #e3f2fd; }
        .card.wedding { background: #fff3e0; }
        .card.funeral { background: #ffebee; }
        .card.regular { background: #e8f5e9; }

    </style>
</head>
<body>
<div class="container">
    <h1>Welcome, <?php echo $_SESSION['staff_name']; ?></h1>
    <h2>Dashboard Overview</h2>

    <!-- BUTTONS -->
    <div class="btn-group">
        <a href="dashboard.php" class="btn-home">Home</a>
        <a href="bookings.php" class="btn-add">Add Booking</a>
    </div>

    <!-- DASHBOARD CARDS -->
    <div class="cards">
        <a href="bookings.php?type=Binyag" class="card christening">
=======
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
>>>>>>> 9c194cfaf6bbc38594f7fb565efab438e1853ca8
            <h3>Christening</h3>
            <p><?php echo $binyag; ?></p>
        </a>

<<<<<<< HEAD
        <a href="bookings.php?type=Wedding" class="card wedding">
=======
        <a href="bookings.php?type=Wedding" class="box">
>>>>>>> 9c194cfaf6bbc38594f7fb565efab438e1853ca8
            <h3>Wedding</h3>
            <p><?php echo $wedding; ?></p>
        </a>

<<<<<<< HEAD
        <a href="bookings.php?type=Misa sa Patay" class="card funeral">
=======
        <a href="bookings.php?type=Misa sa Patay" class="box">
>>>>>>> 9c194cfaf6bbc38594f7fb565efab438e1853ca8
            <h3>Funeral Mass</h3>
            <p><?php echo $funeral; ?></p>
        </a>

<<<<<<< HEAD
        <a href="schedule.php" class="card regular">
            <h3>Regular Mass</h3>
            <p><?php echo $mass; ?></p>
        </a>
    </div>
</div>
</body>
</html>
=======
        <a href="schedule.php" class="box">
            <h3>Regular Mass</h3>
            <p><?php echo $mass; ?></p>
        </a>

    </div>

</div>
>>>>>>> 9c194cfaf6bbc38594f7fb565efab438e1853ca8
