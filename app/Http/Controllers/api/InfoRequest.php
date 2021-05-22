<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Models\InfoRequest as Model;
use App\Mail\InfoRequestReceived;

class InfoRequest extends Controller
{
	public function index(Request $request)
	{
		$model = new Model();


		if (!empty($request->search)) {
			return $model
				->where('company_name', 'like', '%'.$request->search.'%')
				->orWhere('contact_name', 'like', '%'.$request->search.'%')
				->orWhere('contact_email', 'like', '%'.$request->search.'%')
				->orderBy('id', 'desc')
				->get();
		}

		return $model
			->orderBy($request->order, $request->direction)
			->get();
	}

	public function store(Request $request)
	{
		$record = new Model();
		$record->company_name = $request->company_name;
		$record->annual_income = $request->annual_income;
		$record->contact_name = $request->contact_name;
		$record->contact_phone = $request->contact_phone;
		$record->contact_email = $request->contact_email;
		$record->message = $request->message;
		$record->legal_terms = $request->legal_terms;
		$record->is_managed = $request->is_managed;
		$record->save();

		$values = Model::find($record->id)->toArray();

		$record->notifyReceived($values);

		return $record;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		return Model::find($id);
	}

	// TODO: averiguar porqué esto no está funcionado
	public function toggle_is_managed($id)
	{
		$record = Model::find($id);
		$record->update([
			'company_name' => 'AAAAAA', // prueba update otro atributo
			'is_managed' => '1',
		]);

		return Model::find($id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$record = Model::find($id);
		$record->company_name = $request->company_name;
		$record->annual_income = $request->annual_income;
		$record->contact_name = $request->contact_name;
		$record->contact_phone = $request->contact_phone;
		$record->contact_email = $request->contact_email;
		$record->message = $request->message;
		$record->legal_terms = $request->lega_terms;
		$record->is_managed = $request->is_managed;
		$record->save();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
