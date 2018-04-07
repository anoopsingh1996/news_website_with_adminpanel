<?php 
session_start();
if(isset($_SESSION['user']))
{
	include("connect.php");
	$uid=$_SESSION['user'];
	$did=$_REQUEST['delid'];
	mysqli_query($con,"delete from news where nid=$did and id=$uid");
	if(mysqli_affected_rows($con)>0)
	{
		header("location:viewnews.php");
	}
}
else
{
	header("location:login.php");
}
?>