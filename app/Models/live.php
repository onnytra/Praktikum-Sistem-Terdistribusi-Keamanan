<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class live extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_live';
    protected $fillable = ['nama', 'deskripsi', 'lokasi','poster'];

    public function movies(){
        return $this->hasMany(movies::class, 'id_live');
    }
}
