<?php 
$rows = $db->fetchRows("SELECT * FROM query_logs ORDER BY id DESC LIMIT 1000");
?>

<h1 class="page-header">Query Logs</h1>

<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Created</th>
				<th>IP</th>
				<th>Hostname</th>
				<th>WPAD</th>
				<th>$_SERVER</th>
			</tr>
		</thead>
		<tbody>
<?php foreach($rows as $row):?>
	<tr>
		<td><?= $row["id"]?></td>
		<td><?= $row["created"]?></td>
		<td><?= long2ip($row["ip"]) ?></td>
		<td><?= $row["hostname"]?></td>
		<td>
			<a onclick="$(this).next().toggle();">Show</a>
			<div style="display:none;">
				<pre><?= $row["wpad"] ?></pre>
			</div>
		</td>
		<td>
			<a onclick="$(this).next().toggle();">Show</a>
			<div style="display:none;">
			<pre><?= var_export(json_decode($row["var_server"], true)) ?></pre>
			</div>
		</td>
	</tr>
<?php endforeach; ?>
</tbody>
</table>

</div>