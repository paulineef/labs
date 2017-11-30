<!DOCTYPE html>
<html>
<head>
	<title>Reads</title>
	<link rel="stylesheet" type="text/css" href="../labs.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,700,900|Slabo+27px" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta charset="utf-8">
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<?php include ('../config.php'); ?>
		<script type="text/javascript" charset="utf-8">
			
			$(document).ready(function() {
				$( ".cross" ).hide();

				$( ".hamburger" ).click(function() {
				$( ".menu" ).slideToggle( "normal", function() {
				$( ".hamburger" ).hide();
				$( ".cross" ).show();
					});
				});

				$( ".cross" ).click(function() {
				$( ".menu" ).slideToggle( "normal", function() {
				$( ".cross" ).hide();
				$( ".hamburger" ).show();
					});
				});

			});
		</script>
</head>
<body>
	<header>
		<nav>
			<ul class="hmenu">
				<img src="../img/logo.svg">
				<button class="hamburger">&#9776;</button>
 				<button class="cross">&#735;</button>
 			</ul>
			<ul class="menu">
				<li></li>
				<li><a class="<?php echo ($current_page == 'welcome.php' || $current_page == '') ? 'active' : NULL ?>" href="welcome.php">Home</a></li>
				<li><a class="<?php echo ($current_page == 'manage.php' || $current_page == '') ? 'active' : NULL ?>" href="manage.php">Manage Library</a></li>
				<li><a class="<?php echo ($current_page == 'upload.php' || $current_page == '') ? 'active' : NULL ?>" href="upload.php">Upload Picture</a></li>
			</ul>
		</nav>
	</header>
</body>