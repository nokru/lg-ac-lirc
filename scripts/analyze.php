<?php

require_once("config.php");



function get_element_value($element){
	//check low
	if((LOWVAL-WIDTH <= $element) && ($element <= LOWVAL+WIDTH)){
		return(LOWCHAR);
	}

	//check high
	else if((HIGHVAL-WIDTH <= $element) && ($element <= HIGHVAL+WIDTH)){
		return(HIGHCHAR);
	}

	//check seperate
	else if((SEPERATE-WIDTH <= $element) && ($element <= SEPERATE+WIDTH)){
		return(SEPERATECHAR);
	}

	//check intro
	else if((INTRO-WIDTH <= $element) && ($element <= INTRO+WIDTH)){
		return(INTROCHAR);
	}

	//if nothing return element
	else return($element);
}//function get_element_value


function output_binary_values($elements){
$command_string = "";

	foreach ($elements as $element_id => $element) {
		
		//every first item of a pair AFTER the Seperator and Init is 0 - skip that
		if($element_id >= 2){
			if($element_id % 2 == 0){
				continue;
			}
		}//if first elem - skip
	
		//parse value and round it
		$element_value = get_element_value($element);
	
		//check if valid output
		if(in_array($element_value, array(LOWCHAR,HIGHCHAR,INTROCHAR,SEPERATECHAR))){
			$command_string = $command_string.$element_value;
		}
		else{
			echo "UNKNOWN VALUE ".$element_value;
			exit();
		}
	
	}//foreach

	//Output File Name and IR-Command String
	echo $command_string."\n";

}//function output_binary_values


//check for argv
if(!isset($argv[1]))
	exit("No arguments provided\n");


$file_content = file_get_contents($argv[1]);

//remove line breaks
$file_content = str_replace("\n", " ", $file_content);
$file_content = str_replace("\r", " ", $file_content);

//var_dump($file_content);




//string to integer-array
$elements = array_map('intval', explode(" ", $file_content));

//remove empty elements
$elements = array_filter($elements);

//reorder
$elements = array_values($elements);

//var_dump($elements);

//replace key-press delay with KEYPRESS
foreach($elements as $elements_id => $element_value){
	if($element_value > SEPERATE*MULTI)
		$elements[$elements_id] = "NEWKEY";
}

//make a long string again
$elements = implode(" ", $elements);
$elements = trim($elements);


//explode by NEWKEY
$key_data = explode("NEWKEY", $elements);



//output every keypress-binary
echo "File: ".$argv[1].": \n";
foreach ($key_data as $key_data_id => $key_data_value) {
	$key_data_array = array_map('intval', explode(" ",$key_data_value));
	
	$key_data_array = array_filter($key_data_array);
	$key_data_array = array_values($key_data_array);
	
	//var_dump($key_data_array);
	
	if(count($key_data_array)>1)
		output_binary_values($key_data_array);
}





?>