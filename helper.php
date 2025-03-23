<?php 
function loadConfig($configFile = './../config.json') {
    if (!file_exists($configFile)) {
        die("Configfile not found!");
    }
    return json_decode(file_get_contents($configFile));
}

function fetchAllDevices($config) {
    $cacheFile = './../cache/devices.json';

    if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < 10)) {
        return json_decode(file_get_contents($cacheFile), true);
    }

    $url = $config->address . "/api/states";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer " . $config->token,
        "Content-Type: application/json"
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200) {
        $data = json_decode($response, true);
        file_put_contents($cacheFile, json_encode($data));
        return $data;
    }
    if ($httpCode === 403) {
        echo "Request forbidden. Please check the token or the ip_ban.yaml in the homeassistant dir.";
    }

    return [];
}

function sendCommandToDevice($config, $entity_id, $service) {
    $domain = explode(".", $entity_id)[0];
    $url = $config->address . "/api/services/$domain/$service";

    $payload = json_encode(["entity_id" => $entity_id]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer " . $config->token,
        "Content-Type: application/json"
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return ($http_code === 200) ? json_decode($response, true) : null;
}

function getIconFile($deviceType, $state) {
    $icons = [
        'light' => [
            'on' => '../icons/light-on.html',
            'off' => '../icons/light-off.html'
        ],
        'switch' => [
            'on' => '../icons/switch-on.html',
            'off' => '../icons/switch-off.html'
        ]
    ];

    if (isset($icons[$deviceType][$state])) {
        return file_get_contents($icons[$deviceType][$state]);
    }

    return file_get_contents('../icons/alert.html');
}

?>