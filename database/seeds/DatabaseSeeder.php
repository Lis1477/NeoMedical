<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')
        ->insert([
            [
                'name' => 'Администратор',
                'login' => 'admin',
                'email' => 'admin@neomedical.by',
                'password' => bcrypt('kd64AL87'),
                'role' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Редактор',
                'login' => 'redactor',
                'email' => 'redactor@neomedical.by',
                'password' => bcrypt('HR32v98'),
                'role' => 'redactor',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Прайс-редактор',
                'login' => 'price_redactor',
                'email' => 'pricered@neomedical.by',
                'password' => bcrypt('50my15QC'),
                'role' => 'price_redactor',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
