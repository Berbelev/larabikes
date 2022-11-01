<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable{
    use Queueable, SerializesModels;

    public $mensaje; // Objeto que contendrá toda la info

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mensaje){

        $this->mensaje = $mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){

        // Prepara el email (sin fichero todavía)
        $email=$this->from($this->mensaje->email)
                    ->subject('Mensaje recibido:'.$this->mensaje->asunto)
                    ->with('centro', 'CIFO Sabadell')
                    ->view('emails.contact');

        // si hay un fichero, lo adjuntamos
        if($this->mensaje->fichero)
            $email->attach($this->mensaje->fichero,[
                'as' => 'adjunto_'.uniqid().'.pdf',  // nombre único
                'mime' => 'application/pdf',
            ]);

        return $email;

        /**  TODO:LAR.Ejercicio->nombre del fichero adjunto sea el nombre original, no uno generado.
         *   añadir propiedad al mensaje (nombre original)
         *   editar parámetro sel método attach()
         * */
    }
}
