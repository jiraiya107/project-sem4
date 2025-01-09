<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Replace with your MySQL password
$dbname = "e_learning";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course_title = $conn->real_escape_string($_POST['course_title']);
    $course_description = $conn->real_escape_string($_POST['course_description']);

    // Handling file uploads
    $thumbnail_dir = "../uploads/thumbnails/";
    $content_dir = "../uploads/content/";

    if (!is_dir($thumbnail_dir)) mkdir($thumbnail_dir, 0777, true);
    if (!is_dir($content_dir)) mkdir($content_dir, 0777, true);

    $thumbnail_file = $thumbnail_dir . basename($_FILES['course_thumbnail']['name']);
    $content_file = $content_dir . basename($_FILES['course_content']['name']);

    if (move_uploaded_file($_FILES['course_thumbnail']['tmp_name'], $thumbnail_file) &&
        move_uploaded_file($_FILES['course_content']['tmp_name'], $content_file)) {

        // Insert data into the database
        $sql = "INSERT INTO courses (title, description, thumbnail_path, content_path)
                VALUES ('$course_title', '$course_description', '$thumbnail_file', '$content_file')";

        if ($conn->query($sql) === TRUE) {
            echo "Course uploaded successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading files.";
    }
}

$conn->close();
?>
