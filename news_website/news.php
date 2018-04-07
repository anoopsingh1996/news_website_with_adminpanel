<?php 
if(isset($_REQUEST['nid']))
{
	include("connect.php");
	$nid=$_REQUEST['nid'];
	$res=mysqli_query($con,"select *from news where nid=$nid");
	$row=mysqli_fetch_assoc($res);
	include("main-header.php");
	?>
		<div class="content">
			<h3><?php echo $row['title']?></h3>
			<img src="news/<?php echo $row['filename']?>" height="300" width="600">
			<p><?php echo $row['description']?></p>
			<p></p>
			<p>Category:<?php echo $row['category']?></p>
			<p>Posted By:<?php echo $row['name']?></p>
			<p>Posted On:<?php echo date("l dS M Y",$row['date'])?></p>
		
			<h2>Related Articles</h2>
			<?php 
			$other=mysqli_query($con,"select nid,title from news where status=1");
			if(mysqli_num_rows($other))
			{
				echo "<ul>";
				while($trow=mysqli_fetch_assoc($other))
				{
					?>
						<li><a href="news.php?nid=<?php echo $trow['nid']?>"><?php echo $trow['title']?></a></li>
					<?php
				}
				echo "</ul>";
			}
			else
			{
				echo "Sorry! No Articles Found";
			}
			?>
		</div>
		
	<?php
	include("main-footer.php");
}
else
{
	header("location:index.php");
}
?>