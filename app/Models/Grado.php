<?php namespace cteles\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grado extends Model {

    public $table = "grados";

    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public $fillable = ["nom_grado"	];

    protected $hidden = ['created_at','updated_at'];

    public static $rules = [
        "nom_grado" => "required|unique:grados"
    ];
    //******************* Relaciones ******************
    public function aulas(){
        return $this->hasMany('cteles\Models\Aula');
    }
   // public function inscripciones(){
   //     return $this->hasMany('cteles\Models\Inscripcion');
   // }
}
