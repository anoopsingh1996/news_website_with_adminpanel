<?php include("main-header.php");?>
		<div class="content">
		<h1 align="center">Login Here</h1>
		<?php session_start(); ?>
		<?php
			include("connect.php");
			if(isset($_POST['login']))
			{
				$email=$_POST['email'];
				$pwd=md5($_POST['pwd']);
				
				$result=mysqli_query($con,"select *from register
				where email='$email' AND password='$pwd'");
				if(mysqli_num_rows($result)==1)
				{
					$row=mysqli_fetch_assoc($result);
					if($row['status']==0)
					{
						echo "<p>Please Activate Your Account</p>";
					}
					else
					{
						$_SESSION['user']=$row['id'];
						header("location:home.php");
					}
				}
				else
				{
					echo "<p>Wrong Credentials</p>";
				}
				
			}
		?>
		<form method="POST" action="" 
		onsubmit="return loginValidation()">
			<table align="center">
				
				<tr>
					<td><label>Email</label></td>
					<td><input type="text" name="email" id="email" placeholder="Enter Emali"></td>
				</tr>
				<tr>
					<td><label>Password</label></td>
					<td><input type="password" name="pwd" id="pwd" placeholder="Enter Password"></td>
				</tr>
								
				<tr>
					<td></td>
					<td><input type="submit" name="login" 
					value="Login Now" style="color:green">
					<a href="forgot.php">Forgot Password</a>
					</td>
				</tr>
				
				
			</table>
		</form>
		</div>
		<script>
			function loginValidation()
			{
				if(document.getElementById("email").value=="")
				{
					alert("Enter Email");
					return false;
				}
				if(document.getElementById("pwd").value=="")
				{
					alert("Enter Password");
					return false;
				}
			}
		</script>
	<?php include("main-footer.php");?>