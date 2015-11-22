<?php 
$rows = $db->fetchRows("SELECT * FROM wpads");
?>

<h1 class="page-header">Dynamic WPAD.DAT</h1>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>CIDR</th>
				<th>Active</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
<?php foreach($rows as $row):?>
<tr>
	<td><?= $row["id"]?></td>
	<td><?= $row["name"]?></td>
	<td><?= long2ip($row["ip"])."/".$row["mask"]?></td>
	<td>
		<?php if($row["id"] > 1): ?>
			<a href="index.php?action=toggle_wpad&id=<?= $row["id"]?>"><?= $row["is_active"]?"Active":"Inactive" ?></a>
		<?php else: ?>
			Active
		<?php endif; ?>
	</td>
	<td>
		<a href="index.php?action=edit_wpad&id=<?= $row["id"]?>">Edit</a>
		<?php if($row["id"] > 1) :?>
			| <a href="index.php?action=delete_wpad&id=<?= $row["id"]?>" onclick="return confirm('Are you sure?');">Delete</a>
		<?php endif; ?>
	</td>
</tr>
<?php endforeach; ?>
		</tbody>
	</table>
</div>
<button type="button" class="btn btn-lg btn-default" onclick="window.location = 'index.php?action=edit_wpad';">+ add new WPAD.DAT</button>