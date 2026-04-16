<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Database\Factories\CompanyFactory;
use Illuminate\Database\Seeder;

class UserCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a single admin user and their personal company
        $user = User::factory()
            ->withPersonalCompany(function (CompanyFactory $factory) {
                return $factory
                    ->state([
                        'name' => 'ERPSAAS',
                    ])
                    ->withTransactions(250)
                    ->withOfferings()
                    ->withClients()
                    ->withVendors()
                    ->withInvoices(30)
                    ->withRecurringInvoices()
                    ->withEstimates(30)
                    ->withBills(30);
            })
            ->create([
                'name' => 'Admin',
                'email' => 'admin@filament.test',
                'password' => bcrypt('password'),
                'current_company_id' => 1,  // Assuming this will be the ID of the created company
            ]);

        $additionalCompanies = [
            ['name' => 'VexalTrix Analytics', 'country' => 'US', 'currency' => 'USD', 'locale' => 'en'],
            ['name' => 'Cyber Security Tech Solutions', 'country' => 'VN', 'currency' => 'VND', 'locale' => 'vi'],
            ['name' => 'MNC Services', 'country' => 'VN', 'currency' => 'VND', 'locale' => 'vi'],
        ];

        foreach ($additionalCompanies as $companyData) {
            Company::factory()
                ->state([
                    'name' => $companyData['name'],
                    'user_id' => $user->id,
                    'personal_company' => false,
                ])
                ->withCompanyProfile($companyData['country'])
                ->withCompanyDefaults($companyData['currency'], $companyData['locale'])
                ->withTransactions(50)
                ->withOfferings()
                ->withClients()
                ->withVendors()
                ->withInvoices()
                ->withRecurringInvoices()
                ->withEstimates()
                ->withBills()
                ->create();
        }
    }
}
