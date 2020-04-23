<?php

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = ['Acme', 'Apple', 'Microsoft'];
        foreach ($clients as $client) {
            Client::create([
                'client' => $client,
            ]);
        }
    }
}
