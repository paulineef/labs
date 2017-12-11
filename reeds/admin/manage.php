<?php
session_start();
if (isset($_SESSION['username'])) {
    header("location:admin.php");
}
?>
<?php include('aHeader.php');
		include('../config.php'); ?>
<body>
<img class="topimg" src="../img/admin.png"/>
	<div class="content">
		<div class="half">
			<h2>Manage the Library</h2>

				<h4>Add a book</h4>

				<?php
				@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

			    if ($db->connect_error) {
			        echo "could not connect: " . $db->connect_error;
			        printf("<br><a href=addbook.php style='text-decoration: underline; color: blue; '>Return to home page </a>");
			        exit();
			    }
					if (isset($_POST['title'])) {
					    $bookID = trim($_POST['bookID']);
					    $title = trim($_POST['title']);
					    $authorID = trim($_POST['authorID']);
					    $author = trim($_POST['author']);

					    if (!$title || !$author || !$bookID ||!$authorID) {
					        printf("You must specify both a title and an author");
					        printf("<br><a href=manage.php>Get back </a>");
					        exit();
					    }

					    $bookID = addslashes($bookID);
					    $title = addslashes($title);
					    $authorID = addslashes($authorID);
					    $author = addslashes($author);


					    $sql = "INSERT INTO books(bookID, title, reserved) VALUES ('$bookID', '$title', 'false');";
					    $sql .= "INSERT INTO authors(authorID, name) VALUES ('$authorID', '$author');";
					    $sql .= "INSERT INTO author_books(authorID, bookID) VALUES ('$authorID', '$bookID');";

					    if ($db->multi_query($sql) === TRUE) {
						    echo "New book created successfully!";
						    printf("<br><a href=manage.php>Back to Manage Books </a>");
						} else {
						    echo "Error: " . $sql . "<br>" . $db->error;
						    printf("<br><a href=manage.php>Try again? </a>");
						}

						// $db->close();
					    exit();
					}

					if (isset($_POST['dbookID'])){
						$dbookID = trim($_POST['dbookID']);
						// $dauthorID = trim($_POST['dauthorID']);

							if (!$dbookID) {
						        printf("You must specify a book.");
						        printf("<br><a href=manage.php>Get back </a>");
						        exit();
					    	}

					        $dbookID = htmlentities($dbookID);
							$dbookID = mysqli_real_escape_string($db, $dbookID);
							$dbookID = addslashes($dbookID);
					        // $dauthorID = addslashes($dauthorID);

					        // $del = "DELETE books.bookID, authors.authorID, author_books.bookID, author_books.authorID FROM books, authors, author_books WHERE bookID='$dbookID' AND authorID='$dauthorID'";

					        $del = "DELETE FROM books WHERE bookID='$dbookID'";

					        if ($db->query($del) === TRUE) {
							    echo "Record deleted successfully";
							} else {
							    echo "Error deleting record: " . $db->error;
							    printf("<br><a href=manage.php style='color: green;'>Try again? </a>");
							} 
					 
					    // $db->close();
					 	exit(); 
					}
				?>
				<!-- Add book -->
				<form method="POST" action="manage.php">
					<input type="text" name="bookID" placeholder="Book ID (a number)">
					<input type="text" name="title" placeholder="Title">
					<input type="text" name="authorID" placeholder="Author ID (a number)">
					<input type="author" name="author" placeholder="Author">
					<input type="submit" name="add" value="Add" class="submit">
				</form>

				<h4>Delete a book</h4>
				<form method="POST" action="manage.php">
					<input type="number" name="dbookID" placeholder="Book ID">
					<!-- <input type="number" name="dauthorID" placeholder="Author ID"> -->
					<input type="submit" name="delete" value="Delete" class="submit">
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

			if (isset($_POST) && !empty($_POST)) {
				
			    $searchtitle = trim($_POST['searchtitle']);
			    $searchauthor = trim($_POST['searchauthor']);

				$searchtitle = htmlentities($searchtitle);
				$searchtitle = mysqli_real_escape_string($db, $searchtitle);

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
			    echo '<tr><th>Book ID</th><th>Title</th><th>Author ID</th><th>Author</th></tr>';
			    while ($stmt->fetch()) {
			        echo "<tr>";
					echo "<td style='text-align:right; padding-right: 28px; font-weight: bold; '>$bookID</td><td> $title </td><td style='text-align:right; padding-right: 28px; font-weight: bold; '>$authorID</td><td> $name </td>";
				    echo "</tr>";   
			    }
			    echo "</table>";
			?>
		</div>

	</div>
</body>

<?php include ('aFooter.php'); ?>