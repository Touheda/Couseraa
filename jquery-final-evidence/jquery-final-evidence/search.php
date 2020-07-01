<?php 
$conn = new mysqli('localhost','root','','idbexxam');
if(!empty($_POST['roundData'])){
	$roundData=$_POST['roundData'];
	$selResult = $conn->query("SELECT * FROM student WHERE round='$roundData'");
		if($selResult->num_rows > 0){
			echo '<option value="">Select Name</option>';
			while($rounds = $selResult->fetch_assoc()){
				echo "<option value='".$rounds['id']."'>".$rounds['name']."</option>";
			}
		}
}else if(!empty($_POST['stdId'])){
	$stdId=$_POST['stdId'];
	$stdResult = $conn->query("SELECT * FROM student WHERE id='$stdId'");
	if($stdResult->num_rows > 0){
		while($data = $stdResult->fetch_assoc()){
			echo "<tr>
				<td>".$data['name']."</td>
				<td>".$data['course']."</td>
				<td>".$data['round']."</td>
			</tr>";
		}
	}
}
?>