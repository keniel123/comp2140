<?php 

include '../config.php';




	function userCount($database)
{
	$q =$database->prepare("SELECT * FROM members");
			$q->execute();
			$count =$q->rowCount();
			echo $count;
			

}


function set_count($file_name = 'viewCount.txt')
{
	if (file_exists($file_name)){
		//read the value 
		$count= (int)file_get_contents($file_name)+1;
		//print_r(file($file_name));
		file_put_contents($file_name, $count);
		
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





function visitPercentage()
{
	$visit=set_count();
	$percentage=$visit/100;
	echo $percentage;
}


			

?>