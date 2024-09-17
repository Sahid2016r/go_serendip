<?php
// Include database connection file
include 'db_connect.php';

// Handle customer request submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_request'])) {
    $customer_name = $conn->real_escape_string($_POST['customer_name']);
    $location_name = $conn->real_escape_string($_POST['location_name']);
    $location_url = $conn->real_escape_string($_POST['location_url']);
    $message = $conn->real_escape_string($_POST['message']);
    
    // Handle image upload
    if ($_FILES['location_image']['name']) {
        $image_path = 'uploads/' . basename($_FILES['location_image']['name']);
        move_uploaded_file($_FILES['location_image']['tmp_name'], $image_path);
    } else {
        $image_path = '';  // No image uploaded
    }

    // Insert request into the database
    $insert_sql = "INSERT INTO message_requests (customer_name, location_name, location_url, location_image, message) 
                   VALUES ('$customer_name', '$location_name', '$location_url', '$image_path', '$message')";

    if ($conn->query($insert_sql) === TRUE) {
        echo "<script>alert('Request submitted successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $insert_sql . "<br>" . $conn->error . "');</script>";
    }
}

// Handle admin reply
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_reply'])) {
    $id = intval($_POST['message_id']);
    $reply = $conn->real_escape_string($_POST['reply']);

    // Update the reply in the database
    $update_sql = "UPDATE message_requests SET reply = '$reply' WHERE id = $id";

    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Reply submitted successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $update_sql . "<br>" . $conn->error . "');</script>";
    }
}

// Fetch all customer requests
$sql = "SELECT * FROM message_requests ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Requests</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        input[type="text"], input[type="url"], textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .submit-button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #218838;
        }

        .chat-container {
            background-color: #e9ecef;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .message-item {
            margin-bottom: 20px;
        }

        .customer-message, .admin-reply {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 20px;
            max-width: 80%;
            word-wrap: break-word;
            margin-bottom: 10px;
        }

        .customer-message {
            background-color: #dcf8c6;
            color: #333;
            float: left;
            clear: both;
        }

        .admin-reply {
            background-color: #f1f0f0;
            color: #333;
            float: right;
            clear: both;
        }

        .chat-timestamp {
            font-size: 12px;
            color: #999;
            text-align: right;
        }

        .message-form {
            margin-top: 20px;
        }

        .image-preview {
            max-width: 100px;
            height: auto;
            margin-top: 10px;
        }

        .clearfix::after {
            content: "";
            display: block;
            clear: both;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Submit Location Details</h2>
    <!-- Customer Request Form -->
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <input type="text" name="customer_name" placeholder="Your Name" required>
        </div>
        <div class="form-group">
            <input type="text" name="location_name" placeholder="Location Name" required>
        </div>
        <div class="form-group">
            <input type="url" name="location_url" placeholder="Location URL" required>
        </div>
        <div class="form-group">
            <label for="location_image">Location Image (optional):</label>
            <input type="file" name="location_image" id="location_image">
        </div>
        <div class="form-group">
            <textarea name="message" rows="4" placeholder="Message" required></textarea>
        </div>
        <button type="submit" name="submit_request" class="submit-button">Send</button>
    </form>

    <div class="chat-container">
        <h3>Chat History</h3>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "
                    <div class='message-item clearfix'>
                        <div class='customer-message'>
                            <p><strong>{$row['customer_name']}</strong> - {$row['location_name']}</p>
                            <p>{$row['message']}</p>
                            <p><strong>URL:</strong> <a href='{$row['location_url']}' target='_blank'>{$row['location_url']}</a></p>";
                
                if ($row['location_image']) {
                    echo "<img src='{$row['location_image']}' alt='Location Image' class='image-preview'>";
                }

                echo "<p class='chat-timestamp'>{$row['created_at']}</p>
                        </div>";

                // Admin Reply (if available)
                if (!empty($row['reply'])) {
                    echo "<div class='admin-reply'>
                            <p><strong>Admin Reply:</strong> {$row['reply']}</p>
                            <p class='chat-timestamp'>{$row['created_at']}</p>
                          </div>";
                }

                // Reply form for admin
                echo "<div class='message-form'>
                        <form action='' method='POST'>
                            <textarea name='reply' rows='2' placeholder='Reply...' required>{$row['reply']}</textarea>
                            <input type='hidden' name='message_id' value='{$row['id']}'>
                            <button type='submit' name='submit_reply' class='submit-button'>Reply</button>
                        </form>
                      </div>
                    </div>";
            }
        } else {
            echo "<p>No messages found.</p>";
        }
        ?>
    </div>
</div>

</body>
</html>
