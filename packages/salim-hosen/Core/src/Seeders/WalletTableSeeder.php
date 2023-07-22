<?php

namespace SalimHosen\Core\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use SalimHosen\Ecommerce\Models\Wallet;

class WalletTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Wallet::create([
            "uuid" => Str::uuid(),
            "company_id" => env("ADMIN_COMPANY_ID", 1),
            "balance" => 0,
            "is_active" => true
        ]);

    }
}
