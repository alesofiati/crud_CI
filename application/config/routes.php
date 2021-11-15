<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// rotas
$route['default_controller'] = 'crud';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['pessoa/create'] = 'crud/create';
$route['pessoa/store'] = 'crud/store';
$route['pessoa/(:num)/edit'] = 'crud/edit/$1';
$route['pessoa/(:num)/update'] = 'crud/update/$1';
$route['pessoa/(:num)/delete'] = 'crud/softDelete/$1';
$route['pessoa/(:num)/force-delete'] = 'crud/destroy/$1';
$route['pessoa/(:num)/restore'] = 'crud/restore/$1';
$route['pessoas/trash'] = 'crud/trash';
