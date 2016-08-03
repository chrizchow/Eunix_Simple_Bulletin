<html>
<head>
	<title>Installation Page of Eunix Simple Bulletin</title>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="bootstrap/css/blog.css" rel="stylesheet">
	<!-- CKEditor is the free WYSIWYG Editor -->
    <script src="../ckeditor/ckeditor.js"></script>

</head>

<body>
    <div class="blog-masthead">
      <div class="container">
      	<!-- the navigation bar -->
        <nav class="blog-nav">
          <a class="blog-nav-item active" href="index.php">Home</a>
        </nav>

      </div>
    </div>

    <div class="container">
    	<div class="blog-header">
        	<h1 class="blog-title">Eunix SB Install Wizard</h1>
        	<p class="lead blog-description">Erasing all posts to create a new bulletin board.</p>
      	</div>

		<?php
		//Establish DB Connection:
		try{
			$dbconn = new PDO('sqlite:database.sqlite');
		}catch(PDOException $e){
			exit('Error on connecting DB<br />');
		}

		//Erase all things inside posts.db if needed:
		$sql_erase = 'DROP TABLE posts';
		$dbconn->exec($sql_erase);
		echo '<h2>Dropped Old Table...</h2>';

		//Create a new posts table:
		$sql_createNew = "CREATE TABLE posts(
						postID INTEGER PRIMARY KEY ASC,
						date INTEGER,
						authorID INTEGER,
						title varchar(128),
						content varchar(65535))";
		$dbconn->exec($sql_createNew);
		echo '<h3>Created New Table...</h3>';

		//Make a new "hello, world" post:
		$sql_helloWorld =  "INSERT INTO posts(date, authorID, title, content) 
					VALUES (20160610, 1, 'Hello', 'Hello, world! This is the content!')";
		$dbconn->exec($sql_helloWorld);
		echo '<h4>Added Hello Post...</h4>';
		echo "<h5>Everything's okay so far :)</h5>";

		?>
	</div>
</body>

</html>