<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'budgetcontroller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//ALLOTMENT
$route['allotment'] = 'budgetcontroller/allotment';
$route['allotment/create'] = 'budgetcontroller/allotment_create';

//CLASS
$route['allotment/class/(:num)'] = 'budgetcontroller/allotment_class/$1';
$route['allotment/class/update'] = 'budgetcontroller/allotment_class_update';

//SAA
$route['allotment/class/saa/(:num)'] = 'budgetcontroller/allotment_class_saa/$1';
$route['allotment/class/saa/create/(:num)'] = 'budgetcontroller/allotment_class_saa_create/$1';
$route['allotment/class/saa/delete/(:num)'] = 'budgetcontroller/allotment_class_saa_delete/$1';
//END ALLOTMENT

//MAIN PAP
$route['mp'] = 'budgetcontroller/main_pap_viewall';
$route['mp/create'] = 'budgetcontroller/main_pap_create';
$route['mp/edit/(:num)'] = 'budgetcontroller/main_pap_edit/$1';
$route['mp/update'] = 'budgetcontroller/main_pap_update';
$route['mp/delete/(:num)'] = 'budgetcontroller/main_pap_delete/$1';
//END MAIN PAP

//SUB PAP
$route['sp'] = 'budgetcontroller/sub_pap_viewall';
$route['sp/create'] = 'budgetcontroller/sub_pap_create';
$route['sp/edit/(:num)'] = 'budgetcontroller/sub_pap_edit/$1';
$route['sp/update'] = 'budgetcontroller/sub_pap_update';
$route['sp/delete/(:num)'] = 'budgetcontroller/sub_pap_delete/$1';
//END SUB PAP