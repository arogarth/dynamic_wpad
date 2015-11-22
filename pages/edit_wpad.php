<?php
$defaultWpad = "function FindProxyForURL(url, host) {\n\treturn \"DIRECT\";\n}";

$data = array(
		"name" => "", "ip" => "", "mask" => "", "contect" => "", "is_active" => false
);

if($_POST) {
	/**
	 * @var $db Db
	 */
	
	$ip = split("\/", $_POST["cidr"])[0];
	$maskBits = split("\/", $_POST["cidr"])[1];
	
	$row = [
			"name" => $_POST["name"],
			"ip" => ip2long($ip),
			"mask" => $maskBits,
			"content" => $_POST["wpad_content"],
			"is_active" => isset($_POST["is_active"])?"1":"0",
	];
	
	if(isset($_POST["id"])) {
		$row["id"] = $_POST["id"];
	}
	
	$id = $db->insertRow("wpads", $row);
	header("Location: index.php?action=edit_wpad&id={$id}");
}

if($_GET) {
	$data = $db->fetchRow("wpads", $_GET["id"]);
}

if(empty($data["content"])) {
	$data["content"] = $defaultWpad;
}
?>

<script>
var _defaultWpad = `<?= $defaultWpad ?>`;
</script>

<h1 class="page-header">WPAD.DAT Edit</h1>

<form action="index.php?action=edit_wpad" method="post">
<?php if(isset($data["id"])): ?> 
<input type="hidden" name="id" value="<?= $data["id"] ?>" />
<?php endif; ?>

<div>

<div style="width: 300px; float: left; margin: 10px;">

<label for="basic-ip">Activate</label>
<div class="input-group">
<!--   <span class="input-group-addon" id="basic-addon-activate">192.168.10.0/24</span> -->
  <input type="checkbox"
  	class="form-control"
  	id="basic-activate"
  	<?= !$data["id"]||$data["id"]>"1"?:"readonly checked" ?>
  	name="is_active" />
</div>

<label for="basic-url">Name</label>
<div class="input-group">
  <span class="input-group-addon" id="basic-name">@</span>
  <input type="text" class="form-control" placeholder="Name" required="required" <?= !$data["id"]||$data["id"]>"1"?:"readonly" ?> aria-describedby="basic-name" name="name" value="<?= $data["name"]?>">
</div>

<label for="basic-cidr">IP/Subnet</label>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon-cidr">IP</span>
  <input type="text" class="form-control" id="basic-cidr" name="cidr" required="required" <?= !$data["id"]||$data["id"]>"1"?:"readonly" ?> placeholder="192.168.10.0/24" aria-describedby="basic-addon-cidr"  value="<?= !empty($data["ip"])?long2ip($data["ip"])."/".$data["mask"]:""?>">
</div>

</div>

<div style="width: 200px; float: left; margin: 10px;">

<label for="basic-ip">WPAD.DAT content</label>
<div class="input-group">
	<textarea class="span6" rows="15" cols="80" placeholder="What's up?" required="required" name="wpad_content"><?= $data["content"]?></textarea>
</div>
<a onclick="$('[name=wpad_content]').val(_defaultWpad);">Reset to default wpad.dat</a>
</div>

<div style="clear: both"></div>
</div>

<script type="text/javascript">
$("[id='basic-activate']").bootstrapSwitch('state', <?=$data["is_active"]?"true":"false"?>, true);
</script>

<div class="input-group" style="margin-top: 20px;">
	<button type="submit" class="btn btn-lg btn-success">Commit</button>
</div>

</form>
