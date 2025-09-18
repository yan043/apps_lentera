<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('telegram:updateWebhookLenteraBot', function ()
{
    \App\Http\Controllers\TelegramController::updateWebhookLenteraBot();
});

Artisan::command('telegram:lenteraBot', function ()
{
    \App\Http\Controllers\TelegramController::lenteraBot();
});

Artisan::command('bima:all-workorder-list', function ()
{
    \App\Http\Controllers\TlkmLeakController::bima_all_workorder_list();
});

Artisan::command('bima:get-workorder-list-date {witel}', function ($witel)
{
    \App\Http\Controllers\TlkmLeakController::bima_get_workorder_list_date($witel);
});

Artisan::command('bima:find-workorder {id}', function ($id)
{
    \App\Http\Controllers\TlkmLeakController::bima_find_workorder($id);
});

Artisan::command('insera:all-ticket-list', function ()
{
    \App\Http\Controllers\TlkmLeakController::insera_all_ticket_list();
});

Artisan::command('insera:ticket-list {witel}', function ($witel)
{
    \App\Http\Controllers\TlkmLeakController::insera_ticket_list($witel);
});

Artisan::command('utonline:all-list-order', function ()
{
    \App\Http\Controllers\TlkmLeakController::utonline_all_list_order();
});

Artisan::command('utonline:list-order {ref_code} {witel} {date}', function ($ref_code, $witel, $date)
{
    \App\Http\Controllers\TlkmLeakController::utonline_list_order($ref_code, $witel, $date);
});

Artisan::command('utonline:load-keterangan-semua-foto {id}', function ($id)
{
    \App\Http\Controllers\TlkmLeakController::utonline_load_keterangan_semua_foto($id);
});

Artisan::command('utonline:reports-not-valid', function ()
{
    \App\Http\Controllers\TlkmLeakController::utonline_reports_not_valid();
});

Artisan::command('scone:login {username} {password} {chatid}', function ($username, $password, $chatid)
{
    \App\Http\Controllers\TlkmLeakController::scone_login($username, $password, $chatid);
});

Artisan::command('scone:logout', function ()
{
    \App\Http\Controllers\TlkmLeakController::scone_logout();
});

Artisan::command('scone:refresh', function ()
{
    \App\Http\Controllers\TlkmLeakController::scone_refresh();
});

Artisan::command('scone:order-weekly {witel}', function ($witel)
{
    \App\Http\Controllers\TlkmLeakController::scone_order_weekly($witel);
});

Artisan::command('newscmt:location-id {type} {parent}', function ($type, $parent)
{
    \App\Http\Controllers\ApiController::newscmt_location_id($type, $parent);
});

Artisan::command('newscmt:detail-location-id {type} {parent}', function ($type, $parent)
{
    \App\Http\Controllers\ApiController::newscmt_detail_location_id($type, $parent);
});
