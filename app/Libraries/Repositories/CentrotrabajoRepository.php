<?php

namespace App\Libraries\Repositories;


use App\Models\Centrotrabajo;
use Illuminate\Support\Facades\Schema;

class CentrotrabajoRepository
{

	/**
	 * Returns all Centrotrabajos
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function all()
	{
		return Centrotrabajo::all();
	}

	public function search($input)
    {
        $query = Centrotrabajo::query();

        $columns = Schema::getColumnListing('centrotrabajos');
        $attributes = array();

        foreach($columns as $attribute){
            if(isset($input[$attribute]))
            {
                $query->where($attribute, $input[$attribute]);
                $attributes[$attribute] =  $input[$attribute];
            }else{
                $attributes[$attribute] =  null;
            }
        };

        return [$query->get(), $attributes];

    }

	/**
	 * Stores Centrotrabajo into database
	 *
	 * @param array $input
	 *
	 * @return Centrotrabajo
	 */
	public function store($input)
	{
		return Centrotrabajo::create($input);
	}

	/**
	 * Find Centrotrabajo by given id
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Support\Collection|null|static|Centrotrabajo
	 */
	public function findCentrotrabajoById($id)
	{
		return Centrotrabajo::find($id);
	}

	/**
	 * Updates Centrotrabajo into database
	 *
	 * @param Centrotrabajo $centrotrabajo
	 * @param array $input
	 *
	 * @return Centrotrabajo
	 */
	public function update($centrotrabajo, $input)
	{
		$centrotrabajo->fill($input);
		$centrotrabajo->save();

		return $centrotrabajo;
	}
}