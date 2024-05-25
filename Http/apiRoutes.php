<?php

use Illuminate\Routing\Router;

$locale = \LaravelLocalization::setLocale() ?: \App::getLocale();
Route::prefix('/icommercepricelist/v3')->middleware('auth:api')->group(function (Router $router) use($locale) {
  //======  PRICE LISTS
  $router->apiCrud([
    'module' => 'icommercepricelist',
    'prefix' => 'price-lists',
    'controller' => 'PriceListApiController',
    'middleware' => [
      'create' => ['auth:api', 'auth-can:icommercepricelist.pricelists.create'],
      'update' => ['auth:api', 'auth-can:icommercepricelist.pricelists.edit'],
      'delete' => ['auth:api', 'auth-can:icommercepricelist.pricelists.destroy'],
      // 'restore' => []
    ]
  ]);

  //======  PRODUCT LISTS
  $router->apiCrud([
    'module' => 'icommercepricelist',
    'prefix' => 'product-lists',
    'controller' => 'ProductListApiController',
    'middleware' => [
      'create' => ['auth:api', 'auth-can:icommercepricelist.productlist.create'],
      'update' => ['auth:api', 'auth-can:icommercepricelist.productlist.edit'],
      'delete' => ['auth:api', 'auth-can:icommercepricelist.productlist.destroy'],
      // 'restore' => []
    ],
    'customRoutes' => [ // Include custom routes if needed
      [
        'method' => 'post',
        'path' => '/sync',
        'uses' => 'syncProductsList',
        //'middleware' => []
      ]
    ]
  ]);
});
