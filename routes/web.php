<?php
///php artisan krlove:generate:model Material --table-name=materials

Route::resource('/', 'main\homeController');
Route::resource('home', 'main\homeController');
Route::resource('signup', 'Auth\RegisterController');
Route::post('register', 'main\signupController@registration');
Route::get('article/{id}', 'main\articleController@index')->where('id', '[0-9]+');
Route::get('category/{type}/{id}', 'main\categoryController@index')->where(['id' => '[0-9]+', 'type' => '[0-9]+',]);
Route::get('browse_version', 'main\browseController@browse_version');
Route::get('browse_researcher', 'main\browseController@browse_researcher');
Route::get('browse_category', 'main\browseController@browse_category');
Route::get('browse_index_researcher', 'main\browseController@browse_index_researcher');
Route::get('browse_index_researcher_by_folder/{id}', 'main\browseController@browse_index_researcher')->where('id', '[0-9]+');


/*********************************/


Route::group(['middleware' => ['web', 'auth']], function () {


    Route::get('datatableUser', 'userController@datatableUser');
    Route::post('update_user', 'userController@update_User');
    Route::resource('user', 'userController');

    /*********************************/

    Route::get('datatableFolder', 'folderController@datatableFolder');
    Route::post('update_user', 'folderController@update_Folder');
    Route::resource('folder', 'folderController');

    /*********************************/

    Route::get('datatableVersion', 'versionController@datatableVersion');
    Route::post('update_version', 'versionController@update_Version');
    Route::resource('version', 'versionController');

    /*********************************/
    Route::get('datatableCategory', 'categoryController@datatablecategory');
    Route::post('update_category', 'categoryController@update_category');
    Route::resource('category', 'categoryController');

    /*********************************/
    Route::get('datatableJournal', 'journalController@datatableJournal');
    Route::post('update_journal', 'journalController@update_journal');
    Route::resource('journal', 'journalController');

    /*********************************/
    Route::get('datatableResearch', 'researchController@datatableResearch');
    Route::post('update_research', 'researchController@update_research');
    Route::resource('research', 'researchController');
    Route::get('logout', 'loginController@logout');


    Route::get('logout', 'loginController@logout');
    /*********************************/

    Route::get('/migrate', function () {
        ini_set('max_execution_time', 300);
        Artisan::call('migrate:fresh --seed', []);


        return redirect('/');
    });

    Route::get('/seed', function () {
        ini_set('max_execution_time', 300);

        Artisan::call('db:seed', []);

        return redirect('/');
    });

    /*********************************/


    Route::get('/reset', function () {
        ini_set('max_execution_time', 300);
        Artisan::call('migrate:reset', ['--force' => true]);
        echo "migration done.";
        return redirect('/');
    });
});


/*********************************/


Route::get('/admin', 'loginController@index')->name('login');
Route::post('login', 'loginController@login');
