
<?php include("main-header.php");?>		
	<div class="content">
		<div class="news-blocks">
		<h2>Latest News</h2>
			
			<?php 
			include("connect.php");
			$result=mysqli_query($con,"select *from news where status=1");
			if(mysqli_num_rows($result)>0)
			{
				while($row=mysqli_fetch_assoc($result))
				{
					?>
						<div class="block">
							<img src="news/<?php echo $row['filename']?>">
							<h3><?php echo $row['title'] ?></h3>
							<p><?php echo substr($row['description'],0,100)?></p>
							<a href="news.php?nid=<?php echo $row['nid']?>">Read more...</a>
						</div>
					<?php
				}
				
			}
			else
			{
				echo "<p>Sorry No Records Found</p>";
			}
			?>
		
			
			
		</div>
		
		
		<?php
		//include("class2.php");
		//$obj=new user();
		//$obj->getAllUsers();
		?>
		<h3>Latest User</h3>
		
	</div><!--Content End-->
<?php include("main-footer.php");?>					