<?php include("main-header.php");?>
<div class="content">
		<h1>Forgot Password</h1>
		
		<?php 
		include("connect.php");
		if(isset($_POST['submit']))
		{
			$email=$_POST['email'];
			$result=mysqli_query($con,"select *from 
			register where email='$email'");
			if(mysqli_num_rows($result)>0)
			{
				$row=mysqli_fetch_assoc($result);
				$id=base64_encode($row['id']);
				//print_r($row);
				$subject="Forgot Password";
				$message="Hi ".$row['name'].",<br>Your 
				forgotpassword request
				has been received successfully.
				please click the below link
				to reset paaword<br>
		<a href='http://localhost:8080/7am/resetpwd.php?uid=".$id."'>
				Reset Password</a><br><br>Thanks<br>Our Team";
				echo $message;
				$headers="Content-type:text/html";
				if(mail($email,$subject,$message,$headers))
				{
					echo "Reset Password link send to Registred
					email.Please check";
				}
			}
			else
			{
				echo "<p>Sorry! Email dos not match with our DB</p>";
			}
		}
		?>
		
		<form action="" method="POST">
			<table>
				<tr>
					<td>Enter Email</td>
					<td><input type="text" name="email"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="submit" 
					value="Submit"></td>
				</tr>
			</table>
		</form>
	</div>
<?php 
include("main-footer.php");
?>