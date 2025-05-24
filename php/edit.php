<?php
$conn = new mysqli("localhost", "root", "", "exercisefour_db");

if (!isset($_GET['matric'])) {
    echo "Error: No matric number provided.";
    exit;
}

$matric = $conn->real_escape_string($_GET['matric']);
$result = $conn->query("SELECT * FROM STUDENT WHERE Matric='$matric'");

if ($result->num_rows == 0) {
    echo "Error: No student found with matric number $matric.";
    exit;
}

$row = $result->fetch_assoc();
?>

<form action="update.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="matric" value="<?= htmlspecialchars($row['Matric']) ?>">
    Name: <input type="text" name="name" value="<?= htmlspecialchars($row['Name']) ?>"><br>
    Email: <input type="email" name="email" value="<?= htmlspecialchars($row['Email']) ?>"><br>
    Race: <input type="text" name="race" value="<?= htmlspecialchars($row['Race']) ?>"><br>
    Gender:
    <select name="gender">
        <option value="Male" <?= $row['Gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
        <option value="Female" <?= $row['Gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
    </select><br>
    Image: <input type="file" name="image"><br>
    <input type="submit" value="Update">
</form>
