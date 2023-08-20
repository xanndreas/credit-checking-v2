<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'App\Http\Controllers\Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
  // Permissions
  Route::apiResource('permissions', 'PermissionsApiController');

  // Roles
  Route::apiResource('roles', 'RolesApiController');

  // Users
  Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
  Route::apiResource('users', 'UsersApiController');

  // Request Credit
  Route::apiResource('request-credits', 'RequestCreditApiController');

  // Request Credit Debtor
  Route::apiResource('request-credit-debtors', 'RequestCreditDebtorApiController');

  // Request Credit Help
  Route::apiResource('request-credit-helps', 'RequestCreditHelpApiController');

  // Workflow Process
  Route::apiResource('workflow-processes', 'WorkflowProcessApiController');

  // Workflow Request Credit
  Route::apiResource('workflow-request-credits', 'WorkflowRequestCreditApiController');

  // Workflow Request Credit History
  Route::apiResource('workflow-request-credit-histories', 'WorkflowRequestCreditHistoryApiController');

  // Request Approval
  Route::apiResource('request-approvals', 'RequestApprovalApiController');

  // Survey Addresses
  Route::apiResource('survey-addresses', 'SurveyAddressesApiController');

  // Survey Report
  Route::apiResource('survey-reports', 'SurveyReportApiController');

  // Survey Report Attribute
  Route::apiResource('survey-report-attributes', 'SurveyReportAttributeApiController');

  // Request Credit Attribute
  Route::apiResource('request-credit-attributes', 'RequestCreditAttributeApiController');
});
