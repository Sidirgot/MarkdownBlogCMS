<?php

use App\Category;
use App\Post;;
use App\SocialMedia;
use App\Subscriber;
use App\User;
use Illuminate\Database\Seeder;

class AppTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = $this->createAdministrator();

        factory(Category::class, 4)->create();

        factory(Post::class, 20)->create([
            'author' => $user->id,
            'category_id' => $this->getRandomCategoryID()
        ]);

        factory(Subscriber::class, 20)->create();
    }

    private function getRandomCategoryID()
    {
        $category = Category::inRandomOrder()->first();

        return $category->id;
    }

    private function createAdministrator()
    {
        $user = User::create([
            'name' => 'superadministrator',
            'email' => 'super@app.com',
            'password' => 'password'
        ]);

        return $user;
    }
}
