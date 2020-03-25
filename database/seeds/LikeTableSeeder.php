<?php

use Illuminate\Database\Seeder;
use App\Like;
class LikeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Like::class, 50)->create();
    }
}
