<?php 
session_start();
if(isset($_SESSION['user']))
{
	$uid=$_SESSION['user'];
	include("connect.php");
	$res=mysqli_query($con,"select id,name from register where id=$uid");
	$row=mysqli_fetch_assoc($res);
	?>
		<html>
			<head>
				<title><?php echo $row['name']?> | Add News</title>
				<link rel="stylesheet" href="css/style.css">
			</head>
			<body>
				<div class="main">
					<?php include("menu.php");?>
					<div class="content">
						<h1>Add News</h1>
						
						<?php 
							if(isset($_REQUEST['status']))
							{
								echo "<p>News Added Successfully</p>";
							}
						?>
						
						<?php 
						if(isset($_POST['submit']))
						{
							$cat=$_POST['category'];
							$title=$_POST['title'];
							$desc=$_POST['desc'];
							if(is_uploaded_file($_FILES['file']['tmp_name']))
							{
								$filename=$_FILES['file']['name'];
								move_uploaded_file($_FILES['file']['tmp_name'],"news/$filename");
							}
							else
							{
								$filename="";
							}
							$date=time();
							mysqli_query($con,"insert into news(
							category,title,description,
							filename,date,id,name) values('$cat',
							'$title','$desc','$filename',
							'$date','$uid','$row[name]')");
							if(mysqli_affected_rows($con)>0)
							{
								header("location:addnews.php?status=1");
							}
							else
							{
								echo "Sorry! Unable to Add";
							}
						}
						?>
						
						<form onsubmit="return newsValidation()" method="POST" action="" enctype="multipart/form-data">
							<table>
								<tr>
									<td>Select Category:</td>
									<td><select id="category" name="category">
										<option value="">--Select Category--</option>
										<option value="Movies">Movies</option>
										<option value="Politics">Politics</option>
										<option value="Computers">Computers</option>
									</select></td>
								</tr>
								<tr>
									<td>News Title</td>
									<td><input type="text" name="title" id="title"></td>
								</tr>
								<tr>
									<td>News Description</td>
									<td><textarea name="desc" id="desc"></textarea></td>
								</tr>
								<tr>
									<td>News Image</td>
									<td><input type="file" name="file" id="file"></td>
								</tr>
								<tr>
									<td></td>
									<td><input type="submit" name="submit" value="Add News"></td>
								</tr>
							</table>
						</form>
					</div>
					<?php include("footer.php");?>
				</div>
				
				<script>
					function newsValidation()
					{
						
					}
				</script>
				
			</body>
		</html>
	<?php
}
else
{
	header("location:login.php");
}
?>