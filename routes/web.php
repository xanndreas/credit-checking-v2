<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::post('roles/{role}/tenants', 'RolesController@tenants')->name('roles.tenants');
    Route::resource('roles', 'RolesController');

    // Users
    Route::resource('users', 'UsersController');

    // Request Credit
    Route::resource('request-credits', 'RequestCreditController');
    Route::post('request-credits/download', 'RequestCreditController@download')->name('request-credits.download');

    // Request Credit Debtor
    Route::resource('request-credit-debtors', 'RequestCreditDebtorController');

    // Request Credit Help
    Route::resource('request-credit-helps', 'RequestCreditHelpController');

    // Workflow Process
    Route::resource('workflow-processes', 'WorkflowProcessController');

    // Workflow Request Credit
    Route::resource('workflow-request-credits', 'WorkflowRequestCreditController');

    // Workflow Request Credit History
    Route::resource('workflow-request-credit-histories', 'WorkflowRequestCreditHistoryController');

    // Request Approval
    Route::resource('request-approvals', 'RequestApprovalController');

    // Survey Addresses
    Route::resource('survey-addresses', 'SurveyAddressesController');

    // Survey Report
    Route::resource('survey-reports', 'SurveyReportController');

    // Survey Report Attribute
    Route::resource('survey-report-attributes', 'SurveyReportAttributeController');

    // Request Credit Attribute
    Route::resource('request-credit-attributes', 'RequestCreditAttributeController');

    // Settings
    Route::post('settings/media', 'SettingController@storeMedia')->name('settings.storeMedia');
    Route::resource('settings', 'SettingController')->only(['index', 'update']);
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'App\Http\Controllers\Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
