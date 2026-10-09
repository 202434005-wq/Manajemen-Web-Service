<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('books')->insert([
            [
                'title' => 'Clean Code',
                'isbn' => '9780132350884',
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Pragmatic Programmer',
                'isbn' => '9780135957059',
                'available' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
