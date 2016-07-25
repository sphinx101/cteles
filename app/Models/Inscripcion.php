<?php namespace cteles\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inscripcion extends Model {

    protected $table='Inscripciones';

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable=['alumno_id','aula_id','cicloescolar_id','turno_id','grupo_id','grado_id'];
    protected $guarded=['id'];

    protected $hidden=['created_at','updated_at'];

    public static $rules=[
        'alumno_id'=>'required',
        'aula_id' => 'required',
        'cicloescolar_id'=>'required',
        'turno_id'=> 'required',
        'grupo_id' => 'required',
        'grado_id' => 'required'
    ];

    //************************ Relaciones **************************
    public function alumno(){
        return $this->belongsTo('cteles\Models\Alumno');
    }
    public function aula(){
        return $this->belongsTo('cteles\Models\Aula');
    }
    public function cicloescolar(){
        return $this->belongsTo('cteles\Models\Cicloescolar');
    }
    public function turno(){
        return $this->belongsTo('cteles\Models\Turno');
    }
    public function grupo(){
        return $this->belongsTo('cteles\Models\Grupo');
    }
    public function grado(){
        return $this->belongsTo('cteles\Models\Grado');
    }


}
