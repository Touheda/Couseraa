<?php 
$conn = new mysqli('localhost','root','','idb');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jquery Evidences</title>
    <style>
        .main{
            width:1170px;
            margin:0 auto;
        }
		table,tr,th,td{
			padding:5px;
			border:1px solid #000;
			border-collapse:collapse;
		}
		th {
			width: 150px;
		}
		#color{
			height:300px;
			width:400px;
			background:#000;
			color:#fff;
		}
		
		.error{color:red;}
		.success{color:green;}
    </style>
</head>
<body>
<div class="main">

<h2>INSERT DATA INTO STUDENT TABLE</h2>
<form id="insert">
<table>
	<tr>
		<th>Name:</th>
		<td><input type="text" name="name" /></td>
	</tr>
	<tr>
		<th>Round:</th>
		<td>
			<select name="round">
				<option value="">Select Round</option>
				<?php
					$result = $conn->query("SELECT * FROM batch");
					if($result->num_rows > 0){
						while($rounds = $result->fetch_assoc()){
							echo "<option value='".$rounds['round']."'>".$rounds['round']."</option>";
						}
					}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<th>Course:</th>
		<td>
			<select name="course">
				<option value="">Select Course</option>
				<option value="WDPF">WDPF</option>
				<option value="DDD">DDD</option>
				<option value="ESAD">ESAD</option>
				<option value="J2EE">J2EE</option>
				<option value="GAVE">GAVE</option>
				<option value="NT">NT</option>
			</select>
		</td>
	</tr>
	<tr>
		<th></th>
		<td><input type="submit" value="Submit" /></td>
	</tr>
</table>
</form>
<br/>
<br/>
<div>
<h2>ALL RESULT STUDENT TABLE</h2>
	<table>
		<thead>
			<tr>
				<th>Name</th>
				<th>Course</th>
				<th>Round</th>
			</tr>
		</thead>
		<tbody id="show">
		</tbody>
	</table>
</div>

<br/>
<br/>
<!--dependency Search-->
<h2>Dependency Search</h2>
<form>
Round:
	<select name="round2" id="round2">
				<option value="">Select Round</option>
				<?php
					$result = $conn->query("SELECT * FROM batch");
					if($result->num_rows > 0){
						while($rounds = $result->fetch_assoc()){
							echo "<option value='".$rounds['round']."'>".$rounds['round']."</option>";
						}
					}
				?>
	</select>
	Name:
	<select id="stdname">
		<option value="">Select Round First</option>
	</select>
</form>
<div>
<h2>Single Student Details</h2>
	<table>
		<thead>
			<tr>
				<th>Name</th>
				<th>Course</th>
				<th>Round</th>
			</tr>
		</thead>
		<tbody id="singleshow">
		</tbody>
	</table>
</div>
<!--Color Change-->
<h2>Random Color Change</h2>
<div id="color">
</div>
<br/>
<br/>
<h2>User Name Availability</h2>
<form>
	<table>
		<tr>
			<th>Name:</th>
			<td><input type="text" id="username" /></td>
		</tr>
	</table>
</form>	
<p id="msg"></p>

<br/>
<br/>
<br/>
<br/>

</div>
<script src="jquery-3.3.1.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
		//query for insert data
        $('#insert').on('submit',function(e){
			e.preventDefault();
			let formData = $(this).serialize();
			$.ajax({
				type:'POST',
				url:'insert.php',
				data:formData,
				success:function(result){
					$('#show').html(result);
				}
			});
		});
       //query for dependency Search
	   $('#round2').on('change',function(){
			let roundData = $(this).val();
			$.ajax({
				type:'POST',
				url:'search.php',
				data:({'roundData':roundData}),
				success:function(data){
					$('#stdname').html(data);
				}
			});
		});
	   //query for Second field dependency Search
	   $('#stdname').on('change',function(){
			let stdId = $(this).val();
			$.ajax({
				type:'POST',
				url:'search.php',
				data:({'stdId':stdId}),
				success:function(res){
					$('#singleshow').html(res);
				}
			});
		});
	   //random color change
	   setInterval(changeColor,1000)
       function changeColor(){
		   let colors = ['green','blue','yellow','pink'];
		   let randNo = Math.floor(Math.random()*colors.length);
		   let randColor = colors[randNo];
		   $('#color').css('background',randColor);
	   }
	   //User Name Availability--
	   $('#username').on('keyup',function(){
		   let username = $(this).val();
			$.ajax({
				type:'POST',
				url:'username.php',
				data:({'username':username}),
				success:function(msg){
					$('#msg').html(msg);
				}
			});
	   })
    });
</script>
</body>
</html>