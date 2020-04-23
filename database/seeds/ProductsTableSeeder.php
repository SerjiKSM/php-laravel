<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = 1;
        $total = 30;
        $numProduct = 1;
        $countProduct = 19;
        while ($countProduct > 0) {
            Product::create([
                'product' => 'The Matrix Trilogy ' . $numProduct,
                'total' => $total,
                'date' => Carbon::createFromDate(2015, 02, $date),
                'client_id' => 1,
            ]);

            $countProduct--;
            $numProduct++;
            $total++;
            $date++;
        }

        $date--;
        $countProduct = 10;
        $total = 1200;
        $numProduct = 1;
        while ($countProduct > 0) {
            Product::create([
                'product' => 'Macbook Air ' . $numProduct,
                'total' => $total,
                'date' => Carbon::createFromDate(2015, 02, $date),
                'client_id' => 3,
            ]);

            $countProduct--;
            $numProduct++;
            $total++;
            $date++;
        }

        $date = 1;
        $countProduct = 9;
        while ($countProduct > 0) {
            Product::create([
                'product' => 'Macbook Air ' . $numProduct,
                'total' => $total,
                'date' => Carbon::createFromDate(2015, 03, $date),
                'client_id' => 3,
            ]);

            $countProduct--;
            $numProduct++;
            $total++;
            $date++;
        }

        Product::create([
            'product' => 'Server Rack',
            'total' => 10000,
            'date' => Carbon::createFromDate(2015, 02, 10),
            'client_id' => 2,
        ]);

        Product::create([
            'product' => 'Server Farm',
            'total' => 100000,
            'date' => Carbon::createFromDate(2015, 02, 28),
            'client_id' => 2,
        ]);

        Product::create([
            'product' => 'Watch',
            'total' => 399,
            'date' => Carbon::createFromDate(2015, 03, 9),
            'client_id' => 2,
        ]);

    }
}
