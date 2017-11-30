<?php include('header.php'); ?>
<body>
<img class="topimg" src="img/index.png"/>
	<div class="content">
		<div class="news">
			<?php
			
			@ $db = new mysqli('localhost', 'root', 'root', 'reads');

			if ($db->connect_error) {
				echo "could not connect: " . $db->connect_error;
				printf("<br><a href=index.php>Return to home page </a>");
				exit();
			}

			$query = "SELECT articles.articleID, articles.title, articles.text, articles.author, articles.date FROM articles"; 

			$stmt = $db->prepare($query);
			$stmt->bind_result($articleID, $title, $text, $author, $date);
			$stmt->execute();

			while ($stmt->fetch()) {

		    		echo '<div class="article">';
					echo "<h2> $title </h2>";
					echo "<p> $text</p>";
					echo "<div id='border'></div>";
					echo "<span> $author $date </span>";
					echo "</div>";
				}
			?>
		</div>
		<aside>
			<div class="top5">
				<h3>TOP 5</h3>
				<ul>
					<li>TITEL - Author</li>
					<li>TITEL - Author</li>
					<li>TITEL - Author</li>
					<li>TITEL - Author</li>
					<li>TITEL - Author</li>
				</ul>
			</div>
			<div class="recent">
				<h3>RECENT POSTS</h3>
				<ul>
					<?php 
						$stmt = $db->prepare($query);
						$stmt->bind_result($articleID, $title, $text, $author, $date);
						$stmt->execute();
						while ($stmt->fetch()) {
							echo "<li><a href='articleBase.php/articleID=$articleID'> $title </a></li>";
						}
					 ?>
				</ul>
			</div>
		</aside>

	</div>
</body>

<?php include ('footer.php'); ?>