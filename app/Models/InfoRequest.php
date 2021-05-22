<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use App\Mail\InfoRequestReceived;

class InfoRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'annual_income',
        'contact_name',
        'contact_phone',
        'contact_email',
        'message',
        'legal_terms',
        'is_managed',
    ];

    public function builPdfPath(Array $values)
    {
        return storage_path("app/info_request_{$values['id']}.pdf");
    }

    public function savePdf(Array $values)
    {
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
		foreach($values as $key=>$value) {
			$html[] = "<p><b>{$key}</b>:<br> {$value}</p>";
		}
		$html[] = '</div>';
		$html[] = '</html>';

		$path = $this->builPdfPath($values);
        $content = implode("\n", $html);
		$pdf = App::make('dompdf.wrapper');
		$done = $pdf->loadHTML($content)->save($path);

        return $done;
		// dd(__METHOD__, $done);
    }

	public function composePdf(Array $values)
	{
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
		foreach($values as $key=>$value) {
			$html[] = "<p><b>{$key}</b>:<br> {$value}</p>";
		}
		$html[] = '</div>';
		$html[] = '</html>';

		return implode("\n", $html);
	}

    public function notifyReceived(Array $values)
    {
        //$values = InfoRequest::find($id)->toArray();

        $this->savePdf($values);

		$mailable = new InfoRequestReceived([
            'path' => $this->builPdfPath($values),
            'values' => $values
        ]);

		Mail::to($values['contact_email'])->send($mailable);

		//dd(__METHOD__, $mailable);
    }
}
