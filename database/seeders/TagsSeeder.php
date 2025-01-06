<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Tag;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Knitting']);
        Category::create(['name' => 'Crochet']);
        Category::create(['name' => 'Sewing']);
        Category::create(['name' => 'Embroidery']);
        Category::create(['name' => 'Weaving']);
        Category::create(['name' => 'Felting']);

        $tags = [
            'Beginner',
            'Intermediate',
            'Advanced',
            'Easy',
            'Quick',
            'Amigurumi',
            'Gift Ideas',
            'Home Decor',
            'Wearables',
            'Holiday Projects',
            'Christmas',
            'Halloween',
            'Sc-Fi',
            'Fantasy',
            'Storage Items',
            'Bags',
            'Accessories',
            'Cowls & Scarves',
            'Hats',
            'Toys',
            'Fiber Arts',
        ];

        foreach ($tags as $tagName) {
            Tag::create(['name' => $tagName]);
        }
    }
}
