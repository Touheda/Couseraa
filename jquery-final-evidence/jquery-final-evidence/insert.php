<?php 
$conn = new mysqli('localhost','root','','idbexxam');
if(!empty($_POST['name']) || !empty($_POST['course']) || !empty($_POST['round'])){
$name=$_POST['name'];
$course=$_POST['course'];
$round=$_POST['round'];
$insertRes = $conn->query("INSERT INTO student(name, course, round) VALUES('$name','$course','$round')");
if($insertRes){
	$selResult = $conn->query("SELECT * FROM student");
	if($selResult->num_rows > 0){
		while($data = $selResult->fetch_assoc()){
			echo "<tr>
				<td>".$data['name']."</td>
				<td>".$data['course']."</td>
				<td>".$data['round']."</td>
			</tr>";
		}
	}
}
}
?>
<?php

$conn = new mysqli("localhost", "root", "", "idbexxam");

$sql = "SELECT * FROM round";
$result = $conn->query($sql);	

if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {	

		echo "<option value='".$row['id'] ."'>".$row['round'] ."</option>";

		}
		
	}

	
$conn->close();
?>