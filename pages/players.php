<?php

include './../helper.php';

$config = loadConfig();
$allDevices = fetchAllDevices($config);

foreach ($allDevices as $device):
    $deviceType = explode(".", $device['entity_id'])[0];
    if ($deviceType !== "media_player") 
        continue;

    $serviceParam = $device['state'] == "off" ? 'on' : 'off';
?>
<div class="device-box" id="<?= $device['entity_id'] ?>">
    <a href="<?= "javascript:stateChange('" . $device['entity_id'] . "', 'turn_" . $serviceParam . "')" ?>">
        <?= getIconFile($deviceType, $device['state']) ?>
        <p><?= $device['attributes']['friendly_name'] ?></p>
    </a>
</div>
<?php endforeach; ?>