<?php namespace cteles\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grupo extends Model {

    public $table = "grupos";

    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public $fillable = ["nom_grupo"	];

    protected $hidden = ['created_at','updated_at'];

    public static $rules = [
        "nom_grupo" => "required|unique:grupos"
    ];

    //******************* Relaciones ******************
    //public function aulas(){
    //    return $this->hasMany('cteles\Models\Aula');
    //}
    public function inscripciones(){
        return $this->hasMany('cteles\Models\Inscripcion');
    }
}
