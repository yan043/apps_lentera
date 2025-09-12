<?php

namespace App\Http\Controllers;

class ReportsPaymentController extends Controller
{
    public function dailyReports()
    {
        return view('reports-payment.daily-reports');
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
