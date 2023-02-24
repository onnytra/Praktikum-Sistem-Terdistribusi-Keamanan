<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class movies extends Model
{
    use HasFactory;
    protected $fillable = ['judul', 'tanggal', 'genre', 'sinopsis','poster','id_live'];
    
    public function live(){
        return $this->belongsTo(live::class, 'id_live');
    }
}
