<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        /* General Reset */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #fff;
            border-bottom: 1px solid #e0e0e0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .logo img {
            height: 80px;
            width: auto;
        }
        nav {
            display: flex;
            gap: 20px;
            align-items: center;
        }
        nav a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        nav a:hover {
            color: #3b82f6;
        }
        .btn {
            padding: 10px 20px;
            border: 2px solid #3b82f6;
            border-radius: 6px;
            color: #3b82f6;
            background-color: transparent;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #3b82f6;
            color: #fff;
        }
        .search-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid #ccc;
            border-radius: 50px;
            padding: 5px 10px;
            max-width: 300px;
        }
        .search-bar input {
            border: none;
            outline: none;
            width: 100%;
        }
        .search-bar button {
            background-color: #3b82f6;
            border: none;
            border-radius: 50%;
            color: #fff;
            width: 30px;
            height: 30px;
        }
        /* Course Cards */
        .course-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .course-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .course-thumbnail {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .course-details {
            padding: 15px;
        }
        .course-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .course-description {
            color: #555;
            margin: 10px 0;
        }
        .btn-course {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3b82f6;
            color: #fff;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-course:hover {
            background-color: #2c6fd9;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo">
            <a>
                <img src="../assets/logo.png" alt="E-Learning Logo">
            </a>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="What do you want to learn?">
            <button>&#128269;</button>
        </div>
        <nav>
            <a href="./aboutus.html">About Us</a>
            <a href="./careers.html">Careers</a>
            <a href="./profile.html">Profile</a>
        </nav>
    </header>

    <!-- Course Section -->
    <div class="course-container">
        <?php
        // Database connection
        $conn = new mysqli("localhost", "root", "", "e_learning");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch courses
        $sql = "SELECT * FROM courses";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "
                <div class='course-card'>
                    <img src='{$row['thumbnail_path']}' alt='Course Thumbnail' class='course-thumbnail'>
                    <div class='course-details'>
                        <div class='course-title'>{$row['title']}</div>
                        <div class='course-description'>" . substr($row['description'], 0, 100) . "...</div>
                        <a href='view_course.php?id={$row['id']}' class='btn-course'>View Course</a>
                    </div>
                </div>
                ";
            }
        } else {
            echo "<p>No courses available at the moment.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
