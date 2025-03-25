<?php

use Illuminate\Support\Facades\Route;
use Mews\Captcha\Captcha;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderManagementController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\TechnicianAttendanceController;
use App\Http\Controllers\InventoryManagementController;
use App\Http\Controllers\ReportsPaymentController;
use App\Http\Controllers\EmployeeManagementController;
use App\Http\Controllers\RegionalUnitController;
use App\Http\Controllers\ReportingConfigurationController;
use App\Http\Controllers\AjaxController;

Route::get('/login', [AuthController::class, 'auth'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('captcha', [Captcha::class, 'create']);

Route::middleware(['auth'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');

    Route::prefix('order-management')->group(function () {
        Route::get('new', [OrderManagementController::class, 'newOrders']);
        Route::get('assigned', [OrderManagementController::class, 'assignedOrders']);
        Route::get('ongoing', [OrderManagementController::class, 'ongoingOrders']);
        Route::get('completed', [OrderManagementController::class, 'completedOrders']);
        Route::get('cancel', [OrderManagementController::class, 'cancelOrders']);
    });

    Route::prefix('support')->group(function () {
        Route::get('order-tracking', [SupportController::class, 'orderTracking']);
        Route::get('helpdesk-monitoring', [SupportController::class, 'helpdeskMonitoring']);
        Route::get('maps-routing', [SupportController::class, 'mapsRouting']);
    });

    Route::prefix('technician-attendance')->group(function () {
        Route::get('daily-attendance', [TechnicianAttendanceController::class, 'dailyAttendance']);
        Route::get('shift-management', [TechnicianAttendanceController::class, 'shiftManagement']);
        Route::get('leave-request', [TechnicianAttendanceController::class, 'leaveRequest']);
        Route::get('attendance-report', [TechnicianAttendanceController::class, 'attendanceReport']);
        Route::get('late-absence-logs', [TechnicianAttendanceController::class, 'lateAbsenceLogs']);
    });

    Route::prefix('inventory-management')->group(function () {
        Route::get('stock-overview', [InventoryManagementController::class, 'stockOverview']);
        Route::get('material-request', [InventoryManagementController::class, 'materialRequest']);
        Route::get('material-inbound', [InventoryManagementController::class, 'materialInbound']);
        Route::get('material-usage', [InventoryManagementController::class, 'materialUsage']);
        Route::get('material-return', [InventoryManagementController::class, 'materialReturn']);
    });

    Route::prefix('reports-payment')->group(function () {
        Route::get('daily-reports', [ReportsPaymentController::class, 'dailyReports']);
        Route::get('technician-performance', [ReportsPaymentController::class, 'technicianPerformance']);
        Route::get('billing-payment', [ReportsPaymentController::class, 'billingPayment']);
    });

    Route::prefix('employee-management')->group(function () {
        Route::get('list', [EmployeeManagementController::class, 'employeeList']);
        Route::get('roles-permissions', [EmployeeManagementController::class, 'rolesPermissions']);
    });

    Route::prefix('regional-unit')->group(function () {
        Route::get('regional', [RegionalUnitController::class, 'regional']);
        Route::post('regional/store', [RegionalUnitController::class, 'storeRegional']);
        Route::get('regional/destroy/{id}', [RegionalUnitController::class, 'destroyRegional']);

        Route::get('witel', [RegionalUnitController::class, 'witel']);
        Route::post('witel/store', [RegionalUnitController::class, 'storeWitel']);
        Route::get('witel/destroy/{id}', [RegionalUnitController::class, 'destroyWitel']);

        Route::get('sub-unit', [RegionalUnitController::class, 'subUnit']);
        Route::post('sub-unit/store', [RegionalUnitController::class, 'storeSubUnit']);
        Route::get('sub-unit/destroy/{id}', [RegionalUnitController::class, 'destroySubUnit']);

        Route::get('sub-group', [RegionalUnitController::class, 'subGroup']);
        Route::post('sub-group/store', [RegionalUnitController::class, 'storeSubGroup']);
        Route::get('sub-group/destroy/{id}', [RegionalUnitController::class, 'destroySubGroup']);

        Route::get('mitra', [RegionalUnitController::class, 'mitra']);
        Route::post('mitra/store', [RegionalUnitController::class, 'storeMitra']);
        Route::get('mitra/destroy/{id}', [RegionalUnitController::class, 'destroyMitra']);
    });

    Route::prefix('reporting-configuration')->group(function () {
        Route::get('status', [ReportingConfigurationController::class, 'status']);
        Route::post('status/store', [ReportingConfigurationController::class, 'storeStatus']);
        Route::get('status/destroy/{id}', [ReportingConfigurationController::class, 'destroyStatus']);

        Route::get('sub-status', [ReportingConfigurationController::class, 'subStatus']);
        Route::post('sub-status/store', [ReportingConfigurationController::class, 'storeSubStatus']);
        Route::get('sub-status/destroy/{id}', [ReportingConfigurationController::class, 'destroySubStatus']);

        Route::get('segments', [ReportingConfigurationController::class, 'segments']);
        Route::post('segments/store', [ReportingConfigurationController::class, 'storeSegment']);
        Route::get('segments/destroy/{id}', [ReportingConfigurationController::class, 'destroySegment']);

        Route::get('actions', [ReportingConfigurationController::class, 'actions']);
        Route::post('actions/store', [ReportingConfigurationController::class, 'storeAction']);
        Route::get('actions/destroy/{id}', [ReportingConfigurationController::class, 'destroyAction']);
    });

    Route::prefix('ajax')->group(function () {
        Route::prefix('employee-management')->group(function () {
            Route::get('list', [AjaxController::class, 'get_employee_list']);
            Route::get('list/{id}', [AjaxController::class, 'get_employee_list_by_id']);

            Route::get('roles-permissions', [AjaxController::class, 'get_employee_roles_permissions']);
            Route::get('get-witel-by-regional/{regional_id}', [AjaxController::class, 'get_witel_by_regional']);
            Route::get('get-mitra-by-witel/{witel_id}', [AjaxController::class, 'get_mitra_by_witel']);
            Route::get('get-sub-unit-by-regional/{regional_id}', [AjaxController::class, 'get_sub_unit_by_regional']);
        });

        Route::prefix('reporting-configuration')->group(function () {
            Route::get('status', [AjaxController::class, 'get_order_status']);
            Route::get('status/{id}', [AjaxController::class, 'get_order_status_by_id']);

            Route::get('sub-status', [AjaxController::class, 'get_order_sub_status']);
            Route::get('sub-status/{id}', [AjaxController::class, 'get_order_sub_status_by_id']);

            Route::get('segments', [AjaxController::class, 'get_order_segments']);
            Route::get('segments/{id}', [AjaxController::class, 'get_order_segement_by_id']);

            Route::get('actions', [AjaxController::class, 'get_order_actions']);
            Route::get('actions/{id}', [AjaxController::class, 'get_order_actions_by_id']);
        });

        Route::prefix('regional-unit')->group(function () {
            Route::get('regional', [AjaxController::class, 'get_regional']);
            Route::get('regional/{id}', [AjaxController::class, 'get_regional_by_id']);

            Route::get('witel', [AjaxController::class, 'get_witel']);
            Route::get('witel/{id}', [AjaxController::class, 'get_witel_by_id']);

            Route::get('sub-unit', [AjaxController::class, 'get_sub_unit']);
            Route::get('sub-unit/{id}', [AjaxController::class, 'get_sub_unit_by_id']);

            Route::get('sub-group', [AjaxController::class, 'get_sub_group']);
            Route::get('sub-group/{id}', [AjaxController::class, 'get_sub_group_by_id']);

            Route::get('mitra', [AjaxController::class, 'get_mitra']);
            Route::get('mitra/{id}', [AjaxController::class, 'get_mitra_by_id']);
        });
    });
});
