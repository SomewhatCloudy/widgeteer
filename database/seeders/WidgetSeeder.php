<?php

namespace Database\Seeders;

use App\Models\Widget;
use Illuminate\Database\Seeder;

class WidgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = [
            250,
            500,
            1000,
            2000,
            5000
        ];

        foreach ($sizes as $size)
        {
            $widget = new Widget();
            $widget->quantity = $size;
            $widget->save();
        }
    }
}
