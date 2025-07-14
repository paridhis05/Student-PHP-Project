<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Student Portal</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }

        body {
            display: flex;
            height: 100vh;
            background: #f5f7fa;
        }

        /* Sidebar */
        .sidebar {
            width: 220px;
            background-color: #043763;
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            color: white;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            padding-bottom: 10px;
        }

        .nav-link {
            text-decoration: none;
            color: white;
            font-weight: 500;
            padding: 12px 15px;
            margin: 6px 0;
            border-radius: 6px;
            transition: background 0.3s;
        }

        .nav-link:hover {
            background: #0a4c85;
        }

        /* Main content */
        .main-content {
            flex: 1;
            padding: 40px;
        }

        .main-content h1 {
            color: #043763;
            font-size: 36px;
            margin-bottom: 20px;
        }

        .main-content p {
            font-size: 18px;
            color: #444;
            max-width: 700px;
            line-height: 1.6;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Student Panel</h2>
        <a href="home.php" class="nav-link">Home</a>
        <a href="form.php" class="nav-link">Register Student</a>
        <a href="table.php" class="nav-link">Student Records</a>
        <a href="form.php" class="nav-link">Payment Dashboard</a>
        <a href="marks.php" class="nav-link">Enter Marks</a>
        <a href="logout.php" class="nav-link">Logout</a>
    </div>

    <div class="main-content">
        <h1>Welcome to the Student Management System</h1>
    </div>

</body>
</html>
