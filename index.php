<?php

require realpath("vendor/autoload.php");

use App\Base\Route\Route;
use App\Controller\ProductsController;

Route::get('/', function ($request) {

    return (new ProductsController($request))->get_front();
});

// route to add product page
Route::get('/add-product', function ($request) {

    return (new ProductsController($request))->get_add_product();
});

// route to get-someother page
Route::get('/get-someother', function ($request) {

    return (new ProductsController($request))->get_some_other();
});

// route to delete products 
Route::post('/', function ($request) {

    $controller = new ProductsController($request);

    if ($request->get('_method') == 'delete') {
        return $controller->delete();
    }
    return $controller->get_front();
});

// route to store product
Route::post('/', function ($request) {

    return (new ProductsController($request))->store();
});
