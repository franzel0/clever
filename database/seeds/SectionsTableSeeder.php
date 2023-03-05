<?php

use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = ['Chirurgie', 'Pflege', 'Haustechnik'];

        foreach ($sections as $key => $section) {
            DB::table('sections')->insert([
                'name' => $section,
            ]);
        }
    }
}
