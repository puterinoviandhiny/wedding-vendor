<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $business = Business::create([
            'name' => 'Puteri Wedding',
            'slug' => 'puteri-wedding',
            'business_type' => 'Wedding Vendor',

            'email' => 'hello@puteriwedding.test',
            'phone' => '081234567890',
            'whatsapp' => '081234567890',

            'address' => 'Pontianak, Kalimantan Barat',
            'city' => 'Pontianak',
            'province' => 'Kalimantan Barat',

            'invoice_prefix' => 'INV',

            'invoice_notes' => 'Terima kasih telah mempercayakan wedding Anda kepada kami.',

            'bank_name' => 'BCA',
            'bank_account_name' => 'Puteri Wedding',
            'bank_account_number' => '1234567890',
        ]);

        User::create([
            'name' => 'Owner',
            'email' => 'owner@example.com',
            'password' => Hash::make('password'),
            'business_id' => $business->id,
            'role' => 'owner',
        ]);
    }
}