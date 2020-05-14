<?php

use App\Account;
use App\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transactions')->delete();
        DB::table('accounts')->delete();
        DB::table('clients')->delete();

        factory(Client::class, 5)->create()->each(function (Client $client) {
           $client->accounts()->saveMany(factory(Account::class, rand(1, 3))->make());
        });
    }
}
