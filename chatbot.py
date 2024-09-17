from nltk.chat.util import Chat, reflections

# Define patterns and responses
pairs = [
    (r'hi|hello', ['Hello! How can I assist you with your travel plans in Sri Lanka?']),
    (r'what can I do in (.*)', ['In Sri Lanka, you can visit beautiful places like Colombo, Kandy, and Sigiriya. What interests you?']),
    (r'where can I stay in (.*)', ['There are many hotels and resorts in Sri Lanka. You can check options in cities like Colombo, Kandy, and Galle.']),
    (r'what is the best time to visit (.*)', ['The best time to visit Sri Lanka is from December to March for the west coast and from April to September for the east coast.']),
    (r'(.*) (thanks|thank you)', ['You’re welcome! Let me know if you need any more help.']),
    (r'(.*)', ['Sorry, I didn’t understand that. Can you please rephrase?'])
]

class TravelChatbot:
    def __init__(self):
        self.chatbot = Chat(pairs, reflections)

    def get_response(self, message):
        return self.chatbot.respond(message)

if __name__ == "__main__":
    chatbot = TravelChatbot()
    while True:
        user_input = input("You: ")
        response = chatbot.get_response(user_input)
        print("Bot:", response)
