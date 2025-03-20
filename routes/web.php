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
        Route::get('witel', [RegionalUnitController::class, 'witel']);
        Route::get('sub-unit', [RegionalUnitController::class, 'subUnit']);
        Route::get('sub-group', [RegionalUnitController::class, 'subGroup']);
        Route::get('mitra', [RegionalUnitController::class, 'mitra']);
    });

    Route::prefix('reporting-configuration')->group(function () {
        Route::get('status', [ReportingConfigurationController::class, 'status']);
        Route::get('sub-status', [ReportingConfigurationController::class, 'subStatus']);
        Route::get('segments', [ReportingConfigurationController::class, 'segments']);
        Route::get('actions', [ReportingConfigurationController::class, 'actions']);
    });

    Route::prefix('ajax')->group(function () {
        Route::prefix('reporting-configuration')->group(function () {
            Route::get('status', [AjaxController::class, 'get_order_status']);
            Route::get('sub-status', [AjaxController::class, 'get_order_sub_status']);
            Route::get('segments', [AjaxController::class, 'get_order_segments']);
            Route::get('actions', [AjaxController::class, 'get_order_actions']);
        });
    });
});
