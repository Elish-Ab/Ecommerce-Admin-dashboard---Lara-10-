<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Hash;

class AdminTableSeeder extends Seeder
{
    
    public function run(): void
    {
        $password = Hash::make('12345678');
        $adminRecords = [
            ['id'=>1, 'name'=>'Admin', 'type'=>'admin', 'mobile'=>'987654321', 'email'=> 'admin@gmail.com', 'password'=>$password, 'image'=> '', 'status'=>1]
        ];
        Admin::insert($adminRecords);
    }
}
