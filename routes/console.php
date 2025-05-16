<?php

// use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\TlkmLeakController;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote');

Artisan::command('bima:get-workorder-list-date {witel}', function ($witel) {
    \App\Http\Controllers\TlkmLeakController::bima_get_workorder_list_date($witel);
});

Artisan::command('insera:login {username} {password}', function ($username, $password) {
    \App\Http\Controllers\TlkmLeakController::insera_login($username, $password);
});

Artisan::command('insera:refresh', function () {
    \App\Http\Controllers\TlkmLeakController::insera_refresh();
});

Artisan::command('insera:all-ticket-list', function () {
    \App\Http\Controllers\TlkmLeakController::insera_all_ticket_list();
});

Artisan::command('insera:ticket-list {witel}', function ($witel) {
    \App\Http\Controllers\TlkmLeakController::insera_ticket_list($witel);
});

Artisan::command('scone:login {username} {password} {chatid}', function ($username, $password, $chatid) {
    \App\Http\Controllers\TlkmLeakController::scone_login($username, $password, $chatid);
});

Artisan::command('scone:logout', function () {
    \App\Http\Controllers\TlkmLeakController::scone_logout();
});

Artisan::command('scone:refresh', function () {
    \App\Http\Controllers\TlkmLeakController::scone_refresh();
});

Artisan::command('scone:order-weekly {witel}', function ($witel) {
    \App\Http\Controllers\TlkmLeakController::scone_order_weekly($witel);
});
