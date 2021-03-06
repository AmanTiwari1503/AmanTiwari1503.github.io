<?php   
session_start();  
if(!isset($_SESSION["sess_user"])){  
    header("location:login.php");  
} else {  
?>  
<!doctype html>  
<html>  
<head>  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bttn.css/0.2.4/bttn.css" />
<title>Welcome</title>  
    <style>   
        body{  
		margin-left:10px;
		margin-right:10px;
    background-color: azure ;  
    color: palevioletred;  
    font-family: Arial;
      
        }  
            h2 {  
    color: indigo;  
    font-family: Arial;   
}  
        h1 {  
    color: indigo;  
    font-family: Arial; 
}  
.titles{
	text-align:center;
	border:2px solid black;
	border-radius:5px 5px 0px 0px;
	padding:5px;
	background:url('todo.jpg');
	background-repeat:no-repeat;
	background-size:100% 100%;
	color:white;
}
.descriptions{
	text-align:center;
	padding:5px;
	background:url('description.jpg');
	background-repeat:no-repeat;
	background-size:100% 100%;
	color:white;
	border:2px solid black;
	border-radius:0px 0px 5px 5px;;
}
form{
	text-align:center;
}
.todo{
	border:2px solid black;
	border-radius:10px;
}
#heading{
	text-align:center;
	color:rgb(110,0,0);
	text-decoration:underline;
}	
#info{
	display:-webkit-box;
	-webkit-box-orient:horizontal;
}
#welcome{
	-webkit-box-flex:5;
	text-decoration:underline;
}
#lout{
	margin-top:18px;
	margin-right:15px;
}
.invalid{
	text-align:center;
	color:red;
}
.delete{
	float:right;
}
	    </style>  
</head>  
<body>  
<h1 style="text-align:center;text-decoration:underline;">NoteStore</h1> 
<div id="info">      
<h2 id="welcome">Welcome, <em><?=$_SESSION['sess_user'];?></em>!</h2> 
<a href="logout.php"><button class="bttn-jelly bttn-md bttn-warning" id="lout">Logout</button></a>  
</div>
<p>  
<form action="" method="POST">
Title:<br /><input type="text" name="title" /><br />
Description:<br /><textarea name="description" rows="7" cols="100">Type Something</textarea><br />
<input type="submit" value="ADD" name="submit" />  
</form>
</p>
<?php
$user=$_SESSION["sess_user"];
$mysqli=new mysqli("localhost","root","","user_registration") or die(mysqli_error());
	$sql = "SELECT * FROM TodoOf$user";
	$result = $mysqli->query($sql);
	echo '<h2 id="heading">Your TODO\'s</h2>';

	if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		echo '<div class="todo">';
        echo '<div class="titles">';
		echo $row["title"];
		echo '<form action="delete.php" method="POST" class="delete">';
		echo '<input type="hidden" name="var" value="'.$row["title"].'">';
		echo '<input type="hidden" name="nameuser" value="'.$user.'">';
		echo '<input type="submit" value="DELETE" name="sub">';
		echo '</form>';
		echo '</div>';
		echo '<div class="descriptions">';
		echo '<p>'.$row["description"].'</p>';
		echo '</div>';
		echo '</div>';
		echo '<br>';
    }
	}
if(isset($_POST["submit"])){
if(!empty($_POST['title']) && !empty($_POST['description'])) {  
    $title=$_POST['title'];  
    $description=$_POST['description']; 
	
	$query=$mysqli->query("SELECT * FROM TodoOf$user WHERE title='".$title."'");  
    $numrows=mysqli_num_rows($query);  
    if($numrows==0)  
    {  
    $sql="INSERT INTO TodoOf$user(title,description) VALUES('$title','$description')";
	$result=$mysqli->query($sql);
	
	if($result){
		echo '<div class="todo">';
		echo '<div class="titles">';
		echo $title;
		echo '<form action="delete.php" method="POST" class="delete">';
		echo '<input type="hidden" name="var" value="'.$title.'">';
		echo '<input type="hidden" name="nameuser" value="'.$user.'">';
		echo '<input type="submit" value="DELETE" name="sub">';
		echo '</form>';
		echo '</div>';
		echo '<div class="descriptions">';
		echo "<p>$description</p>";
		echo '</div>';
		echo '</div>';
		
	}
	else{
	echo '<br>';
    echo '<div class="invalid">';
    echo "Failure";  
	echo '</div>';
	}
	}
	else {  
    echo '<br>';
    echo '<div class="invalid">';
    echo "That todo already exists! Please try again with another.";  
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
</body>  
</html>  
<?php  
}  
?>  