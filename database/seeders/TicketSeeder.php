<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tickets = [
            [
                'name' => 'Tiket Reguler',
                'price' => 35000,
                'description' => 'Tiket standar untuk weekday (Senin - Jumat). Akses semua wahana air, fasilitas locker, area parkir gratis, berlaku seharian.',
                'type' => 'reguler',
                'status' => 'aktif',
            ],
            [
                'name' => 'Tiket Weekend',
                'price' => 45000,
                'description' => 'Tiket spesial untuk weekend (Sabtu - Minggu). Semua fasilitas reguler, akses wahana premium, welcome drink gratis, event & hiburan spesial.',
                'type' => 'paket',
                'status' => 'aktif',
            ],
            [
                'name' => 'Tiket Premium',
                'price' => 75000,
                'description' => 'Pengalaman terbaik dengan layanan VIP. Semua fasilitas premium, private locker VIP, free lunch & snack, priority access semua wahana, photo session gratis.',
                'type' => 'paket',
                'status' => 'aktif',
            ],
        ];

        foreach ($tickets as $ticket) {
            Ticket::create($ticket);
        }
    }
}
