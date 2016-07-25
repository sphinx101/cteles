<?php namespace cteles\Models;

use Illuminate\Database\Eloquent\Model;

class Maestro extends Model
{
    
	public $table = "maestros";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public $fillable = [
	    "nombre",
		"rfc"
	];

	public static $rules = [
	    "rfc" => "requires|unique:maestros"
	];

}
