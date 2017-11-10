
<?php
	include("config.php");
	$title = "Search books";
	include("header.php");
?>
<head>
	<meta charset="UTF-8">
	<title>Behind the book</title>
	<link rel="stylesheet" type="text/css" href="CSS/main.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>	
<body>
	<h2>SEARCH IN OUR LIBRARY</h2>
	<p>You may search by title, by author or by both. <br></p>
	<form action="listBooks.php" method="POST">
		<table cellpadding="6" style="margin:0 0 50px 100px">
			<tbody>
				<tr>
					<td>Title:</td>
					<td><INPUT type="text" name="searchtitle"></td>
				</tr>
				<tr>
					<td>Author:</td>
					<td><INPUT type="text" name="searchauthor"></td>
				</tr>
				<tr>
					<td></td>
					<td><INPUT type="submit" name="submit" value="Submit"></td>
				</tr>
			</tbody>
		</table>
	</form>
	<h2>THE LIBRARY IN A LIST</h2>
</body>
<style>
	body {
		position: relative;
	}
	.headList {
		color: #e6975e;
	}
	#footerPart2 {
		background-color: #e6975e ;
		width: 100%;
		padding: 20px;
		margin: 0;
		padding-bottom: 10px;
		position: absolute;
		left: 0;
		bottom: 0;
	}
	#button {
		text-decoration: none;
		background-color: #e6975e;
		padding: 5px;
		color: #000;
	}
	#button:hover {
		background-color: #925f4e;
	}
</style>
<?php
# This is the mysqli version

$searchtitle = "";
$searchauthor = "";

//Open the database
@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

//if there is anything in the form field
if (isset($_POST) && !empty($_POST)) {
	//remove blank spaces
    $searchtitle = trim($_POST['searchtitle']);
    $searchauthor = trim($_POST['searchauthor']);

	//add htmlentities and string escaping to the search function for the title
	$searchtitle = htmlentities($searchtitle);
	$searchtitle = mysqli_real_escape_string($db, $searchtitle);

	//add htmlentities and string escaping to the search function for the author
	$searchauthor = htmlentities($searchauthor);
	$searchauthor = mysqli_real_escape_string($db, $searchauthor);
}

//	if (!$searchtitle && !$searchauthor) {
//	  echo "You must specify either a title or an author";
//	  exit();
//	}

	$searchtitle = addslashes($searchtitle);
	$searchauthor = addslashes($searchauthor);

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    printf("<br><a href=index.php>Return to home page </a>");
    exit();
} //if the database could not be connected

# Build the query. Users are allowed to search on title, author, or both
 
//create a query that connects the different columns with the search function in the form
$query = "SELECT bookID, title, author, reserved FROM book";
if ($searchtitle && !$searchauthor) { // Title search only
    $query = $query . " where title like '%" . $searchtitle . "%'";
}
if (!$searchtitle && $searchauthor) { // Author search only
    $query = $query . " where author like '%" . $searchauthor . "%'";
}
if ($searchtitle && $searchauthor) { // Title and Author search
    $query = $query . " where title like '%" . $searchtitle . "%' and author like '%" . $searchauthor . "%'"; // unfinished
}

//echo "Running the query: $query <br/>"; # For debugging


  # Here's the query using an associative array for the results
//$result = $db->query($query);
//echo "<p> $result->num_rows matching books found </p>";
//echo "<table border=1>";
//while($row = $result->fetch_assoc()) {
//echo "<tr><td>" . $row['bookid'] . "</td> <td>" . $row['title'] . "</td><td>" . $row['author'] . "</td></tr>";
//}
//echo "</table>";
 

//Here's the query using bound result parameters
    // echo "we are now using bound result parameters <br/>";
    $stmt = $db->prepare($query); //create a variable and prepare the database query for action
    $stmt->bind_result($bookID, $title, $author, $reserved); //the result of the search we put in the stmt variable
    $stmt->execute(); //execute the result

    echo '<table cellpadding="6" style="margin:0 0 0 50px; padding-bottom:150px">';
    echo '<tr><b><td class="headList">Title</td> <td class="headList">Author</td> <td class="headList">Reserved</td> </b> </tr>';
    while ($stmt->fetch()) {
		if ($reserved == 0) 
			$reserved = "NO";
		else $reserved ="YES";
        echo "<tr>";
        echo "<td> $title </td><td> $author </td><td> $reserved </td>";
        echo '<td><a id="button" href="reserveBook.php?bookID=' . urlencode($bookID) . '"> Reserve </a></td>';
        echo "</tr>";
    }
    ?>

<?php include("footer.php"); ?>