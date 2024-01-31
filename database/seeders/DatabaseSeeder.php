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
        // \App\Models\User::factory(25)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

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
            'role' => 'cashier',
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
        Order::create([
            'product_id' => 1,
            'custName' => 'Tony Stark',
            'contact' => '+44-2829',
            'status' => 'list',
        ]);
        Order::create([
            'product_id' => 1,
            'custName' => 'Tony Stark',
            'contact' => '+44-2829',
            'status' => 'list',
        ]);
        Order::create([
            'product_id' => 1,
            'custName' => 'Tony Stark',
            'contact' => '+44-2829',
            'status' => 'list',
        ]);
        Order::create([
            'product_id' => 1,
            'custName' => 'Tony Stark',
            'contact' => '+44-2829',
            'status' => 'list',
        ]);
        Order::create([
            'product_id' => 1,
            'custName' => 'Tony Stark',
            'contact' => '+44-2829',
            'status' => 'list',
        ]);
        Order::create([
            'product_id' => 1,
            'custName' => 'Tony Stark',
            'contact' => '+44-2829',
            'status' => 'list',
        ]);
        Order::create([
            'product_id' => 1,
            'custName' => 'Tony Stark',
            'contact' => '+44-2829',
            'status' => 'list',
        ]);
        Order::create([
            'product_id' => 1,
            'custName' => 'Tony Stark',
            'contact' => '+44-2829',
            'status' => 'list',
        ]);
        Order::create([
            'product_id' => 1,
            'custName' => 'Tony Stark',
            'contact' => '+44-2829',
            'status' => 'list',
        ]);

        Transaction::create([
            'order_id' => 1,
            'uniqcode' => 'INV-0p01k1',
            'cash' => 300000,
            'change' => 25000,
        ]);
        Transaction::create([
            'order_id' => 2,
            'uniqcode' => 'INV-0p01k12',
            'cash' => 300000,
            'change' => 25000,
        ]);
        Transaction::create([
            'order_id' => 3,
            'uniqcode' => 'INV-0p01k13',
            'cash' => 300000,
            'change' => 25000,
        ]);

        Transaction::create([
            'order_id' => 3,
            'uniqcode' => 'INV-0p01k14',
            'cash' => 300000,
            'change' => 25000,
        ]);

        Transaction::create([
            'order_id' => 5,
            'uniqcode' => 'INV-0p01k15',
            'cash' => 300000,
            'change' => 25000,
        ]);

        Transaction::create([
            'order_id' => 6,
            'uniqcode' => 'INV-0p01k16',
            'cash' => 300000,
            'change' => 25000,
        ]);

        Transaction::create([
            'order_id' => 7,
            'uniqcode' => 'INV-0p01k17',
            'cash' => 300000,
            'change' => 25000,
        ]);

        Transaction::create([
            'order_id' => 8,
            'uniqcode' => 'INV-0p01k18',
            'cash' => 300000,
            'change' => 25000,
        ]);

        Transaction::create([
            'order_id' => 9,
            'uniqcode' => 'INV-0p01k19',
            'cash' => 300000,
            'change' => 25000,
        ]);
    }
}
