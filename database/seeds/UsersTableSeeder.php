<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
        	'username' => 'smarthaidian',
        	'name'	   => '智慧海淀',
        	'password' => Hash::make('jjh2019123456*'),
        	'email'	   =>'haidian@shanghai163.com'
        ]);
        
    }
}
