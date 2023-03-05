<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        //$this->call(PostsTableSeeder::class); in UsersTableSeeder
        $this->call(SectionsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
    }
}
