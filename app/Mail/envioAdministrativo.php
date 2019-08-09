<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class envioAdministrativo extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * The demo object instance.
     *
     * @var ObjAdministrativos;
     */
    public $ObjAdministrativos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ObjAdministrativos)
    {
        //
        $this->ObjAdministrativos = $ObjAdministrativos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

      $email = $this->view('mails.infopago')->subject('Quantico servicios de asistencia | Nueva solicitud de pago')->from('atencion.cliente@quanticoservicios.com');




        return $email;
    }
}
