<?php
$conn = new mysqli("localhost", "root", "", "exercisefour_db");

$result = $conn->query("SELECT Matric, Name FROM STUDENT");

echo "<h2>Student List</h2>";
echo "<ul>";

while ($row = $result->fetch_assoc()) {
    $matric = htmlspecialchars($row['Matric']);
    $name = htmlspecialchars($row['Name']);
    echo "<li><a href='edit.php?matric=$matric'>$name ($matric)</a></li>";
}

echo "</ul>";
?>
