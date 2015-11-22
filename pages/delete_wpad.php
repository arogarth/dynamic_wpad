<?php
if(isset($_GET["id"])) {
	$db->deleteRowById("wpads", $_GET["id"]);
	
}
header("Location: index.php?action=main");