<?php

use Illuminate\Database\Seeder;
use App\Friend;
class FriendTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Friend::class, 50)->create();
    }
}
