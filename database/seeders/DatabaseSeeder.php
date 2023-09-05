<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;  ////has to include the model you want to use
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      Article::factory()->count(20)->create();
      Comment::factory()->count(40)->create();

    //   Category::factory()->create([
    //     "name" => "News"
    //   ]);
    //   Category::factory()->create([
    //     "name" => "Health"
    //   ]);
    //   Category::factory()->create([
    //     "name" => "Crime"
    //   ]);
    //   Category::factory()->create([
    //     "name" => "Tech"
    //   ]);
    //   Category::factory()->create([
    //     "name" => "Politics"
    //   ]);

      $list = ['News', 'Health', 'Crime', 'Tech', 'Politics'];
      foreach($list as $name) {
            Category::factory()->create(['name' => $name ]);
        };


      User::factory()->create([
        "name" => "Alice",
        "email" => "alice@gmail.com",
      ]);
      User::factory()->create([
        "name" => "Bob",
        "email" => "bob@gmail.com",
      ]);
    }
}
