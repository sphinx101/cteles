<?php namespace cteles\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parentesco extends Model {

	protected $table='parentescos';

    use SoftDeletes;
    protected $dates=['deleted_at'];

    protected $fillable=['tipo'];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

    public static $rules=['tipo'=>'required'];


    /************************************ R e l a c i o n e s **********************************/
    public function alumnos(){
        return $this->belongsToMany('cteles\Models\Alumno','alumno_padretutor')->withTimestamps()->withPivot('padretutor_id');
    }
    public function padretutores(){
        return $this->belongsToMany('cteles\Models\Padretutor','alumno_padretutor')->withTimestamps()->withPivot('alumno_id');
    }



}
