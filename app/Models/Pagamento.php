<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mese;
use App\Models\TipoPagamento;
use App\Models\Aluno;
use App\Models\Funcionario;
class Pagamento extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function aluno(){
        return $this->belongsTo(Aluno::class);
    }

    public function meses(){

        return $this->belongsToMany(Mese::class);
    }


    public function tipo_pagamento(){
        return $this->belongsTo(TipoPagamento::class);
    }
  
      public function funcionario(){
           
          return $this->belongsTo(Funcionario::class);
       }
}
