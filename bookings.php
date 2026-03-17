$result = $conn->query("SELECT * FROM bookings ORDER BY event_date ASC");
echo "<table border='1'>
<tr><th>Event</th><th>Name</th><th>Date</th><th>Time</th><th>Priest</th><th>Actions</th></tr>";

while($row = $result->fetch_assoc()){
    echo "<tr>
    <td>{$row['event_type']}</td>
    <td>{$row['person_name']}</td>
    <td>{$row['event_date']}</td>
    <td>{$row['event_time']}</td>
    <td>{$row['priest']}</td>
    <td>
        <a href='bookings.php?edit={$row['id']}'>Edit</a> | 
        <a href='bookings.php?delete={$row['id']}'>Delete</a>
    </td>
    </tr>";
}
echo "</table>";