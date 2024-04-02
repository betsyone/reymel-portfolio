<?php
// Main entry point - Ensure this script only handles GET and POST requests
if (isset($_SERVER["REQUEST_METHOD"]) && ($_SERVER["REQUEST_METHOD"] === "GET" || $_SERVER["REQUEST_METHOD"] === "POST")) {
    // Check if the request is coming from LexiBot and if the question parameter is provided
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["question"])) {
        // Get the user's question from the request
        $userQuestion = $_POST["question"];

        // Process the user's question and generate a response
        $botResponse = getBotResponse($userQuestion);

        // Send the bot's response back to LexiBot
        echo json_encode(["answer" => $botResponse]);
    } elseif ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["question"])) {
        // Get the user's question from the request
        $userQuestion = $_GET["question"];

        // Process the user's question and generate a response
        $botResponse = getBotResponse($userQuestion);

        // Send the bot's response back to LexiBot
        echo json_encode(["answer" => $botResponse]);
    } else {
        // If the question parameter is missing, return an error
        http_response_code(400);
        echo "Bad Request: Question parameter is missing";
    }
} else {
    // If the request method is not GET or POST, return an error
    http_response_code(405);
    echo "Method Not Allowed: Only GET and POST requests are allowed";
}

// Function to process the user's question and generate a response
function getBotResponse($question) {
    // Static responses based on user's question
    switch ($question) {
        case "What is your name?":
            return "I'm LexiBot!";
        case "How are you?":
            return "I'm doing great, thanks for asking!";
        default:
            return "I'm sorry, I don't understand your question.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Simple Chatbot</title>
<style>
    .container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
}

#chat-container {
    margin-bottom: 10px;
    padding: 10px;
    border: 1px solid #ccc;
    height: 300px;
    overflow-y: auto;
}

.user-message {
    text-align: right;
    color: blue;
}

.bot-message {
    text-align: left;
    color: green;
}

</style>
</head>
<body>

<div class="container">
    <h1>Simple Chatbot</h1>
    <div id="chat-container"></div>
    <input type="text" id="user-input" placeholder="Type your message...">
    <button id="send-button">Send</button>
</div>

<script>
    const chatContainer = document.getElementById('chat-container');
const userInput = document.getElementById('user-input');
const sendButton = document.getElementById('send-button');

sendButton.addEventListener('click', sendMessage);

userInput.addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
        sendMessage();
    }
});

function sendMessage() {
    const userMessage = userInput.value.trim();
    if (userMessage === '') return;

    addMessage(userMessage, 'user');

    fetch('backend.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ message: userMessage })
    })
    .then(response => response.json())
    .then(data => {
        addMessage(data.answer, 'bot');
    })
    .catch(error => {
        console.error('Error:', error);
    });

    userInput.value = '';
}

function addMessage(message, sender) {
    const messageElement = document.createElement('div');
    messageElement.textContent = message;
    messageElement.classList.add(sender === 'user' ? 'user-message' : 'bot-message');
    chatContainer.appendChild(messageElement);
    chatContainer.scrollTop = chatContainer.scrollHeight;
}

</script>

</body>
</html>
