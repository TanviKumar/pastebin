<html>
<head>
	<title>Snippet</title>
	<style type="text/css">
		body {
		     font-family:Arial, Sans-Serif;
		     background-color: cyan;
		}
		.form{
		     width: 400px;
		     margin: 0 auto;
		}
		.snippet{
		     width :400px;
		     min-height: 400px;
		     border:3px solid black;

		}
	</style>
	<?php
		require('db.php');
		session_start();
		if(isset($_GET["id"])){
	    	$id = $_GET["id"];
	    }
	    $q = "SELECT id, username,title, snippet,language, privacy, anonimity FROM snippets WHERE id = '".$id."' ";
    	$sql = mysqli_query($con,$q);

    	while($result = mysqli_fetch_array($sql)){
  
	      if(!empty($result["snippet"])){
	         $snippet = $result["snippet"];
	       }
	      
	      $language= "Language : ".$result["language"];
	     
	      if($result["privacy"]==1 && isset($_SESSION["username"]) && 
	       	  $result["username"]==$_SESSION["username"]){
	          //Private snippet
	   		  echo  "<div class='form'><br>
	   			<p> Title:     " . $result["title"]."</p> 
	   			<br>
	   			<p >Snippet : <br></p >
	   			<div class='snippet'><code>".$snippet. "</code></div>
	   			<p> Language: ".$result['language']."</p>
	   			<br></div>";
	       }
	      else if($result["privacy"]==0){
	        //Public snippet

	        if($result["anonimity"]==0){
	          echo "<p class='form'>Snippet contributed by : "
	          .$result["username"]."</p>";
	         } 
	        else{
	          echo "<p class='form'>Snippet contributed by Anonymous user</p>";
	        }

	         print  "<div class='form'><br>
	         	<p> Title:     " . $result["title"]."</p> 
	         	<br>
	         	<p>Snippet : <br></p>
	         	<div class='snippet'><code>".$snippet. "</code></div>
	         	<p> Language: ".$result['language']."</p>
	         	<br></div>";
	         }
	        else{
	          echo "<p class='form'>Sorry this snippet is set private by the contributor</p>";
	        }

	     
	   

	    }
	
	?>
</head>
<body>

</body>
</html>