<?php 
require_once __DIR__ . '/../check_login.php'; 
ob_start();
include_once __DIR__ . '/../header.php';
$headerHtml = ob_get_clean();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Chat Room</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
<style>
    body, html {
        margin: 0; padding: 0; height: 100%;
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        display: flex;
        flex-direction: column;
    }
    a {
        color: white;
        text-decoration: none;
    }
    a:hover, a:focus {
        text-decoration: underline;
        color: white;
    }
    main {
        flex: 1;
        display: flex;
        flex-direction: column;
        max-width: 600px;
        margin: 80px auto 40px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        padding: 20px;
        box-sizing: border-box;
    }
    h2 {
        margin-top: 0;
        text-align: center;
        color: #333;
    }
    #chat {
        flex: 1;
        border: 1px solid #ccc;
        padding: 10px;
        height: 300px;
        overflow-y: auto;
        background: #fafafa;
        border-radius: 6px;
        margin-bottom: 15px;
        font-size: 14px;
    }
    .message {
        margin: 6px 0;
    }
    #message {
        flex-grow: 0;
        padding: 8px;
        width: calc(100% - 80px);
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-sizing: border-box;
        outline: none;
        transition: border-color 0.2s ease;
    }
    #message:focus {
        border-color: #3498db;
    }
    #send {
        width: 70px;
        margin-left: 10px;
        padding: 9px 0;
        font-weight: 600;
        color: white;
        background-color: #3498db;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    #send:hover {
        background-color: #2980b9;
    }
    .input-group {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }
    @media (max-width: 640px) {
        main {
            margin: 90px 10px 20px;
            width: auto;
        }
        #message {
            width: 100%;
        }
        #send {
            width: 100%;
            margin-left: 0;
        }
        .input-group {
            flex-direction: column;
            gap: 10px;
        }
    }
</style>
</head>
<body style="margin: 0; background-color: #1f2937; color: black; font-family: Arial, sans-serif;">
<?php echo $headerHtml; ?>

<main>
    <h2>Simple Chat</h2>
    <div id="chat" aria-live="polite" aria-relevant="additions"></div>

    <div class="input-group">
        <input type="text" id="message" placeholder="Type your message" aria-label="Message input" />
        <button id="send" aria-label="Send message">Send</button>
    </div>
</main>
<script>
const chatBox = document.getElementById('chat');
const msgInput = document.getElementById('message');

let username = localStorage.getItem('chatUsername');
if (!username) {
    username = prompt("Enter your username:");
    while (!username || username.trim() === "") {
        username = prompt("Username cannot be empty! Enter your username:");
    }
    username = username.trim();
    localStorage.setItem('chatUsername', username);
}

let lastRenderedIndex = -1;

function renderMessage(msg) {
    const div = document.createElement('div');
    div.className = 'message';
    div.innerHTML = `<strong>${msg.user}:</strong> ${msg.text}`;
    chatBox.appendChild(div);
    chatBox.scrollTop = chatBox.scrollHeight;

    div.querySelectorAll('script').forEach(oldScript => {
        const newScript = document.createElement('script');
        for (const attr of oldScript.attributes) {
            newScript.setAttribute(attr.name, attr.value);
        }
        newScript.text = oldScript.textContent;
        oldScript.parentNode.replaceChild(newScript, oldScript);
    });
}

function loadMessages() {
    fetch('messages.json?nocache=' + Date.now())
        .then(res => {
            if (!res.ok) throw new Error('Network response was not ok');
            return res.json();
        })
        .then(data => {
            if (!Array.isArray(data)) return;

            for (let i = lastRenderedIndex + 1; i < data.length; i++) {
                renderMessage(data[i]);
            }
            lastRenderedIndex = data.length - 1;
        })
        .catch(err => console.error('Error loading messages:', err));
}

function sendMessage() {
    const text = msgInput.value.trim();
    if (text === "") return;

    const body = `user=${encodeURIComponent(username)}&text=${encodeURIComponent(text)}`;

    fetch('post.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: body
    }).then(res => {
        if (!res.ok) throw new Error('Send failed');
        msgInput.value = "";
        loadMessages();
    }).catch(err => console.error('Send error:', err));
}

document.getElementById('send').addEventListener('click', sendMessage);
msgInput.addEventListener('keydown', e => {
    if (e.key === 'Enter') {
        e.preventDefault();
        sendMessage();
    }
});

const POLL_MS = 2000;
setInterval(loadMessages, POLL_MS);
loadMessages();
</script>
</body>
</html>
