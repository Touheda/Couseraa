<?php 
$conn = new mysqli('localhost','root','','idb');
if(!empty($_POST['username'])){
	$username=$_POST['username'];
	$selResult = $conn->query("SELECT * FROM users WHERE username='$username' LIMIT 1");
		if($selResult->num_rows == 1){
			echo "<span class='error'>This Username is not Available!</span>";
		}else{
			echo "<span class='success'>This Username is Available!</span>";
		}
}else{
	echo "<span class='error'>Please input a Username...</span>";
}
?>