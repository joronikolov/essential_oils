<?php include_once('scripts/connection.php');?>
<!DOCTYPE html>
<html>
<head>
<title>essential oils</title>
<link type="text/css" rel="stylesheet" href="css/default.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="js/jquery.js"></script>
</head>
<body>
	<?php include('scripts/menu.php');
	$action='default';
	$dont_load=array('index', 'header', 'footer','connection');
	if(file_exists('scripts/'.$_GET["action"].'.php')&&!in_array($_GET['action'],$dont_load)){
		$action=$_GET["action"];
	};
	include("scripts/$action.php");
	?>
	<div id="container">
	
	</div>



</body>

</html>
