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
    'categories.quizzes' => 'QuizController',
    'categories.questions' => 'QuestionController',
    'questions.words' => 'WordController',
    'users' => 'UserController'
]);

Route::get('/categories/admin/list', 'CategoryController@ownerCategoriesList')->name('categories.admin');

Route::get('/categories/{category_id}/results', 'QuizController@displayResults')->name('categories.results');

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/categories/{category_id}/lessons/{lesson_id}/question/{question_id}/page/{page}', 'QuizController@setAnswer')->name('categories.quizzes.answer');

Route::patch('/home/users/{user_id}/upload-avatar', 'UserController@uploadAvatar')->name('home.users.upload-avatar');
