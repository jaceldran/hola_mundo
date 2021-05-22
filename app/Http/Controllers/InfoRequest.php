<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InfoRequest as Model;
use Illuminate\Support\Facades\App;

class InfoRequest extends Controller
{
	function index()
	{
		return view('home');
	}

	function contact()
	{
		return view('contact');
	}

	function edit()
	{
		return view('contact');
	}

	function manage()
	{
		return view('manage');
	}

	function download($id)
	{
		$record = new Model();
		$path = $record->builPdfPath(['id'=>$id]);

		if (file_exists($path)) {
			// si el archivo existe lo carga en el navegador
			header('Content-Description: File Transfer');
			header('Content-Type: application/pdf');
			header('Content-Disposition: inline; filename="'.basename($path).'"');
			// descomentar estas líneas para forzar la descarga
			//header('Content-Type: application/octet-stream');
			//header('Content-Disposition: attachment; filename="'.basename($path).'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($path));
			readfile($path);
			exit;
		} else {
			// si no lo encuentra, lo renderiza y lo carga en el navegador
			$values = Model::find($id)->toArray();
			$html = $record->composePdf($values);
			$pdf = App::make('dompdf.wrapper');
			$pdf->loadHTML($html);
			return $pdf->stream();
		}
	}
}
