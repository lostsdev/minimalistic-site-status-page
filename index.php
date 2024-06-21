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
    <script>
        var snowMax = 50;

        var snowColor = ["#DDD", "#EEE"];

        var snowEntity = "❄";

        var snowSpeed = 0.75;

        var snowMinSize = 9;

        var snowMaxSize = 25;

        var snowRefresh = 50;

        var snowStyles = "cursor: default; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; -o-user-select: none; user-select: none;";


        var snow = [],
            pos = [],
            coords = [],
            lefr = [],
            marginBottom,
            marginRight;

        function randomise(range) {
            rand = Math.floor(range * Math.random());
            return rand;
        }

        function initSnow() {
            var snowSize = snowMaxSize - snowMinSize;
            marginBottom = document.body.scrollHeight - 5;
            marginRight = document.body.clientWidth - 15;

            for (i = 0; i <= snowMax; i++) {
                coords[i] = 0;
                lefr[i] = Math.random() * 15;
                pos[i] = 0.03 + Math.random() / 10;
                snow[i] = document.getElementById("flake" + i);
                snow[i].style.fontFamily = "inherit";
                snow[i].size = randomise(snowSize) + snowMinSize;
                snow[i].style.fontSize = snow[i].size + "px";
                snow[i].style.color = snowColor[randomise(snowColor.length)];
                snow[i].style.zIndex = 1000;
                snow[i].sink = snowSpeed * snow[i].size / 5;
                snow[i].posX = randomise(marginRight - snow[i].size);
                snow[i].posY = randomise(2 * marginBottom - marginBottom - 2 * snow[i].size);
                snow[i].style.left = snow[i].posX + "px";
                snow[i].style.top = snow[i].posY + "px";
                snow[i].style.zIndex = 1;

            }

            moveSnow();
        }

        function resize() {
            marginBottom = document.body.scrollHeight - 5;
            marginRight = document.body.clientWidth - 15;
        }

        function moveSnow() {
            for (i = 0; i <= snowMax; i++) {
                coords[i] += pos[i];
                snow[i].posY += snow[i].sink;
                snow[i].style.left = snow[i].posX + lefr[i] * Math.sin(coords[i]) + "px";
                snow[i].style.top = snow[i].posY + "px";

                if (snow[i].posY >= marginBottom - 2 * snow[i].size || parseInt(snow[i].style.left) > (marginRight - 3 * lefr[i])) {
                    snow[i].posX = randomise(marginRight - snow[i].size);
                    snow[i].posY = 0;
                }
            }

            setTimeout("moveSnow()", snowRefresh);
        }

        for (i = 0; i <= snowMax; i++) {
            document.write("<span id='flake" + i + "' style='" + snowStyles + "position:absolute;top:-" + snowMaxSize + "'>" + snowEntity + "</span>");
        }

        window.addEventListener('resize', resize);
        window.addEventListener('load', initSnow);
    </script>
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
            background-color: #e2adef;
        }
    </style>
</head>
<body>
    <div>
        <p>Сайт <?php echo $url; ?> сейчас <?php echo $status; ?>.</p>
    </div>
</body>
</html>