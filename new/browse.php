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
			$books = array();
			$books[] = array("title" => "Love", "author" => "Johan John");
			$books[] = array("title" => "Batman", "author" => "Kingsly Urban");
			$books[] = array("title" => "Jo Levis", "author" => "Jo Levis");
			$books[] = array("title" => "Exit", "author" => "Anonymous");	
				
            if (isset($_POST) && !empty($_POST)) {	
				                
                $searchtitle = trim($_POST['searchtitle']);
                $searchauthor = trim($_POST['searchauthor']);

                $searchtitle = addslashes($searchtitle);
                $searchauthor = addslashes($searchauthor);        
                
                $id = array_search($searchtitle, array_column($books, 'title'));
				$id2 = array_search($searchauthor, array_column($books, 'author'));

                echo '<table>';
                echo '<tr><th>Title</th> <th>Author</th> <th>Reserve</th></tr>';
                
                if ($id !== FALSE) {
                    $book = $books[$id];
                    $title = $book['title'];
                    $author = $book['author'];
                    echo "<tr>";
                    echo "<td> $title </td><td> $author </td>";
                    echo '<td><a href="reserve.php?reservation=' .  urlencode($title) . '"> Reserve </a></td>';
                    echo "</tr>";

                } elseif ($id2 !== FALSE) {
                    $book = $books[$id2];
                    $title = $book['title'];
                    $author = $book['author'];
                    echo "<tr>";
                    echo "<td> $title </td><td> $author </td>";
                    echo '<td><a href="reserve.php?reservation=' .  urlencode($title) . '"> Reserve </a></td>';
                    echo "</tr>";
               		}
                	echo "</table>";

            	} else {                
	                echo '<table cellpadding="6">';
	                echo '<tr><th>Title</th> <th>Author</th> <th>Reserve</th></tr>';
	                foreach ($books as $book) {
	                    $title = $book['title'];
	                    $author = $book['author'];
	                    echo "<tr>";
	                    echo "<td> $title </td><td> $author </td>";
	                    echo '<td><a href="reserve.php?reservation=' . urlencode($title) . '"> Reserve </a></td>';
	                    echo "</tr>";
	                }
	                echo "</table>";
            	}
            ?>

		</div>
	</div>
</body>

<?php include ('footer.php'); ?>