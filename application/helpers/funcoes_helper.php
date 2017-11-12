<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('set_msg')) {
	
	function set_msg($msg=NULL){
		$CI = & get_instance();
		$CI->session->set_userdata( 'aviso', $msg );
	}
}
if (!function_exists('get_msg')) {
	function get_msg($destroy=TRUE){
		$CI = & get_instance();
		$retorno = $CI->session->userdata('aviso');
		if ($destroy) $CI->session->unset_userdata('aviso');
		return $retorno;
	}
}

if (!function_exists('confereLogin')) {
	function confereLogin($privilegio = '',$redirect ='login'){
		$CI = & get_instance();
		if (!$CI->session->userdata('logged') or $CI->session->userdata('privilegio') != $privilegio && $privilegio != '' ) {
			set_msg('Acesso restrito!');
			redirect($redirect,'refresh');
		}
	}
}

if (!function_exists('config_upload')) {
	function config_upload($path='./uploads/podcast/',$types='mp3|wav|wma|ogg|aac|flac|ape|alac',$size=100000){
		$config['upload_path'] = $path;
		$config['allowed_types'] = $types;
		$config['max_size']  = $size;
		return $config;
	}
}

if (!function_exists('to_bd')) {
	//codifica o html para salvar no banco de dados
	function to_bd($string=NULL){
		return htmlentities($string);
	}
}

if (!function_exists('to_html')) {
	//decodifica o html e remove barras invertidas do conteúdo
	function to_html($string=NULL){
		return html_entity_decode($string);
	}
}