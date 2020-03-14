<?php 
$base_url = "http://" . $_SERVER['HTTP_HOST'];
$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);

define('BASE_URL', $base_url);
define('BASE_URL_PAINEL', $base_url.'painel/');
define("ENVIRONMENT", 'develop');

/* Configurações globais */
global $config;
$config = array();

if(ENVIRONMENT == 'develop'){
	$config['db_name'] = 'cupom';
	$config['db_user'] = 'root';
	$config['db_pass'] = '';
	$config['db_host'] = 'localhost';
} else {
	
	$config['db_name'] = 'soare416_style';
	$config['db_host'] = 'ns528.hostgator.com.br';
	$config['db_user'] = 'soare416';
	$config['db_pass'] = 'GGv27080@';
}

?>
