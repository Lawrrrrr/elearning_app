<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resources([
    'categories' => 'CategoryController',
    'categories.questions' => 'QuestionController',
    'questions.words' => 'WordController'
]);
Route::get('/categories/admin/list', 'CategoryController@ownerCategoriesList')->name('categories.admin');
Route::get('/home', 'HomeController@index')->name('home');
