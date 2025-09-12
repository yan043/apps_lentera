<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeManagementController;
use App\Http\Controllers\InventoryManagementController;
use App\Http\Controllers\OrganizationStructureController;
use App\Http\Controllers\ReportingConfigurationController;
use App\Http\Controllers\ReportsPaymentController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\TechnicianAttendanceController;
use App\Http\Controllers\WorkOrderManagementController;
use Illuminate\Support\Facades\Route;
use Mews\Captcha\Captcha;

Route::get('login', [AuthController::class, 'auth'])->name('login');
Route::post('login', [AuthController::class, 'login'])->middleware('guest')->name('login.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('captcha', [Captcha::class, 'create'])->name('captcha');

Route::middleware(['auth'])->group(function ()
{
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('profile/store', [AuthController::class, 'storeProfile'])->name('profile.store');
    Route::get('profile/deactivate', [AuthController::class, 'deactivateAccount'])->name('profile.deactivate');

    Route::prefix('work-order-management')->middleware('role:Developer,Direktur,OSM,GM_VP_PM,Manager,Officer_1,Assistant_Manager,Officer_2,Head_of_Service_Area,Officer_3,Team_Leader,Kordinator_Lapangan,Staff,Drafter,Helpdesk')->group(function ()
    {
        Route::get('view/{id}', [WorkOrderManagementController::class, 'view'])->name('work-order-management.view');
        Route::put('view/{id}', [WorkOrderManagementController::class, 'viewUpdate'])->name('work-order-management.view.update');

        Route::post('updateOrInsertOrder', [WorkOrderManagementController::class, 'updateOrInsertOrder'])->name('work-order-management.updateOrInsertOrder');

        Route::get('new', [WorkOrderManagementController::class, 'newOrders'])->name('work-order-management.new');
        Route::get('new/details', [WorkOrderManagementController::class, 'newOrderDetails'])->name('work-order-management.new.details');

        Route::get('assigned', [WorkOrderManagementController::class, 'assignedOrders'])->name('work-order-management.assigned');
        Route::get('assigned/details', [WorkOrderManagementController::class, 'assignedOrderDetail'])->name('work-order-management.assigned.detail');

        Route::get('in-progress', [WorkOrderManagementController::class, 'inProgressOrders'])->name('work-order-management.in-progress');
        Route::get('in-progress/details', [WorkOrderManagementController::class, 'inProgressOrderDetail'])->name('work-order-management.in-progress.detail');

        Route::get('completed', [WorkOrderManagementController::class, 'completedOrders'])->name('work-order-management.completed');
        Route::get('completed/details', [WorkOrderManagementController::class, 'completedOrderDetail'])->name('work-order-management.completed.detail');

        Route::get('cancelled', [WorkOrderManagementController::class, 'cancelledOrders'])->name('work-order-management.cancelled');
        Route::get('cancelled/details', [WorkOrderManagementController::class, 'cancelledOrderDetail'])->name('work-order-management.cancelled.detail');
    });

    Route::prefix('support')->middleware('role:Developer,Direktur,OSM,GM_VP_PM,Manager,Officer_1,Assistant_Manager,Officer_2,Head_of_Service_Area,Officer_3,Team_Leader,Kordinator_Lapangan,Staff,Drafter,Helpdesk')->group(function ()
    {
        Route::get('order-tracking', [SupportController::class, 'orderTracking'])->name('support.order-tracking');
        Route::get('helpdesk-monitoring', [SupportController::class, 'helpdeskMonitoring'])->name('support.helpdesk-monitoring');
        Route::get('maps-routing', [SupportController::class, 'mapsRouting'])->name('support.maps-routing');
    });

    Route::prefix('technician-attendance')->middleware('role:Developer,Direktur,OSM,GM_VP_PM,Manager,Officer_1,Assistant_Manager,Officer_2,Head_of_Service_Area,Officer_3,Team_Leader,Kordinator_Lapangan,Staff,Drafter,Helpdesk')->group(function ()
    {
        Route::get('daily-attendance', [TechnicianAttendanceController::class, 'dailyAttendance'])->name('technician-attendance.daily-attendance');
        Route::get('shift-management', [TechnicianAttendanceController::class, 'shiftManagement'])->name('technician-attendance.shift-management');
        Route::get('leave-request', [TechnicianAttendanceController::class, 'leaveRequest'])->name('technician-attendance.leave-request');
        Route::get('attendance-report', [TechnicianAttendanceController::class, 'attendanceReport'])->name('technician-attendance.attendance-report');
        Route::get('late-absence-logs', [TechnicianAttendanceController::class, 'lateAbsenceLogs'])->name('technician-attendance.late-absence-logs');
    });

    Route::prefix('inventory-management')->middleware('role:Developer,Direktur,OSM,GM_VP_PM,Manager,Officer_1,Assistant_Manager,Officer_2,Head_of_Service_Area,Officer_3,Team_Leader,Kordinator_Lapangan,Staff,Drafter,Helpdesk')->group(function ()
    {
        Route::get('stock-overview', [InventoryManagementController::class, 'stockOverview'])->name('inventory-management.stock-overview');
        Route::get('material-request', [InventoryManagementController::class, 'materialRequest'])->name('inventory-management.material-request');
        Route::get('material-inbound', [InventoryManagementController::class, 'materialInbound'])->name('inventory-management.material-inbound');
        Route::get('material-usage', [InventoryManagementController::class, 'materialUsage'])->name('inventory-management.material-usage');
        Route::get('material-return', [InventoryManagementController::class, 'materialReturn'])->name('inventory-management.material-return');
    });

    Route::prefix('reports-payment')->middleware('role:Developer,Direktur,OSM,GM_VP_PM,Manager,Officer_1,Assistant_Manager,Officer_2,Head_of_Service_Area,Officer_3,Team_Leader,Kordinator_Lapangan,Staff,Drafter,Helpdesk')->group(function ()
    {
        Route::get('daily-reports', [ReportsPaymentController::class, 'dailyReports'])->name('reports-payment.daily-reports');
        Route::get('technician-performance', [ReportsPaymentController::class, 'technicianPerformance'])->name('reports-payment.technician-performance');
        Route::get('billing-payment', [ReportsPaymentController::class, 'billingPayment'])->name('reports-payment.billing-payment');
    });

    Route::prefix('employee-management')->middleware('role:Developer,Direktur,OSM,GM_VP_PM,Manager,Officer_1,Assistant_Manager,Officer_2,Head_of_Service_Area,Officer_3,Team_Leader,Kordinator_Lapangan')->group(function ()
    {
        Route::get('list', [EmployeeManagementController::class, 'employeeList'])->name('employee-management.list');
        Route::post('list/store', [EmployeeManagementController::class, 'storeEmployee'])->name('employee.store');
        Route::put('list/update/{id}', [EmployeeManagementController::class, 'updateEmployee'])->name('employee.update');

        Route::get('roles-permissions', [EmployeeManagementController::class, 'rolesPermissions'])->name('employee-management.roles-permissions');
        Route::post('roles-permissions/store', [EmployeeManagementController::class, 'storeRole'])->name('roles-permissions.store');
        Route::put('roles-permissions/update', [EmployeeManagementController::class, 'updateRole'])->name('roles-permissions.update');
    });

    Route::prefix('organization-structure')->middleware('role:Developer,Direktur,OSM,GM_VP_PM,Manager,Officer_1,Assistant_Manager,Officer_2,Head_of_Service_Area,Officer_3,Team_Leader,Kordinator_Lapangan')->group(function ()
    {
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

        Route::get('work-zone', [OrganizationStructureController::class, 'workZone'])->name('organization-structure.work-zone');
        Route::post('work-zone/store', [OrganizationStructureController::class, 'storeworkZone'])->name('organization-structure.work-zone.store');
        Route::get('work-zone/destroy/{id}', [OrganizationStructureController::class, 'destroyworkZone'])->name('organization-structure.work-zone.destroy');

        Route::get('team', [OrganizationStructureController::class, 'team'])->name('organization-structure.team');
        Route::post('team/store', [OrganizationStructureController::class, 'storeTeam'])->name('organization-structure.team.store');
        Route::get('team/destroy/{id}', [OrganizationStructureController::class, 'destroyTeam'])->name('organization-structure.team.destroy');
    });

    Route::prefix('reporting-configuration')->middleware('role:Developer,Direktur,OSM,GM_VP_PM,Manager,Officer_1,Assistant_Manager,Officer_2,Head_of_Service_Area,Officer_3,Team_Leader,Kordinator_Lapangan,Helpdesk')->group(function ()
    {
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

        Route::get('labels', [ReportingConfigurationController::class, 'labels'])->name('reporting-configuration.labels');
        Route::post('labels/store', [ReportingConfigurationController::class, 'storeLabel'])->name('reporting-configuration.labels.store');
        Route::get('labels/destroy/{id}', [ReportingConfigurationController::class, 'destroyLabel'])->name('reporting-configuration.labels.destroy');
    });

    Route::prefix('ajax')->group(function ()
    {
        Route::prefix('work-order-management')->middleware('role:Developer,Direktur,OSM,GM_VP_PM,Manager,Officer_1,Assistant_Manager,Officer_2,Head_of_Service_Area,Officer_3,Team_Leader,Kordinator_Lapangan,Staff,Drafter,Helpdesk')->group(function ()
        {
            Route::get('new/charts', [AjaxController::class, 'get_new_order_charts'])->name('ajax.work-order-management.new.charts');
            Route::get('new/details', [AjaxController::class, 'get_new_order_details'])->name('ajax.work-order-management.new.details');

            Route::get('assigned/details', [AjaxController::class, 'get_assigned_order_details'])->name('ajax.work-order-management.assigned.details');
        });

        Route::prefix('support')->middleware('role:Developer,Direktur,OSM,GM_VP_PM,Manager,Officer_1,Assistant_Manager,Officer_2,Head_of_Service_Area,Officer_3,Team_Leader,Kordinator_Lapangan,Staff,Drafter,Helpdesk')->group(function ()
        {
            Route::get('order-tracking/search/{id}', [AjaxController::class, 'get_search_order'])->name('ajax.support.search');
        });

        Route::prefix('inventory-management')->middleware('role:Developer,Direktur,OSM,GM_VP_PM,Manager,Officer_1,Assistant_Manager,Officer_2,Head_of_Service_Area,Officer_3,Team_Leader,Kordinator_Lapangan,Staff,Drafter,Helpdesk')->group(function ()
        {
            Route::get('designator/materials', [AjaxController::class, 'get_inventory_material'])->name('ajax.inventory-management.designator.materials');
            Route::get('designator/nte/{type}', [AjaxController::class, 'get_inventory_nte'])->name('ajax.inventory-management.designator.nte');
        });

        Route::prefix('employee-management')->middleware('role:Developer,Direktur,OSM,GM_VP_PM,Manager,Officer_1,Assistant_Manager,Officer_2,Head_of_Service_Area,Officer_3,Team_Leader,Kordinator_Lapangan')->group(function ()
        {
            Route::get('list', [AjaxController::class, 'get_employee_list'])->name('ajax.employee-management.list');
            Route::get('list/{id}', [AjaxController::class, 'get_employee_list_by_id'])->name('ajax.employee-management.list.id');

            Route::get('roles-permissions', [AjaxController::class, 'get_employee_roles_permissions'])->name('ajax.employee-management.roles-permissions');
            Route::get('get-witel-by-regional/{regional_id}', [AjaxController::class, 'get_witel_by_regional'])->name('ajax.employee-management.get-witel-by-regional');
            Route::get('get-mitra-by-witel/{witel_id}', [AjaxController::class, 'get_mitra_by_witel'])->name('ajax.employee-management.get-mitra-by-witel');
            Route::get('get-sub-unit-by-regional/{regional_id}', [AjaxController::class, 'get_sub_unit_by_regional'])->name('ajax.employee-management.get-sub-unit-by-regional');
        });

        Route::prefix('organization-structure')->middleware('role:Developer,Direktur,OSM,GM_VP_PM,Manager,Officer_1,Assistant_Manager,Officer_2,Head_of_Service_Area,Officer_3,Team_Leader,Kordinator_Lapangan')->group(function ()
        {
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

            Route::get('work-zone', [AjaxController::class, 'get_work_zone'])->name('ajax.organization-structure.work-zone');
            Route::get('work-zone/{id}', [AjaxController::class, 'get_work_zone_by_id'])->name('ajax.organization-structure.work-zone.id');

            Route::get('team', [AjaxController::class, 'get_team'])->name('ajax.organization-structure.team');
            Route::get('team/{id}', [AjaxController::class, 'get_team_by_id'])->name('ajax.organization-structure.team.id');
        });

        Route::prefix('reporting-configuration')->middleware('role:Developer,Direktur,OSM,GM_VP_PM,Manager,Officer_1,Assistant_Manager,Officer_2,Head_of_Service_Area,Officer_3,Team_Leader,Kordinator_Lapangan,Helpdesk')->group(function ()
        {
            Route::get('status', [AjaxController::class, 'get_order_status'])->name('ajax.reporting-configuration.status');
            Route::get('status/{id}', [AjaxController::class, 'get_order_status_by_id'])->name('ajax.reporting-configuration.status.id');
            Route::get('status/step/{id}', [AjaxController::class, 'get_order_status_by_step'])->name('ajax.reporting-configuration.status.step');

            Route::get('sub-status', [AjaxController::class, 'get_order_sub_status'])->name('ajax.reporting-configuration.sub-status');
            Route::get('sub-status/{id}', [AjaxController::class, 'get_order_sub_status_by_id'])->name('ajax.reporting-configuration.sub-status.id');
            Route::get('sub-status/by-status/{id}', [AjaxController::class, 'get_order_sub_status_by_status_id'])->name('ajax.reporting-configuration.sub-status.by-status');

            Route::get('segments', [AjaxController::class, 'get_order_segments'])->name('ajax.reporting-configuration.segments');
            Route::get('segments/{id}', [AjaxController::class, 'get_order_segment_by_id'])->name('ajax.reporting-configuration.segments.id');

            Route::get('actions', [AjaxController::class, 'get_order_actions'])->name('ajax.reporting-configuration.actions');
            Route::get('actions/by-segment/{id}', [AjaxController::class, 'get_order_action_by_segment_id'])->name('ajax.reporting-configuration.actions.id');

            Route::get('labels', [AjaxController::class, 'get_order_labels'])->name('ajax.reporting-configuration.labels');

            Route::get('photo-list/{sourcedata}/{id}', [AjaxController::class, 'get_photo_list'])->name('ajax.reporting-configuration.photo-list');
        });
    });
});
