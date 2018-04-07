<?php session_start(); 
if(isset($_SESSION['user']))
{
	$sid=$_SESSION['user'];
	include("connect.php");
	$result=mysqli_query($con,"select *from register where
	id=$sid");
	$row=mysqli_fetch_assoc($result);
	date_default_timezone_set("Asia/Calcutta");
	
	?>
	<html>
		<head>
			<title><?php echo ucfirst($row['name'])?> 
			Profile</title>
			<link href="css/style.css" rel="stylesheet">
		</head>
		<body>
			<div class="main">
				
				<?php 
					include("menu.php")
				?>
				<div class='content'>
				
					<h1 class="title">Welcome to 
					<?php echo ucfirst($row['name'])?></h1>
						<div class="table-content">
							<table>
							<tr>
								<td>Username</td>
								<td><?php echo $row['name']?></td>
							</tr>
							<tr>
								<td>Email</td>
								<td><?php echo $row['email']?></td>
							</tr>
							<tr>
								<td>MObile</td>
								<td><?php echo $row['mobile']?></td>
							</tr>
							<tr>
								<td>Gender</td>
								<td><?php echo $row['gender']?></td>
							</tr>
							<tr>
								<td>Address</td>
								<td><?php echo $row['address']?></td>
							</tr>
							<tr>
								<td>City</td>
								<td><?php echo $row['city']?></td>
							</tr>
							<tr>
								<td>State</td>
								<td><?php echo $row['state']?></td>
							</tr>
							<tr>
								<td>Pincode</td>
								<td><?php echo $row['pincode']?></td>
							</tr>
							<tr>
								<td>Date Of Reg</td>
								<td><?php echo date("l, dS F Y h:i:s a",$row['date'])?></td>
							</tr>
						</table>
						</div>
						
					
				</div><!--Content Div End-->
				<?php 
					include("footer.php");
				?>
			</div><!--Main_div_End-->
		</body>
	</html>
	<?php
}
else
{
	header("location:login.php");
}

?>
