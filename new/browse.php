<?php include ('header.php'); ?>
<body>
	<img class="topimg" src="img/index.png"/>
	<div class="content">
		<div class="half">
			<h3>Search</h3>
			<form action="browse.php" method="POST">
				<input type="text" name="searchtitle" placeholder="Title"><br>
				<input type="text" name="searchauthor" placeholder="Author"><br>
				<input type="submit" name="search" value="Search" class="submit">
			</form>

            <?php

            $searchtitle = "";
			$searchauthor = ""; 

			@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

			if ($db->connect_error) {
			    echo "could not connect: " . $db->connect_error;
			    printf("<br><a href=index.php>Return to home page </a>");
			    exit();
			}

			//if there is anything in the form field
			if (isset($_POST) && !empty($_POST)) {
				
			    $searchtitle = trim($_POST['searchtitle']);
			    $searchauthor = trim($_POST['searchauthor']);

				//add htmlentities and string escaping to the search function for the title
				$searchtitle = htmlentities($searchtitle);
				$searchtitle = mysqli_real_escape_string($db, $searchtitle);

				//add htmlentities and string escaping to the search function for the author
				$searchauthor = htmlentities($searchauthor);
				$searchauthor = mysqli_real_escape_string($db, $searchauthor);

				$searchtitle = addslashes($searchtitle);
				$searchauthor = addslashes($searchauthor);
			}


			$query = "SELECT books.bookID, books.title, books.reserved, authors.authorID, authors.name FROM books 
					JOIN author_books ON books.bookID = author_books.bookID 
					JOIN authors ON authors.authorID = author_books.authorID";

			if ($searchtitle && !$searchauthor) { // Title search only
			    $query = $query . " where title like '%" . $searchtitle . "%' GROUP BY books.title ";
			}
			if (!$searchtitle && $searchauthor) { // Author search only
			    $query = $query . " where name like '%" . $searchauthor . "%'";
			}
			if ($searchtitle && $searchauthor) { // Title and Author search
			    $query = $query . " where title like '%" . $searchtitle . "%' and name like '%" . $searchauthor . "%'";
			}
			if (!$searchtitle && !$searchingauthor) {
		   		 $query = $query . " GROUP BY books.title ";
		    }

				$stmt = $db->prepare($query); 
			    $stmt->bind_result($bookID, $title, $reserved, $authorID, $name); 
			    $stmt->execute();

			    echo '<table>';
			    echo '<tr><th>Title</th> <th>Author</th> <th>Reserve</th></tr>';
			    while ($stmt->fetch()) {
					if ($reserved == 0) 
						$reserved = "NO";
					else $reserved ="YES";
			        echo "<tr>";
					echo "<td> $title </td><td> $name </td> <td> $reserved </td>";
				    echo '<td><a class="return" href="reserveBook.php?bookID=' . urlencode($bookID) . '"> Reserve </a></td>';
				    echo "</tr>";   
			    }
			    echo "</table>";
			?>

		</div>
	</div>
</body>

<?php include ('footer.php'); ?>