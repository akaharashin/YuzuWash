<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'username' => 'cashier',
            'password' => bcrypt('cashier'),
            'name' => 'Cashier Arthur',
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

        Product::create([
            'name' => 'Basic',
            'desc' => 'Membersihkan seluruh bagian mobil menggunakan sampo Meguiars Gold dan peralatan standar profesional.',
            'serv1' => 'Hand Wash',
            'serv2' => 'Interior Cleaning',
            'serv3' => 'Vacuum',
            'price' => 75000,
            'estimate' => 1
        ]);
        Product::create([
            'name' => 'Standard',
            'desc' => 'Paket Basic + membersihkan bercak atau noda berkerak pada permukaan cat dan bagian mesin.',
            'serv1' => 'All in Basic',
            'serv2' => 'Foam Wash',
            'serv3' => 'Engine Cleaning',
            'price' => 125000,
            'estimate' => 2
        ]);
        Product::create([
            'name' => 'Professional',
            'desc' => 'Paket Standard + membersihkan jamur, kerak pada kaca mobil dan noda aspal pada permukaan cat mobil.',
            'serv1' => 'All in Standard',
            'serv2' => 'Spot Remover (Window)',
            'serv3' => 'Tar Remover',
            'price' => 275000,
            'estimate' => 3
        ]);
    }
}
