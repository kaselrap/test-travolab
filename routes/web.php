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

Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index',
]);
Route::post('form_apply', [
    'as' => 'request.apply',
    'middleware' => 'web',
    'uses' => 'UserRequestController@apply'
]);

Auth::routes();

Route::group(['prefix' => 'administration', 'middleware' => ['auth', 'web']], function () {
    Route::get('/', function () {
         return redirect()->route('user_requests');
    })->name('administration');
    Route::group(['prefix' => 'user_requests'], function () {
        Route::get('/', [
            'as' => 'user_requests',
            'uses' => 'UserRequestController@index'
        ]);
        Route::match(['GET', 'DELETE'], 'delete/{userRequest}', [
            'as' => 'user_requests.delete',
            'uses' => 'UserRequestController@delete'
        ]);
    });
    Route::group(['prefix' => 'places'], function () {
        Route::get('/', [
            'as' => 'places',
            'uses' => 'PlaceController@index'
        ]);
        Route::get('create', [
            'middleware' => 'can:show,App\User',
            'as' => 'places.create',
            'uses' => 'PlaceController@show'
        ]);
        Route::get('edit/{place}', [
            'middleware' => 'can:show,App\User',
            'as' => 'places.edit',
            'uses' => 'PlaceController@show'
        ]);
        Route::post('store/{place?}', [
            'middleware' => 'can:show,App\User',
            'as' => 'places.store',
            'uses' => 'PlaceController@update'
        ]);
        Route::match(['GET', 'DELETE'], 'delete/{place}', [
            'middleware' => 'can:show,App\User',
            'as' => 'places.delete',
            'uses' => 'PlaceController@delete'
        ]);
    });


    Route::group(['prefix' => 'types'], function () {
        Route::get('/', [
            'as' => 'types',
            'uses' => 'TypeController@index'
        ]);
        Route::get('create', [
            'as' => 'types.create',
            'uses' => 'TypeController@show'
        ]);
        Route::get('edit/{type}', [
            'as' => 'types.edit',
            'uses' => 'TypeController@show'
        ]);
        Route::post('store/{type?}', [
            'as' => 'types.store',
            'uses' => 'TypeController@update'
        ]);
        Route::match(['GET', 'DELETE'], 'delete/{type}', [
            'as' => 'types.delete',
            'uses' => 'TypeController@delete'
        ]);
    });

    Route::group(['prefix' => 'subtypes'], function () {
        Route::get('/', [
            'as' => 'subtypes',
            'uses' => 'SubTypeController@index'
        ]);
        Route::get('create', [
            'as' => 'subtypes.create',
            'uses' => 'SubTypeController@show'
        ]);
        Route::get('edit/{subtype}', [
            'as' => 'subtypes.edit',
            'uses' => 'SubTypeController@show'
        ]);
        Route::post('store/{subtype?}', [
            'as' => 'subtypes.store',
            'uses' => 'SubTypeController@update'
        ]);
        Route::match(['GET', 'DELETE'], 'delete/{subtype}', [
            'as' => 'subtypes.delete',
            'uses' => 'SubTypeController@delete'
        ]);
    });

    Route::group(['prefix' => 'organization-types'], function () {
        Route::get('/', [
            'as' => 'organization.types',
            'uses' => 'OrganizationTypeController@index'
        ]);
        Route::get('create', [
            'as' => 'organization.types.create',
            'uses' => 'OrganizationTypeController@show'
        ]);
        Route::get('edit/{organizationType}', [
            'as' => 'organization.types.edit',
            'uses' => 'OrganizationTypeController@show'
        ]);
        Route::post('store/{organizationType?}', [
            'as' => 'organization.types.store',
            'uses' => 'OrganizationTypeController@update'
        ]);
        Route::match(['GET', 'DELETE'], 'delete/{organizationType}', [
            'as' => 'organization.types.delete',
            'uses' => 'OrganizationTypeController@delete'
        ]);
    });

    Route::group(['prefix' => 'employees'], function () {
        Route::get('/', [
            'as' => 'employees',
            'uses' => 'EmployeeController@index'
        ]);
        Route::get('show-time-table/{employee}', [
            'as' => 'employees.show_timetable',
            'uses' => 'EmployeeController@showTimeTable'
        ]);
        Route::get('showSchedule/{employee}', [
            'as' => 'employees.showSchedule',
            'uses' => 'EmployeeController@showScheduleModal'
        ]);
        Route::get('create', [
            'middleware' => 'can:show,App\User',
            'as' => 'employees.create',
            'uses' => 'EmployeeController@show'
        ]);
        Route::get('edit/{employee}', [
            'middleware' => 'can:show,App\User',
            'as' => 'employees.edit',
            'uses' => 'EmployeeController@show'
        ]);
        Route::post('store/{employee?}', [
            'middleware' => 'can:show,App\User',
            'as' => 'employees.store',
            'uses' => 'EmployeeController@update'
        ]);
        Route::match(['GET', 'DELETE'], 'delete/{employee}', [
            'middleware' => 'can:show,App\User',
            'as' => 'employees.delete',
            'uses' => 'EmployeeController@delete'
        ]);
    });
    Route::group(['prefix' => 'events'], function () {
        Route::get('/', [
            'as' => 'events',
            'uses' => 'EventController@index'
        ]);
        Route::get('renderRequestModal/{event}', [
            'as' => 'events.renderRequestModal',
            'uses' => 'EventController@renderRequestModal'
        ]);
        Route::post('add-reservation', [
            'as' => 'events.addReservation',
            'uses' => 'EventController@addReservation',
        ]);
        Route::get('create', [
            'as' => 'events.create',
            'uses' => 'EventController@show'
        ]);
        Route::get('edit/{event}', [
            'as' => 'events.edit',
            'uses' => 'EventController@show'
        ]);
        Route::post('store/{event?}', [
            'as' => 'events.store',
            'uses' => 'EventController@update'
        ]);
        Route::match(['GET', 'DELETE'], 'delete/{event}', [
            'as' => 'events.delete',
            'uses' => 'EventController@delete'
        ]);
    });
    Route::group(['prefix' => 'event_coast'], function () {
        Route::get('/', [
            'as' => 'event_coast',
            'uses' => 'EventCoastController@index'
        ]);
        Route::get('create', [
            'as' => 'event_coast.create',
            'uses' => 'EventCoastController@show'
        ]);
        Route::get('edit/{eventCoast}', [
            'as' => 'event_coast.edit',
            'uses' => 'EventCoastController@show'
        ]);
        Route::post('store/{eventCoast?}', [
            'as' => 'event_coast.store',
            'uses' => 'EventCoastController@update'
        ]);
        Route::match(['GET', 'DELETE'], 'delete/{eventCoast}', [
            'as' => 'event_coast.delete',
            'uses' => 'EventCoastController@delete'
        ]);
    });
    Route::group(['prefix' => 'clients'], function () {
        Route::get('/', [
            'as' => 'clients',
            'uses' => 'ClientController@index'
        ]);
        Route::get('{type}/create', [
            'as' => 'clients.create',
            'uses' => 'ClientController@show'
        ]);
        Route::get('{type}/edit/{client}', [
            'as' => 'clients.edit',
            'uses' => 'ClientController@show'
        ]);
        Route::post('{type}/store/{client?}', [
            'as' => 'clients.store',
            'uses' => 'ClientController@update'
        ]);
        Route::match(['GET', 'DELETE'], 'delete/{client}', [
            'as' => 'clients.delete',
            'uses' => 'ClientController@delete'
        ]);
    });
    Route::group(['prefix' => 'reports'], function () {
        Route::get('/', [
            'as' => 'reports',
            'uses' => 'ReportController@index'
        ]);
        Route::get('renderReportLink', [
            'as' => 'reports.renderReportLink',
            'uses' => 'ReportController@renderReportLink'
        ]);
        Route::get('reservations/{period}', [
            'as' => 'reports.reservations',
            'uses' => 'ReportController@reservations'
        ])->where(['period' => '\d{1,2}/\d{1,2}/\d{4} - \d{1,2}/\d{1,2}/\d{4}',]);
    });
});
