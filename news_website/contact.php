<?php include("main-header.php")?>
<div class="content">
		<h1>Contact Form</h1>
		<?php 
			if(isset($_POST['submit']))
			{
				$name=$_POST['name'];
				$email=$_POST['email'];
				$mobile=$_POST['mobile'];
				$msg=$_POST['msg'];
				
				$con=mysqli_connect("localhost","root","","7am");
				
				mysqli_query($con,
				"INSERT INTO contact values('','$name','$email',
				'$mobile','$msg')");
				if(mysqli_affected_rows($con))
				{
					echo "Thanks! We will get back you soon";
				}
				else
				{
					echo "Sorry! Unable to Submit, Please 
					Try Again";
				}
				
			}
		?>
		<form method="POST" action="" 
		onsubmit="return validate()">
			<label>Name</label><br>
			<input type="text" name="name" id="name">
			<br><br>
			<label>Email</label><br>
			<input type="text" name='email' id='email'>
			
			<br><br>
			<label>Mobile</label><br>
			<input type="text" name='mobile' id='mobile'>
			
			<br><br>
			<label>Message</label><br>
			<textarea name='msg' id='msg'></textarea>
			<br><br>
			<input type="submit" name="submit" value="Send">
		</form>
	</div>
		<script>
			function validate()
			{
				var name= document.getElementById("name").value;
				if(name=="")
				{
					alert("Please Enter Name");
					//document.getElementById("name").focus();
					return false;
				}
				var email=document.getElementById("email").value;
				if(email=="")
				{
					alert("Please Enter Email");
					return false;
				}
				
				var mobile=document.getElementById("mobile").value;
				if(mobile=="")
				{
					alert("Please Enter Mobile");
					return false;
				}
				
				var msg=document.getElementById("msg").value;
				if(msg=="")
				{
					alert("Please Enter Your Message");
					return false;
				}
				
				
			}
		</script>
<?php include("main-footer.php");?>