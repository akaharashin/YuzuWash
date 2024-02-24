<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Order;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'username' => 'cashier',
            'password' => bcrypt('cashier'),
            'name' => 'Kasir Arthur',
            'role' => 'cashier',
        ]);
        User::create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'name' => 'Admin Pedro',
            'role' => 'admin',
        ]);
        User::create([
            'username' => 'owner',
            'password' => bcrypt('owner'),
            'name' => 'Owner Peter',
            'role' => 'owner',
        ]);
        User::create([
            'username' => 'user',
            'password' => bcrypt('user'),
            'name' => 'Pengguna',
            'role' => 'customer',
        ]);

        Product::create([
            'name' => 'Basic',
            'desc' => 'Membersihkan seluruh bagian mobil menggunakan sampo Meguiars Gold dan peralatan standar profesional.',
            'services' => 'Hand Wash, Interor Cleaning, Vacuum',
            'price' => 75000,
            'estimate' => 1
        ]);
        Product::create([
            'name' => 'Standard',
            'desc' => 'Paket Basic + membersihkan bercak atau noda berkerak pada permukaan cat dan bagian mesin.',
            'services' => 'All in Basic, Foam Wash, Engine Cleaning',
            'price' => 125000,
            'estimate' => 2
        ]);
        Product::create([
            'name' => 'Professional',
            'desc' => 'Paket Standard + membersihkan jamur, kerak pada kaca mobil dan noda aspal pada permukaan cat mobil.',
            'services' => 'All in Standard, Spot Remover, Tar Remover',
            'price' => 275000,
            'estimate' => 3
        ]);

        Order::factory(16)->create();
        Transaction::factory(30)->create();
       
    }
}
