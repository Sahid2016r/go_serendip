<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - GO SERENDIP</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            transition: background-color 0.3s, color 0.3s;
            background: linear-gradient(to right, #e0f7fa, #ffffff);
            color: #333;
        }

        nav {
            width: 100%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
            display: flex;
            justify-content: space-between;
            padding: 10px 30px;
            background-color: #fff;
        }

        nav ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            transition: background-color 0.3s, color 0.3s;
            color: #00796b;
        }

        nav ul li a:hover {
            background-color: #e0f7fa;
            border-radius: 5px;
        }

        .toggle-button {
            background-color: #00796b;
            color: #ffffff;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 50%;
            transition: background-color 0.3s, color 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toggle-button:hover {
            background-color: #ffffff;
            color: #00796b;
        }

        .container {
            margin-top: 50px;
            max-width: 800px;
            text-align: center;
            padding: 20px;
        }

        h1 {
            margin-bottom: 30px;
            color: #00796b;
            font-size: 3em;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        p {
            line-height: 1.6;
            color: #555;
            font-size: 1.2em;
        }

        .section {
            margin-top: 40px;
        }

        .section h2 {
            margin-bottom: 20px;
            color: #00796b;
            font-size: 2em;
        }

        .section p {
            font-size: 1.1em;
        }

        .image-container {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .image-container img {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 100%;
            height: auto;
            transition: transform 0.3s;
        }

        .image-container img:hover {
            transform: scale(1.05);
        }

        /* Dark Mode Styles */
        .dark-mode {
            background: linear-gradient(to right, #2c3e50, #4ca1af);
            color: #ffffff;
        }

        .dark-mode nav {
            background-color: #2c3e50;
        }

        .dark-mode nav ul li a {
            color: #ffffff;
        }

        .dark-mode nav ul li a:hover {
            background-color: #34495e;
        }

        .dark-mode .toggle-button {
            background-color: #3498db;
            color: #ffffff;
        }

        .dark-mode .toggle-button:hover {
            background-color: #ffffff;
            color: #3498db;
        }

        .dark-mode h1, .dark-mode h2 {
            color: #ecf0f1;
        }

        .dark-mode p {
            color: #bdc3c7;
        }
    </style>
</head>
<body class="light-mode">
    <nav>
        <ul>
            <li><a href="home1.php">Home</a></li>
            <li><a href="about.php">About</a></li>
        </ul>
        <ul class="right-nav">
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
            <li>
                <button class="btn btn-primary toggle-button" onclick="toggleMode()">
                    <i class="fas fa-moon"></i>
                </button>
            </li>
        </ul>
    </nav>
    <div class="container">
        <h1>About_GO_SERENDIP</h1>
        <div class="section">
            <h2>Introduction</h2>
            <p>Welcome to <strong>GO SERENDIP</strong>, your ultimate travel companion for exploring the enchanting island of Sri Lanka. Our mission is to provide travelers with the most comprehensive, accurate, and up-to-date information about Sri Lanka’s rich cultural heritage, stunning landscapes, and hidden gems. Whether you are an adventure seeker, a history enthusiast, or someone looking for a relaxing beach getaway, <strong>GO SERENDIP</strong> has something for everyone.</p>
            <div class="image-container">
                <img src="image/pexels-genine-alyssa-pedreno-andrada-1263127-2403209.jpg" alt="Sri Lanka Landscape">
            </div>
        </div>
        <div class="section">
            <h2>Mission</h2>
            <p>At <strong>GO SERENDIP</strong>, our mission is to inspire and assist travelers in discovering the beauty and diversity of Sri Lanka. We strive to offer an unparalleled travel planning experience by providing detailed guides, travel tips, and local insights that ensure a memorable and enjoyable journey.</p>
            <div class="image-container">
                <img src="https://example.com/sri_lanka_mission.jpg" alt="Mission">
            </div>
        </div>
        <div class="section">
            <h2>Vision</h2>
            <p>Our vision is to become the leading travel resource for Sri Lanka, helping visitors create unforgettable memories. We aim to promote sustainable tourism and support local communities by highlighting eco-friendly practices and encouraging responsible travel.</p>
            <div class="image-container">
                <img src="https://example.com/sri_lanka_vision.jpg" alt="Vision">
            </div>
        </div>
    </div>
    <script>
        function toggleMode() {
            const body = document.body;
            const button = document.querySelector('.toggle-button');
            const icon = button.querySelector('i');
            if (body.classList.contains('light-mode')) {
                body.classList.remove('light-mode');
                body.classList.add('dark-mode');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
                localStorage.setItem('mode', 'dark');
            } else {
                body.classList.remove('dark-mode');
                body.classList.add('light-mode');
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
                localStorage.setItem('mode', 'light');
            }
        }

        function applyMode() {
            const mode = localStorage.getItem('mode');
            const button = document.querySelector('.toggle-button');
            const icon = button.querySelector('i');
            if (mode === 'dark') {
                document.body.classList.add('dark-mode');
                document.body.classList.remove('light-mode');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            } else {
                document.body.classList.add('light-mode');
                document.body.classList.remove('dark-mode');
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            }
        }

        window.onload = applyMode;
    </script>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
