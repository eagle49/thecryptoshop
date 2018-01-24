<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * Model binding into route
 */
Route::model('blogcategory', 'App\BlogCategory');
Route::model('blog', 'App\Blog');
Route::model('file', 'App\File');
Route::model('task', 'App\Task');
Route::model('users', 'App\User');

Route::pattern('slug', '[a-z0-9- _]+');

Route::group(array('prefix' => 'admin'), function () {

    # Error pages should be shown without requiring login
    Route::get('404', function () {
        return View('admin/404');
    });
    Route::get('500', function () {
        return View::make('admin/500');
    });

    Route::post('secureImage', array('as' => 'secureImage','uses' => 'JoshController@secureImage'));
    
    # Lock screen
    Route::get('{id}/lockscreen', array('as' => 'lockscreen', 'uses' =>'UsersController@lockscreen'));
    Route::post('{id}/lockscreen', array('as' => 'lockscreen', 'uses' =>'UsersController@postLockscreen'));

    # All basic routes defined here
    Route::get('signin', array('as' => 'signin', 'uses' => 'AuthController@getSignin'));
    Route::post('signin', 'AuthController@postSignin');
    Route::post('signup', array('as' => 'signup', 'uses' => 'AuthController@postSignup'));
    Route::post('forgot-password', array('as' => 'forgot-password', 'uses' => 'AuthController@postForgotPassword'));
    Route::get('login2', function () {
        return View::make('admin/login2');
    });

    # Register2
    Route::get('register2', function () {
        return View::make('admin/register2');
    });
    Route::post('register2', array('as' => 'register2', 'uses' => 'AuthController@postRegister2'));

    # Forgot Password Confirmation
    Route::get('forgot-password/{userId}/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'AuthController@getForgotPasswordConfirm'));
    Route::post('forgot-password/{userId}/{passwordResetCode}', 'AuthController@postForgotPasswordConfirm');

    # Logout
    Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));

    # Account Activation
    Route::get('activate/{userId}/{activationCode}', array('as' => 'activate', 'uses' => 'AuthController@getActivate'));
});

