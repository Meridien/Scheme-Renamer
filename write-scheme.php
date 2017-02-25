<?php

function writeHistoryString($history_array, $new_item){
	
	array_push($history_array, $new_item);
	
	$history_array = array_unique($history_array);
	$history_array = array_reverse($history_array);
    
	$history_buffer = 0;
	$history_string="";
	foreach($history_array as $item){
		
		$continue=true;
		
		if($history_buffer > 400){
			$continue=false;
		}
		
		if($item==""){
			$continue=false;
		}
		if($item==" "){
			$continue=false;
		}
		if(is_numeric($item)){
			$continue=false;
		}
		if(ctype_punct($item)){
			$continue=false;
		}
		if($continue==true){
			$history_string.='"'.$item.'",' . PHP_EOL ;
			$history_buffer++;
		}
		
	}
	
	$history_string = substr($history_string,0,strlen($history_string)-3);
	
	return $history_string;
}

include('scheme.php');

$tfield1 = $_GET["tfield1"];
$tfield2 = $_GET["tfield2"];
$tfield3 = $_GET["tfield3"];
$tfield4 = $_GET["tfield4"];
$tfield5 = $_GET["tfield5"];
$file_ext = $_GET["file_ext"];
$last_selected = $_GET["last_selected"];
$fh = fopen('scheme.php', 'w');

$tfield1_history_string = writeHistoryString($tfield1_history,$tfield1);
$tfield2_history_string = writeHistoryString($tfield2_history,$tfield2);
$tfield3_history_string = writeHistoryString($tfield3_history,$tfield3);
$tfield4_history_string = writeHistoryString($tfield4_history,$tfield4);
$tfield5_history_string = writeHistoryString($tfield5_history,$tfield5);

$text = '

$tfield1 = "'.$tfield1.'";
$tfield2 = "'.$tfield2.'";
$tfield3 = "'.$tfield3.'";
$tfield4 = "'.$tfield4.'";
$tfield5 = "'.$tfield5.'";
$file_ext = "'.$file_ext.'";
$last_selected = "'.$last_selected.'";

$tfield1_history = array('.$tfield1_history_string.');
$tfield2_history = array('.$tfield2_history_string.');
$tfield3_history = array('.$tfield3_history_string.');
$tfield4_history = array('.$tfield4_history_string.');
$tfield5_history = array('.$tfield5_history_string.');

';

fwrite($fh, '<?php '.$text.' ?>');
fclose($fh);

?>