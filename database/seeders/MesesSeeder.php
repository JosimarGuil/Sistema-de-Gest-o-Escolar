<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mese;
class MesesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mese::create([
            'nome'=>'Janeiro',
        ]);
        
        Mese::create([
            'nome'=>'Fevereiro',
        ]);
        Mese::create([
            'nome'=>'Março',
        ]);
        Mese::create([
            'nome'=>'Abril',
        ]);
        Mese::create([
            'nome'=>'Maio',
        ]);
        Mese::create([
            'nome'=>'Junho',
        ]);
        Mese::create([
            'nome'=>'Julho',
        ]);
        Mese::create([
            'nome'=>'Agosto',
        ]);
        Mese::create([
            'nome'=>'Setembro',
        ]);
        Mese::create([
            'nome'=>'Outubro',
        ]);
        Mese::create([
            'nome'=>'Novembro',
        ]);
        Mese::create([
            'nome'=>'Dezenbro',
        ]);
      
    }
}
