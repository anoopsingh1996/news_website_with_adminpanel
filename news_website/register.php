<?php include("main-header.php");?>
<div class="content">
		<h1 align="center">Register Here</h1>
		<?php
			include("connect.php");
			if(isset($_POST['register']))
			{
				$name=mysqli_real_escape_string($con,$_POST['name']);
				$email=mysqli_real_escape_string($con,$_POST['email']);
				$pwd=mysqli_real_escape_string($con,md5($_POST['pwd']));
				$mobile=mysqli_real_escape_string($con,$_POST['mobile']);
				$city=mysqli_real_escape_string($con,$_POST['city']);
				$state=mysqli_real_escape_string($con,$_POST['state']);
				$gender=mysqli_real_escape_string($con,$_POST['gender']);
				$address=mysqli_real_escape_string($con,$_POST['addr']);
				$pincode=mysqli_real_escape_string($con,$_POST['pincode']);
				$terms=mysqli_real_escape_string($con,$_POST['terms']);
				//genaral Information
				$ip=$_SERVER['REMOTE_ADDR'];
				$date=time();
				
				mysqli_query($con,"insert into register(
				name,email,password,address,city,state,mobile,
				pincode,gender,terms,date,ip
				)values('$name','$email','$pwd','$address',
				'$city','$state','$mobile','$pincode','$gender',
				$terms,$date,'$ip')");
				if(mysqli_affected_rows($con)>0)
				{
					$id=mysqli_insert_id($con);
					$subject="Activation Link";
					$message="Hi ".$name.",<br><br>Thanks! You have
					been registered successfully,your account details
					are:<br><br>Email:Your Email<br>Password:".$_POST['pwd']."<br><br>
					To get Access our web site please click the below link toactivate your account
					<br><br><a href='http://localhost:8080/7am/activate.php?uid=".$id."' target='_blank'>Activate Now</a><br><br>Thanks<br>OurTeam";
					$headers="Content-type:text/html";
					
					echo $message;
					echo "<br>";
					
					/*if(mail($email,$subject,$message,$headers))
					{
						echo "Registered Successfully! Please activate your account";
					}*/
				}
				else{
					echo "<p>Sorry! Unable to Register, Try Again</p>";
					echo "<p>".mysqli_error($con)."</p>";
				}
				
				
			}
		?>
		<form method="POST" action="" onsubmit="return validation()">
			<table align="center">
				<tr>
					<td><label>Name</label></td>
					<td>
						<input type="text" 
						name="name" id="name">
						<span id="err_name"></span>
					</td>
				</tr>
				<tr>
					<td><label>Email</label></td>
					<td>
						<input onblur="checkEmail(this.value)" type="text" 
						name="email" id="email">
						<span style="color:red" id="email_err"></span>
					</td>
				</tr>
				<tr>
					<td><label>Password</label></td>
					<td><input type="password" name="pwd" id="pwd"></td>
				</tr>
				<tr>
					<td><label>Confirm Password</label></td>
					<td><input type="password" name="cpwd" id="cpwd"></td>
				</tr>
				<tr>
					<td><label>Mobile</label></td>
					<td><input type="text" name="mobile" id="mobile"></td>
				</tr>
				<tr>
					<td><label>Gender</label></td>
					<td>
						<input type="radio" value="Male" name="gender" id="gender">Male &nbsp;
						<input type="radio" value="Female" name="gender" id="gender">Female
					</td>
				</tr>
				
				<tr>
					<td><label>Address</label></td>
					<td><textarea cols="22" rows="3" id="addr" name="addr"></textarea></td>
				</tr>
				
				<tr>
					<td><label>City</label></td>
					<td><input type="text" name="city" id="city"></td>
				</tr>
				
				<tr>
					<td><label>State</label></td>
					<td><select id="state" name="state">
						<option value="">--Select State--</option>
						<option value="Telangana">Delhi</option>
						<option value="Madhyapradesh">Madhyapradesh</option>
						<option value="Uttarpradesh">Uttarpradesh</option>
						<option value="Andhrapradesh">Andhrapradesh</option>
						<option value="Maharastra">Maharastra</option>
						<option value="Bihar">Bihar</option>
					</select></td>
				</tr>
				
				<tr>
					<td><label>Pincode</label></td>
					<td><input type="text" name="pincode" id="pincode"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="checkbox" name="terms" id="terms" value="1">
					Please accept <a href=''>terms and conditions</a></td>
				</tr>
				
				<tr>
					<td></td>
					<td><input type="submit" name="register" value="Register Now"></td>
				</tr>
				
			</table>
		</form>
		</div>
		<script>
		
			function checkEmail(e)
			{
				var obj;
				/*if(window.XMLHttpRequest)
				{
					obj=new XMLHttpRequest();
				}
				else
				{
					obj=new ActiveXObject("MicrosoftXMLHTTP");
				}*/
				obj=new XMLHttpRequest();
				
				obj.onreadystatechange=function(){
					if(obj.readyState==4)
					{
						if(obj.responseText==1)
						{
							document.getElementById("email_err").innerHTML="Email alredy Exists";
						}
						else
						{
							document.getElementById("email_err").innerHTML="";
						}
					}
				}
				
				obj.open("GET","check.php?email="+e,true);
				obj.send();
				
			}
		
		
			function validation()
			{
				if(document.getElementById("name").value=="")
				{
					alert("Enter Name");
					document.getElementById("name").focus();
					return false;
				}
				if(document.getElementById("email").value=="")
				{
					alert("Enter Email");
					document.getElementById("email").focus();
					return false;
				}
				else
				{
					var email=document.getElementById("email").value;
					var pat=/^([a-zA-Z0-9\_\.\-])+\@(([a-zA-Z0-9])+\.)+([a-zA-Z]{2,4})+$/;
					if(!pat.test(email))
					{
						alert("Please Enter Valid EMail");
						return false;
					}
				}
				
				var pwd=document.getElementById("pwd").value;
				if(pwd=="")
				{
					alert("Enter Password");
					document.getElementById("pwd").focus();
					return false;
				}
				else
				{
					if(pwd.length<5)
					{
						alert("Password length More than 5chars");
						return false;
					}
				}
				var cpwd=document.getElementById("cpwd").value;
				if(cpwd=="")
				{
					alert("Enter COnfirm Password");
					document.getElementById("cpwd").focus();
					return false;
				}
				if(pwd!=cpwd)
				{
					alert("passwords Does not Match");
					return false;
				}
				var mobile=document.getElementById("mobile").value;
				if(mobile=="")
				{
					alert("Enter MObile NUmber");
					document.getElementById("mobile").focus();
					return false;
				}
				else
				{
					var mpat=/^\d{10}$/
					if(!mpat.test(mobile))
					{
						alert("Please Enter Valid NUmber");
					document.getElementById("mobile").focus();
					return false;
					}
				}
			}
		</script>
<?php include("main-footer.php");?>