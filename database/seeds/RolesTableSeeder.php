<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Admin', 'Publisher', 'Author'];
        $descriptions = ['Als Admin hat man alle Rechte',
                  'Als Publisher kann man Artikel verfassen und freigeben bzw. prüfen',
                  'Als Author kann man Artikel verfassen'];

        foreach ($roles as $key => $role) {
            DB::table('roles')->insert([
                'name' => $role,
                'description' => $descriptions[$key],
            ]);
        }
    }
}
