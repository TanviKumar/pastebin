<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
    <?php
    require('db.php');
    $unique = 0;
    
    // If form submitted, insert values into the database.
    if (isset($_REQUEST['username'])){
        $username = stripslashes($_REQUEST['username']); // removes backslashes
        $username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con,$password);
        $trn_date = date("Y-m-d H:i:s");

        if(isset($username)){
            $sql = mysqli_query($con,"SELECT * FROM `users` WHERE username = '$username'");
            $get_rows= mysqli_num_rows($sql);
            if($get_rows >=1){
            echo "user exists";
            }

            else{
                $query = "INSERT into users (username, password, trn_date) VALUES ('$username', '".md5($password)."',  '$trn_date')";
                $result = mysqli_query($con,$query);
                if($result){
                    echo "<div class='form'><h3>You are registered successfully.</h3><br/>
                    Click here to <a href='login.php'>Login</a></div>";
                }
            }



        }
       
        
    }

?>
<link rel="stylesheet" href="style.css" />
</head>
<body>

<div class="form">
<h1>Registration</h1>
<form name="registration" action="" method="post">
<input type="text" name="username" placeholder="Username" required />
<input type="password" name="password" placeholder="Password" required />
<input type="submit" name="submit" value="Register" />
</form>
</div>
</body>
</html>