<?php

namespace SalimHosen\Core\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use SalimHosen\Core\Models\Contact;
use SalimHosen\Core\Models\Company;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = Company::create([
            "company_id" => 1,
            "name" => "Riadah Incubator",
            "is_active" => true,
            "is_approved" => true,
            "slug" => Str::slug("Riadah Incubator")
        ]);

        Contact::create([
            "name" => $company->name,
            "contact_type" => 0,
            "company_id" => $company->id,
            "email" => "info@riadahin.com",
            "phone" => "+966551175959",
            "country_id" => 1,
            "state_id" => 1,
            "city" => "Riyadh",
            "zip_code" => 1263,
            "address" => "Riadah Incubators corporate factory - Khaldiya Towers - 4th Tower - Faisal Bin Turki Road - Office No. 6 - Floor 13 - Riyadh",
            "is_default_contact" => true,
        ]);

        User::find(1)->companies()->sync([$company->id]);
    }
}
