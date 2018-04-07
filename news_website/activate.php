<?php 
include("connect.php");
$uid=$_REQUEST['uid'];

$res=mysqli_query($con,"select status from register 
where id=$uid");
if(mysqli_num_rows($res)>0)
{
	$row=mysqli_fetch_assoc($res);
	if($row['status']==0)
	{
		$res=mysqli_query($con,"update register set 
		status=1 where id=$uid");
		if(mysqli_affected_rows($con)>0)
		{
			echo "Account Activated Successfully
			Please <a href='login.php'>Login Now</a>";
		}
		
	}
	else
	{
		echo "YOur account is alredy activated
		Please <a href='login.php'>Login Now</a>";
	}
	
}
else
{
	echo "Sorry! Some thing wrong";
}


?>