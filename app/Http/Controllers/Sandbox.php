<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use App\Mail\InfoRequestReceived;
use App\Models\InfoRequest;

class Sandbox extends Controller
{
	/**
	 * generar un pdf y almacenarlo / descargarlo
	 */
	public function pdf()
	{
		$record = InfoRequest::find('1')->toArray();

		$html[] = '
		<html>
		<head>
		<style>
			body {
				font-family: sans-serif;
				color: #333;
			}
			h1 {
				color: darkgray;
				border-bottom: 4px solid #ddd;
			}
			.box {
				border:1px solid #ddd;
				background-color:#eee;
				padding: 1rem;
			}
		</style>
		</head>
		<body>

		<h1>Solicitud recibida</h1>
		';

		$html[] = '<div class="box">';
		foreach($record as $key=>$value) {
			$html[] = "<p><b>{$key}</b>:<br> {$value}</p>";
		}
		$html[] = '</div>';

		$html[] = '</html>';

		$path = storage_path("app/info_request_{$record['id']}.pdf");
		$pdf = App::make('dompdf.wrapper');
		$done = $pdf->loadHTML( implode("\n", $html) )->save($path);
		//dd(__METHOD__, $done);
		//return $pdf->stream();
	}

	/**
	 * probar envío de correo con attachment
	 */
	public function mailtrap()
	{
		$record = InfoRequest::find('1')->toArray();

		$mailable = new InfoRequestReceived($record);

		Mail::to('jaceldran@gmail.com')->send($mailable);

		dd(__METHOD__, $mailable);
	}
}
