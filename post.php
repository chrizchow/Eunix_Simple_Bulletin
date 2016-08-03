<?php 

//Take the content first:
$title = htmlspecialchars($_POST["title"]);
$date = htmlspecialchars($_POST["date"]);
$authorID = htmlspecialchars($_POST["authorID"]);
$content = htmlspecialchars($_POST["content"]);

?>
<html>
<head>
	<title>New Post - Eunix Simple Bulletin</title>
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
          <a class="blog-nav-item" href="post.php">Write New Post</a>
          <a class="blog-nav-item" href="manage.php">Post Management</a>
          <a class="blog-nav-item" href="#">About</a>
        </nav>

      </div>
    </div>

    <div class="container">

      <div class="blog-header">
        <h1 class="blog-title">Eunix Simple Bulletin</h1>
        <p class="lead blog-description">Posting a new post into the bulletin board.</p>
      </div>

      <!-- This form is sumbit form: -->
	  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<p>Title: <input type="text" name="title" size="60" value="<?php echo $title; ?>"></p>
		<p>Date Number: <input type="number" name="date" value="<?php echo $date; ?>"></p>
		<p>Author ID: <input type="password" name="authorID" value="<?php echo $authorID; ?>"></p>
		<p>Content: <br /> 
		<textarea name="content" id="content_editor">
		<?php echo $content; ?>
		</textarea>
		</p>
		<script>
			CKEDITOR.replace( 'content_editor' );
		</script>
		<input type="submit">
	  </form>

	<?php
	//Handling sumbit thing:

	//Check if it is POST method:
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		//Data Validation:
		if (empty($title) || empty($authorID) || 
			empty($content) || empty($date)){
			//Prompt user to check things:
			exit("Something is missing, please check ! <br />");

		}else{
			echo "Everything is fine. Checking authorID...<br />";
			//Check authorID, currently only 20124101 works:
			if($authorID!=20124101){
				exit('Stop: authorID is wrong');
			}

			//Data is valid, put content inside database...
			
			//Establish DB Connection:
			try{
				$dbconn = new PDO('sqlite:database.sqlite');
			}catch(PDOException $e){
				echo 'Error on connecting DB!...<br />';
			}

			//Insert SQL:
			$sql_insert = 'INSERT INTO posts (title, date, authorID, content) VALUES (?, ?, ?, ?)';
			//$insertData = array($title, $date, $authorID, $content);
			$insertData = array($title, $date, $authorID, $_POST["content"]);
			$sth = $dbconn->prepare($sql_insert);
			try{
				if($sth->execute($insertData)){
					echo "Added to bulletin successfully!<br />";
				}else{
				echo "Failed to add data: Error 67<br />";
				}
			}catch(PDOException $e){
				echo "Failed to add data: Error 70<br />";
			}

		}

	}

	?>

	</div>
</body>

</html>





