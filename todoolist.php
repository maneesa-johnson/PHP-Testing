<?php

// Plan
// Submiting to the form should save data in an object format to a  file   // done
// Convert the data to string // done
// Iterate through the data on the file with a foreach loop  // done
// filter data by date // done
session_start();

class toDoList {


	public $task;
	public $date;




/* WRITING DATA TO TEXT FILE */

public static function settingTaskProp($task, $date){

	$tasks = array('task' => $task , 'date' => $date);
   $file = file_get_contents("newTestFile.php");

if (isset($task) && isset($date)){
	if(!empty($file)){
			$aved_Data = json_decode($file, true);
			array_push($aved_Data, $tasks );
			$jsonencode = json_encode($aved_Data, JSON_FORCE_OBJECT);
			$myfile = fopen("newTestFile.php", "w") or die("Unable to open file!");
			fwrite($myfile,$jsonencode);
		} elseif(empty($file)){
			$fullarray = array();
			array_push($fullarray , $tasks);
			$json_encode = json_encode($fullarray, JSON_FORCE_OBJECT);
			$Thefile = fopen("newTestFile.php", "w") or die("Unable to open file!");
			fwrite($Thefile,$json_encode);

	 }
}
	 
	
	
}

/* LOOPING THROUGH DATA */


	public static function looping()
	{

		$file = file_get_contents("newTestFile.php");
		$array = json_decode($file, true);

		$result = array();
		foreach($array as $item ){
			if (isset($result[$item['date']])) array_push($result[$item['date']], $item['task']);
			else $result[$item['date']] = array($item['task']);
		}

		foreach($result as $date => $tasks)
			{
				$time = strtotime($date);
				$newformat = date('Y-m-d',$time);    
				echo "<h3>{$newformat}</h3>";
			foreach($tasks as $task) echo "<p>$task</p>";
			}


}

/* OLD CODE */

	public static function FormInput1()
    {	
						
			

			if ($_POST['submit']){

				$myfile = fopen("newfile.php", "a") or die("Unable to open file!");
				$task =  $_POST["name"];
				$date = $_POST["date"];
				$json = '{"task": "' .  $task . '","date": "'. $date . '"}';
				$json .= ','; 
				fwrite($myfile, $json);
				fclose($myfile);
			}


						
		}

 public static function Iteration()
	{
	$file = file_get_contents("newfile.php");
	$result = rtrim($file, ",");
	$array = json_decode('[' . $result . ']');

	$res = array();
	foreach($array as $item)
		{
		if (isset($res[$item->date])) array_push($res[$item->date], $item->task);
		  else $res[$item->date] = array(
			$item->task
		);
		}

	foreach($res as $date => $tasks)
		{
			$time = strtotime($date);
         $newformat = date('Y-m-d',$time);    
			echo "<h3>{$newformat}</h3>";
		foreach($tasks as $task) echo "<p>$task</p>";
		}
	}
	

}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <link rel="stylesheet" href="css/default.css" /> 
    <title>My To-Do List</title> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script> 
    <script type="text/javascript" src="js/scripts.js"></script> 
</head> 
  
<body> 
  
<div id="container"> 
      
<h1>My to-Do List</h1> 
<form method="post" action="<? echo $_SERVER['PHP_SELF']; ?>">
	<ul>
		<li>Task Name:<input name ="name" type='text'/></li>
		<li>Task Date:<input name ="date" type="text"></li>
		<li><input type="submit" name="submit" value="Submit"></li>
	</ul>
</form>

  
<div id="main"> 

<h2>All Tasks</h2>
<?php

//CALLING THE FUNCTIONS
echo toDoList::looping();
echo toDoList::settingTaskProp($_POST['name'],$_POST['date']);

?>

</div>


  
</body> 
</html>




