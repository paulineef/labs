<?php include ('header.php'); ?>
<body>
	<img class="topimg" src="img/index.png"/>
	<div class="content">
		<div class="half">
			<h3>Contact Us</h3>
			
			<form>
					Name: <br>
					<input type="text" name="name" placeholder="Firstname Lastname">
					<br>
					Email: <br>
					<input type="text" name="email" placeholder="name@name.se">
					<br>
					Message: <br>
					<input type="text" name="message" size="50" style="height: 50px;" placeholder="Write your message here." >
					<br>
					<input type="submit" name="send" value="SEND" class="submit">
			</form>

		</div>
	</div>
</body>

<?php include ('footer.php'); ?>