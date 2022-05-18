<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(GeneralSettingSeeder::class);
        $this->call(CountriesSeeders::class);
     
    }
}
