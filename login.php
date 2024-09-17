<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #e0f7fa, #ffffff);
        }

        .container {
            max-width: 400px;
            width: 100%;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        h1 {
            margin-bottom: 20px;
            color: #00796b;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        form input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: border-color 0.3s, box-shadow 0.3s;
            font-size: 16px;
        }

        form input:focus {
            border-color: #00796b;
            box-shadow: 0 0 5px rgba(0, 121, 107, 0.5);
            outline: none;
        }

        form .btn-primary {
            background-color: #00796b;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
            width: 100%;
            margin-top: 10px;
        }

        form .btn-primary:hover {
            background-color: #004d40;
            transform: translateY(-2px);
        }

        .error-message {
            color: #d32f2f;
            text-align: center;
            margin-top: 10px;
        }
        .register-link {
            text-align: center;
            margin-top: 20px;
        }

        .register-link a {
            color: #00796b;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .register-link a:hover {
            color: #004d40;
        }

        .toggle-button {
            background-color: #004d40;
            color: #ffffff;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 50%;
            transition: background-color 0.3s, color 0.3s;
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .back-button {
            background-color: #00796b;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #004d40;
        }

        
    </style>
</head>
<body class="light-mode">
    <div class="container">
        
        <h1>Login</h1>
        <form method="post" action="login_process.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn-primary">Login</button>
        </form>
        <?php if (isset($error_message)): ?>
            <div class="error-message">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        <div class="register-link">
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
        <button class="back-button" onclick="window.location.href='home1.php'">Back to Home</button>
    </div>
    
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
