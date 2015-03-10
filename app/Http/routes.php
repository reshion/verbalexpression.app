<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


get('/', 'VerbalExpression\PageController@index');
get('/credits', 'VerbalExpression\PageController@credits');
get('/documentation/{page?}', 'VerbalExpression\DocsController@show');

Route::group(array('prefix' => 'api/v1'), function ()
{
    get('keywords', 'VerbalExpression\Api\One\KeywordController@index');
    post('creator/create', 'VerbalExpression\Api\One\CreatorController@create');
    post('tester/match', 'VerbalExpression\Api\One\TesterController@match');

});


//Route::get('home', 'HomeController@index');
//
//Route::controllers([
//    'auth' => 'Auth\AuthController',
//    'password' => 'Auth\PasswordController',
//]);
