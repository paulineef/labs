
<?php

include("config.php");

$bookID = trim($_GET['bookID']);
echo '<INPUT type="hidden" name="bookID" value=' . $bookID . '>';

$bookID = trim($_GET['bookID']);      // From the hidden field
$bookID = addslashes($bookID);

@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

    if ($db->connect_error) {
        echo "could not connect: " . $db->connect_error;
        printf("<br><a href=index.php>Return to home page </a>");
        exit();
    }
    
   echo $bookID;

    // Prepare an update statement and execute it
    $stmt = $db->prepare("UPDATE books SET reserved=0 WHERE bookID = ?");
    $stmt->bind_param('i', $bookID);
    $stmt->execute();
    printf("<br>Succesfully returned!");
    printf("<br><a href=browse.php>Search and Book more Books </a>");
    printf("<br><a href=mybooks.php>Return to Reserved Books </a>");
    printf("<br><a href=index.php>Return to home page </a>");
    exit;

?>

    


