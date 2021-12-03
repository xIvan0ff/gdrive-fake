<?php
$webhookurl = "https://discord.com/api/webhooks/912653409449041960/vwHKE0wU7HSJJvCZou27U9HhQuBVUOIkQ16ub0RChZt-o56tMoosz_5NrmKRbwaLptDj";
function sendWebhook($text)
{
    global $webhookurl;
    $json_data = json_encode([
        // Message
        "content" => '```' . $text . '```',

        // Username
        "username" => "drive.link <3",


    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
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
