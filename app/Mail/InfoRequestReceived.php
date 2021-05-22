<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\InfoRequest;

class InfoRequestReceived extends Mailable
{
	use Queueable, SerializesModels;

	public $subject = 'Solicitud recibida';

	public $info_request;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct(Array $info_request = [])
	{
		$this->info_request = $info_request;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		$path = $this->info_request['path'];

		if (file_exists($path)) {
			return $this->view('mails.info_request_received')
				->attach($path, [
					'as' => 'solicitud_recibida.pdf',
					'mime' => 'application/pdf'
				]);
		} else {
			dd("NOT_FOUND $path");
		}
	}
}
