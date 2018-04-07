<?php 
session_start();
if(isset($_SESSION['user']))
{
	include("connect.php");
	$nid=$_REQUEST['hs'];
	$uid=$_SESSION['user'];
	
	$res=mysqli_query($con,"select status from news where nid=$nid and id=$uid");
	$row=mysqli_fetch_assoc($res);
	if($row['status']==1)
	{
		mysqli_query($con,"update news set status=0 where nid=$nid and id=$uid");
		header("Location:viewnews.php");
	}
	else
	{
		mysqli_query($con,"update news set status=1 where nid=$nid and id=$uid");
		header("Location:viewnews.php");
	}
}
else
{
	header("location:login.php");
}
?>