<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('loans', LoanController::class);
    $router->resource('saccos', SaccoController::class);
    $router->resource('savings', SavingController::class);
    $router->resource('transactions', TransactionController::class);
    $router->resource('sacco-members', SaccoMemberController::class);
    $router->resource('applications', ApplicationController::class);

});
