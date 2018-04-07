<?php 
session_start();
if(isset($_SESSION['user']))
{
	include("connect.php");
	$uid=$_SESSION['user'];
	$result=mysqli_query($con,"select *from register 
	where id=$uid");
	$row=mysqli_fetch_assoc($result);
	?>
		<html>
			<head>
				<title><?php echo ucfirst($row['name']); ?> 
				| Edit Profile</title>
				<link rel="stylesheet" href="css/style.css">
			</head>
			<body>
				<div class="main">
					<?php include("menu.php"); ?>
					<div class="content">
						<h1>Edit Profile</h1>
						
						<?php 
						if(isset($_REQUEST['msg']))
						{
							echo "<p>Updated Successfuly</p>";
						}
						?>
						
						<?php 
						if(isset($_POST['update']))
						{
							$name=$_POST['name'];
							$mobile=$_POST['mobile'];
							$gender=$_POST['gender'];
							$addr=$_POST['address'];
							$city=$_POST['city'];
							$state=$_POST['state'];
							$pin=$_POST['pincode'];
							
							mysqli_query($con,"update register set
							name='$name',mobile='$mobile',gender='$gender',
							address='$addr',city='$city',pincode='$pin',
							state='$state' where id=$uid");
							if(mysqli_affected_rows($con)==1)
							{
								header("location:edit.php?msg=1");
							}
							else
							{
								echo "<p>Sorry! Unable to Update</p>";
							}
						}
						?>
						
						
						<form method="POST" action="">
							<table>
								<tr>
									<td>Name</td>
									<td><input value="<?php echo $row['name']?>" 
									type="text" name="name"></td>
								</tr>
								<tr>
									<td>Mobile</td>
									<td><input value="<?php echo $row['mobile']?>"
									type="text" name="mobile"></td>
								</tr>
								<tr>
									<td>Gender</td>
									<td>
										<input value="Male" 
										<?php if($row['gender']=="Male") echo "checked"?>
										type="radio" name="gender">Male &nbsp;
										<input VALUE="Female" 
										<?php if($row['gender']=="Female") echo "checked"?> 
										type="radio" name="gender">Female
									</td>
								</tr>
								<tr>
									<td>Address</td>
									<td><textarea name="address">
									<?php echo $row['address']?></textarea></td>
								</tr>
								<tr>
									<td>City</td>
									<td><input value="<?php echo $row['city']?>" 
									type="text" name="city"></td>
								</tr>
								<tr>
									<td><label>State</label></td>
									<td><select id="state" name="state">
										<option value="">--Select State--</option>
										<option <?php if($row['state']=="Telangana") 
											echo "selected"; ?> value="Telangana">Telangana</option>
										<option <?php if($row['state']=="Madhyapradesh") 
											echo "selected"; ?> value="Madhyapradesh">
										Madhyapradesh</option>
										<option <?php if($row['state']=="Uttarpradesh") echo "selected"; ?> value="Uttarpradesh">Uttarpradesh</option>
										<option <?php if($row['state']=="Andhrapradesh") echo "selected"; ?> value="Andhrapradesh">Andhrapradesh</option>
										<option <?php if($row['state']=="Maharastra") echo "selected"; ?> value="Maharastra">Maharastra</option>
										<option <?php if($row['state']=="Bihar") echo "selected"; ?>value="Bihar">Bihar</option>
									</select></td>
								</tr>
								<tr>
									<td>Pincode</td>
									<td><input value="<?php echo $row['pincode']?>"
									type="text" name="pincode"></td>
								</tr>
								<tr>
									<td></td>
									<td><input value="Update" type="submit" 
									name="update"></td>
								</tr>
							</table>
						</form>
					</div>
					<?php include("footer.php");?>
				</div>
			</body>
		</html>
	<?php
}
else
{
	header("location:login.php");
}
?>