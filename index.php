<?php

require realpath("vendor/autoload.php");

use App\Base\Request\Request;
use App\Base\Route\Route;
use App\Controller\ProductsController;

$route = new Route();

// route to main page
$route->get('/', function ($request) {

    return (new ProductsController($request))->get_front();
});

// route to add product page
$route->get('/add-product', function ($request) {

    return (new ProductsController($request))->get_add_product();
});

// route to delete products 
$route->post('/', function (Request $request) {

    $controller = new ProductsController($request);

    if ($request->get('_method') == 'delete') {
        return $controller->delete();
    }
    return $controller->get_front();
});

// route to store product
$route->post('/', function (Request $request) {

    return (new ProductsController($request))->store();
});
