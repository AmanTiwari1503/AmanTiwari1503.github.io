<!doctype html>  
<html>  
<head> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bttn.css/0.2.4/bttn.css" />
<title>Login</title>  
    <style>   
        body{   
    background-color: azure ;  
    color: palevioletred;  
    font-family:Arial;  
    font-size: 100%  
      
        }  
            h1 {  
    color: indigo;  
    font-family:Arial;
	text-decoration:underline;	
}  
        h3 {  
    color: indigo;  
    font-family: verdana;    
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
<h1 style="text-align:center">NoteStore Login</h1>  
<h3 style="text-align:center">Login Form</h3>  
<form action="" method="POST">  
Username: <input type="text" name="user"><br /><br/>  
Password: <input type="password" name="pass"><br /><br />  
<input type="submit" value="LOGIN" name="submit" />  
</form>
<?php
if(isset($_POST["submit"])){  
  
if(!empty($_POST['user']) && !empty($_POST['pass'])) {  
    $user=$_POST['user'];  
    $pass=$_POST['pass'];  
  
    $mysqli=new mysqli("localhost","root","","user_registration") or die(mysqli_error());    
  
    $query=$mysqli->query("SELECT * FROM login WHERE username='".$user."' AND password='".$pass."'");  
    $numrows=mysqli_num_rows($query);  
    if($numrows!=0)  
    {  
    while($row=mysqli_fetch_assoc($query))  
    {  
    $dbusername=$row['username'];  
    $dbpassword=$row['password'];  
    }  
  
    if($user == $dbusername && $pass == $dbpassword)  
    {  
    session_start();  
    $_SESSION['sess_user']=$user;  
  
    /* Redirect browser */  
    header("Location: mem.php");  
    }  
    } else {  
	echo '<br>';
    echo '<div class="invalid">';
	echo 'Invalid username or password!';
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
<p style="text-align:center">New to my app? <a href="register.php"><button class="bttn-jelly bttn-md bttn-success">SIGN UP</button></a></p>
</body>  
</html>   