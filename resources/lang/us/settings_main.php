<?php

use App\models\SettingsMain;

$settingsMain = SettingsMain::all();
$data = [];
foreach($settingsMain as $sm) {
    $data[$sm->prefix] = $sm->name_us;
}

return $data;
