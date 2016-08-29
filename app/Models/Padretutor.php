<?php namespace cteles\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Padretutor extends Model {

	protected $table='padretutores';
    use SoftDeletes;
    protected $dates=['deleted_at'];

    protected $fillable=[
        'alumno_id',
        'nombre',
        'appaterno',
        'apmaterno',
        'telefono',
        'celular',
        'parentesco',
        'domicilio',
        'localidad',
        'ocupacion',
        'escolaridad'
    ];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

    public static $rules=[
        'alumno_id'=>'required',
        'nombre'=>'required',
        'appaterno'=>'required',
        'apmaterno'=>'required',
        'telefono'=>'required',
        'parentesco'=>'required',
        'domicilio'=>'required',
        'localidad'=>'required'
    ];


    //***************************  Relaciones **************************
    public function alumnos(){
        return $this->belongsToMany('cteles\Models\Alumno')->withTimestamps();
    }



}
