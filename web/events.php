<?php
require("env.php");


function new_event($type, $descr){
	$error = 0;
	if(file_exists(LOGFILE)){
		$curr_json_data = read_file();
		array_push($curr_json_data, array("time" => date("d-m-Y H:i"), "type" => $type, "descr" => $descr));
		$new_json_data = json_encode($curr_json_data, JSON_PRETTY_PRINT);
		if(file_put_contents(LOGFILE, $new_json_data)) $error = 0;
		else $error = 1;
	} else {
		$error = 1;
	} 
	return $error;
}


function read_file(){
	if(file_exists(LOGFILE)){
		if(filesize(LOGFILE)){
			$error = 0;
		} else {
			$wr_empty_file = fopen(LOGFILE,"w");
			fwrite($wr_empty_file, "[]\n");
			fclose($wr_empty_file);
		}
		$json_data = file_get_contents(LOGFILE); //data read from json file
		$log_array = json_decode($json_data, true);  //decode the data
	} else {
		$wr_empty_file = fopen(LOGFILE,"w");
		fwrite($wr_empty_file, "[]\n");
		fclose($wr_empty_file);
		$json_data = file_get_contents(LOGFILE); //data read from json file
		$log_array = json_decode($json_data, true);  //decode the data
	}
	return $log_array;
}


$msg = read_file();

//Envia a resposta para a página HTML com o AJAX.
echo json_encode(array('error' => $error, 'message' => $msg, 'redirect' => $redirect));
?>
