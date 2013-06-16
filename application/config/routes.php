<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['account/register'] = 'account/register';
$route['account/login'] = 'account/login';
$route['account/logout'] = 'account/logout';
$route['account/avatar'] = 'account/avatar';
$route['account/upload_avatar'] = 'account/upload_avatar';
$route['account'] = 'account';
$route['users'] = "users";
$route['users/order/(:any)'] = 'users/order/$1';
$route['users/post/(:any)'] = 'users/post/$1';
$route['users/comment/(:any)'] = 'users/comment/$1';
$route['users/recipe/(:any)'] = 'users/recipe/$1';
$route['users/edit_introduce'] = 'users/edit_introduce';
$route['users/edit_address'] = 'users/edit_address';
$route['users/(:any)'] = 'users/post/$1';
$route['posts/create'] = 'posts/create';
$route['posts'] = 'posts';
$route['orders/create'] = 'orders/create';
$route['orders/get_by_post'] = 'orders/get_by_post';
$route['orders/comment'] = 'orders/comment';
$route['orders'] = 'orders';
$route['recipes'] = 'recipes';
$route['recipes/create'] = 'recipes/create';
$route['recipes/add_image'] = 'recipes/add_image';
$route['recipes/do_create'] = 'recipes/do_create';
$route['default_controller'] = "pages/view";
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */