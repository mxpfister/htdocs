<?php

include './../helper.php';

$config = loadConfig();
$allDevices = fetchAllDevices($config);

$deviceMap = [];
foreach ($allDevices as $device) {
    $deviceMap[$device['entity_id']] = $device;
}

foreach ($config->devices->main as $device):
    if (!isset($deviceMap[$device->id])) 
        continue;
    $deviceType = !empty($device->type) ? $device->type : explode(".", $device->id)[0];
    $data = $deviceMap[$device->id];

    $serviceParam = $data['state'] == "off" ? 'on' : 'off';

?>
<div class="device-box" id="<?= $device->id ?>">
    <a href="<?= "javascript:stateChange('" . $device->id . "', 'turn_" . $serviceParam . "')" ?>">
        <?= getIconFile($deviceType, $data['state']) ?>
        <p><?= $data['attributes']['friendly_name'] ?></p>
    </a>
</div>
<?php endforeach; ?>