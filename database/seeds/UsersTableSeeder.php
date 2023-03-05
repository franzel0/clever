<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $firstnames = ['Frank', 'Peter', 'Sabine', 'Lara', 'Britta', 'John'];
        $lastnames = ['Fischer', 'Müller', 'Schmitz', 'Heimlich', 'Bold', 'Doe'];
        $tags = ['Chirurgie', 'Arbeit', 'KIS', 'Technik', 'IT', 'Abrechnung', 'Anträge'];

        foreach ($firstnames as $key => $firstname) {
            $user = App\User::create([
                'name' => substr($firstname,0,1).'.'.$lastnames[$key],
                'firstname' => $firstname,
                'lastname' => $lastnames[$key],
                'email' => substr($firstname, 0, 1).'.'.$lastnames[$key].'@clever.com',
                'password' => bcrypt('secret'),
                'active' => 1,
                'section_id' => rand(1,3),
                'phone' => rand(1000, 9999),
                'role_id' => 1,
            ]);

            $user->posts()->saveMany(factory(App\Post::class, 10)->make([
                'section_id' => $user->section_id,
            ]));
        }

        foreach ($tags as $key => $tag) {
            App\Tag::create([
                'name' => $tag,
            ]);
        }

        $tags_ids = \App\Tag::all()->pluck('id')->toArray();
        foreach (App\Post::all() as $key => $post) {
            shuffle($tags_ids);
            $post->tags()->attach([$tags_ids[1], $tags_ids[2], $tags_ids[3]]);
        }
    }
}
