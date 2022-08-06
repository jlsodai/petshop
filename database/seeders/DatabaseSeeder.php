<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Payment::factory(10)->create();
        Category::factory(10)->create();
        Product::factory(10)->create();

        $order_statuses = ['canceled', 'shipped', 'paid', 'pending', 'open'];

        foreach ($order_statuses as $order_status) {
            OrderStatus::create([
                "title" => $order_status
            ]);
        }

        Order::factory(10)->create();
    }
}
