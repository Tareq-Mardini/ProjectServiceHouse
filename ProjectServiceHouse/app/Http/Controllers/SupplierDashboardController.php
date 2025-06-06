<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Work;
use App\Models\Transaction;
use Termwind\Components\Raw;
use Illuminate\Support\Facades\DB;

class SupplierDashboardController extends Controller
{
    public function ViewDashboard()
    {
        $supplierId = session('supplier_user_id');
        $stats = [
            ['label' => 'Waiting Orders', 'value' => Order::where('supplier_id', $supplierId)->where('supplier_status', 'waitings')->count(), 'icon' => 'clock', 'color' => 'blue'],
            ['label' => 'Accepted Orders', 'value' => Order::where('supplier_id', $supplierId)->where('supplier_status', 'acceptance')->count(), 'icon' => 'check-circle', 'color' => 'green'],
            ['label' => 'Rejected Orders', 'value' => Order::where('supplier_id', $supplierId)->where('supplier_status', 'rejection')->count(), 'icon' => 'x-circle', 'color' => 'red'],
            ['label' => 'Completed Orders', 'value' => Order::where('supplier_id', $supplierId)->where('supplier_status', 'completed')->count(), 'icon' => 'check-square', 'color' => 'purple'],
            [
                'label' => 'Number Work',
                'value' => Work::where('supplier_id', $supplierId)->count(),
                'color' => 'orange',
                'icon' => 'briefcase',
            ],
        ];

        $earnings = Transaction::where('receiver_id', $supplierId)
            ->where('receiver_role', 'supplier')
            ->where('status', 'The money has been transferred to the supplier')
            ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"), DB::raw("SUM(amount) as total"))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $earningsChartData = [
            'labels' => $earnings->pluck('month'),
            'data' => $earnings->pluck('total'),
        ];

        $earningsYearly = Transaction::where('receiver_id', $supplierId)
            ->where('receiver_role', 'supplier')
            ->where('status', 'The money has been transferred to the supplier')
            ->select(
                DB::raw("YEAR(created_at) as year"),
                DB::raw("SUM(amount) as total")
            )
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        $earningsChartDataYearly = [
            'labels' => $earningsYearly->pluck('year'),
            'data' => $earningsYearly->pluck('total'),
        ];
        return view('Supplier.Home.Dashboard', compact('stats', 'earningsChartData', 'earningsChartDataYearly'));
    }
}
