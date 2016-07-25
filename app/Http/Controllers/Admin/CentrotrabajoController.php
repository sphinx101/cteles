<?php namespace cteles\Http\Controllers\Admin;

use cteles\Http\Requests;
use cteles\Http\Controllers\Controller;

use cteles\Repositorios\CentrotrabajoRepo;
use Illuminate\Http\Request;

class CentrotrabajoController extends Controller {


	/**
	 * @var CentrotrabajoRepo
	 */
	private $ctRepo;

	function __construct(CentrotrabajoRepo $ctRepo){

		$this->ctRepo = $ctRepo;
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){
		$result=$this->ctRepo->all();

		return view('centrotrabajo.listCCT',compact('result'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
