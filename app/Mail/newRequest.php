<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class newRequest extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * The demo object instance.
     *
     * @var ObjAdministrativos;
     */
    public $data2;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data2)
    {
        //
        $this->data2 = $data2;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

      $email = $this->view('mails.notificacion')->subject('Quantico servicios de asistencia | Nueva solicitud de reintegro via web')->from('atencion.cliente@quanticoservicios.com');




        return $email;
    }
}
