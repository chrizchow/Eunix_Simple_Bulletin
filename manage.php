<html>
<head>
	<title>Manage Posts - Eunix Simple Bulletin</title>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="bootstrap/css/blog.css" rel="stylesheet">

</head>

<body>
    <div class="blog-masthead">
      <div class="container">
      	<!-- the navigation bar -->
        <nav class="blog-nav">
          <a class="blog-nav-item active" href="index.php">Home</a>
          <a class="blog-nav-item" href="post.php">Write New Post</a>
          <a class="blog-nav-item" href="manage.php">Post Management</a>
          <a class="blog-nav-item" href="#">About</a>
        </nav>

      </div>
    </div>

    <div class="container">

      <div class="blog-header">
        <h1 class="blog-title">Eunix Simple Bulletin</h1>
        <p class="lead blog-description">Deleting old posts with correct authorID.</p>
      </div>

      <?php
     	//Establish DB Connection:
		try{
			$dbconn = new PDO('sqlite:database.sqlite');
		}catch(PDOException $e){
			exit('<h1>Error on connecting DB</h1><br />');
		}

		//Check if there's any GET requests first:
		$delete = htmlspecialchars($_POST["delete"]);
		$authorID = htmlspecialchars($_POST["authorID"]);

		//If there's anything in $delete, handle it:
		if(!empty($delete)){
			//Do author ID checking:
			if($authorID!=20124101){
				exit("Stop: authorID is not correct.<br />");
			}

			//Delete the entry:
			$sql_delete = 'DELETE FROM posts WHERE postID=?';
			$sth = $dbconn->prepare($sql_delete);
			$sth->execute(array($delete));
			echo "Post with postID {$delete} has been deleted.<br />";
		}

		//After that, read the posts and display them:
		$sth = $dbconn->prepare('SELECT postID, title FROM posts');
		$sth->execute();

		//Display the executed and fetched result:
		echo "<table style='width:100%' border='1px'>";
		echo "<tr><td>postID</td><td>Title</td><td>Operation</td></tr>";
		$result = $sth->fetchAll();
		for($i = 0; $i<count($result); $i++){
			echo "\n<tr>";
			echo "\n	<td>{$result[$i][postID]}</td>";
			echo "\n	<td>{$result[$i][title]} </td>";
			echo "\n 	<td><form method=\"post\" action={$_SERVER["PHP_SELF"]}>";
			echo "authorID: <input type=\"password\" name=\"authorID\"> ";
			echo "<button name=\"delete\" value=\"{$result[$i][postID]}\">Delete</button></form></td>";
			echo "\n</tr>";
		}
		echo "\n</table>";

	  ?>
    </div>
</body>

</html>
