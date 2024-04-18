<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Curso;
use App\Models\Siculo;
class Clace extends Model
{
    use HasFactory;
    protected $guarded=[];
    public $timestamps=false;

    public function curso(){
   return $this->belongsTo(Curso::class);
    }

    public function siculo(){
        return $this->belongsTo(Siculo::class);
    }
}
