<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("admin.php");
}?>
<?php include('aHeader.php'); ?>
<body>
<img class="topimg" src="../img/admin.png"/>
	<div class="content">
		<div class="half">
			<h2>Welcome to the admin page!</h2>
			<p>
				Here you can add and delete books under Manage books and upload pictures. To logout look at the bottom of the page.<br/><br/>
				Have fun!
			</p>
		</div>

	</div>
</body>

<?php include ('aFooter.php'); ?>