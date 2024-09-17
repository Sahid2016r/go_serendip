<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Chatbox</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #e0f7fa, #ffffff);
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }

        nav {
            background-color: #ffffff;
            width: 100%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 10px 150px;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: #00796b;
            font-weight: bold;
            padding: 10px 20px;
            transition: background-color 0.3s, color 0.3s;
        }

        nav ul li a:hover {
            background-color: #00796b;
            color: #ffffff;
            border-radius: 4px;
        }

        h1 {
            margin: 20px 0;
            color: #00796b;
        }

        #chatbox {
            width: 300px;
            height: 400px;
            border: 1px solid #00796b;
            padding: 10px;
            overflow-y: scroll;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
        }

        #userInput {
            width: 300px;
            padding: 10px;
            border: 1px solid #00796b;
            border-radius: 4px;
            outline: none;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <nav>
        <ul id="user-links">
            <li><a href="home.php">Home</a></li>
            <li><a href="search.php">Search Trips</a></li>
            <li><a href="create_trip.php">Create Trip</a></li>
            <li><a href="map.php">Explore Map</a></li>
            <li><a href="budget.php">Budget Plan</a></li>
            <li><a href="chatbox.php">Chatbox</a></li>
            <li><a href="review.php">Review</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="wishlist.php">Wishlist</a></li>
        </ul>
    </nav>

    <h1>AI Chatbox</h1>
    <div id="chatbox"></div>
    <input type="text" id="userInput" placeholder="Type a message..." onkeydown="if(event.key === 'Enter') sendMessage()">

    <script>
        function sendMessage() {
            var userInput = document.getElementById('userInput').value;
            var chatbox = document.getElementById('chatbox');
            chatbox.innerHTML += `<div><strong>You:</strong> ${userInput}</div>`;

            fetch('https://api.dialogflow.com/v1/query?v=20150910', {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer YOUR_DIALOGFLOW_CLIENT_ACCESS_TOKEN',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    query: userInput,
                    lang: 'en',
                    sessionId: '1234567890'
                })
            })
            .then(response => response.json())
            .then(data => {
                var botResponse = data.result.fulfillment.speech;
                chatbox.innerHTML += `<div><strong>Bot:</strong> ${botResponse}</div>`;
                chatbox.scrollTop = chatbox.scrollHeight;
            });

            document.getElementById('userInput').value = '';
        }
    </script>
</body>
</html>
