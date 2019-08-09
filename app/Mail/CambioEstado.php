<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CambioEstado extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * The demo object instance.
     *
     * @var ObjReintegros;
     */
    public $ObjReintegros;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ObjReintegros)
    {
        //
         $this->ObjReintegros = $ObjReintegros;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

         $email = $this->view('mails.estatus')->subject('Quantico servicios de asistencia | Su estatus de reembolso ha sido actualizado!')->from('atencion.cliente@quanticoservicios.com');

if ($this->ObjReintegros->files != NULL) {
    foreach($this->ObjReintegros->files as $file){
        $email->attach($file->getRealPath(),
            [
                    'as' => $file->getClientOriginalName(),
                    'mime' => $file->getClientMimeType(),
                ]);
    }
}
   

  


         return $email;
                   
    }
}
