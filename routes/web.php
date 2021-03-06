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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

//DB::listen(function($query) {
//    var_dump($query->sql, $query->bindings);
//});

Route::get('test', "Test@index")->name('test');


Route::get('migrate', "Migrate@index")->name('migrate');
Route::get('migrate/rollback', "Migrate@rollback")->name('migrate-rollback');
Route::get('seed', "Seed@index")->name('seed');

Route::get('lacale/{language}', "Admin\Locale@index")->name('locale');

Route::post('bot/user/{id}', "Bot\Bot@index")->name('bot-webhook');

Route::match(['get', 'post'], 'payment/qiwi/handler', "Payment@qiwiHandler");
Route::match(['get', 'post'], 'payment/yandex/handler', "Payment@yandexHandler");
Route::match(['get', 'post'], 'payment/webmoney/handler', "Payment@webmoneyHandler");
Route::match(['get', 'post'], 'payment/paypal/handler', "Payment@paypalHandler");

Route::match(['get', 'post'], 'payment/method/{messenger}/{id}/{amount?}/{purpose?}', "Pay@method");
Route::match(['post'], 'payment/invoice', "Pay@invoice")->name('payment-invoice');

Route::match(['get', 'post'], 'bot/index', "Bot\RequestHandler@index");
Route::get('bot/send/mailing', "Send@mailing"); // Рассылка (Каждые 2 минуты)

Route::match(['get', 'post'], 'pay/handler', "Payment@handler");

