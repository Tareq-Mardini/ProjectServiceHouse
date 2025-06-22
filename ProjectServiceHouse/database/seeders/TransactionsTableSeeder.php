<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TransactionsTableSeeder extends Seeder
{
    public function run()
    {
        $statuses = [
            'The money has been transferred to the supplier',
            'Pending',
            'Failed',
            'Processing',
        ];

        $receiverRoles = ['client', 'supplier', 'System'];

        $now = Carbon::now();

        for ($i = 1; $i <= 40; $i++) {
            DB::table('transactions')->insert([
                'order_id' => rand(1,40),
                'sender_id' => rand(1, 2),
                'receiver_id' => rand(1,2),
                'receiver_role' => $receiverRoles[array_rand($receiverRoles)],
                'status' => $statuses[array_rand($statuses)],
                'amount' => rand(10, 1000) + (rand(0, 99)/100),
                'created_at' => $now->copy()->subMonths(rand(0, 5))->subDays(rand(0, 28))->format('Y-m-d H:i:s'),
                'updated_at' => $now->format('Y-m-d H:i:s'),
            ]);
        }
    }
}

