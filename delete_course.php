<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "e_learning");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the course ID from the URL
if (isset($_GET['id'])) {
    $course_id = intval($_GET['id']);

    // Fetch course thumbnail and content file paths for cleanup
    $fetch_query = "SELECT thumbnail_path, content_path FROM courses WHERE id = $course_id";
    $result = $conn->query($fetch_query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $thumbnail_path = $row['thumbnail_path'];
        $content_path = $row['content_path'];

        // Delete the files if they exist
        if (file_exists($thumbnail_path)) {
            unlink($thumbnail_path);
        }
        if (file_exists($content_path)) {
            unlink($content_path);
        }
    }

    // Delete the course from the database
    $delete_query = "DELETE FROM courses WHERE id = $course_id";

    if ($conn->query($delete_query) === TRUE) {
        echo "<script>alert('Course deleted successfully.'); window.location.href='manage_courses.php';</script>";
    } else {
        echo "<script>alert('Error deleting course: " . $conn->error . "'); window.location.href='manage_courses.php';</script>";
    }
} else {
    echo "<script>alert('Invalid course ID.'); window.location.href='manage_courses.php';</script>";
}

// Close the connection
$conn->close();
?>
