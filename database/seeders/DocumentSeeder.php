<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Document;

class DocumentSeeder extends Seeder
{
    public function run(): void
    {
        $documents = [
            ['name' => 'Aadhar', 'price' => 2],
            ['name' => 'PAN', 'price' => 5],
            ['name' => 'GST', 'price' => 3],
            ['name' => 'Passport', 'price' => 4],
            ['name' => 'Driving License', 'price' => 3],
        ];

        foreach ($documents as $doc) {
            Document::create($doc);
        }
    }
}
