<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['stock/in'] = 'stock/stock_in_data';
$route['stock/in/create'] = 'stock/stock_in_create';
$route['stock/in/delete/(:num)/(:num)'] = 'stock/stock_in_delete';
$route['stock/out'] = 'stock/stock_out_data';
$route['stock/out/create'] = 'stock/stock_out_create';
$route['stock/out/delete/(:num)/(:num)'] = 'stock/stock_out_delete';