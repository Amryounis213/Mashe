<?php

namespace Database\Seeders;

use App\Models\Market;
use App\Models\Menu;
use App\Models\Restaurant;
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
        // \App\Models\Vendor::factory(10000)->create();
        // \App\Models\Restaurant::factory(10000)->create();
        // $this->call([
        //     UserSeeder::class
        // ]);

        $menu = new Menu();
        $menu->parentable_id =1;
        $menu->parentable_type = Market::class ;
        $menu->save();



        
    }
}
