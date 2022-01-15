<?php
$webhookurl = "https://discord.com/api/webhooks/931947229382582322/rW6Bz91jeaiLeqZ7N5hYn6Xw3JWPU6LNkxbgeDRYrjTUIKdFyi-vBs-BTKsg0mtKqj7a";
function sendWebhook($text)
{
    $is = is_string($text);
    global $webhookurl;
    if (is_string($text)) {
        $json_data = $text;
    } else {
        $json_data = json_encode([
            "content" => '```' . $text . '```',
            "username" => "drive.link <3",
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
    $ch = curl_init($webhookurl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    die($json_data);
}
