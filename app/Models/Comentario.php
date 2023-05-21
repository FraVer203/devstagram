<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    // Aquí se está guardando el comentario de la publicación
    protected $fillable = [
        'user_id',
        'post_id',
        'comentario'
    ];

    // Aquí vamos a estar trayendo el nombre de usuario que comentó:

    public function user(){
        return $this->belongsTo(User::class);
    }
}

