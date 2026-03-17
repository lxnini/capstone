<?php
include 'includes/db.php';

$result = $conn->query("SELECT * FROM mass_schedule 
ORDER BY FIELD(day,'Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'), time ASC");

echo "<h2>Regular Mass Schedule</h2>";
echo "<ul>";

while($row = $result->fetch_assoc()){
    echo "<li>
        {$row['day']} - {$row['time']} - Priest: {$row['priest']}
    </li>";
}

echo "</ul>";
?>