<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']            = 'welcome';
$route['404_override']                  = '';
$route['translate_uri_dashes']          = false;
$route['templates/(:any)'] = "/templates/$1/#";
$route['locatarios/listar'] = "Locatario/index";
$route['locatarios/atualizar/(:any)'] = "Locatario/put";
$route['locatarios/cadastrar']['post'] = "Locatario/post";
$route['locatarios/remover/(:any)']['delete'] = "Locatario/delete$1";
//$route['itemsCreate']['post'] = "items/store";
//$route['itemsEdit/(:any)'] = "items/edit/$1";
//$route['itemsUpdate/(:any)']['put'] = "items/update/$1";
//$route['itemsDelete/(:any)']['delete'] = "items/delete/$1";
