<?php

	include("config.php");
	$title = "My reserved books";
	include("header.php");
?>
<head>
	<meta charset="UTF-8">
	<title>Behind the book</title>
	<link rel="stylesheet" type="text/css" href="CSS/main.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>
	<h2>SEARCH IN YOUR BOOK LIST</h2>
	<p>You may search by title, by author or by both. <br></p>
	<form action="listBooks.php" method="POST">
		<table cellpadding="6" style="margin-top:0">
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
					<td><INPUT type="submit" name="submit" value="Submit" class="submit"></td>
				</tr>
			</tbody>
		</table>
	</form>
</body>
<style>
	body {
		position: relative;
	}
	.headList {
		color: #e6975e;
	}
	.submit {
		margin-left: 100px;
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


$searchtitle = "";
$searchauthor = "";
//define the variables

if (isset($_POST) && !empty($_POST)) {
//if there is anythin the search field
	$searchtitle = trim($_POST['searchtitle']);
    $searchauthor = trim($_POST['searchauthor']);
}

//	if (!$searchtitle && !$searchauthor) {
//	  echo "You must specify either a title or an author";
//	  exit();
//	}

$searchtitle = addslashes($searchtitle);
$searchauthor = addslashes($searchauthor);

//Open the database
@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    printf("<br><a href=index.php>Return to home page </a>");
    exit();
}

//create a query that connects the different columns with the search function in the form
$query = " SELECT title, author, reserved, bookID FROM book WHERE reserved is true";
if ($searchtitle && !$searchauthor) { // Title search only
    $query = $query . " and title like '%" . $searchtitle . "%'";
}
if (!$searchtitle && $searchauthor) { // Author search only
    $query = $query . " and author like '%" . $searchauthor . "%'";
}
if ($searchtitle && $searchauthor) { // Title and Author search
    $query = $query . " and title like '%" . $searchtitle . "%' and author like '%" . $searchauthor . "%'"; // unfinished
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
 

# Here's the query using bound result parameters
    // echo "we are now using bound result parameters <br/>";
    $stmt = $db->prepare($query);
    $stmt->bind_result($title, $author, $reserved, $bookID);
    $stmt->execute();
    
//    $stmt2 = $db->prepare("update onloan set 0 where bookid like ". $bookid);
//    $stmt2->bind_result($onloan, $bookid);
    

    echo '<table cellpadding="6" style="margin:0 0 0 50px; padding-bottom:150px">';
    echo '<tr><b><td class="headList">BookID</td><b> <td class="headList">Title</td> <td class="headList">Author</td> <td class="headList">Reserved</td></b></tr>';
    while ($stmt->fetch()) {
        if($reserved==1)
            $reserved="Yes";
       
        echo "<tr>";
        echo "<td> $bookID </td><td> $title </td><td> $author </td><td> $reserved </td>";
        echo '<td><a  id="button"href="returnBook.php?bookID=' . urlencode($bookID) . '">Return</a></td>';
        echo "</tr>";
        
    }
    echo "</table>";
    ?>

<?php include("footer.php"); ?>

