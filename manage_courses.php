<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #e0e0e0;
            color: #333;
            padding: 20px;
            height: 100vh;
        }
        .sidebar h2 {
            text-align: center;
            color: #333;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            margin: 20px 0;
        }
        .sidebar ul li a {
            color: #333;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 4px;
            background-color: #d6d6d6;
            text-align: center;
            transition: 0.3s;
        }
        .sidebar ul li a:hover {
            background-color: #bdbdbd;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #ffffff;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            text-align: left;
            padding: 12px;
            color: #333;
        }
        th {
            background-color: #d6d6d6;
            color: #000;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e0e0e0;
        }
        .btn {
            padding: 8px 12px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            color: #fff;
        }
        .btn-edit {
            background-color: #ffa726;
        }
        .btn-delete {
            background-color: #ef5350;
        }
        .btn-edit:hover {
            background-color: #fb8c00;
        }
        .btn-delete:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="admin.html">Upload Course</a></li>
            <li><a href="manage_courses.php">Manage Courses</a></li>
            <li><a href="upload_video.php">Upload Video</a></li>
            <li><a href="manage_videos.php">Manage Videos</a></li>
            <li><a href="settings.php">Settings</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Manage Courses</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Thumbnail</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch courses from the database
                $conn = new mysqli("localhost", "root", "", "e_learning");

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM courses";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['title']}</td>
                            <td>{$row['description']}</td>
                            <td><img src='{$row['thumbnail_path']}' alt='Thumbnail' width='50'></td>
                            <td>
                                <a href='edit_course.php?id={$row['id']}' class='btn btn-edit'>Edit</a>
                                <a href='delete_course.php?id={$row['id']}' class='btn btn-delete'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No courses found.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
