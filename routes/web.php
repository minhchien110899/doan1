<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome1');
});
//User route
Auth::routes();
Route::post('/logout', 'Auth\LoginController@userLogout')->name('logout');
Route::get('/home', 'HomeController@index')->name('home');
// route profile
Route::group(['prefix' => 'profile', 'namespace' => 'user'], function(){
	Route::get('/', 'ProfileUserController@index')->name('user.profile');
	Route::post('/change_avatar', 'ProfileUserController@change_avatar');
	Route::post('/change_info', 'ProfileUserController@change_info');
});
//route exam
Route::group(['prefix' => 'exam', 'namespace' => 'user'], function(){
	Route::get('/', 'ExamController@index')->name('subject');
	Route::get('/result', 'ExamController@all_result')->name('user.result');
	Route::get('/subject/{id}', 'ExamController@show');
	Route::get('/review/{id}', 'ExamController@review');
	Route::get('/make/{id}', 'ExamController@make');
	Route::post('/create_history/{id}', 'ExamController@create_history');
	Route::get('/result/detail/{id}/send_mail', 'ExamController@send_mail');
	Route::get('/result/detail/{id}', 'ExamController@result_detail');
});
Route::group(['prefix' => 'chat', 'namespace' => 'user'], function () {
	Route::get('/', 'ChatController@index');
	Route::get('/contacts', 'ChatController@getContacts');
	Route::get('/get_unread', 'ChatController@get_unread');
	Route::get('/conversation/{id}', 'ChatController@getConversation');
	Route::post('/conversation/send',  'ChatController@send');
});
// lộ trình học cá nhân
Route::group(['prefix' => 'personalizeElearning', 'namespace' => 'user'], function(){
	Route::get('/', 'PersonalizeController@index');
});

//setting user
Route::group(['prefix' => 'setting', 'namespace' => 'user'], function(){
	Route::get('/', 'SettingController@index');
	Route::post('/change_theme_color', 'SettingController@change_theme_color');
});

Route::group(['prefix' => 'admin','namespace' => 'admin'], function(){
	Route::get('/login','AdminLoginController@login')->name('admin.login');
	Route::post('/login','AdminLoginController@postlogin');	
	Route::get('/logout','AdminLoginController@logout')->name('admin.logout');
	Route::get('/','AdminController@index')->name('admin.index');
	Route::get('/profile','AdminController@profile')->name('admin.profile');

	//route admin subject
	Route::group(['prefix' => 'subject'],function(){
		Route::get('/','SubjectController@index')->name('admin.subject');
		Route::post('/change_name/{id}','SubjectController@change_name');
		Route::post('/off_status/{id}','SubjectController@off_status');
		Route::post('/on_status/{id}','SubjectController@on_status');
		Route::post('/add_subject', 'SubjectController@add_subject');
		Route::post('/del_subject/{id}','SubjectController@del_subject');
		Route::get('/restore_trash/{id}', 'SubjectController@restore_trash');
	});
	
	//Route admin testexam
	Route::group(['prefix' => 'testexam'], function(){
		Route::get('/', 'TestExamController@index')->name('admin.testexam');
		Route::post('/change_name/{id}', 'TestExamController@change_name');
		Route::post('/del_testexam/{id}', 'TestExamController@del_testexam');
		Route::get('/restore_trash/{id}', 'TestExamController@restore_trash');
		Route::post('/add_testexam', 'TestExamController@add_testexam');
		Route::get('/{id}/review', 'TestExamController@review');
		Route::post('/{id}/add_question', 'TestExamController@add_question');
		Route::post('/{testexam_id}/del_question/{question_id}', 'TestExamController@del_question');
	});
	//Route admin question
	Route::group(['prefix' => 'question'], function(){
		Route::get('/', 'QuestionController@index')->name('admin.question');
		Route::post('/add_question', 'QuestionController@add_question');
		Route::post('/change_content/{id}', 'QuestionController@change_content');
		Route::post('del_question/{id}', 'QuestionController@del_question');
		Route::get('/restore_trash/{id}', 'QuestionController@restore_trash');
	});

	Route::group(['prefix' => 'chapter'], function(){
		Route::post('/add_chapter', 'ChapterController@add_chapter');
		Route::post('/del_chapter/{id}', 'ChapterController@del_chapter');
	});
	// Route admin Option
	// Route::group(['prefix' => 'option'], function(){
	// 	Route::post('/change_answer/{id}', 'OptionController@change_answer');
	// });
	//Route admin profile
	Route::group(['prefix' => 'profile'], function(){
		Route::get('/', 'ProfileController@index')->name('admin.profile');
		Route::post('/change_info/{id}', 'ProfileController@change_info');
		Route::post('/change_avatar/{id}', 'ProfileController@change_avatar');
	});

});

Route::get('/admin/test', 'TestController@checkcountdown');
