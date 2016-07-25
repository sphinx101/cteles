<?php namespace cteles\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Centrotrabajo extends Model{
    
	public $table = "centrotrabajos";

	use SoftDeletes;
	protected $dates = ['deleted_at'];

	public $fillable = ["cct","nombre"];

	protected $hidden = ['created_at','updated_at'];

	public static $rules = [
	    "cct" => "required|unique:centrotrabajos"
	];

    //******************* Relaciones ******************
    public function docentes(){
        return $this->hasMany('cteles\Models\Docente');
    }
    public function alumnos(){
        return $this->hasMany('cteles\Models\Alumno');
    }
}
