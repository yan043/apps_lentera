<?php

namespace App\Http\Controllers;

use App\Models\ReportsPaymentModel;

class ReportsPaymentController extends Controller
{
    public function dailyReports()
    {
        $start_date = request()->input('start_date') ?? date('Y-m-01');
        $end_date   = request()->input('end_date') ?? date('Y-m-d');

        return view('reports-payment.daily-reports', ['start_date' => $start_date, 'end_date' => $end_date]);
    }

    public function technicianPerformance()
    {
        return view('reports-payment.technician-performance');
    }

    public function billingPayment()
    {
        return view('reports-payment.billing-payment');
    }
}
