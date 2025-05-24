<?php
$conn = new mysqli("localhost", "root", "", "exercisefour_db");

$filter = $_GET['filter'] ?? '';
$type = $_GET['type'] ?? '';

$query = "SELECT * FROM STUDENT";
if ($type == 'race') {
    $query .= " WHERE Race='$filter'";
} elseif ($type == 'gender') {
    $query .= " WHERE Gender='$filter'";
}

$result = $conn->query($query);
?>

<form method="GET">
    Search by:
    <select name="type">
        <option value="race">Race</option>
        <option value="gender">Gender</option>
    </select>
    <input type="text" name="filter">
    <input type="submit" value="Search">
</form>

<table border="1">
    <tr><th>Matric</th><th>Name</th><th>Email</th><th>Race</th><th>Gender</th><th>Image</th></tr>
    <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['Matric'] ?></td>
            <td><?= $row['Name'] ?></td>
            <td><?= $row['Email'] ?></td>
            <td><?= $row['Race'] ?></td>
            <td><?= $row['Gender'] ?></td>
            <td>
                <?php if ($row['Image']): ?>
                    <img src="uploads/<?= $row['Image'] ?>" width="50">
                <?php endif; ?>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
