<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            'Entwurf',
            'Wiedervorlage',
            'Zum Prüfer schicken',
            'Freigegeben'
        ];

        $descriptions = [
            'Der Artikel liegt als Entwurf vor.',
            'Der Artikel wurde wieder vorgelegt bzw. zurückgeschickt',
            'Der Artikel wurde an den Prüfer / Publisher geschickt',
            'Der Artikel ist freigegebn.'
        ];

        foreach ($statuses as $key => $status) {
            DB::table('statuses')->insert([
                'name' => $status,
                'description' => $descriptions[$key],
            ]);
        }
    }
}
