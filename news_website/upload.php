<html>
	<head>
		<title>
			File Uploading
		</title>
	</head>	
	<body>
		<h1>File Uploading</h1>
		<?php 
			if(isset($_POST['upload']))
			{
				$name=$_POST['uname'];
				$email=$_POST['email'];
				$pwd=$_POST['pwd'];
				
				$filename=$_FILES['image']['name'];
				$size=$_FILES['image']['size'];
				$type=$_FILES['image']['type'];
				$tname=$_FILES['image']['tmp_name'];
				
				/*echo "FileName:".$filename."<br>";
				echo "FileSize:".$size."kb<br>";
				echo "FileType:".$type."<br>";
				echo "FileTmp Name:".$tname."<br>";*/
				$arr=array(
				"image/jpeg",
				"image/png",
				"image/jpg",
				"image/gif"
				);
				if($size<=1000000)
				{
					if(in_array($type,$arr))
					{
						$status=move_uploaded_file($tname,
						"uploads/$filename");
						if($status==1)
						{
							echo "<p>File Uploaded 
							Successfully</p>";
						}
						else
						{
							echo $_FILES['image']['error'];
						}
					}
					else
					{
						echo "Please Upload 
						a Valid Image";
					}
				}
				else
				{
					echo "<p>File size should
					below 1MB</p>";
				}
				
			}
		?>
		
		<form method="POST" action="" 
		enctype="multipart/form-data">
			<table>
				<tr>
					<td>Username</td>
					<td><input type="text" 
					name="uname"></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><input type="text" 
					name="email"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" 
					name="pwd"></td>
				</tr>
				<tr>
					<td>Upload Profile Image</td>
					<td><input type="file" 
					name="image"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" 
					name="upload" value="Register"></td>
				</tr>
			</table>
		</form>
	</body>
</html>