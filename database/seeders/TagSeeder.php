<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            ['name' => 'PHP'],
            ['name' => 'Laravel'],
            ['name' => 'JavaScript'],
			['name' => 'AI'],
			['name' => 'Machine Learning'],
			['name' => 'Python'],
			['name' => 'Java'],
			['name' => 'C#'],
			['name' => 'C++'],
			['name' => 'C'],
			['name' => 'Ruby'],
			['name' => 'Rust'],
			['name' => 'Go'],
			['name' => 'Swift'],
			['name' => 'Kotlin'],
			['name' => 'Dart'],
			['name' => 'Flutter'],
			['name' => 'React'],
			['name' => 'Vue'],
			['name' => 'Angular'],
			['name' => 'Node'],
			['name' => 'Express'],
			['name' => 'Django'],
			['name' => 'Flask'],
			['name' => 'Spring'],
			['name' => 'ASP.NET'],
			['name' => 'Stocks'],
			['name' => 'Cryptocurrency'],
			['name' => 'Blockchain'],
			['name' => 'Web Development'],
			['name' => 'Mobile Development'],
			['name' => 'Game Development'],
			['name' => 'Software Development'],
			['name' => 'Data Science'],
			['name' => 'DevOps'],
			
			//Add more tags if you want Dillon
			//['name' => ''],
        ];

        Tag::insert($tags);
    }
}
