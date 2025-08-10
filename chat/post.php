<?php
$messagesFile = __DIR__ . '/messages.json';

// If file doesn't exist, create an empty JSON array
if (!file_exists($messagesFile)) {
    file_put_contents($messagesFile, json_encode([], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
}

// Read existing messages from the file
$messages = json_decode(file_get_contents($messagesFile), true);
if (!is_array($messages)) {
    $messages = [];
}

// Get POST data
$user = $_POST['user'] ?? 'Anonymous';
$text = $_POST['text'] ?? '';

if (trim($text) !== '') {
    // Append new message
    $messages[] = ['user' => $user, 'text' => $text];

    // Save updated messages back to file
    file_put_contents($messagesFile, json_encode($messages, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
}

http_response_code(200);
