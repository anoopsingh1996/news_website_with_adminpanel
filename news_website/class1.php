<?php 
class Test
{
	public function add()
	{
		echo "Add function";
	}
	public function __construct()
	{
		echo "Default Constructor";
	}	
	protected function hello()
	{
		echo "Hello function";
	}
	private function welcome()
	{
		echo "Welcome function";
	}
}

$obj=new test();
$obj->add();
$obj->hello();//Error
$obj->Welcome();//Erorr

?>




