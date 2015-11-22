<?php
if(isset($_GET["id"])) {
	$row = $db->fetchRow("wpads", $_GET["id"]);
	$row["is_active"] = !$row["is_active"];
	$db->insertRow("wpads", $row);
}
header("Location: index.php?action=main");