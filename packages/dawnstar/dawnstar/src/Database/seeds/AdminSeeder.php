<?php
namespace Dawnstar\Database\seeds;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database Seeds.
     *
     * @return void
     */
    public function run()
    {
        \Dawnstar\Models\Admin::create([
            'name' => "Valtheim",
            'email' => "valtheim@gmail.com",
            "password" => \Illuminate\Support\Facades\Hash::make(123123)
        ]);
        \Dawnstar\Models\User::create([
            'name' => "Alperen Keşkekoğlu",
            'credit' => 10,
            'email' => "keskekoglualperen@gmail.com",
            "password" => \Illuminate\Support\Facades\Hash::make(123123)
        ]);
    }
}
