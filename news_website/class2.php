<?php 
class user
{
	public $con;
	
	public function __construct()
	{
		$this->con=mysqli_connect("localhost","root","","7am");
	}
	
	public function __destruct()
	{
		mysqli_close($this->con);
	}
	
	function getAllUsers()
	{
		
		$res=mysqli_query($this->con,"select *from register");
		if(mysqli_num_rows($res)>0)
		{
			echo "<table border=1>";
			while($row=mysqli_fetch_assoc($res))
			{
				?>
					<tr>
						<td><?php echo $row['id']?></td>
						<td><?php echo strip_tags($row['name']);?></td>
						<td><?php echo $row['email']?></td>
						<td><?php echo $row['mobile']?></td>
					</tr>
				<?php
			}
			echo "</table>";
			
		}else
		{
			echo "<p>Sorry! No records Found</p>";
		}
	}
	function latestUser()
	{
		$res=mysqli_query($this->con,"select *from register order by 
		id desc limit 1");
		$row=mysqli_fetch_assoc($res);
		print_r($row);
	}
	function selectedUser($id)
	{
		$res=mysqli_query($this->con,"select *from register where id=$id");
		$row=mysqli_fetch_assoc($res);
		print_r($row);
	}
}

$obj=new user();

$obj->getAllUsers();
$obj->latestUser();
$obj->selectedUser(10);


?>