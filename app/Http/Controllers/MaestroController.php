<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateMaestroRequest;
use Illuminate\Http\Request;
use App\Libraries\Repositories\MaestroRepository;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;

class MaestroController extends AppBaseController
{

	/** @var  MaestroRepository */
	private $maestroRepository;

	function __construct(MaestroRepository $maestroRepo)
	{
		$this->maestroRepository = $maestroRepo;
	}

	/**
	 * Display a listing of the Maestro.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
	    $input = $request->all();

		$result = $this->maestroRepository->search($input);

		$maestros = $result[0];

		$attributes = $result[1];

		return view('maestros.index')
		    ->with('maestros', $maestros)
		    ->with('attributes', $attributes);
	}

	/**
	 * Show the form for creating a new Maestro.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('maestros.index');
	}

	/**
	 * Store a newly created Maestro in storage.
	 *
	 * @param CreateMaestroRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateMaestroRequest $request)
	{
        $input = $request->all();

		$maestro = $this->maestroRepository->store($input);

		Flash::message('Maestro saved successfully.');

		return redirect(route('maestros.index'));
	}

	/**
	 * Display the specified Maestro.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$maestro = $this->maestroRepository->findMaestroById($id);

		if(empty($maestro))
		{
			Flash::error('Maestro not found');
			return redirect(route('maestros.index'));
		}

		return view('maestros.show')->with('maestro', $maestro);
	}

	/**
	 * Show the form for editing the specified Maestro.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$maestro = $this->maestroRepository->findMaestroById($id);

		if(empty($maestro))
		{
			Flash::error('Maestro not found');
			return redirect(route('maestros.index'));
		}

		return view('maestros.edit')->with('maestro', $maestro);
	}

	/**
	 * Update the specified Maestro in storage.
	 *
	 * @param  int    $id
	 * @param CreateMaestroRequest $request
	 *
	 * @return Response
	 */
	public function update($id, CreateMaestroRequest $request)
	{
		$maestro = $this->maestroRepository->findMaestroById($id);

		if(empty($maestro))
		{
			Flash::error('Maestro not found');
			return redirect(route('maestros.index'));
		}

		$maestro = $this->maestroRepository->update($maestro, $request->all());

		Flash::message('Maestro updated successfully.');

		return redirect(route('maestros.index'));
	}

	/**
	 * Remove the specified Maestro from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$maestro = $this->maestroRepository->findMaestroById($id);

		if(empty($maestro))
		{
			Flash::error('Maestro no encontrado');
			return redirect(route('maestros.index'));
		}

		$maestro->delete();

		Flash::message('Maestro deleted successfully.');

		return redirect(route('maestros.index'));
	}

}
