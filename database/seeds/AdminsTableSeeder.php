<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin;
        $admin->name = 'Super User';
        $admin->email = 'super@admin.com';
      //  $admin->type = 'super';
        $admin->password = Hash::make('test123');
        $admin->save();
    }
}
