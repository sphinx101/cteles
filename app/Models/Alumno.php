<?php namespace cteles\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alumno extends Model{
    
	protected $table = "alumnos";

	use SoftDeletes;
	protected $dates=['deleted_at'];

	protected $fillable = [
	    'centrotrabajo_id',
		'curp',
		'nombre',
		'appaterno',
		'apmaterno',
		'localidad',
		'domicilio'
	];
	protected $guarded=['id'];
	protected $hidden=['created_at','updated_at'];

	public static $rules = [
	    'centrotrabajo_id' => 'required',
		'curp' => 'required|unique:alumnos|min:18|max:18',
		'nombre' => 'required',
		'appaterno' => 'required',
		'apmaterno' => 'required',
		'localidad' => 'required',
		'domicilio' => 'required'
	];


	/********************* Relaciones *****************************/
	public function centrotrabajo(){
		 return $this->belongsTo('cteles\Models\Centrotrabajo');
	}
	public function padretutores(){
		return $this->belongsToMany('cteles\Models\Padretutor')->withTimestamps();
	}

}
