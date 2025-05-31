<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Supplier;
use App\Models\Order;
use App\Models\Section;
use App\Models\services;
use App\Models\Wallet;
use App\Models\Work;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'Clients' => Client::count(),
            'Suppliers' => Supplier::count(),
            'Orders' => Order::count(),
            'Sections' => Section::count(),
            'Services' => services::count(),
            'Works' => Work::count(),
        ];
        $stats['Total Earnings ($)'] = Wallet::where('user_id', 0)->value('balance');
        $topService = services::select('name')
            ->withCount('works')
            ->orderBy('works_count', 'desc')
            ->first();

        if ($topService) {
            $stats['Top Service'] =  $topService->name;
            $topWork = Work::withCount('orders')->orderBy('orders_count', 'desc')->first();
            $stats['Top Work'] = $topWork = $topWork->title;
        }
        $ordersPerMonth = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->where('order_status', 'approved')
            ->where('supplier_status', 'completed')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $monthlyOrders = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyOrders[] = $ordersPerMonth->get($i, 0);
        }

        $last7Days = collect();
        for ($i = 6; $i >= 0; $i--) {
            $last7Days->push(Carbon::today()->subDays($i)->format('Y-m-d'));
        }
        $ordersPerDay = Order::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('order_status', 'approved')
            ->where('supplier_status', 'completed')
            ->whereBetween('created_at', [Carbon::today()->subDays(6), Carbon::today()])
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date');
        $dailyOrders = [];
        foreach ($last7Days as $day) {
            $dailyOrders[] = $ordersPerDay->get($day, 0);
        }
        $dailyLabels = $last7Days->map(function ($date) {
            return Carbon::parse($date)->format('M d');
        });

        $ordersPerYear = Order::selectRaw('YEAR(created_at) as year, COUNT(*) as count')
            ->where('order_status', 'approved')
            ->where('supplier_status', 'completed')
            ->groupBy('year')
            ->orderBy('year')
            ->pluck('count', 'year');
        $yearlyLabels = $ordersPerYear->keys();
        $yearlyOrders = $ordersPerYear->values();
        return view('admin.dashboard', compact('stats', 'monthlyOrders', 'dailyOrders', 'dailyLabels', 'yearlyLabels', 'yearlyOrders'));
    }
}
