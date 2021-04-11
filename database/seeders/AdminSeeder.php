<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Admin::create([
        'name' => "Ng. Viet Duc",
        'email' => "admin@gmail.com",
        "password" => bcrypt("123123")
      ]);
    }
}
