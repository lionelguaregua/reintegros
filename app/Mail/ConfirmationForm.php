<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmationForm extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * The demo object instance.
     *
     * @var ObjAdministrativos;
     */
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

      $email = $this->view('mails.confirmacion')->subject('Quantico servicios de asistencia | Solicitud de reintegro recibida')->from('atencion.cliente@quanticoservicios.com');




        return $email;
    }
}
