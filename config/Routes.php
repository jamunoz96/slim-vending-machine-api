<?php

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


return function (App $app) {

    $app->get('/', 'App\Controllers\DefaultController:help');

    $app->group('/api/v1', function (RouteCollectorProxy $group) {
        $group->group('/products', function (RouteCollectorProxy $group) {
    
            // Get All Products
            $group->get('', 'App\Controllers\ProductsController:index');
    
            // Update Product
            $group->put('/{id}', 'App\Controllers\ProductsController:update');
    
        });

    });    
};