Route::group(array('prefix' => 'admin', 'middleware' => 'SentinelAdmin'), function () {
    # Dashboard / Index
    Route::get('/', array('as' => 'dashboard','uses' => 'JoshController@showHome'));
    Route::get('/dashboard', array('as' => 'dashboard1','uses' => 'JoshController1@showHome'));  //original dashboard

    Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder');
    Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate');
    Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate');

    # User Management
    Route::group(array('prefix' => 'users'), function () {
        Route::get('/', array('as' => 'users', 'uses' => 'UsersController@index'));
        Route::get('data',['as' => 'users.data', 'uses' =>'UsersController@data']);
        Route::get('create', 'UsersController@create');
        Route::post('create', 'UsersController@store');
        Route::get('{userId}/delete', array('as' => 'delete/user', 'uses' => 'UsersController@destroy'));
        Route::get('{userId}/approve', array('as' => 'approve/user', 'uses' => 'UsersController@approve'));
        Route::get('{userId}/confirm-delete', array('as' => 'confirm-delete/user', 'uses' => 'UsersController@getModalDelete'));
        Route::get('{userId}/confirm-approve', array('as' => 'confirm-approve/user', 'uses' => 'UsersController@getModalApprove'));
        Route::get('{userId}/restore', array('as' => 'restore/user', 'uses' => 'UsersController@getRestore'));
        Route::get('{userId}', array('as' => 'users.show', 'uses' => 'UsersController@show'));
        Route::post('{userId}/passwordreset', array('as' => 'passwordreset', 'uses' => 'UsersController@passwordreset'));
    });
    Route::resource('users', 'UsersController');

    Route::get('deleted_users',array('as' => 'deleted_users','before' => 'Sentinel', 'uses' => 'UsersController@getDeletedUsers'));

     # Product Management
    Route::group(array('prefix' => 'products'), function () {
        Route::get('/', array('as' => 'products', 'uses' => 'ProductsController@index'));
        Route::get('data',['as' => 'products.data', 'uses' =>'ProductsController@data']);
        Route::get('create', 'ProductsController@create');
        Route::post('create', 'ProductsController@store');
        //Route::get('{productId}/edit', array('as' => 'edit/product', 'uses' => 'ProductsController@edit'));
        Route::get('{productId}/delete', array('as' => 'delete/product', 'uses' => 'ProductsController@destroy'));
        Route::get('{productId}/confirm-delete', array('as' => 'confirm-delete/product', 'uses' => 'ProductsController@getModalDelete'));
        Route::get('{productId}/restore', array('as' => 'restore/product', 'uses' => 'ProductsController@getRestore'));
        Route::get('{productId}', array('as' => 'products.show', 'uses' => 'ProductsController@show'));
        Route::post('{productId}', array('as' => 'products.update', 'uses' => 'ProductsController@update'));
    });
    Route::resource('products', 'ProductsController');

    Route::group(array('prefix' => 'settings'), function () {
        Route::get('/', array('as' => 'products', 'uses' => 'SettingsController@index'));
        Route::post('create', 'SettingsController@store');
    });
    Route::resource('settings', 'SettingsController');

    Route::group(array('prefix' => 'orders'), function () {
        Route::get('/', array('as' => 'orders', 'uses' => 'OrdersController@index'));
        Route::get('{orderId}/confirm-accpet', array('as' => 'confirm-accept/order', 'uses' => 'OrdersController@getModalAccpet'));
        Route::get('{orderId}/confirm-complete', array('as' => 'confirm-complete/order', 'uses' => 'OrdersController@getModalComplete'));
        Route::get('{orderId}/accept', array('as' => 'accept/order', 'uses' => 'OrdersController@accept'));
        Route::get('{orderId}/complete', array('as' => 'complete/order', 'uses' => 'OrdersController@complete'));
        //Route::post('create', 'SettingsController@store');
    });
    Route::resource('orders', 'OrdersController');

    # Group Management
    Route::group(array('prefix' => 'groups'), function () {
        Route::get('/', array('as' => 'groups', 'uses' => 'GroupsController@index'));
        Route::get('create', array('as' => 'create/group', 'uses' => 'GroupsController@create'));
        Route::post('create', 'GroupsController@store');
        Route::get('{groupId}/edit', array('as' => 'update/group', 'uses' => 'GroupsController@edit'));
        Route::post('{groupId}/edit', 'GroupsController@update');
        Route::get('{groupId}/delete', array('as' => 'delete/group', 'uses' => 'GroupsController@destroy'));
        Route::get('{groupId}/confirm-delete', array('as' => 'confirm-delete/group', 'uses' => 'GroupsController@getModalDelete'));
        Route::get('{groupId}/restore', array('as' => 'restore/group', 'uses' => 'GroupsController@getRestore'));
    });
    /*routes for blog*/
    Route::group(array('prefix' => 'blog'), function () {
        Route::get('/', array('as' => 'blogs', 'uses' => 'BlogController@index'));
        Route::get('create', array('as' => 'create/blog', 'uses' => 'BlogController@create'));
        Route::post('create', 'BlogController@store');
        Route::get('{blog}/edit', array('as' => 'update/blog', 'uses' => 'BlogController@edit'));
        Route::post('{blog}/edit', 'BlogController@update');
        Route::get('{blog}/delete', array('as' => 'delete/blog', 'uses' => 'BlogController@destroy'));
        Route::get('{blog}/confirm-delete', array('as' => 'confirm-delete/blog', 'uses' => 'BlogController@getModalDelete'));
        Route::get('{blog}/restore', array('as' => 'restore/blog', 'uses' => 'BlogController@restore'));
        Route::get('{blog}/show', array('as' => 'blog/show', 'uses' => 'BlogController@show'));
        Route::post('{blog}/storecomment', array('as' => 'restore/blog', 'uses' => 'BlogController@storeComment'));
    });

    /*routes for blog category*/
    Route::group(array('prefix' => 'blogcategory'), function () {
        Route::get('/', array('as' => 'blogcategories', 'uses' => 'BlogCategoryController@index'));
        Route::get('create', array('as' => 'create/blogcategory', 'uses' => 'BlogCategoryController@create'));
        Route::post('create', 'BlogCategoryController@store');
        Route::get('{blogcategory}/edit', array('as' => 'update/blogcategory', 'uses' => 'BlogCategoryController@edit'));
        Route::post('{blogcategory}/edit', 'BlogCategoryController@update');
        Route::get('{blogcategory}/delete', array('as' => 'delete/blogcategory', 'uses' => 'BlogCategoryController@destroy'));
        Route::get('{blogcategory}/confirm-delete', array('as' => 'confirm-delete/blogcategory', 'uses' => 'BlogCategoryController@getModalDelete'));
        Route::get('{blogcategory}/restore', array('as' => 'restore/blogcategory', 'uses' => 'BlogCategoryController@getRestore'));
    });

    /*routes for file*/
    Route::group(array('prefix' => 'file'), function () {
        Route::post('create', 'FileController@store');
        Route::post('createmulti', 'FileController@postFilesCreate');
        Route::delete('delete', 'FileController@delete');
    });

    Route::get('crop_demo', function () {
        return redirect('admin/imagecropping');
    });
    Route::post('crop_demo','JoshController@crop_demo');

    /* laravel example routes */
    # datatables
    Route::get('datatables', 'DataTablesController@index');
    Route::get('datatables/data', array('as' => 'admin.datatables.data', 'uses' => 'DataTablesController@data'));

    # editable datatables
    Route::get('editable_datatables', 'EditableDataTablesController@index');
    Route::get('editable_datatables/data', array('as' => 'admin.editable_datatables.data', 'uses' => 'EditableDataTablesController@data'));
    Route::post('editable_datatables/create','EditableDataTablesController@store');
    Route::post('editable_datatables/{id}/update', 'EditableDataTablesController@update');
    Route::get('editable_datatables/{id}/delete', array('as' => 'admin.editable_datatables.delete', 'uses' => 'EditableDataTablesController@destroy'));

    # custom datatables
    Route::get('custom_datatables', 'CustomDataTablesController@index');
    Route::get('custom_datatables/sliderData', array('as' => 'admin.custom_datatables.sliderData', 'uses' => 'CustomDataTablesController@sliderData'));
    Route::get('custom_datatables/radioData', array('as' => 'admin.custom_datatables.radioData', 'uses' => 'CustomDataTablesController@radioData'));
    Route::get('custom_datatables/selectData', array('as' => 'admin.custom_datatables.selectData', 'uses' => 'CustomDataTablesController@selectData'));
    Route::get('custom_datatables/buttonData', array('as' => 'admin.custom_datatables.buttonData', 'uses' => 'CustomDataTablesController@buttonData'));
    Route::get('custom_datatables/totalData', array('as' => 'admin.custom_datatables.totalData', 'uses' => 'CustomDataTablesController@totalData'));
    
    //tasks section
    Route::post('task/create', 'TaskController@store');
    Route::get('task/data', 'TaskController@data');
    Route::post('task/{task}/edit', 'TaskController@update');
    Route::post('task/{task}/delete', 'TaskController@delete');


    # Remaining pages will be called from below controller method
    # in real world scenario, you may be required to define all routes manually

    Route::get('{name?}', 'JoshController@showView');

});

