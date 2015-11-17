<?php
function aboutus($file_name = 'aboutus.txt')
{
	if (file_exists($file_name)){
		//read the value 
		$about_us= file_get_contents($file_name);
		//print_r(file($file_name));
		file_put_contents($file_name, $about_us);
		
	}else{
		//create it 
		$handle = fopen($file_name, 'w+');
		$count=1;
		//set default value of one 
		fwrite($handle, $count);
		fclose($handle);
	}
	return $count;
}

require 'aboutus.php';
?>