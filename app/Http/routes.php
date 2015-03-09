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

use VerbalExpressions\PHPVerbalExpressions\VerbalExpressions;

get('/', 'VerbalExpression\PageController@index');
get('/credits', 'VerbalExpression\PageController@credits');
get('/documentation/{page?}', 'VerbalExpression\DocsController@show');

Route::group(array('prefix' => 'api/v1'), function ()
{
    get('keywords', 'VerbalExpression\Api\One\KeywordController@index');
    post('creator/create', 'VerbalExpression\Api\One\CreatorController@create');
    post('tester/match', 'VerbalExpression\Api\One\TesterController@match');

});

get('/test', function ()
{
    $input = ['foo' => ''];

    $v = \Validator::make($input, ['pairs' => 'present']);
    $v->passes();

    $input = ['foo' => 'bar'];
    $v = \Validator::make($input, ['pairs' => 'present']);
    $v->passes();


    $input = [
        'pairs' => [
            ['keyword' => 'startOfLine', 'value' => 'test']
        ]
    ];

    $v = \Validator::make($input, ['pairs' => 'required|array']);
    $v->each('pairs', [
        'keyword' => 'required',
        'value' => 'required|string'
    ]);


    if(!$v->passes()){
        echo "currently fail";
        var_dump($v->errors());
    }


    die();
    $regex = new VerbalExpressions;

    var_dump($regex->getRegex());

    $regex
        ->startOfLine()
        ->then("http")
        ->maybe("s")
        ->then("://")
        ->maybe("www.")
        ->anythingBut(" ")
        ->endOfLine();

    var_dump($regex->test("http://github.com"));
    var_dump(preg_match($regex, 'http://github.com'));

    echo "<pre>" . $regex->getRegex() . "</pre>";

    var_dump($regex);


    // return View::make('hello');
});

//get('/test2', function ()
//{
//
//	$regex = new \App\SpeakingRegex\VerbalExpression();
//
//	$regex
//		->startOfLine()
//		->startOfGroup()
//		->maybe('(')
//		->maybe('+')
//		->range('0', '9')->atLeastOnce()
//		->maybe(')')
//		->endOfGroup()
//		->maybe(' ')
//		->range('0', '9')->atLeastOnce()
//		->endOfLine();
//
//
//	var_dump($regex->getRegex());
//
//	var_dump($regex->test("(+49)15142324728"));
//
//});

//Route::get('home', 'HomeController@index');
//
//Route::controllers([
//    'auth' => 'Auth\AuthController',
//    'password' => 'Auth\PasswordController',
//]);
