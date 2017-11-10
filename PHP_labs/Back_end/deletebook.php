<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("admin.php");
}
?>
<?php
include("../config.php");
$title = "Delete book";
include("admin_header.php");
?>

<?php
if (isset($_GET['submit'])) {
    // We know the borrower so go ahead and check the book out
    # Get data from form
    $bookID = trim($_GET['bookID']);      // From the hidden field
    $bookID = addslashes($bookID);

    # Open the database using the "librarian" account
    @ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

    if ($db->connect_error) {
        echo "could not connect: " . $db->connect_error;
        printf("<br><a href=library.php>Return to Library </a>");
        exit();
    }

    // Prepare an update statement and execute it
    
        $stmt = $db->prepare("delete from book where bookID = ?");
        $stmt->bind_param('i', $bookID);
        $response = $stmt->execute();
        printf("<br>Book deleted!");
        printf("<br><a href=library.php>Return to Library </a>");
    exit;
}

// We don't have a borrower id yet so present a form to get one,
// then post back using a hidden field to pass through the bookid
// which came from the hand-crafted URL query string on the book
// search page
?>

<h2>Delete book</h2>
<form action="deletebook.php" method="GET">
    Are you sure you want to delete book?
    <?php
    $bookID = trim($_GET['bookID']);
    echo '<INPUT type="hidden" name="bookID" value=' . $bookID . '>';
    ?>
    <INPUT type="submit" name="submit" value="Continue">
</form>
<style>
	form {
		padding-bottom: 100px;
		font-family: "roboto";
		margin-left: 100px;
	}	
	inpu {
		margin-right: 20px;

	}
</style>
<?php include("../footer.php"); ?>