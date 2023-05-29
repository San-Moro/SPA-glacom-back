<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i<10; $i++) {
            $article = new Article();
            $article->title = $faker->sentence(8);
            $article->description = $faker->text(600);
            $article->slug = Str::slug($article->title, '-');
            $article->save();
        }
    }
}
