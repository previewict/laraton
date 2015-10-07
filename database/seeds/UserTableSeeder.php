<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\laraton\User::class)->create(array(
            'name' => 'previewICT',
            'email' => 'info@miteksoftware.com',
            'password' => bcrypt('ltqpsmr7')
        ));
    }
}
