<?php namespace cteles\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aula extends Model {

    protected $table='aulas';

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['docente_id'];

    protected $hidden = ['created_at','updated_at'];

    public static $rules = [

            "docente_id" => "required"


    ];
    //******************* Relaciones ******************
    public function docente(){
        return $this->belongsTo('cteles\Models\Docente');
    }
    public function inscripciones(){
        return $this->hasMany('cteles\Models\Inscripcion');
    }
   // public function alumno(){
   //     return $this->belongsTo('cteles\Models\Alumno');
   // }
   // public function cicloescolar(){
   //     return $this->belongsTo('cteles\Models\Cicloescolar');
   // }
    /*public function grupo(){
        return $this->belongsTo('cteles\Models\Grupo');
    }
    public function grado(){
        return $this->belongsTo('cteles\Models\Grado');
    }*/
}
