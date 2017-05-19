<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'atividades';
//$route['404_override'] = '';
//$route['translate_uri_dashes'] = FALSE;

$route['atividade/nova'] = "atividades/nova";
$route['atividade/editar/(:num)'] = "atividades/editar/$1";