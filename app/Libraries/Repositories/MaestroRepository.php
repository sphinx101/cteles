<?php

namespace App\Libraries\Repositories;


use App\Models\Maestro;

use Illuminate\Support\Facades\Schema;

class MaestroRepository
{

	/**
	 * Returns all Maestros
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function all()
	{
		return Maestro::all();
	}


	public function search($input)
    {
        $query = Maestro::query();

        $columns = Schema::getColumnListing('maestros');
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
	 * Stores Maestro into database
	 *
	 * @param array $input
	 *
	 * @return Maestro
	 */
	public function store($input)
	{
		return Maestro::create($input);
	}

	/**
	 * Find Maestro by given id
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Support\Collection|null|static|Maestro
	 */
	public function findMaestroById($id)
	{
		return Maestro::find($id);

	}

	/**
	 * Updates Maestro into database
	 *
	 * @param Maestro $maestro
	 * @param array $input
	 *
	 * @return Maestro
	 */
	public function update($maestro, $input)
	{
		$maestro->fill($input);
		$maestro->save();

		return $maestro;
	}
}