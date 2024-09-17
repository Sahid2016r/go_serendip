from flask import Flask, request, jsonify
from flask_cors import CORS
from chatbot import TravelChatbot

app = Flask(__name__)
CORS(app)  # Allow cross-origin requests

chatbot = TravelChatbot()

@app.route('/chat', methods=['POST'])
def chat():
    data = request.json
    user_message = data.get('message', '')
    bot_response = chatbot.get_response(user_message)
    return jsonify({'response': bot_response})

if __name__ == "__main__":
    app.run(debug=True)