#FrontEndController
Route::get('login', array('as' => 'login','uses' => 'FrontEndController@getLogin'));
Route::post('login','FrontEndController@postLogin');
Route::get('register', array('as' => 'register','uses' => 'FrontEndController@getRegister'));
Route::post('register','FrontEndController@postRegister');
Route::get('activate/{userId}/{activationCode}',array('as' =>'activate','uses'=>'FrontEndController@getActivate'));
Route::get('forgot-password',array('as' => 'forgot-password','uses' => 'FrontEndController@getForgotPassword'));
Route::post('forgot-password','FrontEndController@postForgotPassword');
# Forgot Password Confirmation
Route::get('forgot-password/{userId}/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'FrontEndController@getForgotPasswordConfirm'));
Route::post('forgot-password/{userId}/{passwordResetCode}', 'FrontEndController@postForgotPasswordConfirm');
# My account display and update details
Route::group(array('middleware' => 'SentinelUser'), function () {
    Route::get('my-account', array('as' => 'my-account', 'uses' => 'FrontEndController@myAccount'));
    Route::put('my-account', 'FrontEndController@update');
});
Route::get('logout', array('as' => 'logout','uses' => 'FrontEndController@getLogout'));
# contact form
Route::post('contact',array('as' => 'contact','uses' => 'FrontEndController@postContact'));

#frontend views
// Route::get('/', array('as' => 'home', function () {
//     return View::make('index');
// }));
Route::get('/', array('as' => 'home', 'uses' => 'FrontEndController@showHomepage'));

Route::get('blog', array('as' => 'blog', 'uses' => 'FrontendBlogController@index'));
Route::get('blog/{slug}/tag', 'FrontendBlogController@getBlogTag');
Route::get('blogitem/{slug?}', 'FrontendBlogController@getBlog');
Route::post('blogitem/{blog}/comment', 'FrontendBlogController@storeComment');

//Route::get('coins', array('as' => 'coins', 'uses' => 'CoinsController@index'));
Route::get('coins/{coinId}', array('as' => 'coins', 'uses' => 'CoinsController@index'));
Route::post('coins/', array('as' => 'coins', 'uses' => 'CoinsController@saveOrder'));
Route::post('coins/orderStatus', array('as' => 'coins', 'uses' => 'CoinsController@orderStatus'));
Route::post('coins/timeout', array('as' => 'coins', 'uses' => 'CoinsController@setExpire'));
Route::get('{name?}', 'JoshController@showFrontEndView');



# End of frontend views

