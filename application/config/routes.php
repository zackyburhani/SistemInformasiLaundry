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
$route['default_controller'] = 'ControllerLogin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//dashboard
$route['dashboard'] = 'ControllerDashboard';

//login
$route['login/auth'] = 'ControllerLogin/login';
$route['login/logout'] = 'ControllerLogin/logout';

//pelanggan
$route['pelanggan'] = 'ControllerPelanggan';
$route['pelanggan/data_pelanggan'] = 'ControllerPelanggan/data_pelanggan';
$route['pelanggan/simpan'] = 'ControllerPelanggan/simpan';
$route['pelanggan/ubah'] = 'ControllerPelanggan/ubah';
$route['pelanggan/get_pelanggan'] = 'ControllerPelanggan/get_pelanggan';
$route['pelanggan/hapus'] = 'ControllerPelanggan/hapus';
$route['pelanggan/getKode'] = 'ControllerPelanggan/getKode';

//barang
$route['barang'] = 'ControllerBarang';
$route['barang/data_barang'] = 'ControllerBarang/data_barang';
$route['barang/simpan'] = 'ControllerBarang/simpan';
$route['barang/ubah'] = 'ControllerBarang/ubah';
$route['barang/get_barang'] = 'ControllerBarang/get_barang';
$route['barang/hapus'] = 'ControllerBarang/hapus';
$route['barang/getKode'] = 'ControllerBarang/getKode';

//jasa
$route['jasa'] = 'ControllerJasa';
$route['jasa/data_jasa'] = 'ControllerJasa/data_jasa';
$route['jasa/simpan'] = 'ControllerJasa/simpan';
$route['jasa/ubah'] = 'ControllerJasa/ubah';
$route['jasa/get_jasa'] = 'ControllerJasa/get_jasa';
$route['jasa/hapus'] = 'ControllerJasa/hapus';
$route['jasa/getKode'] = 'ControllerJasa/getKode';

//order
$route['order'] = 'ControllerOrder';
$route['order/data_order'] = 'ControllerOrder/data_order';
$route['order/simpan'] = 'ControllerOrder/simpan';
$route['order/simpan_detail'] = 'ControllerOrder/simpan_detail';
$route['order/cetak/(:any)'] = 'ControllerOrder/cetak/$1';
$route['order/get_order'] = 'ControllerOrder/get_order';
$route['order/get_detail_order'] = 'ControllerOrder/get_detail_order';
$route['order/proses/(:any)/(:any)'] = 'ControllerOrder/proses/$1/$2';
$route['order/getKode'] = 'ControllerOrder/getKode';
$route['order/destroy'] = 'ControllerOrder/destroy';