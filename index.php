<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta name="format-detection" content="telephone=no">
    <meta name="HandheldFriendly" content="true">
    <meta name="MobileOptimized" content="width">

    <link rel="stylesheet" href="./style.css" />
    <script src="./main.js"></script>

    <title>HA Dashboard</title>
</head>
<body>
    <body onload="startup(1)">
    <div id="">
        <div id="header">
            <div id="main-menu">
                <a onclick="startup(1)">
                    <div class="main-menu-item" id="menu1">
                        <?= file_get_contents('./icons/dashboard.html') ?>
                        Main
                    </div>
                </a>
                <a onclick="startup(3)">
                    <div class="main-menu-item" id="menu3">
                        <?= file_get_contents('./icons/switches.html') ?>
                        Switches
                    </div>
                </a>
                <a onclick="startup(4)">
                    <div class="main-menu-item" id="menu4">
                        <?= file_get_contents('./icons/light-on.html') ?>
                        Lights
                    </div>
                </a>
                <a onclick="startup(5)">
                    <div class="main-menu-item" id="menu5">
                        <?= file_get_contents('./icons/automations-on.html') ?>
                        Automations
                    </div>
                </a>
                <a onclick="startup(6)">
                    <div class="main-menu-item" id="menu6">
                        <?= file_get_contents('./icons/play.html') ?>
                        Players
                    </div>
                </a>
            </div>
            <div id="page-content"></div>
    </div>
</body>
</html>
