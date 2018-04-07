<html>
	<head>
		<title>Reset Password</title>
	</head>
	<body>
		<h1>Reset Password</h1>
		
		<?php 
		$uid=base64_decode($_REQUEST['uid']);
		include("connect.php");
		
		if(isset($_POST['submit']))
		{
			$pwd=md5($_POST['pwd']);
			$cpwd=md5($_POST['cpwd']);
			
			if($pwd==$cpwd)
			{
				mysqli_query($con,"update register set 
				password='$pwd' where id=$uid");
				if(mysqli_affected_rows($con)>0)
				{
					echo "Passwords Updated Successfully.
					Please login Now
					<a href='login.php'>Login</a>";
				}
				else{
					echo "<p>Sorry UNable TO update</p>";
				}
			}
			else
			{
				echo "<p>Passwords DOes not MActh</p>";
			}
		}
		
		?>
		
		<form action="" method="POST">
			<table>
				<tr>
					<td>Enter New Password</td>
					<td><input type="password" name="pwd"></td>
				</tr>
				<tr>
					<td>Confirm New Password</td>
					<td><input type="password" name="cpwd"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="submit" 
					value="Submit"></td>
				</tr>
			</table>
		</form>
	</body>
</html>