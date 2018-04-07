<?php 
session_start();
if(isset($_SESSION['user']))
{
	$uid=$_SESSION['user'];
	include("connect.php");
	$res=mysqli_query($con,"select name from register where id=$uid");
	$row=mysqli_fetch_assoc($res);
	
	?>
		<html>
			<head>
				<title><?php echo ucfirst($row['name']);?> | Views</title>
				<link rel="stylesheet" href="css/style.css">
			</head>
			<body>
				<div class="main">
					<?php include("menu.php");?>
					<div class="content">
						<h1>View News</h1>
						<?php 
						
							$news=mysqli_query($con,"select *from news where id=$uid");
							if(mysqli_num_rows($news)>0)
							{
								?>
									<table border=1>
										<tr>
											<th>Nid</th>
											<th>Category</th>
											<th>Title</th>
											<th>Description</th>
											<th>Filename</th>
											<th>Posted By</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
										<?php 
										while($row=mysqli_fetch_assoc($news))
										{
											?>
												<tr>
													<td><?php echo $row['nid']?></td>
													<td><?php echo $row['category']?></td>
													<td><?php echo $row['title']?></td>
													<td><?php echo substr($row['description'],0,100)?></td>
													<td><img src="news/<?php echo $row['filename']?>" height="50" width="50"></td>
													<td><?php echo $row['name']?></td>
													<td><?php echo $row['status']?></td>
													<td>
														<a href="editnews.php?newsid=<?php echo $row['nid']; ?>">Edit</a> | 
														<a href="deletenews.php?delid=<?php echo $row['nid']?>">Delete</a> | 
														<?php 
														if($row['status']==0)
														{
															?>
																<a href="hideshow.php?hs=<?php echo $row['nid'];?>">Show</a> 	
															<?php
														}
														else
														{
															?>
																<a href="hideshow.php?hs=<?php echo $row['nid'];?>">Hide</a> 	
															<?php
														}
														?>
														
														
													</td>
												</tr>
											<?php
										}
										?>
									</table>
								<?php
							}
							else
							{
								echo "Sorry! You don't have any articles, 
								please <a href='addnews.php'>Add Now</a>";
							}
						
						?>
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