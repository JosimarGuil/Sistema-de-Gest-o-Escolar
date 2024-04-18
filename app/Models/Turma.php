<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Clace;
use App\Models\Sala;
class Turma extends Model
{
    use HasFactory;
    protected $guarded=[];
    public $timestamps=false;

    
    public function clace(){
        return $this->belongsTo(Clace::class);
    }
    public function sala(){
        return $this->belongsTo(Sala::class);
    }

    
}
