<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = [
            [
                'name' => 'Tunai',
                'code' => 'cash',
                'description' => 'Pembayaran tunai di tempat',
                'is_active' => true,
            ],
            [
                'name' => 'Midtrans',
                'code' => 'midtrans',
                'description' => 'Pembayaran melalui gateway Midtrans',
                'is_active' => true,
            ],
        ];

        foreach ($paymentMethods as $method) {
            PaymentMethod::create($method);
        }
    }
}
