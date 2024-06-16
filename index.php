<?php
$url = 'https://lostslvtt.ru';
$timeout = 100;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
curl_close($ch);
$status = ($httpCode >= 200 && $httpCode < 400) ? "работает" : "не работает";
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'JetBrains Mono', monospace;
            font-size: 24px;
            text-align: center;
            background-color: #EBDADA;
        }
    </style>
</head>
<body>
    <div>
        <p>Сайт <?php echo $url; ?> сейчас <?php echo $status; ?>.</p>
    </div>
</body>
</html>