<?php namespace cteles\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Docente extends Model {

    protected $table='docentes';

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['centrotrabajo_id','user_id','rfc', 'curp','nombre','appaterno','apmaterno','celular','telefono','actualizado'];
    protected $guarded = ['id'];

    protected $hidden = ['created_at','updated_at'];

    public static $rules=[
        'centrotrabajo_id' => 'required',
        'user_id' => 'required',
        'rfc' => 'required|unique:docentes',
        'curp' =>'required|unique:docentes',
        'nombre'=>'required',
        'appaterno'=>'required',
        'apmaterno'=>'required'
    ];
    //******************* Relaciones ******************
    public function user(){
        return $this->belongsTo('cteles\User');

    }
    public function centrotrabajo(){
        return $this->belongsTo('cteles\Models\Centrotrabajo');
    }
    public function aulas(){
        return $this->hasMany('cteles\Models\Aula');


    }


    //*******************Query Scope ************************
    /**
     * @param $query
     * @param $user_id
     * @return Collection(Docente)
     */
    public function scopeAllDocentesForAdmin($query,$user_id){
        return $query->where('user_id','<>',$user_id);
    }




}
