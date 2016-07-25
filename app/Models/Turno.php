<?php namespace cteles\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Turno extends Model {

    public $table = "turnos";

    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public $fillable = ["nom_turno"	];

    protected $hidden = ['created_at','updated_at'];

    public static $rules = [
        "nom_turno" => "required|unique:turnos"
    ];
    //******************* Relaciones ******************
   // public function aulas(){
   //     return $this->hasMany('cteles\Models\Aula');
   // }
    public function inscripciones(){
        return $this->hasMany('cteles\Models\Inscripcion');
    }
}