Route::group(['middleware' => 'auth', 'prefix'=>'admin'], function() {
    Route::group(['middleware' => 'access:statistics'], function () {
        Route::get('/', "Admin\Statistics@index")->name('statistics');
    });

    Route::group(['prefix' => '/mailing', 'middleware' => 'access:mailing'], function () {
        Route::get('/', "Admin\Mailing@index")->name('mailing');
        Route::post('/send', "Admin\Mailing@send");
        Route::post('/cancel', "Admin\Mailing@cancel");
        Route::get('/analize', "Admin\Mailing@analize");
        Route::get('/log', "Admin\Mailing@log");
        Route::post('/mark-inactive-users', "Admin\Mailing@markInactiveUsers");
    });

    Route::group(['prefix' => '/users', 'middleware' => 'access:users'], function () {
        Route::get('/', "Admin\Users@index")->name('users');
        Route::get('/profile/{id}', "Admin\Users@profile")->name('user-profile');
        Route::get('/search', "Admin\Users@createUrlSearch");
        Route::get('/search/{str}', "Admin\Users@search");
        Route::post('/access/', "Admin\Users@access")->name('user-access');
        Route::post('/count/chat', "Admin\Users@countChat")->name('user-count-chat');
        Route::post('/count/mailing', "Admin\Users@countMailing")->name('user-count-mailing');
        Route::post('/send/message', "Admin\Users@sendMessage")->name('user-send-message');
    });

        Route::group(['prefix' => 'languages', 'middleware' => 'access:languages'], function () {
            Route::get('/list', "Admin\Languages@list")->name('languages-list');
            Route::get('/add', "Admin\Languages@add")->name('languages-add');
            Route::post('/add/save', "Admin\Languages@addSave")->name('languages-add-save');
            Route::post('/delete', "Admin\Languages@delete")->name('languages-delete');
        });

        Route::group(['prefix' => 'contacts', 'middleware' => 'access:contacts'], function () {
            Route::get('/general', "Admin\Contacts@general")->name('contacts-general');
            Route::get('/access', "Admin\Contacts@access")->name('contacts-access');
            Route::get('/advertising', "Admin\Contacts@advertising")->name('contacts-advertising');
            Route::get('/offers', "Admin\Contacts@offers")->name('contacts-offers');
            Route::post('/answer', "Admin\Contacts@answer")->name('contacts-answer');
            Route::post('/answer/send', "Admin\Contacts@answerSend")->name('contacts-answer-send');
            Route::post('/delete', "Admin\Contacts@delete")->name('contacts-delete');
            Route::post('/delete-check', "Admin\Contacts@deleteCheck")->name('contacts-delete-check');
        });

        Route::group(['prefix' => 'answers', 'middleware' => 'access:answers'], function () {
            Route::get('/list', "Admin\Answers@list")->name('answers');
            Route::get('/add', "Admin\Answers@add");
            Route::post('/edit', "Admin\Answers@edit");
            Route::post('/save', "Admin\Answers@save");
            Route::post('/delete', "Admin\Answers@delete");
        });

        Route::group(['prefix' => 'moderators', 'middleware' => 'access:moderators'], function () {
            Route::get('/permissions', "Admin\Moderators@permissions")->name('moderators-permissions');
            Route::get('/add', "Admin\Moderators@add")->name('moderators-add');
            Route::post('/add/save', "Admin\Moderators@addSave")->name('moderators-save-add');
            Route::get('/', "Admin\Moderators@list")->name('moderators-list');
            Route::post('/edit', "Admin\Moderators@edit")->name('moderators-edit');
            Route::post('/delete', "Admin\Moderators@delete")->name('moderators-delete');
            Route::post('/edit/save', "Admin\Moderators@editSave")->name('moderators-save-edit');
            Route::post('/permissions/save', "Admin\Moderators@permissionsSave")->name('moderators-save-permissions');
        });

        Route::group(['prefix' => 'settings', 'middleware' => 'access:settings'], function () {
            Route::post('/', "Admin\Settings@admin");
            Route::post('/save', "Admin\Settings@adminUpdate");
            Route::get('/main', "Admin\Settings@main")->name('settings-main');
            Route::get('/pages', "Admin\Settings@pages")->name('settings-pages');
            Route::get('/buttons', "Admin\Settings@buttons")->name('settings-buttons');
            Route::post('/main/save', "Admin\Settings@mainSave");
            Route::post('/pages/edit', "Admin\Settings@pagesEdit");
            Route::post('/pages/save', "Admin\Settings@pagesSave");
            Route::post('/buttons/edit', "Admin\Settings@buttonsEdit");
            Route::post('/buttons/save', "Admin\Settings@buttonsSave");
            Route::post('/buttons/view/save', "Admin\Settings@buttonsViewSave")->name('save-view-buttons');
            Route::get('/buttons/go/lang', "Admin\Settings@buttonsGoLang")->name('buttons-go-lang');
            Route::get('/pages/go/lang', "Admin\Settings@pagesGoLang")->name('pages-go-lang');
            Route::get('/pages/{lang}', "Admin\Settings@pages")->name('settings-pages-lang');
            Route::get('/buttons/{lang}', "Admin\Settings@buttons")->name('settings-buttons-lang');
        });

        Route::prefix('add')->group(function () {
            Route::get('/menu', "Admin\Add@menu")->name('add-menu');
        });

        Route::group(['prefix' => 'payment', 'middleware' => 'access:payment'], function () {
            Route::get('/qiwi', "Admin\Payment@qiwi")->name('admin-qiwi');
            Route::post('/qiwi/save', "Admin\Payment@qiwiSave")->name('admin-qiwi-save');
            Route::get('/yandex', "Admin\Payment@yandex")->name('admin-yandex');
            Route::post('/yandex/save', "Admin\Payment@yandexSave")->name('admin-yandex-save');
            Route::get('/webmoney', "Admin\Payment@webmoney")->name('admin-webmoney');
            Route::post('/webmoney/save', "Admin\Payment@webmoneySave")->name('admin-webmoney-save');
            Route::get('/paypal', "Admin\Payment@paypal")->name('admin-paypal');
            Route::post('/paypal/save', "Admin\Payment@paypalSave")->name('admin-paypal-save');
        });

        Route::group(['prefix' => 'countries', 'middleware' => 'access:countries'], function () {
            Route::get('/', "Admin\CountriesController@index")->name('countries');
            Route::get('/add', "Admin\CountriesController@add")->name('countries-add');
            Route::post('/add/save', "Admin\CountriesController@addSave")->name('countries-add-save');
            Route::post('/delete', "Admin\CountriesController@delete")->name('countries-delete');
            Route::post('/edit', "Admin\CountriesController@edit")->name('countries-edit');
            Route::post('/edit/save', "Admin\CountriesController@editSave")->name('countries-edit-save');
        });

        Route::group(['prefix' => 'categories', 'middleware' => 'access:categories'], function () {
            Route::get('/', "Admin\CategoriesController@index")->name('categories');
            Route::get('/add', "Admin\CategoriesController@add")->name('categories-add');
            Route::post('/add/save', "Admin\CategoriesController@addSave")->name('categories-add-save');
            Route::post('/delete', "Admin\CategoriesController@delete")->name('categories-delete');
            Route::post('/edit', "Admin\CategoriesController@edit")->name('categories-edit');
            Route::post('/edit/save', "Admin\CategoriesController@editSave")->name('categories-edit-save');
        });

        Route::group(['prefix' => 'channels', 'middleware' => 'access:channels'], function () {
            Route::get('/{messenger?}', "Admin\ChannelsController@index")->name('channels');
            Route::get('/moderation/0', "Admin\ChannelsController@moderation")->name('channels-moderation');
            Route::get('/top/0/{messenger?}', "Admin\ChannelsController@top")->name('channels-top');
            Route::post('/edit', "Admin\ChannelsController@edit")->name('channels-edit');
            Route::post('/edit/save', "Admin\ChannelsController@editSave")->name('channels-edit-save');
            Route::post('/delete', "Admin\ChannelsController@delete")->name('channels-delete');
            Route::post('/activate', "Admin\ChannelsController@activate")->name('channels-activate');
            Route::post('/moderation/delete', "Admin\ChannelsController@moderationDelete")->name('channels-moderation-delete');
            Route::post('/top/add', "Admin\ChannelsController@addTop")->name('channels-add-top');
            Route::post('/top/delete', "Admin\ChannelsController@topDelete")->name('channels-top-delete');
        });

        Route::group(['prefix' => 'topList', 'middleware' => 'access:top_list'], function () {
            Route::get('/top/top/{messenger?}', "Admin\TopListController@top")->name('top-list-top');
            Route::get('/country', "Admin\TopListController@countries")->name('top-list-select-country');
            Route::get('/category', "Admin\TopListController@categories")->name('top-list-select-category');
            Route::post('/top/save', "Admin\TopListController@topSave")->name('top-list-top-save');
            Route::get('/top/country/{country}/{messenger?}', "Admin\TopListController@topCountry")->name('top-list-country');
            Route::post('/top/country/save', "Admin\TopListController@topCountrySave")->name('top-list-country-save');
            Route::get('/top/category/{category}/{messenger?}', "Admin\TopListController@topCategory")->name('top-list-category');
            Route::post('/top/category/save', "Admin\TopListController@topCategorySave")->name('top-list-category-save');
        });
    });

