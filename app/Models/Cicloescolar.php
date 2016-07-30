<?php namespace cteles\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cicloescolar extends Model{
    
	public $table = "cicloescolares";

	use SoftDeletes;
	protected $dates = ['deleted_at'];

	protected $hidden = ['created_at','updated_at'];


	public $fillable = ["ciclo"	];

	public static $rules = [
	    "ciclo" => "required|unique:cicloescolares"
	];

	//******************* Relaciones ******************
	//public function inscripciones(){
	//	return $this->hasMany('cteles\Models\Inscripcion');
	//}
	public function aulas(){
		return $this->hasMany('cteles\Models\Aula');
	}
}
