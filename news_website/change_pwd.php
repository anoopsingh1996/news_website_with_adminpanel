<?php 
session_start();
if(isset($_SESSION['user']))
{
	$uid=$_SESSION['user'];
	include("connect.php");
	$result=mysqli_query($con,"select *from register where
	id=$uid");
	$row=mysqli_fetch_assoc($result);
	?>
		<html>
			<head>
				<title><?php echo ucfirst($row['name']);?> 
				| Change Password</title>
				<link rel="stylesheet" href="css/style.css">
			</head>
			<body>
				<div class="main">
					<?php include("menu.php")?>
					<div class="content">
						<h1>Change Password</h1>
						
						<?php 
						if(isset($_POST['update']))
						{
							$opwd=md5($_POST['pwd']);
							$npwd=md5($_POST['npwd']);
							$cnpwd=md5($_POST['cnpwd']);
							if($opwd==$row['password'])
							{
								if($npwd==$cnpwd)
								{
									mysqli_query($con,"update register set 
									password='$npwd' where id=$uid");
									if(mysqli_affected_rows($con)==1)
									{
										echo "<p>Password Changed 
										Successfully</p>";
									}
									else
									{
										echo "Sorry Unable toUpdate";
										echo mysqli_error($con);
									}
								}
								else
								{
									echo "Passwords DOes not MAtch";
								}
							}
							else
							{
								echo "<p>Old Password Does not Match 
								with Db</p>";
							}
						}
						?>
						
						<form action="" method="POST">
							<table>
								<tr>
									<td>Old Password</td>
									<td><input type="password" name="pwd"></td>
								</tr>
								<tr>
									<td>New Password</td>
									<td><input type="password" name="npwd"></td>
								</tr>
								<tr>
									<td>Confirm New Password</td>
									<td><input type="password" name="cnpwd"></td>
								</tr>
								<tr>
									<td></td>
									<td><input type="submit" name="update" 
									value="Update"></td>
								</tr>
							</table>
						</form>
					</div>
					<?php include("footer.php")?>
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