Route::group(['middleware' => 'auth', 'prefix'=>'developer'], function() {
        Route::prefix('/settings')->group(function () {
            Route::get('/main', "Developer\Settings@settingsMain");
            Route::get('/pages', "Developer\Settings@settingsPages");
            Route::get('/buttons', "Developer\Settings@settingsButtons");
            Route::post('/main/add', "Developer\Settings@settingsMainAdd");
            Route::post('/main/delete', "Developer\Settings@settingsMainDelete");
            Route::post('/main/edit', "Developer\Settings@settingsMainEdit");
            Route::post('/main/save', "Developer\Settings@settingsMainSave");
            Route::post('/pages/add', "Developer\Settings@settingsPagesAdd");
            Route::post('/pages/delete', "Developer\Settings@settingsPagesDelete");
            Route::post('/pages/edit', "Developer\Settings@settingsPagesEdit");
            Route::post('/pages/save', "Developer\Settings@settingsPagesSave");
            Route::post('/buttons/add', "Developer\Settings@settingsButtonsAdd");
            Route::post('/buttons/delete', "Developer\Settings@settingsButtonsDelete");
            Route::post('/buttons/edit', "Developer\Settings@settingsButtonsEdit");
            Route::post('/buttons/save', "Developer\Settings@settingsButtonsSave");
        });

        Route::prefix('/payment')->group(function () {
            Route::get('/qiwi', "Developer\Payment@qiwi")->name('qiwi');
            Route::post('/qiwi/save', "Developer\Payment@qiwiSave")->name('qiwi-save');
            Route::get('/yandex', "Developer\Payment@yandex")->name('yandex');
            Route::post('/yandex/save', "Developer\Payment@yandexSave")->name('yandex-save');
            Route::get('/webmoney', "Developer\Payment@webmoney")->name('webmoney');
            Route::post('/webmoney/save', "Developer\Payment@webmoneySave")->name('webmoney-save');
            Route::get('/paypal', "Developer\Payment@paypal")->name('paypal');
            Route::post('/paypal/save', "Developer\Payment@paypalSave")->name('paypal-save');
        });

        Route::prefix('/webhook')->group(function () {
            Route::get('/', "Developer\Webhook@index");
            Route::post('/set', "Developer\Webhook@setWebhook");
        });

        Route::prefix('/answers')->group(function () {
            Route::get('/', "Developer\Answers@index")->name('index-answers');
            Route::post('/edit', "Developer\Answers@edit")->name('edit-answer');
            Route::post('/save', "Developer\Answers@save")->name('save-answer');
            Route::post('/add', "Developer\Answers@add")->name('add-answer');
            Route::post('/delete', "Developer\Answers@delete")->name('delete-answer');
        });

        Route::prefix('/permissions')->group(function () {
            Route::get('/', "Developer\Permissions@index")->name('permissions');
            Route::post('/add', "Developer\Permissions@add")->name('permission-add');
            Route::post('/delete', "Developer\Permissions@delete")->name('permission-delete');
        });

        Route::get('/', "Developer\Settings@index");

        Route::get('request', "Developer\RequestJSON@index")->name('request');
});

Auth::routes();

Route::get('logout', 'Auth\LoginController@logout');

Route::match(['get', 'post'], 'register', function() {
    return redirect('admin/');
});

Route::match(['get', 'post'], '/', function() {
    return redirect('/admin');
});
