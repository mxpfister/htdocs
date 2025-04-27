<?php

include './../helper.php';

$config = loadConfig();
$allDevices = fetchAllDevices($config);

$deviceMap = [];
foreach ($allDevices as $device) {
    $deviceMap[$device['entity_id']] = $device;
    $deviceType = explode(".", $device['entity_id'])[0];
}

foreach ($config->devices->main as $device):
    if (!isset($deviceMap[$device->id])) 
        continue;
    $deviceType = !empty($device->type) ? $device->type : explode(".", $device->id)[0];
    $data = $deviceMap[$device->id];

    $serviceParam = $data['state'] == "off" ? 'on' : 'off';
    if ($deviceType === "weather"):
?>
<div class="device-box <?= isset($device->width) ? 'col-' . $device->width : '' ?>" id="<?= $device->id ?>">
    <div class="weather-widget">
        <div class="weather-now">
            <div class="weather-icon"><?= getIconFile($deviceType, $data['state']) ?></div>
            <div class="weather-main">
                <?php if (isset($device->options->temperature) && $device->options->temperature === true): ?>
                    <span class="weather-temp"><?=file_get_contents("../icons/weather/thermometerIcon.html")?> <?= round($data['attributes']['temperature']) ?>°C</span>
                <?php endif; ?>

                <?php if (isset($device->options->humidity) && $device->options->humidity === true): ?>
                    <span class="weather-humidity"><?=file_get_contents("../icons/weather/raindropIcon.html")?> <?= $data['attributes']['humidity'] ?>%</span>
                <?php endif; ?>

                <?php if (isset($device->options->wind) && $device->options->wind === true): ?>
                    <span class="weather-wind"><?=file_get_contents("../icons/weather/windpowerIcon.html")?> <?= round($data['attributes']['wind_speed']) ?> km/h <?= getWindDirection($data['attributes']['wind_bearing']) ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="weather-details">
            <?php if (isset($device->options->cloudCoverage) && $device->options->cloudCoverage === true): ?>
                <p>Cloud Cover: <?= round($data['attributes']['cloud_coverage']) ?>% </p>
            <?php endif; ?>

            <?php if (isset($device->options->UvIndex) && $device->options->UvIndex === true): ?>
                <p>| UV Index: <?= round($data['attributes']['uv_index']) ?> </p>
            <?php endif; ?>

            <?php if (isset($device->options->lastUpdate) && $device->options->lastUpdate === true): ?>
                <p>| Last Update: <?= date('H:i', strtotime($data['last_updated'])) ?> UTC</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
    else:
?>
<div class="device-box <?= isset($device->width) ? 'col-' . $device->width : '' ?>" id="<?= $device->id ?>">
    <a href="<?= "javascript:stateChange('" . $device->id . "', 'turn_" . $serviceParam . "')" ?>">
        <?= getIconFile($deviceType, $data['state']) ?>
        <p><?= $data['attributes']['friendly_name'] ?></p>
    </a>
</div>
<?php endif; endforeach; ?>