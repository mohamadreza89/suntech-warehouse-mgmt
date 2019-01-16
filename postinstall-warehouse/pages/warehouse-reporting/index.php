<?php
require_once('vendor/autoload.php');
require_once('../../conf/production/config-itop.php');
require_once('../../approot.inc.php');
require_once('../../core/metamodel.class.php');
require_once(APPROOT.'/application/application.inc.php');
require_once(APPROOT.'/env-production/dictionaries/languages.php');
require_once('database.php');
require_once('Models/Product.php');
require_once('Models/ProductCategory.php');
require_once('Models/Inventory.php');




use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;



$request = Request::createFromGlobals();



$APPROOT = $request->getRequestUri();
$method = $request->getMethod();

switch ($method) {
	case 'GET':
		//load the form
	//echo $request->getRequestUri();
	$p = $request->query->get('p');
	$valid1 = sha1('Administrator');
	$valid2 = sha1('Warehouse Manager');
	if (($p != $valid1)AND($p != $valid2)) {return 0;}

	$lan = $request->query->get('language');
	Dict::SetUserLanguage($lan);
	
	$products = Product::all()->toArray();
	$product_categories = ProductCategory::all()->toArray();
	$inventories = Inventory::all()->toArray();

	$response = new Response(
	    require_once('form.php'),
	    Response::HTTP_OK,
	    array('content-type' => 'text/html')
	);
		break;

	case 'POST' :
	$lan = $request->request->get('language');
	Dict::SetUserLanguage($lan);
		//load the database edditing page
	$response = new Response(
		    require_once('data_center.php'),
		    Response::HTTP_OK,
		    array('content-type' => 'text/html')
		);
	break;	
}

//$response->prepare($request);
//$response->send();
