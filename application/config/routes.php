<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['index'] = 'home/index';
$route['logout'] = 'home/logout';
$route['signin'] = 'home/signin';
$route['signup'] = 'home/signup';
$route['about'] = 'home/about';
$route['partner'] = 'home/partner';
$route['escrow_service'] = 'home/escrow_service';
$route['terms_condition'] = 'home/terms_condition';
$route['privacy_policy'] = 'home/privacy_policy';
$route['how_to_buy'] = 'home/how_to_buy';
$route['forgot_password'] = 'home/forgot_password';
$route['reset_password/(:any)'] = 'home/reset_password';


$route['faq'] = 'home/faq';
$route['contact'] = 'home/contact';

$route['sales_list/(:any)'] = "home/sales_list/";
$route['user/(:any)'] = "home/user/";
$route['details/(:any)'] = "home/details/";

$route['callback'] = 'dashboard/callback';
$route['get_exchange_rate'] = 'dashboard/get_exchange_rate';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
