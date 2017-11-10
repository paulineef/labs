<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("admin.php");
}?>
<?php
include("../config.php");
$title = "Add new book";
include("admin_header.php");
?>

<?php
if (isset($_POST['newbooktitle'])) {
    // This is the postback so add the book to the database
    // Get data from the form with this values
    $newbooktitle = trim($_POST['newbooktitle']);
    $newbookauthor = trim($_POST['newbookauthor']);

    if (!$newbooktitle || !$newbookauthor) {
        printf("You must specify both a title and an author");
        printf("<br><a href=addbook.php>Return to home page </a>");
        exit();
    }

    $newbooktitle = addslashes($newbooktitle);
    $newbookauthor = addslashes($newbookauthor);

    //Open the database using the "Bibblan" account
	@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

    if ($db->connect_error) {
        echo "could not connect: " . $db->connect_error;
        printf("<br><a href=addbook.php>Return to home page </a>");
        exit();
    }

    // Prepare an insert statement and execute it
    $stmt = $db->prepare("INSERT INTO book(bookID, title, author, reserved) VALUES ('', ?, ?, false)");
    $stmt->bind_param('ss', $newbooktitle, $newbookauthor);
    $stmt->execute();
    printf("<br>Book Added!");
    printf("<br><a href=addbook.php>Return to previous page </a>");
    exit;
}

// Not a postback, so present the book entry form
?>
<html>
	<head>
		<title>Add book</title>
	  <link rel="stylesheet" type="text/css" href="main_admin.css">
	</head>
	<body>
		<h2>Add a new book</h2>
		<p>You must enter both a title and an author! </p>
		<form action="addbook.php" method="POST">
			<table cellpadding="4" style="margin:0 0 0 100px; padding-bottom:150px">
				<tbody>
					<tr>
						<td style="font-family:'roboto'">Title:</td>
						<td><INPUT type="text" name="newbooktitle"></td>
					</tr>
					<tr>
						<td style="font-family:'roboto'">Author:</td>
						<td><INPUT type="text" name="newbookauthor"></td>
					</tr>
					<tr>
						<td></td>
						<td><INPUT type="submit" name="submit" value="Add Book" style="margin-left: 65px"></td>
					</tr>
				</tbody>
			</table>
		</form>
	</body>
</html>
<style>
	
</style>
<?php include("../footer.php"); ?>