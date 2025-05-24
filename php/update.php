<?php
$conn = new mysqli("localhost", "root", "", "exercisefour_db");

// Check if the form is submitted using POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Invalid access method.";
    exit;
}

// Validate fields before using them
$matric = $_POST['matric'] ?? '';
$name   = $_POST['name'] ?? '';
$email  = $_POST['email'] ?? '';
$race   = $_POST['race'] ?? '';
$gender = $_POST['gender'] ?? '';

$imageName = $_FILES['image']['name'] ?? '';
$imagePath = '';

if (!empty($imageName)) {
    $targetDir = "uploads/";
    $imagePath = $targetDir . basename($imageName);
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
        // Upload success
    } else {
        echo "Failed to upload image.";
        $imagePath = '';
    }
}

// Build SQL query
if ($imagePath !== '') {
    $sql = "UPDATE STUDENT SET Name='$name', Email='$email', Race='$race', Gender='$gender', Image='$imageName' WHERE Matric='$matric'";
} else {
    $sql = "UPDATE STUDENT SET Name='$name', Email='$email', Race='$race', Gender='$gender' WHERE Matric='$matric'";
}

if ($conn->query($sql)) {
    echo "Record updated successfully.";
} else {
    echo "Error updating record: " . $conn->error;
}
?>
