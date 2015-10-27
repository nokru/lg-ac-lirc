<?php

require_once("config.php");


//check for argv
if(!isset($argv[1]) && !isset($argv[2]))
	exit("No arguments provided - use php analyze.php FILENAME_IN FILENAME_OUT \n");


$file_content = file_get_contents($argv[1]);


 $lines = explode("\n", $file_content);

 foreach($lines as $line_number =>$line){
 	
 	//check if line starts with semicolon - if so jump to next item
 	if(substr($line, 0,1) == ";" || strlen($line) == 0)
 		goto nextline;

 	$linepart = explode(";", $line);
 	$keyname = $linepart[0];
 	$sequence = $linepart[1];

 	//clean up the hyphon of the INTRO and SEPERATOR
 	$sequence = str_replace("-", "", $sequence);

 	//string to char-array
 	$sequence = str_split($sequence);

 	$output = "\tname ".$keyname."\n";

 	foreach($sequence as $char_index => $irchar){

 		if($char_index == 0)
 			$output = $output."\t\t";

 		switch($irchar){
 			case LOWCHAR:
 				$output = $output.LOWVAL."\t\t".LOWVAL;
 				break;
  			case HIGHCHAR:
 				$output = $output.LOWVAL."\t\t".HIGHVAL;
 				break;
  			case str_replace("-","",INTROCHAR):
 				$output = $output.INTRO;
 				break;
  			case str_replace("-","",SEPERATECHAR):
 				$output = $output.SEPERATE;
 				break;	
 			default:
 				echo "ERROR - Unknown char ".$irchar." at line ".$line_number." Line: ".$line;
 				exit();		
 		}//switch

 		//do tab or new line
 		if($char_index>3 && $char_index % 3 == 0 || $char_index == 3){
 			$output = $output."\n\t\t";
 		}//if new line
 		else{
 			$output = $output."\t\t";
 		}//else do tab-tab
 	}//foreach

//kill last 2 characters
 	//$output = substr($output, 0, -2);

 	//end with a LOWVAL
 	$output = $output.LOWVAL;

 	//new block
 	$output = $output."\n\n";
 	
 	//replace tabs
 	$output = str_replace("\t", "  ", $output);

 	$key_output = $key_output.$output;
 	
 	//if line started with semicolon jump here
 	nextline:
 }//foreach line


$config_file = str_replace("$CODES$", $key_output, TEMPLATE);


file_put_contents($argv[2], $config_file);

echo "Output written to file ".$argv[2]."\n";







?>