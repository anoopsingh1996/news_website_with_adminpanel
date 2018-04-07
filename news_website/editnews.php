<?php  session_start();
if(isset($_SESSION['user']))
{
	if(!isset($_REQUEST['newsid']))
	{
		header("location:home.php");
	}
	
	
	include("connect.php");
	$uid=$_SESSION['user'];
	
	$res=mysqli_query($con,"select id,name from register where id=$uid");
	$row=mysqli_fetch_assoc($res);
	
	$newsid=$_REQUEST['newsid'];
	$news=mysqli_query($con,"select *from news where nid=$newsid and id=$uid");
	$nrow=mysqli_fetch_assoc($news);
	?>
		<html>
			<head>
				<title><?php echo $row['name']?> | Edit News</title>
				<link rel="stylesheet" href="css/style.css">
			</head>
			<body>
				<div class="main">
					<?php include("menu.php");?>
					<div class="content">
						<h1>Edit News</h1>
						
						<?php 
						if(isset($_REQUEST['status']))
						{
							echo "<p>News Updated Successfully</p>";
						}
						?>
						
						<?php 
						if(isset($_POST['submit']))
						{
							$title=$_POST['title'];
							$cat=$_POST['category'];
							$desc=$_POST['desc'];
							if(is_uploaded_file($_FILES['file']['tmp_name']))
							{
								$filename=$_FILES['file']['name'];
								move_uploaded_file($_FILES['file']['tmp_name'],"news/$filename");
							}
							else
							{
								$filename=$nrow['filename'];
							}
							mysqli_query($con,"update news 
							set title='$title',
							category='$cat',
							description='$desc',
							filename='$filename'
							where nid=$newsid and id=$uid");
							if(mysqli_affected_rows($con)>0)
							{
								header("location:editnews.php?newsid=$newsid&status=1");
							}
							else
							{
								echo "<p>Sorry! Unable to update</p>";
								echo "<p>".mysqli_error($con)."</p>";
							}
						}
						?>
						
						
						<form onsubmit="return newsValidation()" method="POST" action="" enctype="multipart/form-data">
							<table>
								<tr>
									<td>Select Category:</td>
									<td><select id="category" name="category">
										<option value="">--Select Category--</option>
										<option value="Movies" <?php if($nrow['category']=="Movies") echo "selected";?>>Movies</option>
										<option value="Politics" <?php if($nrow['category']=="Politics") echo "selected";?>>Politics</option>
									</select></td>
								</tr>
								<tr>
									<td>News Title</td>
									<td><input type="text" value="<?php echo $nrow['title']?>" name="title" id="title"></td>
								</tr>
								<tr>
									<td>News Description</td>
									<td><textarea name="desc" id="desc"><?php echo $nrow['description']?></textarea></td>
								</tr>
								<tr>
									<td>News Image</td>
									<td><input type="file" name="file" id="file"><br>
									<img src="news/<?php echo $nrow['filename'];?>" height="40" width="40">
									</td>
								</tr>
								<tr>
									<td></td>
									<td><input type="submit" name="submit" value="Update News"></td>
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
	header("Location:login.php");
}
?>
