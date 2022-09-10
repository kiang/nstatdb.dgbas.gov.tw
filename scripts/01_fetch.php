<?php
$basePath = dirname(__DIR__);
$fh = fopen($basePath . '/api.csv', 'r');
fgetcsv($fh, 2048);
while ($line = fgetcsv($fh, 2048)) {
    $url = 'https://nstatdb.dgbas.gov.tw/dgbasAll/webMain.aspx?sdmx/' . $line[2] . '//';
    $c = file_get_contents($url);
    if ($c !== 'Parameter error ') {
        file_put_contents($basePath . '/raw/' . $line[2] . '.json', json_encode(json_decode($c), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}
