<?php

/**
 * @param $data
 */
function json($data){
	header('Content-Type: application/json');
	die(json_encode($data));
}

function formErrorJson(){
	$ci = &get_instance();
	$errors = array();
	foreach($ci->input->post() as $key => $value){
		$errors[$key] = strip_tags(form_error($key));
	}
	return json(['type' => 'form_error', 'errors' => array_filter($errors)]);
}
