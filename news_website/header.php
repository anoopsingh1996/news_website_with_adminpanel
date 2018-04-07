<?php 

//header("Location:http://google.com");

header("Content-disposition:attachment;filename=video.zip");
readfile("video.zip");


?>