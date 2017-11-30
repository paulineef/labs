<?php include ('header.php'); ?>
<body>
	<img class="topimg" src="img/index.png"/>
	<div class="content">
		<div class="half">
			<h3>My Books</h3>

			<?php
			@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

			if ($db->connect_error) {
			    echo "could not connect: " . $db->connect_error;
			    printf("<br><a href=index.php>Return to home page </a>");
			    exit();
			}

			$query = "SELECT books.bookID, books.title, books.reserved, authors.authorID, authors.name FROM books 
					JOIN author_books ON books.bookID = author_books.bookID 
					JOIN authors ON authors.authorID = author_books.authorID WHERE books.reserved = 1";

			$stmt = $db->prepare($query); 
			$stmt->bind_result($bookID, $title, $reserved, $authorID, $name); 
			$stmt->execute();

			echo '<table>';
			    echo '<tr><th>Title</th> <th>Author</th> <th>Reserved</th></tr>';
			    while ($stmt->fetch()) {
					if ($reserved == 1) 
						$reserved ="YES";
			        echo "<tr>";
					echo "<td> $title </td><td> $name </td> <td> $reserved </td>";
				    echo '<td><a class="return" href="returnBook.php?bookID=' . urlencode($bookID) . '"> Return </a></td>';
				    echo "</tr>";   
			    }
			    echo "</table>";
			?>
			<!-- <table>
				<tr><th>Title</th><th>Author</th><th>Return Date</th><th></th></tr>
				<tr>
					<td>Love</td><td>Johan John</td><td>12/12/2017</td><td class="return">Return</td>
				</tr>
				<tr>
					<td>Jo Levis</td><td>Jo Levis</td><td>11/03/2017</td><td class="return">Return</td>
				</tr>

			</table> -->



		</div>
	</div>
</body>

<?php include ('footer.php'); ?>