<?php
function ini_flatten($config) {
    $flat = array();
    foreach ($config as $key => $info) {
        $flat[$key] = $info['local_value'];
    }
    return $flat;
}

function ini_diff($config1, $config2) {
    return array_diff_assoc(ini_flatten($config1), ini_flatten($config2));
}

$config1 = ini_get_all();

$export_script = 'http://server-a.example.com/export.php';
$config2 = unserialize(file_get_contents($export_script));

$diff = ini_diff($config1, $config2);
?>
<pre><?php print_r($diff) ?></pre>
