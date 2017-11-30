<?php include('aHeader.php'); ?>
<body>
<img class="topimg" src="../img/admin.png"/>
	<div class="content">
		<div class="half">
			<h2>Manage the Library</h2>

				<h4>Add a book</h4>
				<form>
					<input type="text" name="bookID" placeholder="Book ID">
					<input type="text" name="title" placeholder="Title">
					<input type="author" name="author" placeholder="Author">
					<input type="submit" name="add" value="add" class="submit">
				</form>

				<h4>Delete a book</h4>
				<form>
				</form>

				<h3 style='font-family: roboto, sans-serf; color: orange; margin-bottom: 2px;'> Current Library </h3>
				Press <a href='manage.php' style='color: purple; text-decoration: underline;'>here</a> to refresh.

				<h4 style="margin-top: 10px;">Search</h4>
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
			    printf("<br><a href=welcome.php>Return to home page </a>");
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
			    echo "";
			    echo "";
			    echo '<table>';
			    echo '<tr><th>Book ID</th><th>Title</th><th>Author</th></tr>';
			    while ($stmt->fetch()) {
			        echo "<tr>";
					echo "<td style='text-align:right; padding-right: 28px; font-weight: bold; '>$bookID</td><td> $title </td><td> $name </td>";
				    echo "</tr>";   
			    }
			    echo "</table>";
			?>
		</div>

	</div>
</body>

<?php include ('aFooter.php'); ?>