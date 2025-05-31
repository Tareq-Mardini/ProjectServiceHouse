<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        $descriptions = ['Logo Design', 'Translation', 'Web Development', 'SEO Optimization'];
        $statuses = ['approved', 'waitings'];
        $payment_statuses = ['paid_to_system', 'released_to_supplier'];
        $supplier_statuses = ['acceptance', 'waitings', 'completed', 'rejection'];

        $now = Carbon::now();

        for ($i = 1; $i <= 40; $i++) {
            DB::table('orders')->insert([
                'work_id' => rand(1, 4),
                'client_id' => rand(1, 5),
                'supplier_id' => rand(1, 8),
                'price' => rand(50, 300),
                'order_description' => $descriptions[array_rand($descriptions)],
                'selected_offers' => rand(1, 5),
                'order_status' => $statuses[array_rand($statuses)],
                'payment_status' => $payment_statuses[array_rand($payment_statuses)],
                'supplier_status' => $supplier_statuses[array_rand($supplier_statuses)],
                'created_at' => $now->copy()->subMonths(rand(0, 5))->subDays(rand(0, 28))->format('Y-m-d H:i:s'),
                'updated_at' => $now->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
