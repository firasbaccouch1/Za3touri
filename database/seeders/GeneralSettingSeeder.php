<?php

namespace Database\Seeders;

use App\Models\Admin\GeneralSettings;
use Illuminate\Database\Seeder;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GeneralSettings::create([
            'tax'=>19,
            'currency'=>'USD',
            'shipping' => '6'
        ]);
    }
}
