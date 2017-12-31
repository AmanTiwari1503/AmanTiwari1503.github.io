<!doctype html>  
<html>  
<head>  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bttn.css/0.2.4/bttn.css" />
<title>Register</title>  
    <style>   
        body{    
    background-color: azure ;  
    color: palevioletred;  
    font-family:Arial;
        }  
            h1 {  
    color: indigo;  
    font-family:Arial;
	text-decoration:underline;
}  
         h2 {  
    color: indigo;  
    font-family:Arial;
	text-align:center;
	text-decoration:underline;
}
form{
	text-align:center;
}
.invalid{
	text-align:center;
	color:red;
}
</style>  
</head>  
<body>       
<h1 style="text-align:center">NoteStore Sign Up</h1>   
<h2>Registration Form</h2>
<form action="" method="POST">         
Username:<input type="text" name="user"><br /><br />
Password:<input type="password" name="pass"><br /><br /> 
<input type="submit" value="REGISTER" name="submit" />      
</form> 
<?php 
$mysqli=new mysqli("localhost","root","","user_registration") or die(mysqli_error()); 
$sqldata = "CREATE TABLE IF NOT EXISTS `login`(
	`username` VARCHAR(200) NOT NULL,
	`password` VARCHAR(200) NOT NULL,
	PRIMARY KEY(`username`)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$table=$mysqli->query($sqldata);
if(isset($_POST["submit"])){  
if(!empty($_POST['user']) && !empty($_POST['pass'])) {  
    $user=$_POST['user'];  
    $pass=$_POST['pass'];   
    $query=$mysqli->query("SELECT * FROM login WHERE username='".$user."'");  
    $numrows=mysqli_num_rows($query);  
    if($numrows==0)  
    {  
    $sql="INSERT INTO login(username,password) VALUES('$user','$pass')";  
  
    $result=$mysqli->query($sql);
	$sqldata = "CREATE TABLE IF NOT EXISTS `TodoOf$user`(
	`title` VARCHAR(200) NOT NULL,
	`description` VARCHAR(200) NOT NULL,
	PRIMARY KEY(`title`)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
        if($result && $mysqli->query($sqldata)){  
	echo '<br>';
    echo '<div class="invalid">';
    echo "Account Successfully Created and Database ready";  
	echo '</div>';
	session_start();  
    $_SESSION['sess_user']=$user; 
	header("location:mem.php");
    } else {  
	echo '<br>';
    echo '<div class="invalid">';
    echo "Failure!";  
	echo '</div>';
    }  
  
    } else {  
	echo '<br>';
    echo '<div class="invalid">';
    echo "That username already exists! Please try again with another.";  
	echo '</div>';
    }  
  
} else {  
	echo '<br>';
    echo '<div class="invalid">';
    echo "All fields are required!";  
	echo '</div>';
}  
}  
?>
<p style="text-align:center">Already have an account? <a href="login.php"><button class="bttn-unite bttn-md bttn-primary">LOG IN</button></a></p>  
</body>  
</html>   