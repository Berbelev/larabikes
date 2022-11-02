<?php

namespace App\Listeners;

use App\Events\FirstBikeCreated;
use Illuminate\Support\Facades\Mail;
use App\Mail\Congratulation;

class SendCongratulationEmail{


    /**
     * Handle the event.
     *
     * @param  \App\Events\FirstBikeCreated  $event
     * @return void
     */
    public function handle(FirstBikeCreated $event)    {
        Mail::to($event->user->email)->send(new Congratulation($event->bike));
    }
}
