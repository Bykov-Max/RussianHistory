<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Element;
use App\Models\Image;
use App\Models\Message;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
         Category::factory(5)->create();
         Element::factory(5)->create();
         Role::factory(3)->create();
         User::factory(5)->create();
         Image::factory(5)->create();
         Message::factory(5)->create();
         Comment::factory(5)->create();
    }
}
