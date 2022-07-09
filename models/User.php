<?php
namespace models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $fillable = ['rut','name','lastname','email','email','phone','status','clave','token','rol_id'];

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    public function carritos()
    {
        return $this->hasMany(Carrito::class);
    }
}
