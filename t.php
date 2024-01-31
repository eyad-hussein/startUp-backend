<?php
$hostIp = '127.0.0.1';
$hostPort = 1087;
$timeoutTime = 1;
if ($fp = fsockopen($hostIp, $hostPort, $errCode, $errStr, $timeoutTime)) {
    echo 'Port is open';
} else {
    echo 'Port is closed';
}
fclose($fp);
