<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Welcome Home</title>
		<link rel="stylesheet" href="style.css" />
		<?php
		include("auth.php");
		require('db.php');
		if(isset($_REQUEST['submit'])){
			

			if(isset($_POST["title"])){
				$title = $_POST["title"];
			}

			if(isset($_POST["snippet"])){
				$snippet = $_POST["snippet"];
			}
			
			$username = $_SESSION['username'];

			if(isset($_POST["privacy"])){
				$privacy=1;
			}
			else{
				$privacy=0;
			}

			if(isset($_POST["language"])){
				$language=$_POST["language"];

			}

			if(isset($_POST["anonymity"])){
				$anonymity=1;
			}
			else{
				$anonymity=0;
			}

            if($stmt= $con->prepare("INSERT into `snippets` (`username`, `title`, `snippet`, `language`, `privacy`, `anonimity`) VALUES (?,?,?,?,?,?)")){
                    $stmt->bind_param("ssssii", $username, $title, $snippet, $language,$privacy,$anonymity);
                    $stmt->execute();
                    $stmt->close();
                }
            else{
              	echo "fail";
              }
              
		}else{
		};
		?>
	</head>
	<body>
		<div class="form">
		<form action="" method="post" name="snippetForm">
			<p>Welcome!</p>
			<input name="title" type="text" placeholder="Title" required>
			<br>
			<br>
			<textarea rows="25" cols="50" name="snippet" placeholder=" Enter Snippet"></textarea>
			<br>
			<br>
			<p> Keep it Private : <input type = "radio" name = "privacy"></p>
      		<p> Anonymous : <input type = "radio" name = "anonymity"></p>	

			<input type="text" name="language" placeholder="language" required>
			<br>
			<br>
			<input name="submit" type="submit" value="Create" required>
			<br>	
			<br>	
			<a href="logout.php">Logout</a>
		</form>
		</div>
	</body>
</html>
