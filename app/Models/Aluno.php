<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siculo;
use App\Models\Curso;
use App\Models\Clace;
use App\Models\Sala;
use App\Models\Turma;
class Aluno extends Model
{
    use HasFactory;
    protected $guarded=[];
    public $timestamps=false;

    public function clace(){
        return $this->belongsTo(Clace::class);
    }

    public function curso(){
        return $this->belongsTo(Curso::class);
    }

    public function sala(){
        return $this->belongsTo(Sala::class);
    }

    public function turma(){
        return $this->belongsTo(Turma::class);
    }

    public function siculo(){
        return $this->belongsTo(Siculo::class);
    }
}
