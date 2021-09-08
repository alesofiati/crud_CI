<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// rotas
$route['default_controller'] = 'crud';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['addPessoa'] = 'crud/newPeople';
$route['editPessoa/(:num)'] = 'crud/editPeople/$1';
$route['update'] = 'crud/updatePessoa';
$route['pessoas/endereco'] = 'crud/pessoaJoin';
$route['delete/(:num)'] = 'crud/deletePessoa/$1';
