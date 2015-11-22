
<?php (include_once ('config.php')) or die("Missing config.php") ?>

<?php require_once 'lib/database.php' ?>
<html>
<head>
<title>Dynamic WPAD.DAT</title>

<link rel="stylesheet" href="css/bootstrap.css" />
<link rel="stylesheet" href="css/bootstrap-theme.css" />
<link rel="stylesheet" href="css/bootstrap-switch.min.css" />
<link rel="stylesheet" href="css/dashboard.css" />
<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap-switch.min.js"></script>

</head>
<body>

	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#navbar" aria-expanded="false"
					aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">Dynamic WPAD.DAT</a>
			</div>
			<?php /*<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">Dashboard</a></li>
					<li><a href="#">Settings</a></li>
					<li><a href="#">Profile</a></li>
					<li><a href="#">Help</a></li>
				</ul>
				<form class="navbar-form navbar-right">
					<input type="text" class="form-control" placeholder="Search...">
				</form>
			</div>*/?>
		</div>
	</nav>
	
<div class="row">

	<div class="container-fluid">
		<div class="col-sm-3 col-md-2 sidebar">
			<ul class="nav nav-sidebar">
				<li><a href="index.php?action=main">Overview</a></li>
				<li><a href="index.php?action=query_logs">View Logs</a></li>
			</ul>
		</div>
	</div>
	
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<?php $page = isset($_GET["action"])?$_GET["action"]:"main"; ?>
		<?php include "pages/${page}.php" ?>
	</div>
	
</div>

<script src="js/bootstrap.js"></script>
<script src="js/bootstrap-switch.min.js"></script>

</body>
</html>