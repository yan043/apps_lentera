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
use App\Http\Controllers\OrganizationStructureController;
use App\Http\Controllers\ReportingConfigurationController;
use App\Http\Controllers\AjaxController;

Route::get('login', [AuthController::class, 'auth'])->name('login');
Route::post('login', [AuthController::class, 'login'])->middleware('guest')->name('login.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('captcha', [Captcha::class, 'create'])->name('captcha');

Route::middleware(['auth'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('profile/store', [AuthController::class, 'storeProfile'])->name('profile.store');
    Route::get('profile/deactivate', [AuthController::class, 'deactivateAccount'])->name('profile.deactivate');

    Route::prefix('order-management')->group(function () {
        Route::get('new', [OrderManagementController::class, 'newOrders'])->name('order-management.new');
        Route::get('new/details', [OrderManagementController::class, 'newOrderDetails'])->name('order-management.new.details');

        Route::get('assigned', [OrderManagementController::class, 'assignedOrders'])->name('order-management.assigned');
        Route::get('ongoing', [OrderManagementController::class, 'ongoingOrders'])->name('order-management.ongoing');
        Route::get('completed', [OrderManagementController::class, 'completedOrders'])->name('order-management.completed');
        Route::get('cancel', [OrderManagementController::class, 'cancelOrders'])->name('order-management.cancel');
    });

    Route::prefix('support')->group(function () {
        Route::get('order-tracking', [SupportController::class, 'orderTracking'])->name('support.order-tracking');
        Route::get('helpdesk-monitoring', [SupportController::class, 'helpdeskMonitoring'])->name('support.helpdesk-monitoring');
        Route::get('maps-routing', [SupportController::class, 'mapsRouting'])->name('support.maps-routing');
    });

    Route::prefix('technician-attendance')->group(function () {
        Route::get('daily-attendance', [TechnicianAttendanceController::class, 'dailyAttendance'])->name('technician-attendance.daily-attendance');
        Route::get('shift-management', [TechnicianAttendanceController::class, 'shiftManagement'])->name('technician-attendance.shift-management');
        Route::get('leave-request', [TechnicianAttendanceController::class, 'leaveRequest'])->name('technician-attendance.leave-request');
        Route::get('attendance-report', [TechnicianAttendanceController::class, 'attendanceReport'])->name('technician-attendance.attendance-report');
        Route::get('late-absence-logs', [TechnicianAttendanceController::class, 'lateAbsenceLogs'])->name('technician-attendance.late-absence-logs');
    });

    Route::prefix('inventory-management')->group(function () {
        Route::get('stock-overview', [InventoryManagementController::class, 'stockOverview'])->name('inventory-management.stock-overview');
        Route::get('material-request', [InventoryManagementController::class, 'materialRequest'])->name('inventory-management.material-request');
        Route::get('material-inbound', [InventoryManagementController::class, 'materialInbound'])->name('inventory-management.material-inbound');
        Route::get('material-usage', [InventoryManagementController::class, 'materialUsage'])->name('inventory-management.material-usage');
        Route::get('material-return', [InventoryManagementController::class, 'materialReturn'])->name('inventory-management.material-return');
    });

    Route::prefix('reports-payment')->group(function () {
        Route::get('daily-reports', [ReportsPaymentController::class, 'dailyReports'])->name('reports-payment.daily-reports');
        Route::get('technician-performance', [ReportsPaymentController::class, 'technicianPerformance'])->name('reports-payment.technician-performance');
        Route::get('billing-payment', [ReportsPaymentController::class, 'billingPayment'])->name('reports-payment.billing-payment');
    });

    Route::prefix('employee-management')->group(function () {
        Route::get('list', [EmployeeManagementController::class, 'employeeList'])->name('employee-management.list');
        Route::post('list/store', [EmployeeManagementController::class, 'storeEmployee'])->name('employee.store');
        Route::put('list/update/{id}', [EmployeeManagementController::class, 'updateEmployee'])->name('employee.update');

        Route::get('roles-permissions', [EmployeeManagementController::class, 'rolesPermissions'])->name('employee-management.roles-permissions');
        Route::post('roles-permissions/store', [EmployeeManagementController::class, 'storeRole'])->name('roles-permissions.store');
        Route::put('roles-permissions/update', [EmployeeManagementController::class, 'updateRole'])->name('roles-permissions.update');
    });

    Route::prefix('organization-structure')->group(function () {
        Route::get('regional', [OrganizationStructureController::class, 'regional'])->name('organization-structure.regional');
        Route::post('regional/store', [OrganizationStructureController::class, 'storeRegional'])->name('organization-structure.regional.store');
        Route::get('regional/destroy/{id}', [OrganizationStructureController::class, 'destroyRegional'])->name('organization-structure.regional.destroy');

        Route::get('witel', [OrganizationStructureController::class, 'witel'])->name('organization-structure.witel');
        Route::post('witel/store', [OrganizationStructureController::class, 'storeWitel'])->name('organization-structure.witel.store');
        Route::get('witel/destroy/{id}', [OrganizationStructureController::class, 'destroyWitel'])->name('organization-structure.witel.destroy');

        Route::get('sub-unit', [OrganizationStructureController::class, 'subUnit'])->name('organization-structure.sub-unit');
        Route::post('sub-unit/store', [OrganizationStructureController::class, 'storeSubUnit'])->name('organization-structure.sub-unit.store');
        Route::get('sub-unit/destroy/{id}', [OrganizationStructureController::class, 'destroySubUnit'])->name('organization-structure.sub-unit.destroy');

        Route::get('sub-group', [OrganizationStructureController::class, 'subGroup'])->name('organization-structure.sub-group');
        Route::post('sub-group/store', [OrganizationStructureController::class, 'storeSubGroup'])->name('organization-structure.sub-group.store');
        Route::get('sub-group/destroy/{id}', [OrganizationStructureController::class, 'destroySubGroup'])->name('organization-structure.sub-group.destroy');

        Route::get('mitra', [OrganizationStructureController::class, 'mitra'])->name('organization-structure.mitra');
        Route::post('mitra/store', [OrganizationStructureController::class, 'storeMitra'])->name('organization-structure.mitra.store');
        Route::get('mitra/destroy/{id}', [OrganizationStructureController::class, 'destroyMitra'])->name('organization-structure.mitra.destroy');

        Route::get('service-area', [OrganizationStructureController::class, 'serviceArea'])->name('organization-structure.service-area');
        Route::post('service-area/store', [OrganizationStructureController::class, 'storeServiceArea'])->name('organization-structure.service-area.store');
        Route::get('service-area/destroy/{id}', [OrganizationStructureController::class, 'destroyServiceArea'])->name('organization-structure.service-area.destroy');

        Route::get('team', [OrganizationStructureController::class, 'team'])->name('organization-structure.team');
        Route::post('team/store', [OrganizationStructureController::class, 'storeTeam'])->name('organization-structure.team.store');
        Route::get('team/destroy/{id}', [OrganizationStructureController::class, 'destroyTeam'])->name('organization-structure.team.destroy');
    });

    Route::prefix('reporting-configuration')->group(function () {
        Route::get('status', [ReportingConfigurationController::class, 'status'])->name('reporting-configuration.status');
        Route::post('status/store', [ReportingConfigurationController::class, 'storeStatus'])->name('reporting-configuration.status.store');
        Route::get('status/destroy/{id}', [ReportingConfigurationController::class, 'destroyStatus'])->name('reporting-configuration.status.destroy');

        Route::get('sub-status', [ReportingConfigurationController::class, 'subStatus'])->name('reporting-configuration.sub-status');
        Route::post('sub-status/store', [ReportingConfigurationController::class, 'storeSubStatus'])->name('reporting-configuration.sub-status.store');
        Route::get('sub-status/destroy/{id}', [ReportingConfigurationController::class, 'destroySubStatus'])->name('reporting-configuration.sub-status.destroy');

        Route::get('segments', [ReportingConfigurationController::class, 'segments'])->name('reporting-configuration.segments');
        Route::post('segments/store', [ReportingConfigurationController::class, 'storeSegment'])->name('reporting-configuration.segments.store');
        Route::get('segments/destroy/{id}', [ReportingConfigurationController::class, 'destroySegment'])->name('reporting-configuration.segments.destroy');

        Route::get('actions', [ReportingConfigurationController::class, 'actions'])->name('reporting-configuration.actions');
        Route::post('actions/store', [ReportingConfigurationController::class, 'storeAction'])->name('reporting-configuration.actions.store');
        Route::get('actions/destroy/{id}', [ReportingConfigurationController::class, 'destroyAction'])->name('reporting-configuration.actions.destroy');
    });

    Route::prefix('ajax')->group(function () {
        Route::prefix('employee-management')->group(function () {
            Route::get('list', [AjaxController::class, 'get_employee_list'])->name('ajax.employee-management.list');
            Route::get('list/{id}', [AjaxController::class, 'get_employee_list_by_id'])->name('ajax.employee-management.list.id');

            Route::get('roles-permissions', [AjaxController::class, 'get_employee_roles_permissions'])->name('ajax.employee-management.roles-permissions');
            Route::get('get-witel-by-regional/{regional_id}', [AjaxController::class, 'get_witel_by_regional'])->name('ajax.employee-management.get-witel-by-regional');
            Route::get('get-mitra-by-witel/{witel_id}', [AjaxController::class, 'get_mitra_by_witel'])->name('ajax.employee-management.get-mitra-by-witel');
            Route::get('get-sub-unit-by-regional/{regional_id}', [AjaxController::class, 'get_sub_unit_by_regional'])->name('ajax.employee-management.get-sub-unit-by-regional');
        });

        Route::prefix('organization-structure')->group(function () {
            Route::get('regional', [AjaxController::class, 'get_regional'])->name('ajax.organization-structure.regional');
            Route::get('regional/{id}', [AjaxController::class, 'get_regional_by_id'])->name('ajax.organization-structure.regional.id');

            Route::get('witel', [AjaxController::class, 'get_witel'])->name('ajax.organization-structure.witel');
            Route::get('witel/{id}', [AjaxController::class, 'get_witel_by_id'])->name('ajax.organization-structure.witel.id');

            Route::get('sub-unit', [AjaxController::class, 'get_sub_unit'])->name('ajax.organization-structure.sub-unit');
            Route::get('sub-unit/{id}', [AjaxController::class, 'get_sub_unit_by_id'])->name('ajax.organization-structure.sub-unit.id');

            Route::get('sub-group', [AjaxController::class, 'get_sub_group'])->name('ajax.organization-structure.sub-group');
            Route::get('sub-group/{id}', [AjaxController::class, 'get_sub_group_by_id'])->name('ajax.organization-structure.sub-group.id');

            Route::get('mitra', [AjaxController::class, 'get_mitra'])->name('ajax.organization-structure.mitra');
            Route::get('mitra/{id}', [AjaxController::class, 'get_mitra_by_id'])->name('ajax.organization-structure.mitra.id');

            Route::get('service-area', [AjaxController::class, 'get_service_area'])->name('ajax.organization-structure.service-area');
            Route::get('service-area/{id}', [AjaxController::class, 'get_service_area_by_id'])->name('ajax.organization-structure.service-area.id');

            Route::get('team', [AjaxController::class, 'get_team'])->name('ajax.organization-structure.team');
            Route::get('team/{id}', [AjaxController::class, 'get_team_by_id'])->name('ajax.organization-structure.team.id');
        });

        Route::prefix('reporting-configuration')->group(function () {
            Route::get('status', [AjaxController::class, 'get_order_status'])->name('ajax.reporting-configuration.status');
            Route::get('status/{id}', [AjaxController::class, 'get_order_status_by_id'])->name('ajax.reporting-configuration.status.id');

            Route::get('sub-status', [AjaxController::class, 'get_order_sub_status'])->name('ajax.reporting-configuration.sub-status');
            Route::get('sub-status/{id}', [AjaxController::class, 'get_order_sub_status_by_id'])->name('ajax.reporting-configuration.sub-status.id');

            Route::get('segments', [AjaxController::class, 'get_order_segments'])->name('ajax.reporting-configuration.segments');
            Route::get('segments/{id}', [AjaxController::class, 'get_order_segment_by_id'])->name('ajax.reporting-configuration.segments.id');

            Route::get('actions', [AjaxController::class, 'get_order_actions'])->name('ajax.reporting-configuration.actions');
            Route::get('actions/{id}', [AjaxController::class, 'get_order_action_by_id'])->name('ajax.reporting-configuration.actions.id');
        });

        Route::prefix('order-management')->group(function () {
            Route::prefix('new')->group(function () {
                Route::post('{witel}/{sourcedata}', [AjaxController::class, 'get_new_orders_post'])->name('ajax.order-management.new.post');
                Route::get('{witel}/{sourcedata}/{startdate}/{enddate}', [AjaxController::class, 'get_new_orders'])->name('ajax.order-management.new.get');

                Route::get('details', [AjaxController::class, 'get_new_order_details'])->name('ajax.order-management.new.details');
            });
        });
    });
});
