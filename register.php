<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #e0f7fa, #fff);
            color: #333;
            line-height: 1.6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .container {
            max-width: 800px;
            width: 100%;
            padding: 30px;
            background-color: #ffffff; /* Solid background color */
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-right: 20px;
        }

        h1 {
            margin-bottom: 20px;
            color: #00796b;
            text-align: center;
        }

        .form-row {
            display: flex;
            width: 100%;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .form-column {
            flex: 1;
            padding: 0 10px;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
            display: block;
        }

        input, select {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: border-color 0.3s, box-shadow 0.3s;
            font-size: 16px;
        }

        input:focus, select:focus {
            border-color: #00796b;
            box-shadow: 0 0 5px rgba(0, 121, 107, 0.5);
            outline: none;
        }

        button {
            background-color: #00796b;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
            width: 50%;
            margin-top: 10px;
        }

        button:hover {
            background-color: #004d40;
            transform: translateY(-2px);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            width: 100%;
            color: #333; /* Text color for contrast */
        }

        .login-link a {
            color: #00796b; /* Link color */
            text-decoration: underline;
            font-weight: bold;
        }

        /* Dark Mode Styles */
        .dark-mode {
            background: #2c3e50;
            color: #ecf0f1;
        }

        .dark-mode .container {
            background-color: #34495e;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        .dark-mode h1 {
            color: #ffff;
        }

        .dark-mode label {
            color: #ecf0f1;
        }

        .dark-mode input, .dark-mode select {
            border: 1px solid #95a5a6;
            background-color: #2c3e50;
            color: #ecf0f1;
        }

        .dark-mode input:focus, .dark-mode select:focus {
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
        }

        .dark-mode button {
            background-color: #00796b;
        }

        .dark-mode .login-link {
            color: #ecf0f1;
        }

        .dark-mode .login-link a {
            color: #3498db; /* Link color in dark mode */
        }
    </style>
</head>
<body class="light-mode">
    <div class="container">
        <h1>Register</h1>
        <form action="register_process.php" method="POST">
            <div class="form-row">
                <div class="form-column">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                    
                
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-column">
                    
                    <label for="privacy">Privacy:</label>
                    <select id="privacy" name="privacy">
                        <option value="public">Public</option>
                        <option value="private">Private</option>
                    </select>
                     <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                    
                </div>
            </div>
            <center><button type="submit">Register</button></center>
        </form>
        <div class="login-link">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>

    <script>
        // Toggle dark mode based on user preference
        const themeSelect = document.getElementById('theme');
        themeSelect.addEventListener('change', function() {
            if (this.value === 'dark') {
                document.body.classList.add('dark-mode');
                document.body.classList.remove('light-mode');
            } else {
                document.body.classList.remove('dark-mode');
                document.body.classList.add('light-mode');
            }
        });
    </script>
</body>
</html>
