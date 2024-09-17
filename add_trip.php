<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "go_serendip";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the form data is set
    if (isset($_POST['location_name'], $_POST['location_url'], $_POST['descriptions'])) {
        // Capture form data
        $location_name = $_POST['location_name'];
        $location_url = $_POST['location_url'];
        $descriptions = $_POST['descriptions'];
        $created_at = date('Y-m-d H:i:s');

        // Handle file upload
        $image_url = "";
        if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] === UPLOAD_ERR_OK) {
            $file_tmp = $_FILES['image_url']['tmp_name'];
            $file_name = basename($_FILES['image_url']['name']);
            $upload_dir = 'uploads/'; // Directory where the image will be saved
            $file_path = $upload_dir . $file_name;

            if (move_uploaded_file($file_tmp, $file_path)) {
                $image_url = $file_path;
            } else {
                echo "Error uploading the file.";
                exit;
            }
        }

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO locations (location_name, location_url, image_url, descriptions, created_at) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $location_name, $location_url, $image_url, $descriptions, $created_at);

        if ($stmt->execute()) {
            echo '<!DOCTYPE html>
                  <html lang="en">
                  <head>
                      <meta charset="UTF-8">
                      <meta name="viewport" content="width=device-width, initial-scale=1.0">
                      <title>Success</title>
                      <script>
                          alert("New location saved successfully!");
                          window.location.href = "add_trip.php";
                      </script>
                  </head>
                  <body></body>
                  </html>';
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Please fill in all required fields.";
    }
} else {
    // Display the form
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Location</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #2c3e50;
            color: #ecf0f1;
            position: fixed;
            left: 0;
            top: 0;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            z-index: 1000;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar .logo {
            text-align: center;
            padding: 20px;
            font-size: 24px;
            background-color: #1a252f;
            transition: all 0.3s;
        }

        .sidebar.collapsed .logo {
            font-size: 18px;
            padding: 15px;
        }

        .sidebar .menu ul {
            list-style: none;
            padding: 20px 0;
        }

        .sidebar .menu ul li {
            padding: 15px 20px;
            white-space: nowrap;
        }

        .sidebar .menu ul li a {
            color: #ecf0f1;
            text-decoration: none;
            font-size: 16px;
            display: flex;
            align-items: center;
            transition: all 0.3s;
        }

        .sidebar .menu ul li a i {
            margin-right: 15px;
            font-size: 20px;
        }

        .sidebar.collapsed .menu ul li a {
            justify-content: center;
        }

        .sidebar.collapsed .menu ul li a span {
            display: none;
        }

        .sidebar .menu ul li a:hover {
            background-color: #34495e;
            border-radius: 4px;
        }

        .sidebar-toggle {
            padding: 15px;
            text-align: center;
            cursor: pointer;
        }

        .sidebar-toggle i {
            color: #adb5bd;
            transition: transform 0.3s;
        }

        .sidebar.collapsed .sidebar-toggle i {
            transform: rotate(180deg);
        }

        
       
        .container {
           margin-left: 250px;
            margin-top: 60px;
            padding: 30px;
            background-color: #f4f6f9;
            min-height: calc(100vh - 120px);
            transition: margin-left 0.3s, width 0.3s;}
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        /* Footer Styling */
        .footer {
            width: calc(100% - 250px);
            margin-left: 250px;
            background-color: #2c3e50;
            color: #adb5bd;
            text-align: center;
            padding: 20px 0;
            position: fixed;
            bottom: 0;
            transition: margin-left 0.3s, width 0.3s;
            z-index: 1000;
        }

        .footer.collapsed {
            margin-left: 80px;
            width: calc(100% - 80px);
        }

        .footer a {
            color: #adb5bd;
            text-decoration: none;
        }

        .footer a:hover {
            color: #fff;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .sidebar.collapsed {
                width: 60px;
            }

            .top-nav {
                width: 100%;
                left: 0;
            }

            .footer {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="logo">GO SERENDIP</div>
       <nav class="menu">
            <ul>
                <li><a href="home.php"><i class="fas fa-chart-line"></i><span>Dashboard</span></a></li>
                <li><a href="add_trip.php"><i class="fas fa-wallet"></i><span>Add Trip Creation</span></a></li>
                <li><a href="view_locations.php"><i class="fas fa-user-cog"></i><span>View Location</span></a></li>
                <li><a href="account_management.php"><i class="fas fa-user-cog"></i><span>Account Management</span></a></li>
                <li><a href="message_requests.php"><i class="fas fa-user-cog"></i><span>Message Request </span></a></li>
                <!-- Dropdown Menu for Settings -->
                <li >
                    <a href="#"><i class="fas fa-cogs"></i><span>Settings</span></a>
                    
                </li>
                
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
            </ul>
        </nav>
        <div class="sidebar-toggle" onclick="toggleSidebar()">
            <i class="fas fa-chevron-left"></i>
        </div>
    </div>
    
    
    <!-- Page Content -->
    <div class="container">
        <h1>Add Location</h1>
        <form action="add_trip.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="location_name">Location Name</label>
                <input type="text" id="location_name" name="location_name" required>
            </div>
            <div class="form-group">
                <label for="location_url">Location URL</label>
                <input type="text" id="location_url" name="location_url" required>
            </div>
            <div class="form-group">
                <label for="descriptions">Description</label>
                <textarea id="descriptions" name="descriptions" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="image_url">Upload Image</label>
                <input type="file" id="image_url" name="image_url" accept="image/*">
            </div>
            <div class="form-group">
                <button type="submit">Save Location</button>
            </div>
        </form>
    </div>
    <!-- Footer -->
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('top-nav').classList.toggle('collapsed');
            document.getElementById('content').classList.toggle('collapsed');
            document.getElementById('footer').classList.toggle('collapsed');
        }
    </script>
</body>
</html>
<?php
}
?>
