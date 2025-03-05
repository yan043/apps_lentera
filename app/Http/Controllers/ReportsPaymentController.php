<?php

namespace App\Http\Controllers;

use App\Models\ReportsPaymentModel;
use Illuminate\Http\Request;

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
