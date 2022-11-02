<?php

namespace App\Events;



use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Bike;
use App\Models\User;


class FirstBikeCreated{
    use Dispatchable, SerializesModels;

    public $bike, $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Bike $bike, User $user)
    {
        $this->bike = $bike;
        $this->user = $user;
    }


}
