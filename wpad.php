<?php
include_once 'lib/database.php';

$remoteIp = $_SERVER["REMOTE_ADDR"];
$remoteIpLong = ip2long($remoteIp);

$entry = $db->fetchRows("SELECT * FROM wpads WHERE is_active=1 AND ip <= {$remoteIpLong} ORDER BY ip DESC LIMIT 1");
$entry = $entry[0];

$queryLog = array(
		"ip" => $remoteIpLong,
		"wpad" => $entry["content"],
		"var_server" => json_encode($_SERVER),
);
$db->insertRow("query_logs", $queryLog);

echo $entry["content"];