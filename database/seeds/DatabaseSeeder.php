<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Eloquent::unguard();

        Model::unguard();
        $this->call('BooksTableSeeder');
        $this->call('ArticlesTableSeeder');
        //$this->call('CommentsTableSeeder');
        $this->call('Users2TableSeeder');
        $this->call('UsersTableSeeder');
        Model::reguard();
    }
}

class UsersTableSeeder extends Seeder {

    public function run() {

        //$faker = Faker\Factory::create();//'fr_FR'//nl_NL//ja_JP
        for ($i=0; $i < 10; $i++) { 
            App\User::create([
                'email' => "user$i@user.com",
                'username' => "alex$i",
                'password' => bcrypt('111111'),
                'active' => 1
            ]);
        }
    }
}

class Users2TableSeeder extends Seeder {

    public function run() {

        $faker = Faker\Factory::create();//'fr_FR'//nl_NL//ja_JP
        for ($i=0; $i < 10; $i++) { 
            App\User2::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'address' => $faker->address,
                'email' => $faker->email
            ]);
        }
    }
}

class CommentsTableSeeder extends Seeder{

    public function run() {

        for($i = 0; $i < 4; $i++) {
            App\Comment::create([
                'body' => 'This is comment '.$i,
                'article_id' => 4
            ]);
        }
        for($i = 4; $i < 6; $i++) {
            App\Comment::create([
                'body' => 'This is comment '.$i,
                'article_id' => 5
            ]);
        }
    }
}

class ArticlesTableSeeder extends Seeder{

    public function run(){
        App\Article::create([
            'title' => 'How to ride a bike',
            'body' => '...'
        ]);
        App\Article::create([
            'title' => 'Potetos peeling 4 beginers',
            'body' => '...'
        ]);
    }
}

class BooksTableSeeder extends Seeder {

    public function run() {

        for($i = 0; $i < 100; $i++) {
            DB::table('books')->insert
            ([
                'title' => 'This is book '.$i,
                'author' => 'Author '.$i
            ]);
        }

    }
}