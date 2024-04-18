<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'Esmael',
            'email'=>'esmaiborge@gmail.com',
            'password'=>Hash::make('esmael@borge#123'),
            'fone'=>940114014,
            'sexo'=>'Masculino',
            'status'=>1,
            'perfil'=>'SEO',
        ]);
    }
}
