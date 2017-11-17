<?php include ('header.php'); ?>
<body>
	<img class="topimg" src="img/index.png"/>
	<div class="content">
		<div class="half">
			<h3>Search</h3>
			<form action="browse.php" method="POST">
				<input type="text" name="" placeholder="Title"/><br/>
				<input type="text" name="" placeholder="Author"/><br/>
				<input type="sumbit" id="sumbit" value="Submit" />
			</form>

			<?php

			$db = new mysqli('localhost', 'root', 'root', 'reads');
			
			if ($db->connect_error) {
				echo "could not connect: " . $db->connect_error;
				printf("<br><a href=index.php>Return to home page </a>");
				exit();
			}

			$query = "SELECT books.bookID, books.title, FROM books"; 

			$stmt = $db->prepare($query);
			$stmt->bind_result($bookID, $title);
			$stmt->execute();

			echo '<table>';
   			echo '<tr>
   					<td>Title</td>
   					<td>Author</td>
   				</tr>';
			while ($stmt->fetch()) {
				echo "<tr>";
				echo "<td> $title</a></td> <td></td>";
				echo "</tr>";
			}

			?>



		</div>
	</div>
</body>

<?php include ('footer.php'); ?>